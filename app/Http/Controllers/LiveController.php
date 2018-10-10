<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Image;

use App\LiveModel;

class LiveController extends Controller
{
    //view
    function index()
    {
        $topLive = LiveModel::FreshLives(20);
        return view('live.index', [
            'title' => 'Its a place for designer',
            'nav' => 'lives',
            'path' => 'fresh',
            'topLive' => $topLive
        ]);
    }
    function compose()
    {
        return view('compose.live.create', [
            'title' => 'New Live', 
            'path' => 'compose', 
            'nav' => 'compose'
        ]);
    }
    function designEdit($idlive, $iduser, $token)
    {
        if ($token === csrf_token()) {
            $getStory = StoryModel::GetStory($idlive);
            $restTags = TagModel::GetTags($idlive);
            $temp = [];
            foreach ($restTags as $tag) {
                array_push($temp, $tag->tag);
            }
            $tags = implode(", ", $temp);
            return view('compose.design.edit', [
                'title' => 'Edit Design',
                'path' => 'none',
                'getStory' => $getStory,
                'tags' => $tags
            ]);   
        } else {
            return redirect('/story/'.$idlive);
        }
    }

    //live
    function timelines()
    {
        $id = Auth::id();
        $topLive = [];
        return view('live.index', [
            'title' => 'Timelines',
            'nav' => 'lives',
            'path' => 'timelines',
            'topLive' => $topLive
        ]);
    }
    function popular()
    {
        $topLive = [];
        return view('live.index', [
            'title' => 'Popular',
            'nav' => 'lives',
            'path' => 'popular',
            'topLive' => $topLive
        ]);
    }
    function fresh()
    {
        $topLive = [];
        return view('live.index', [
            'title' => 'Fresh',
            'nav' => 'lives',
            'path' => 'fresh',
            'topLive' => $topLive
        ]);
    }
    function trending()
    {
        $topLive = [];
        return view('live.index', [
            'title' => 'Trending',
            'nav' => 'lives',
            'path' => 'trending',
            'topLive' => $topLive
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

    //crud
    function publish(Request $request)
    {
        $id = Auth::id();
        $title = $request['title'];
        $content = $request['content'];
        $code = $request['code'];
        if ($id) 
        {
            if ($request->hasFile('image')) 
            {
                
                $image = $request->file('image');

                for ($i=0; $i < count($image); $i++) 
                {
                    $wd = getImageSize($image[$i])[0];
                    $hg = getImageSize($image[$i])[1];

                    $chrc = array(
                        '[',']','@',' ','+','-','#','*','<','>',
                        '_','(',')',';',',','&','%','$','!','`',
                        '~','=','{','}','/',':','?','"',"'",'^'
                    );
                    $filename = $id.time().str_replace($chrc, '', $image[$i]->getClientOriginalName());

                    //save image to server
                    //creating thumbnail and save to server
                    $destination = public_path('live/thumbnails/'.$filename);
                    $img = Image::make($image[$i]->getRealPath());
                    $mv1 = $img->resize(400, 400, function ($constraint) {
                        $constraint->aspectRatio();
                    })->save($destination);

                    //saving image real to server
                    $destination = public_path('live/covers/');
                    $mv2 = $image[$i]->move($destination, $filename);

                    if ($mv1 && $mv2) 
                    {
                        $data = array(
                            'image' => $filename, 
                            'description' => $content,
                            'title' => $title,
                            'code' => $code,
                            'id' => $id
                        );
                        $rest = LiveModel::Add($data);
                        if ($rest) 
                        {
                            $idlive = LiveModel::GetID();
                            echo $idlive;
                        }
                        else 
                        {
                            echo 'failed';
                        }
                    }
                    else 
                    {
                        echo 'failed';
                    }
                }
            } else {
                echo 'no-file';
            }
        } else {
            echo 'no-login';
        }
    }
    function edit(Request $request)
    {
        $idlive = $request['idlive'];
        $content = $request['content'];
        $tags = $request['tags'];

        $data = array(
            'description' => $content
        );

        $rest = StoryModel::UpdateStory($idlive, $data);
        if ($rest) {
            //remove tags
            TagModel::DeleteTags($idlive);
            //editting tags
            $this->mentions($request['tags'], $idlive);
            echo $idlive;
        } else {
            echo "failed";
        }
    }
    function delete(Request $request)
    {
        $iduser = Auth::id();
        $idlive = $request['idlive'];

        //deleting cover
        $image = ImageModel::GetAllImage($idlive);
        foreach ($image as $dt) {
            unlink(public_path('story/covers/'.$dt->image));
            unlink(public_path('story/thumbnails/'.$dt->image));
        }

        //deleting like

        //deleting comment

        //deleting story
        $rest = StoryModel::DeleteStory($idlive, $iduser);
        if ($rest) {
            echo "success";
        } else {
            echo "failed";
        }
    }
}
