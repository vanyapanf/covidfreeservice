<?php

namespace App\Http\Controllers;

use App\Models\Report;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Jobs\ReportProcessJob;

class RecoveryController extends Controller
{
    public function recovery() {
        return view('web.recovery.index');
    }

    public function createRecoveryReport() {
        if ($_POST['action'] == 'Add') {
            $recoveryReport = new Report(array(
                'user_id' => Auth::user()->id,
                'type' => 'recovery',
                'status' => 'unconfirmed_report',
                'path_to_doc' => '',
                'admin_id' => -1
            ));

            $recoveryReport->save();
        }
        else if ($_POST['action'] == 'Cancel') {
            Report::where('user_id', Auth::user()->id)->latest()->first()->delete();
        }

        return view('web.recovery.index');
    }

    public function addConfirmToRecoveryReport(Request $request) {
        $path_to_doc = $request->file('doc')->store('public');

        $recoveryReport = Report::where('user_id', Auth::user()->id)->latest()->first();

        $recoveryReport['status'] = 'report_in_progress';
        $recoveryReport['path_to_doc'] = $path_to_doc;

        $recoveryReport->save();

        ReportProcessJob::dispatch($recoveryReport['id'], $path_to_doc);

        return view('web.recovery.index');
    }
}
