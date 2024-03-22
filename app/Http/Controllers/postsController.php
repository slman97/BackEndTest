<?php

namespace App\Http\Controllers;
use Auth;
use App\Models\User;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class postsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index(User $user)
    {
        $posts = DB::table('posts')->where('user_id', $user->id)->paginate(5);
        return view('post.index', compact('posts'));
    }

}
