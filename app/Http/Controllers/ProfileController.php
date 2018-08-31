<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Image;

use App\StoryModel;
use App\ProfileModel;
use App\FollowModel;
use App\TagModel;

class ProfileController extends Controller
{
    //view landing page
	function profile()
    {
        $id = Auth::id();
        $profile = ProfileModel::UserData($id);
        $userStory = StoryModel::PagUserStory(20, $id);
        return view('profile.index', [
            'title' => 'User Profile',
            'path' => 'profile',
            'nav' => 'story',
            'profile' => $profile,
            'userStory' => $userStory
        ]);
    }
	function story($id)
	{
		$iduser = Auth::id();
		if ($iduser == $id) {
			$pathProfile = 'profile';
		} else {
			$pathProfile = 'none';
		}
        $profile = ProfileModel::UserData($id);
        $userStory = StoryModel::PagUserStory(20, $id);
        $statusFolow = FollowModel::Check($id, $iduser);
        return view('profile.index', [
            'title' => 'User Profile',
            'path' => $pathProfile,
            'nav' => 'story',
            'profile' => $profile,
            'userStory' => $userStory,
            'statusFolow' => $statusFolow
        ]);
	}
	function save($id)
	{
		$iduser = Auth::id();
		if ($iduser == $id) {
			$pathProfile = 'profile';
		} else {
			$pathProfile = 'none';
		}
        $profile = ProfileModel::UserData($id);
        $userStory = StoryModel::PagUserBookmark(20, $id);
        $statusFolow = FollowModel::Check($id, $iduser);
        return view('profile.index', [
            'title' => 'User Profile',
            'path' => $pathProfile,
            'nav' => 'bookmark',
            'profile' => $profile,
            'userStory' => $userStory,
            'statusFolow' => $statusFolow
        ]);
	}

    //view setting
	function profileSetting()
    {
        $id = Auth::id();
        $profile = ProfileModel::UserData($id);
        return view('profile.edit.profile-picture', [
            'title' => 'Profile Setting',
            'path' => 'profile-picture',
            'profile' => $profile
        ]);
    }

    function profileSettingInfoPublic()
    {
        $id = Auth::id();
        $profile = ProfileModel::UserData($id);
        return view('profile.edit.info-public', [
            'title' => 'Edit Profile',
            'path' => 'public-informations',
            'profile' => $profile
        ]);
    }
    function profileSettingInfoPrivate()
    {
        $id = Auth::id();
        $profile = ProfileModel::UserData($id);
        return view('profile.edit.info-private', [
            'title' => 'Edit Profile',
            'path' => 'private-informations',
            'profile' => $profile
        ]);
    }
    function profileSettingPassword()
    {
        $id = Auth::id();
        $profile = ProfileModel::UserData($id);
        return view('profile.edit.password', [
            'title' => 'Change Password',
            'path' => 'change-password',
            'profile' => $profile
        ]);
    }

    //save setting
    function savePassword(Request $request)
    {
        $id = Auth::id();
        $old_password = $request['old_password'];
        $new_password = $request['new_password'];
        $renew_password = $request['renew_password'];
        $data_password = ProfileModel::GetPass($id);
        if (Hash::check($old_password, $data_password)) {
            if ($new_password == $renew_password) {
                $request->user()->fill([
                    'password' => Hash::make($new_password)
                ])->save();
                echo "done";
            } else {
                echo "not_seem";
            }
        } else {
            echo "false";
        }
    }
    function savePublicInformations(Request $request)
    {
        $id = Auth::id();

        $name = $request['name'];
        $username = $request['username'];
        $about = $request['about'];
        $website = $request['website'];

        $data = array(
            'name' => $name,
            'username' => $username,
            'about' => $about,
            'website' => $website
        );

        $rest = ProfileModel::EditProfile($id, $data);
        if ($rest) {
            echo "success"; 
        } else {
            echo "failed";
        }
    }
    function savePrivateInformations(Request $request)
    {
        $id = Auth::id();

        $email = $request['email'];
        $phone_number = $request['phone_number'];
        $gender = $request['gender'];

        $data = array(
            'email' => $email,
            'phone_number' => $phone_number,
            'gender' => $gender
        );

        $rest = ProfileModel::EditProfile($id, $data);
        if ($rest) {
            echo "success"; 
        } else {
            echo "failed";
        }
    }
    function saveProfilePicture(Request $request)
    {
        $id = Auth::id();
        $foto = $request['foto'];
        if ($request->hasFile('foto')) {
            //setting foto profile
            $this->validate($request, [
                'foto' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:10048',
            ]);

            $image = $request->file('foto');

            $chrc = array('[',']','@',' ','+','-','#','*','<','>','_','(',')',';',',','&','%','$','!','`','~','=','{','}','/',':','?','"',"'",'^');
            $filename = $id.time().str_replace($chrc, '', $image->getClientOriginalName());

            //create thumbnail
            $destination = public_path('profile/thumbnails/'.$filename);
            $img = Image::make($image->getRealPath());
            $img->resize(200, 200, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destination);

            //create image real
            $destination = public_path('profile/photos/');
            $image->move($destination, $filename); 

            //set array data
            $data = array(
                'foto' => $filename,
            );
            $rest = ProfileModel::EditProfile($id, $data);
            if ($rest) {
                echo "success"; 
            } else {
                echo "failed";
            }
        } else {
            echo 'no-file';
        }
    }
}
