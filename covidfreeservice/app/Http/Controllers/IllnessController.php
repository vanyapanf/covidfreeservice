<?php

namespace App\Http\Controllers;

use App\Models\Report;
use App\Models\User;
use Illuminate\Http\Request;

class IllnessController extends Controller
{
    public function illness($user_id) {
        $user = User::where('user_id', $user_id)->last();

        return view('illness', [
            'user' => $user
        ]);
    }

    public function createIllnessReport($user_id, $has_tracker) {
        $illnessReport = new Report(array(
            'user_id' => $user_id,
            'type' => 'illness',
            'status' => 'unconfirmed_report'
        ));

        $illnessReport->save();

        $user = User::where('user_id', $user_id)->last();

        if ($has_tracker) {
            $user['tracker_id'] = uniqid();

            $user->save();
        }

        return view('illness', [
            'user' => $user
        ]);
    }

    public function addConfirmToIllnessReport($user_id, Request $request) {
        $path_to_doc = $request->file('document')->store('documents');

        $illnessReport = Report::where('user_id', $user_id)->last();

        $illnessReport['status'] = 'report_in_progress';
        $illnessReport['$path_to_doc'] = $path_to_doc;

        $illnessReport->save();

        $user = User::where('user_id', $user_id)->last();

        return view('illness', [
            'user' => $user
        ]);
    }
}
