<?php

namespace App\Http\Controllers;

use App\Category;
use App\Comment;
use App\Http\Requests\PostCreateRequest;
use App\Photo;
use App\Post;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AdminPostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::paginate(10);

        return view("admin.posts.index", compact("posts"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categorys = Category::select("id", "name")->get();
        return view("admin.posts.create", compact("categorys"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostCreateRequest $request)
    {
        $input = $request->all();
        $user = Auth::user();

        if ($file = $request->file("photo_id")) {

            $imagename = time() . $file->getClientOriginalName();
            $file->move("images", $imagename);

            $photo = Photo::create(["file" => $imagename]);

            $input["photo_id"] = $photo->id;
        }

        $user->posts()->create($input);

        return redirect()->route("posts.index")->with(["message" => "User Created Successfully"]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::find($id);
        $categorys = Category::select("id", "name")->get();
        return view("admin.posts.edit", compact("post", "categorys"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PostCreateRequest $request, $id)
    {
        $input = $request->all();
        $post = Auth::user()->posts()->whereId($id)->first();


        if ($file = $request->file("photo_id")) {
            unlink(public_path() . $post->photo->file);
            $imagename = time() . $file->getClientOriginalName();
            $file->move("images", $imagename);

            $photo = Photo::create(["file" => $imagename]);

            $input["photo_id"] = $photo->id;
        }
        $post->update($input);

        return redirect()->route("posts.index")->with(["message" => "Post Update Successfully Done"]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::find($id);
        unlink(public_path() . $post->photo->file);
        $post->delete();
        Session::flash('delete_user', 'User Deleted Successfully');

        return redirect()->route('posts.index');
    }

    public function post($slug)
    {
        $post = Post::findBySlugOrFail($slug);
        $comments = $post->comments()->whereIsActive(1)->get();
        return view('post', compact('post', 'comments'));
    }
}
