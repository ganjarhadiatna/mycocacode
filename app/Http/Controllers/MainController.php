<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\StoryModel;
use App\ProfileModel;
use App\TagModel;
use App\ImageModel;
use App\FollowModel;
use App\BookmarkModel;

class MainController extends Controller
{
    public function imageAll()
    {
        $rest = ImageModel::GetAllImages();
        foreach ($rest as $dt) {
            $img = asset('/story/covers/'.$dt->image);
            $wd = getImageSize($img)[0];
            $hg = getImageSize($img)[1];
            $data = [
                'width' => $wd,
                'height' => $hg
            ];
            $r = ImageModel::UpdateImage($data, $dt->idimage);
            if ($r) {
                echo "sized<br>";
            } else {
                echo "unsized<br>";
            }
        }
    }
    
    function index()
    {
        $topStory = StoryModel::PagAllStory(20);
        return view('home.landing', [
            'title' => 'Its a place for designer',
            'path' => 'fresh',
            'topStory' => $topStory
        ]);
    }
    function timelines()
    {
        $id = Auth::id();
        $profile = FollowModel::GetAllFollowing($id);
        $topStory = StoryModel::PagTimelinesStory(20, $profile);
        return view('home.landing', [
            'title' => 'Timelines',
            'path' => 'timelines',
            'topStory' => $topStory
        ]);
    }
    function popular()
    {
        $topStory = StoryModel::PagPopularStory(20);
        return view('home.landing', [
            'title' => 'Popular',
            'path' => 'popular',
            'topStory' => $topStory
        ]);
    }
    function fresh()
    {
        $topStory = StoryModel::PagAllStory(20);
        return view('home.landing', [
            'title' => 'Fresh',
            'path' => 'fresh',
            'topStory' => $topStory
        ]);
    }
    function trending()
    {
        $topStory = StoryModel::PagTrendingStory(20);
        return view('home.landing', [
            'title' => 'Trending',
            'path' => 'trending',
            'topStory' => $topStory
        ]);
    }

    function collections()
    {
        if (Auth::id()) {
            $id = Auth::id();
        } else {
            $id = 0;
        }
        $topStory = StoryModel::PagAllStory(20);
        $topTags = TagModel::TopTags();
        $allTags = TagModel::AllTags();
        $topUsers = ProfileModel::TopUsers($id, 7);
        return view('collections.index', [
            'title' => 'Collections',
            'path' => 'collections',
            'topStory' => $topStory,
            'topTags' => $topTags,
            'allTags' => $allTags,
            'topUsers' => $topUsers
        ]);
    }
    function collectionsId($ctr)
    {
        return view('others.index', ['title' => 'Collections', 'path' => 'collections']);
    }
    function tagsId($ctr)
    {
        $topStory = StoryModel::PagTagStory($ctr, 12);
        return view('others.index', [
            'title' => $ctr,
            'path' => 'none',
            'topStory' => $topStory
        ]);
    }
    function ctrId($ctr)
    {
        $topStory = StoryModel::PagCtrStory($ctr, 12);
        return view('others.index', [
            'title' => 'Category '.$ctr,
            'path' => 'none',
            'topStory' => $topStory
        ]);
    }
    function ctr()
    {
        if (Auth::id()) {
            $id = Auth::id();
        } else {
            $id = 0;
        }
        $allTags = TagModel::AllTags();
        $topUsers = ProfileModel::TopUsers($id, 8);
        $topTags = TagModel::TopSmallTags();
        return view('main.category', [
            'title' => 'Categories ',
            'path' => 'category',
            'topUsers' => $topUsers,
            'topTags' => $topTags,
            'allTags' => $allTags
        ]);
    }
    
    function search($ctr)
    {
        if (Auth::id()) {
            $id = Auth::id();   
        } else {
            $id = 0;
        }
        if (!empty($ctr)) {
            //$ctr = $_GET['q'];

            $topStory = StoryModel::PagSearchStory($ctr, 20);
            $topUsers = ProfileModel::SearchUsers($ctr, $id);
            $topTags = TagModel::SearchTags($ctr);
            return view('search.index', [
                'title' => $ctr,
                'ctr' => $ctr,
                'path' => 'home-search',
                'topStory' => $topStory,
                'topUsers' => $topUsers,
                'topTags' => $topTags
            ]);

        } else {
            $trendingTags = TagModel::TopSmallTags();
            $topStory = StoryModel::PagTrendingStory(20);
            return view('search.index', [
                'title' => 'Search',
                'ctr' => '',
                'path' => 'home-search',
                'trendingTags' => $trendingTags,
                'topStory' => $topStory
            ]);
        }
    }
    function searchNormal()
    {
        if (Auth::id()) {
            $id = Auth::id();   
        } else {
            $id = 0;
        }
        if (isset($_GET['q'])) {
            $ctr = $_GET['q'];   

            $topStory = StoryModel::PagSearchStory($ctr, 20);
            $topUsers = ProfileModel::SearchUsers($ctr, $id);
            $topTags = TagModel::SearchTags($ctr);
            return view('search.index', [
                'title' => $ctr,
                'ctr' => $ctr,
                'path' => 'home-search',
                'topStory' => $topStory,
                'topUsers' => $topUsers,
                'topTags' => $topTags
            ]);

        } else {
            $topStory = StoryModel::PagTrendingStory(20);
            $trendingTags = TagModel::TopSmallTags();
            return view('search.index', [
                'title' => 'Search',
                'ctr' => '',
                'path' => 'home-search',
                'trendingTags' => $trendingTags,
                'topStory' => $topStory
            ]);
        }
    }

    function composeStory()
    {
        return view('compose.story', ['title' => 'New Story', 'path' => 'compose']);
    }


    function login()
    {
        return view('sign.in', ['title' => 'Login', 'path' => 'none']);
    }
    function signup()
    {
        return view('sign.up', ['title' => 'Signup', 'path' => 'none']);
    }
}
