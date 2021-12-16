<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Report;
use App\Models\Message;
use App\Models\TrackerInfo;
use Illuminate\Http\Request;

class UserProfileController extends Controller
{
    public function userProfile($user_id) {
        $user = User::where('id', $user_id)->latest()->first();

        $last_report = Report::where('user_id', $user_id)->latest()->first();

        $tracker_cards = TrackerInfo::where('tracker_id', $user['tracker_id'])->get();


        return view('user', [
            'user' => $user,
            'last_report' => $last_report,
            'tracker_cards' => $tracker_cards
        ]);
    }

    public function openMessages($user_id) {
        $report = Report::where('user_id', $user_id)->latest()->first();

        $messages = Message::where('report_id', $report['id'])->get();

        return view('user', [
            'messages' => $messages
        ]);
    }

    public function createMessage($user_id, Request $request) {
        $report = Report::where('user_id', $user_id)->latest()->first();

        $message = new Message(array(
            'report_id' => $report['id'],
            'user_id' => $user_id,
            'message_text' => $request['message_text']
        ));

        $message->save();

        $messages = Message::where('report_id', $report['id'])->get();

        return view('user', [
            'messages' => $messages
        ]);
    }

    public function createTrackerCard($user_id, Request $request) {
        $user = User::where('id', $user_id)->latest()->first();

        $trackerInfo = new TrackerInfo(array(
            'tracker_id' => $user['tracker_id'],
            'temperature' => $request['temperature'],
            'health_rate' => $request['health_rate']
        ));

        $trackerInfo->save();

        $last_report = Report::where('user_id', $user_id)->latest()->first();

        $tracker_cards = TrackerInfo::where('tracker_id', $user['tracker_id'])->get();

        return view('user', [
            'user' => $user,
            'last_report' => $last_report,
            'tracker_cards' => $tracker_cards
        ]);
    }
}
