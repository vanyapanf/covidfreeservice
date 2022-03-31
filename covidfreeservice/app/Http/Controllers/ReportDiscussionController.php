<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\Report;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReportDiscussionController extends Controller
{
    public function reportDiscussion($report_id) {
        $report = Report::where('id', $report_id)->latest()->first();

        $messages = Message::where('report_id', $report_id)->get();

        return view('web.report_discussion.index', [
            'report' => $report,
            'messages' => $messages
        ]);
    }

    public function createMessage($report_id, Request $request) {
       if (Message::where('report_id', $report_id)->get()->isEmpty()) {
            $report = Report::where('id', $report_id)->latest()->first();
            $report['status'] = 'in_discussion';

            $report->save();
        }

        $message = new Message(array(
            'report_id' => $report_id,
            'user_id' => Auth::user()->id,
            'message_text' => $request['message_text']
        ));

        $message->save();

        return redirect(route('report_discussion', ['report_id' => $report_id]));
    }

    public function getMessages($report_id, Request $request) {
        $messages = Message::where('report_id', $report_id)->get();

        redirect(route('report_discussion', ['report_id' => $report_id]));
    }
}
