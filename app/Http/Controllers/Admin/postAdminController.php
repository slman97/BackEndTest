<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Post;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\post\postStoreRequest;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class postAdminController extends Controller
{
    public function index(){
        $posts = DB::table('posts')->paginate(5);
       
        return view('Admin.post.showPost',compact('posts'));
    }
    public function create()
    {
        return view('Admin.post.addPost');
    }

    public function store(postStoreRequest $request)
    {
        $data = $request->validated();

        $imagePath = $data['image']->store('uploads', 'public');
    
        auth()->user()->posts()->create([
            'user_id' => $data['caption'],
            'caption' => $data['caption'],
            'discription' => $data['discription'],
            'image' => $imagePath,
        ]);

        return redirect('/dashbord');
    }
    public function edit(Post $post, Request $request, $id){
        $post = Post::find($id);
       return view ('Admin.post.editPost',compact('post'));
    }
    public function update(postStoreRequest $request,$id)
    {
        $post = Post::find($id);
        $data = $request->validated();
        $post->update(array_merge(
            $data,
        ));
        return redirect("/dashbord");
    }
    public function destroy($id){

        $post = post::find($id);
        $post->delete();
        return redirect('/dashbord');
    }
}
