<?php

namespace App\Http\Controllers;

use App\Models\Report;
use App\Models\TrackerInfo;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ReportProcessController extends Controller
{
    public function reportProcess() {
        $active_reports = Report::where('status','report_in_progress')->where('admin_id',-1)->get();
        $canceled_reports = Report::where('status','cancel_report')->where('admin_id', Auth::user()->id)->get();

        return view('web.report_process.index', [
            'active_reports' => $active_reports,
            'canceled_reports' => $canceled_reports
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

    public function viewReportDoc($report_id) {
        $report = Report::where('id', $report_id)->latest()->first();

        $url_to_doc = Storage::url($report['path_to_doc']);

        return view('web.admin.index', [
            'url_to_doc' => $url_to_doc
        ]);
    }
}
