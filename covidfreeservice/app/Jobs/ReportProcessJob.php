<?php

namespace App\Jobs;

// для распознавания текста в документах
use Imagick;
use thiagoalessio\TesseractOCR\TesseractOCR;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\Report;
use App\Models\TrackerInfo;
use App\Models\User;

class ReportProcessJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $report_id;
    private $path_to_doc;

    public function __construct($report_id, $path_to_doc)
    {
        $this->report_id = $report_id;
        $this->path_to_doc = $path_to_doc;
    }

    public function handle()
    {
        $report = Report::where('id', $this->report_id)->first();

        if ($report) {
            $full_path_to_doc = storage_path().'\\app\\'.str_replace("/",'\\',$this->path_to_doc);

            // если пдф, преобразуем в jpg
            if (strpos($report->path_to_doc, '.pdf')) {
                $imagick = new Imagick();
                $imagick->setResolution(300, 300);
                $imagick->readImage($full_path_to_doc);
                $imagick->setImageCompressionQuality(100);
                $full_path_to_doc = str_replace('.pdf','.jpg', $full_path_to_doc);
                $imagick->writeImages($full_path_to_doc, true);
            }

            //TODO: если возможно придумать как сделать перевод на 2 языка
            // распознавание текста
            $recognized_text = (new TesseractOCR($full_path_to_doc))
                ->lang('rus'/*, 'eng'*/)
                ->run();
            $report_info = [];
            $report_reason = 'is_ok';
            $report_is_ok = true;

            // результат теста
            //TODO: придумать регулярку для обнар необнар и тд
            if ($report->type == 'illness'
                && preg_match('/ (О|о)бнар(ужена|ужено|ужен|) | (П|п)оложительн(ый|ая|ое|) /', $recognized_text)
                && !preg_match('/ (Н|н)е обнар(ужена|ужено|ужен|) | (О|о)трицательн(ый|ая|ое|) /', $recognized_text)){
                $report_info['detected'] = true;
            }
            else if ($report->type == 'recovery'
                && preg_match('/ (Н|н)е обнар(ужена|ужено|ужен|) | (О|о)трицательн(ый|ая|ое|) /', $recognized_text)){
                $report_info['detected'] = false;
            }
            else {
                $report_reason = 'тип справки не найден';
                $report_is_ok = false;
            }

            // дата теста
            $date_regex = '/\d{1,2}\.\d{1,2}\.\d{2,4}|\d{1,2}-\d{1,2}-\d{2,4}/';
            preg_match_all($date_regex, $recognized_text, $date_arr);
            $report_date = strtotime($report->created_at);
            //TODO: потом изменить на 30 дней
            $nearest_date = strtotime('-365 days', $report_date);
            foreach ($date_arr[0] as $date_str) {
                $date = strtotime($date_str);
                if ($date <= $report_date
                    && $report_date - $date < $report_date - $nearest_date) {
                    $nearest_date = $date;
                }
            }
            //TODO: потом изменить на 30 дней
            if ($nearest_date != strtotime('-365 days', $report_date)) {
                $report_info['date'] = date('Y-m-d H:i:s', $nearest_date);
            }
            else {
                $report_reason = 'дата справки не найдена';
                $report_is_ok = false;
            }

            // пользователь теста
            $user = User::where('id', $report->user_id)->first();
            if (strpos($recognized_text, $user['name']) && strpos($recognized_text, $user['surname'])) {
                $report_info['username'] = $user['name'].' '.$user['surname'];
            }
            $oms_regex = '/Полис ОМС : \d{16}/';
            if (preg_match($oms_regex, $recognized_text, $oms_match)) {
                $report_info['oms'] = $oms_match;
            }
            if (!isset($report_info['username']) && !isset($report_info['oms'])) {
                $report_reason = 'данные пользователя не найдены';
                $report_is_ok = false;
            }

            if ($report_is_ok) {
                $report['admin_id'] = -1;
                $report['status'] = 'accept';
                $report['report_info'] = serialize($report_info);
                $report->save();

                $user = User::where('id', $report['user_id'])->latest()->first();
                if ($report['type'] == 'illness') {
                    $user['status'] = 'illness';
                }
                else {
                    TrackerInfo::where('tracker_id', $user['tracker_id'])->delete();
                    $user['status'] = 'healthy';
                    $user['tracker_id'] = NULL;
                }
                $user->save();
            }
            else {
                $report = Report::where('id', $report['id'])->latest()->first();
                $report['admin_id'] = -1;
                $report['status'] = 'cancel_report';
                $report['reason'] = $report_reason;
                $report['report_info'] = serialize($report_info);
                $report->save();
            }
            return 0;
        }
        return -1;
    }
}
