<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

class userController extends Controller
{
    //
    public function showProfile($id)
    {  
        $redis = Redis::connection();
       //$redis->set('blog:1:name','Byju');  
      //echo $redis->get('blog:1:name');
      $views = $redis->incr('article:'.$id.'views');
      echo $views;
    }

}
