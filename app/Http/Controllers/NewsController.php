<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NewsController extends Controller
{
    function index()
    {
        $topStory = [];
        return view('news.index', [
            'title' => 'Its a place for designer',
            'nav' => 'news',
            'path' => 'fresh',
            'topStory' => $topStory
        ]);
    }

    //news
    function timelines()
    {
        $id = Auth::id();
        $topStory = [];
        return view('news.index', [
            'title' => 'Timelines',
            'nav' => 'news',
            'path' => 'timelines',
            'topStory' => $topStory
        ]);
    }
    function popular()
    {
        $topStory = [];
        return view('news.index', [
            'title' => 'Popular',
            'nav' => 'news',
            'path' => 'popular',
            'topStory' => $topStory
        ]);
    }
    function fresh()
    {
        $topStory = [];
        return view('news.index', [
            'title' => 'Fresh',
            'nav' => 'news',
            'path' => 'fresh',
            'topStory' => $topStory
        ]);
    }
    function trending()
    {
        $topStory = [];
        return view('news.index', [
            'title' => 'Trending',
            'nav' => 'news',
            'path' => 'trending',
            'topStory' => $topStory
        ]);
    }
}
