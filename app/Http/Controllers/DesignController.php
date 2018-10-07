<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\StoryModel;

class DesignController extends Controller
{
    function index()
    {
        $topStory = StoryModel::PagAllStory(20);
        return view('design.index', [
            'title' => 'Its a place for designer',
            'nav' => 'designs',
            'path' => 'fresh',
            'topStory' => $topStory
        ]);
    }

    //design
    function timelines()
    {
        $id = Auth::id();
        $profile = FollowModel::GetAllFollowing($id);
        $topStory = StoryModel::PagTimelinesStory(20, $profile);
        return view('design.index', [
            'title' => 'Timelines',
            'nav' => 'designs',
            'path' => 'timelines',
            'topStory' => $topStory
        ]);
    }
    function popular()
    {
        $topStory = StoryModel::PagPopularStory(20);
        return view('design.index', [
            'title' => 'Popular',
            'nav' => 'designs',
            'path' => 'popular',
            'topStory' => $topStory
        ]);
    }
    function fresh()
    {
        $topStory = StoryModel::PagAllStory(20);
        return view('design.index', [
            'title' => 'Fresh',
            'nav' => 'designs',
            'path' => 'fresh',
            'topStory' => $topStory
        ]);
    }
    function trending()
    {
        $topStory = StoryModel::PagTrendingStory(20);
        return view('design.index', [
            'title' => 'Trending',
            'nav' => 'designs',
            'path' => 'trending',
            'topStory' => $topStory
        ]);
    }
    function trending()
    {
        $topStory = StoryModel::PagTrendingStory(20);
        return view('design.index', [
            'title' => 'Trending',
            'nav' => 'designs',
            'path' => 'trending',
            'topStory' => $topStory
        ]);
    }
}
