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
        $user = User::where('id', $admin_id)->last();
        $reports = Report::where('status','report_in_progress')->where('admin_id','')->get();
        $chartData = $this->getChartData();
        return view('admin', [
            'user' => $user,
            'reports' => $reports,
            'chart_data' => $chartData
        ]);
    }

    public function createPost($admin_id, $tag, $text, Request $request) {
        $path_to_file = $request->file('document')->store('documents');

        $post = new Post(array(
            'user_id' => $admin_id,
            'tag' => $tag,
            'text' => $text,
            'path_to_file' => $path_to_file
        ));

        $post->save();

        $user = User::where('id', $admin_id)->last();
        $reports = Report::where('status','report_in_progress')->where('admin_id','')->get();
        $chartData = $this->getChartData();

        return view('admin', [
            'user' => $user,
            'reports' => $reports,
            'chart_data' => $chartData
        ]);
    }

    public function addAdmin($admin_id, $selected_user_id) {
        $selectedUser = User::where('id', $selected_user_id)->last();

        $selectedUser['is_admin'] = 'yes';

        $selectedUser->save();

        $user = User::where('id', $admin_id)->last();
        $reports = Report::where('status','report_in_progress')->where('admin_id','')->get();
        $chartData = $this->getChartData();

        return view('admin', [
            'user' => $user,
            'reports' => $reports,
            'chart_data' => $chartData
        ]);
    }

    public function acceptIllnessReport($admin_id, $report_id) {
        $report = Report::where('id', $report_id);

        $report['admin_id'] = $admin_id;
        $report['status'] = 'accept';

        $report->save();

        $user = User::where('id', $report['user_id'])->last();

        $user['status'] = 'illness';

        $user->save();

        $user = User::where('id', $admin_id)->last();
        $reports = Report::where('status','report_in_progress')->where('admin_id','')->get();
        $chartData = $this->getChartData();

        return view('admin', [
            'user' => $user,
            'reports' => $reports,
            'chart_data' => $chartData
        ]);
    }

    public function acceptRecoveryReport($admin_id, $report_id) {
        $report = Report::where('id', $report_id);

        $report['admin_id'] = $admin_id;
        $report['status'] = 'accept';

        $report->save();

        $user = User::where('id', $report['user_id'])->last();

        $user['status'] = 'healthy';
        $user['tracker_id'] = '';

        $user->save();

        $deleted_tracker_info = TrackerInfo::where('tracker_id', $user['tracker_id']);

        $admin = User::where('id', $admin_id)->last();
        $reports = Report::where('status','report_in_progress')->where('admin_id','')->get();
        $chartData = $this->getChartData();

        return view('admin', [
            'user' => $admin,
            'reports' => $reports,
            'chart_data' => $chartData
        ]);
    }

    public function cancelReport($admin_id, $report_id, $message_text) {
        $report = Report::where('id', $report_id);

        $report['admin_id'] = $admin_id;
        $report['status'] = 'report_in_progress';

        $report->save();

        $message = new Message(array(
           'report_id' => $report_id,
           'user_id' => $admin_id,
           'message_text' => $message_text
        ));

        $message->save();

        $user = User::where('id', $admin_id)->last();
        $reports = Report::where('status','report_in_progress')->where('admin_id','')->get();
        $chartData = $this->getChartData();

        return view('admin', [
            'user' => $user,
            'reports' => $reports,
            'chart_data' => $chartData
        ]);
    }

    public function viewReportDoc($report_id) {
        $report = Report::where('id', $report_id);

        $doc = Storage::get($report['path_to_doc']);

        return view('admin', [
            'doc' => $doc
        ]);
    }

    public function openMessages($report_id) {
        $messages = Message::where('report_id', $report_id)->get();

        return view('admin', [
            'messages' => $messages
        ]);
    }

    public function createMessage($admin_id, $report_id, $message_text) {

        $message = new Message(array(
            'report_id' => $report_id,
            'user_id' => $admin_id,
            'message_text' => $message_text
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
            $date = Carbon::today()->subDays($i)->format('Y-m-d');
            $chart_data[$date] = Report::where('created_at', $date)->get()->count();
        }

        return $chart_data;
    }
}
