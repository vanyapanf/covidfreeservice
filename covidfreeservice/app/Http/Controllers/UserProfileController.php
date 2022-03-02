<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Report;
use App\Models\Message;
use App\Models\TrackerInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserProfileController extends Controller
{
    public function userProfile() {
        $last_report = Report::where('user_id', Auth::user()->id)->latest()->first();

        $tracker_cards = TrackerInfo::where('tracker_id', Auth::user()->tracker_id)->get();

        return view('web.user.index', [
            'last_report' => $last_report,
            'tracker_cards' => $tracker_cards
        ]);
    }

    public function createTrackerCard(Request $request) {
        $trackerInfo = new TrackerInfo(array(
            'tracker_id' => Auth::user()->tracker_id,
            'temperature' => $request['temperature'],
            'health_rate' => $request['health_rate']
        ));

        $trackerInfo->save();

        return redirect(route('user'));
    }
}
