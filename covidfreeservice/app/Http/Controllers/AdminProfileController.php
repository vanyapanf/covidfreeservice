<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Post;
use App\Models\Report;
use App\Models\Message;
use App\Models\TrackerInfo;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AdminProfileController extends Controller
{
    public function adminProfile($admin_id) {
        $user = User::where('id', $admin_id)->latest()->first();
        $reports = Report::where('status','report_in_progress')->where('admin_id',-1)->get();
        $chartData = $this->getChartData();

        return view('admin', [
            'user' => $user,
            'reports' => $reports,
            'chart_data' => json_encode($chartData)
        ]);
    }

    public function createPost($admin_id, Request $request) {
        $path_to_file = '/path/to/file';//$request->file('document')->store('documents');

        $post = new Post(array(
            'user_id' => $admin_id,
            'tag' => $request['tag'],
            'post_text' => $request['post_text'],
            'path_to_file' => $path_to_file
        ));

        $post->save();

        $user = User::where('id', $admin_id)->latest()->first();
        $reports = Report::where('status','report_in_progress')->where('admin_id','')->get();
        $chartData = $this->getChartData();

        return view('admin', [
            'user' => $user,
            'reports' => $reports,
            'chart_data' => json_encode($chartData)
        ]);
    }

    public function addAdmin($admin_id, Request $request) {
        $selectedUser = User::where('id', $request['selected_user_id'])->latest()->first();

        $selectedUser['is_admin'] = true;

        $selectedUser->save();

        $user = User::where('id', $admin_id)->latest()->first();
        $reports = Report::where('status','report_in_progress')->where('admin_id','')->get();
        $chartData = $this->getChartData();

        return view('admin', [
            'user' => $user,
            'reports' => $reports,
            'chart_data' => json_encode($chartData)
        ]);
    }

    public function acceptIllnessReport($admin_id, $report_id) {
        $report = Report::where('id', $report_id)->latest()->first();

        $report['admin_id'] = $admin_id;
        $report['status'] = 'accept';

        $report->save();

        $user = User::where('id', $report['user_id'])->latest()->first();

        $user['status'] = 'illness';

        $user->save();

        $user = User::where('id', $admin_id)->latest()->first();
        $reports = Report::where('status','report_in_progress')->where('admin_id','')->get();
        $chartData = $this->getChartData();

        return view('admin', [
            'user' => $user,
            'reports' => $reports,
            'chart_data' => json_encode($chartData)
        ]);
    }

    public function acceptRecoveryReport($admin_id, $report_id) {
        $report = Report::where('id', $report_id)->latest()->first();

        $report['admin_id'] = $admin_id;
        $report['status'] = 'accept';

        $report->save();

        $user = User::where('id', $report['user_id'])->latest()->first();

        TrackerInfo::where('tracker_id', $user['tracker_id'])->delete();
        $user['status'] = 'healthy';
        $user['tracker_id'] = '';

        $user->save();

        $admin = User::where('id', $admin_id)->latest()->first();
        $reports = Report::where('status','report_in_progress')->where('admin_id',-1)->get();
        $chartData = $this->getChartData();

        return view('admin', [
            'user' => $admin,
            'reports' => $reports,
            'chart_data' => json_encode($chartData)
        ]);
    }

    public function cancelReport($admin_id, $report_id, Request $request) {
        $report = Report::where('id', $report_id)->latest()->first();

        $report['admin_id'] = $admin_id;
        $report['status'] = 'cancel_report';

        $report->save();

        $message = new Message(array(
           'report_id' => $report_id,
           'user_id' => $admin_id,
           'message_text' => $request['message_text']
        ));

        $message->save();

        $user = User::where('id', $admin_id)->latest()->first();
        $reports = Report::where('status','report_in_progress')->where('admin_id',-1)->get();
        $chartData = $this->getChartData();

        return view('admin', [
            'user' => $user,
            'reports' => $reports,
            'chart_data' => json_encode($chartData)
        ]);
    }

    public function viewReportDoc($admin_id, $report_id) {
        $report = Report::where('id', $report_id)->latest()->first();

        $url_to_doc = Storage::url($report['path_to_doc']);

        return view('admin', [
            'url_to_doc' => $url_to_doc
        ]);
    }

    public function openMessages($admin_id, $report_id) {
        $messages = Message::where('report_id', $report_id)->get();

        return view('admin', [
            'messages' => $messages
        ]);
    }

    public function createMessage($admin_id, $report_id, Request $request) {

        $message = new Message(array(
            'report_id' => $report_id,
            'user_id' => $admin_id,
            'message_text' => $request['message_text']
        ));

        $message->save();

        $messages = Message::where('report_id', $report_id)->get();

        return view('admin', [
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
