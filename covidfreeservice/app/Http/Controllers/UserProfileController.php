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
        $user = User::where('user_id', $user_id)->last();
        $tracker_cards = TrackerInfo::where('tracker_id', $user['tracker_id'])->get();

        return view('user', [
            'user' => $user,
            'tracker_cards' => $tracker_cards
        ]);
    }

    public function openMessages($user_id) {
        $report = Report::where('user_id', $user_id)->last();

        $messages = Message::where('report_id', $report['id'])->get();

        return view('user', [
            'messages' => $messages
        ]);
    }

    public function createMessage($user_id, $message_text) {
        $report = Report::where('user_id', $user_id)->last();

        $message = new Message(array(
            'report_id' => $report['id'],
            'user_id' => $user_id,
            'message_text' => $message_text
        ));

        $message->save();

        $messages = Message::where('report_id', $report['id'])->get();

        return view('user', [
            'messages' => $messages
        ]);
    }

    public function createTrackerCard($user_id, $card_info) {
        $user = User::where('id', $user_id)->last();

        $trackerInfo = new TrackerInfo(array(
            'tracker_id' => $user['tracker_id'],
            'temperature' => $card_info['temperature'],
            'health_rate' => $card_info['health_rate']
        ));

        $trackerInfo->save();

        $tracker_cards = TrackerInfo::where('tracker_id', $user['tracker_id'])->get();

        return view('user', [
            'tracker_cards' => $tracker_cards
        ]);
    }
}
