<?php

namespace App\Http\Controllers;

use App\Models\Report;
use App\Models\User;
use Illuminate\Http\Request;

class RecoveryController extends Controller
{
    public function recovery($user_id) {
        $user = User::where('user_id', $user_id)->last();

        return view('recovery', [
            'user' => $user
        ]);
    }

    public function createRecoveryReport($user_id) {
        $recoveryReport = new Report(array(
            'user_id' => $user_id,
            'type' => 'recovery',
            'status' => 'unconfirmed_report'
        ));

        $recoveryReport->save();

        $user = User::where('user_id', $user_id)->last();

        $user['tracker_id'] = '';

        $user->save();

        return view('recovery', [
            'user' => $user
        ]);
    }

    public function addConfirmToRecoveryReport($user_id, Request $request) {
        $path_to_doc = $request->file('document')->store('documents');

        $recoveryReport = Report::where('user_id', $user_id)->last();

        $recoveryReport['status'] = 'report_in_progress';
        $recoveryReport['$path_to_doc'] = $path_to_doc;

        $recoveryReport->save();

        $user = User::where('user_id', $user_id)->last();

        return view('recovery', [
            'user' => $user
        ]);
    }
}
