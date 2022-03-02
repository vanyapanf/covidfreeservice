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
        $chartData = $this->getChartData();

        return view('web.admin.index', [
            'reports' => $reports,
            'chart_data' => json_encode($chartData)
        ]);
    }

    public function createPost(Request $request) {
        $path_to_file = '/path/to/file';//$request->file('document')->store('documents');

        $post = new Post(array(
            'user_id' => Auth::user()->id,
            'tag' => $request['tag'],
            'post_text' => $request['post_text'],
            'path_to_file' => $path_to_file
        ));

        $post->save();

        return redirect(route('admin'));
    }

    public function addAdmin(Request $request) {
        $selectedUser = User::where('id', $request['selected_user_id'])->latest()->first();

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

    public function getChartData() {
        $chart_data = array();

        for ($i = 0; $i < 7; $i++) {
            $date1 = Carbon::today()->subDays($i)->format('Y-m-d');
            $date2 = Carbon::today()->subDays($i+1)->format('Y-m-d');
            $chart_data[$date1] = Report::whereBetween('created_at', [$date1, $date2])->count();
        }

        return $chart_data;
    }
}
