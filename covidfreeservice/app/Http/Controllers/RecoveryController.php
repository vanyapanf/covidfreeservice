<?php

namespace App\Http\Controllers;

use App\Models\Report;
use App\Models\User;
use Illuminate\Http\Request;

class RecoveryController extends Controller
{
    public function recovery() {
        return view('web.recovery.index');
    }

    public function createRecoveryReport() {
        $recoveryReport = new Report(array(
            'user_id' => Auth::user()->id,
            'type' => 'recovery',
            'status' => 'unconfirmed_report',
            'path_to_doc' => '',
            'admin_id' => -1
        ));

        $recoveryReport->save();

        return view('web.recovery.index');
    }

    public function addConfirmToRecoveryReport(Request $request) {
        $path_to_doc = $request->file('doc')->store('public');

        $recoveryReport = Report::where('user_id', Auth::user()->id)->latest()->first();

        $recoveryReport['status'] = 'report_in_progress';
        $recoveryReport['path_to_doc'] = $path_to_doc;

        $recoveryReport->save();

        return view('web.recovery.index');
    }
}
