<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LiveController extends Controller
{
    function index()
    {
        $topStory = [];
        return view('live.index', [
            'title' => 'Its a place for designer',
            'nav' => 'lives',
            'path' => 'fresh',
            'topStory' => $topStory
        ]);
    }

    //live
    function timelines()
    {
        $id = Auth::id();
        $topStory = [];
        return view('live.index', [
            'title' => 'Timelines',
            'nav' => 'lives',
            'path' => 'timelines',
            'topStory' => $topStory
        ]);
    }
    function popular()
    {
        $topStory = [];
        return view('live.index', [
            'title' => 'Popular',
            'nav' => 'lives',
            'path' => 'popular',
            'topStory' => $topStory
        ]);
    }
    function fresh()
    {
        $topStory = [];
        return view('live.index', [
            'title' => 'Fresh',
            'nav' => 'lives',
            'path' => 'fresh',
            'topStory' => $topStory
        ]);
    }
    function trending()
    {
        $topStory = [];
        return view('live.index', [
            'title' => 'Trending',
            'nav' => 'lives',
            'path' => 'trending',
            'topStory' => $topStory
        ]);
    }

    function makeApps()
    {
        return view('featured.makeapps', [
            'title' => 'Make Apps',
            'nav' => 'makeapps',
            'path' => 'makeapps',
        ]);
    }
}
