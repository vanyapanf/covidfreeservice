<?php

namespace App\Http\Controllers;

use App\Models\Report;
use App\Models\TrackerInfo;
use App\Models\User;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Collection;

class ReportProcessController extends Controller
{
    public function reportProcess() {
        $canceled_reports = Report::where('status','in_discussion')->where('admin_id', Auth::user()->id)->get();
        $new_canceled_reports = new Collection();

        if (count($canceled_reports) < 5) {
            $new_canceled_reports = Report::where('status','in_discussion')->where('admin_id', -1)->take(5 - count($canceled_reports))->get();
            array_walk($new_canceled_reports, function($item, $key) { $item['admin_id'] = Auth::user()->id; });
        }

        return view('web.report_process.index', [
            //'active_reports' => $active_reports,
            'canceled_reports' => $canceled_reports->merge($new_canceled_reports)
        ]);
    }

    public function acceptReport($report_id) {
        $report = Report::where('id', $report_id)->latest()->first();

        $report['admin_id'] = Auth::user()->id;
        $report['status'] = 'accept';

        $report->save();

        $user = User::where('id', $report['user_id'])->latest()->first();

        if ($report['type'] == 'illness') {
            $user['status'] = 'illness';
        }
        else {
            TrackerInfo::where('tracker_id', $user['tracker_id'])->delete();
            $user['status'] = 'healthy';
            $user['tracker_id'] = '';
        }

        $user->save();

        return redirect(route('report_process'));
    }

    public function cancelReport($report_id, Request $request) {
        $report = Report::where('id', $report_id)->latest()->first();

        $report['admin_id'] = Auth::user()->id;
        $report['status'] = 'cancel_report';

        $report->save();

        $message = new Message(array(
            'report_id' => $report_id,
            'user_id' => Auth::user()->id,
            'message_text' => $request['message_text']
        ));

        $message->save();

        return redirect(route('report_process'));
    }

    public function closeDiscussion($report_id) {
        $report = Report::where('id', $report_id)->latest()->first();

        $report['status'] = 'cancel_report';

        $report->save();

        return redirect(route('report_process'));
    }
}
