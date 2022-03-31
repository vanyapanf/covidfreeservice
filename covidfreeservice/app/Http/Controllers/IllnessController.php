<?php

namespace App\Http\Controllers;

use App\Models\Report;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Jobs\ReportProcessJob;

class IllnessController extends Controller
{
    public function illness() {
        return view('web.illness.index');
    }

    public function createIllnessReport(Request $request) {
        $illnessReport = new Report(array(
            'user_id' => Auth::user()->id,
            'type' => 'illness',
            'status' => 'unconfirmed_report',
            'path_to_doc' => '',
            'admin_id' => -1
        ));

        $illnessReport->save();

        $user = User::where('id', Auth::user()->id)->latest()->first();

        if ($request['has_tracker']) {
            $user['tracker_id'] = uniqid();

            $user->save();
        }

        return view('web.illness.index');
    }

    public function addConfirmToIllnessReport(Request $request) {
        $path_to_doc = $request->file('doc')->store('public');

        $illnessReport = Report::where('user_id', Auth::user()->id)->latest()->first();

        $illnessReport['status'] = 'report_in_progress';
        $illnessReport['path_to_doc'] = $path_to_doc;

        $illnessReport->save();

        ReportProcessJob::dispatch($illnessReport['id'], $path_to_doc);

        return view('web.illness.index');
    }
}
