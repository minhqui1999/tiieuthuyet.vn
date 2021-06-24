<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;
use App\Story;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Controllers\StoryController;
use App\Http\Controllers\ChapterController;

class DashboardController extends Controller
{
    public function search(Request $request)
    {
        if($request->get('type') == 'story'){
            return StoryController::dashboardSearch($request->get('q'),1);
        }
        else if($request->get('type') == 'all'){
            return StoryController::dashboardSearch($request->get('q'),2);
        }
        else if($request->get('type') == 'story_check'){
            return StoryController::dashboardSearch($request->get('q'),0);
        }
        else
        {
            return ChapterController::dashboardSearch($request->get('q'));
        }
    }

    public function index()
    {
        if(Auth::user()->isAdmin())
        {
            $story = Story::get();
            return view('admin.dashboard',compact('story'));
        }
        else
        {
            return view('admin.dashboard');
        }
        
    }

    public function password()
    {
        return view('admin.user.password');
    }

    public function changeName()
    {
        return view('admin.user.name');
    }
}
