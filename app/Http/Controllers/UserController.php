<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    //个人设置页面
    public function setting()
    {
    	return view('user.setting');
    }

    //个人设置行为
    public function settingStore(Request $request)
    {
        return;
    }

    //个人中心页面
    public function show(User $user)
    {
        //
        $user=User::withCount(['stars','fans','posts'])->find($user->id);

        //
        $posts=$user->posts()->orderBy('created_at','desc')->take(10)->get();

        //
        $stars=$user->stars;
        $susers=User::whereIn('id',$stars->pluck('star_id'))->withCount(['stars','fans','posts'])->get();

        //
        $fans=$user->fans;
        $fusers=User::whereIn('id',$fans->pluck('fan_id'))->withCount(['stars','fans','posts'])->get();

    	return view('user/show',compact('user','posts','susers','fusers'));
    }

    //关注用户
    public function fan(User $user)
    {
        $me=\Auth::user();
        $me->doFan($user->id);

    	return [
            'error'=>0,
            'msg'=>''
        ];
    }

    //取消关注
    public function unfan(User $user)
    {
        $me=\Auth::user();
        $me->doUnfan($user->id);

    	return [
            'error'=>0,
            'msg'=>''
        ];
    }
}
