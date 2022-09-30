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
        return view('design.index', [
            'title' => 'Its a place for designer',
            'nav' => 'designs',
            'path' => 'designs',
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
    function explore($idtags)
    {
        $ctr = TagModel::GetTagBYId($idtags);
        $topStory = StoryModel::PagTagStory($ctr, 20);
        return view('design.index', [
            'title' => 'Explore '.$ctr,
            'nav' => 'designs',
            'path' => 'explore-'.$idtags,
            'topStory' => $topStory
        ]);
    }

    function makeApps()
    {
        return view('featured.makeapps', [
            'title' => 'Make or Design Apps Now It\'s So Easy',
            'nav' => 'makeapps',
            'path' => 'makeapps',
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
            'nav' => 'all-ctr',
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
        $topStory = StoryModel::PagTagStory(urldecode($ctr), 20);
        return view('others.index', [
            'title' => strtoupper(urldecode($ctr)),
            'path' => 'none',
            'nav' => 'all-ctr',
            'topStory' => $topStory
        ]);
    }
    function ctrId($ctr)
    {
        $topStory = StoryModel::PagCtrStory($ctr, 20);
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
            'nav' => 'all-ctr',
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
                'nav' => 'search',
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
                'nav' => 'search',
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
                'nav' => 'search',
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
                'nav' => 'search',
                'path' => 'home-search',
                'trendingTags' => $trendingTags,
                'topStory' => $topStory
            ]);
        }
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
