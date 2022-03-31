<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Post;
use App\Models\Report;
use App\Models\Message;
use App\Models\TrackerInfo;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AdminProfileController extends Controller
{
    public function adminProfile() {
        $reports = Report::where('status','report_in_progress')->where('admin_id',-1)->get();

        $chart_illness_data = array();
        $chart_recovery_data = array();
        for ($i = 0; $i < 7; $i++) {
            $date1 = Carbon::today()->subDays($i+1)->toDateString();
            $date2 = Carbon::today()->subDays($i)->toDateString();
            $chart_illness_data[$date1] = Report::where('type', 'illness')->whereBetween('created_at', [$date1, $date2])->get()->count();
            $chart_recovery_data[$date1] = Report::where('type', 'recovery')->whereBetween('created_at', [$date1, $date2])->get()->count();
        }

        return view('web.admin.index', [
            'reports' => $reports,
            'chart_illness_data' => json_encode($chart_illness_data),
            'chart_recovery_data' => json_encode($chart_recovery_data)
        ]);
    }

    public function createPost(Request $request) {
        $path_to_img = 0;

        if ($request->file('image')) {
            $path_to_img = $request->file('image')->store('public');
        }

        $post = new Post(array(
            'user_id' => Auth::user()->id,
            'title' => $request['title'],
            'post_text' => $request['post_text'],
            'path_to_img' => $path_to_img
        ));

        $post->save();

        return redirect(route('admin'));
    }

    public function addAdmin(Request $request) {
        $selectedUser = User::where('email', $request['email'])->latest()->first();

        $selectedUser['is_admin'] = true;

        $selectedUser->save();

        return redirect(route('admin'));
    }

    public function openMessages($report_id) {
        $messages = Message::where('report_id', $report_id)->get();

        return view('web.admin.index', [
            'messages' => $messages
        ]);
    }

    public function createMessage($report_id, Request $request) {

        $message = new Message(array(
            'report_id' => $report_id,
            'user_id' => Auth::user()->id,
            'message_text' => $request['message_text']
        ));

        $message->save();

        $messages = Message::where('report_id', $report_id)->get();

        return view('web.admin.index', [
            'messages' => $messages
        ]);
    }
}
