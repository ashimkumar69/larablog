<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserEditRequest;
use App\Http\Requests\UserRequest;
use App\Photo;
use App\Role;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AdminUsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return view("admin.users.index", [
            "users" => User::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::select("id", "name")->get();
        return view("admin.users.create", compact("roles"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(UserRequest $request)
    {
        $input = $request->all();

        if ($file = $request->file("photo_id")) {
            $imagename = time() . $file->getClientOriginalName();
            $file->move("images", $imagename);
            $photo = Photo::create(["file" => $imagename]);

            $input["photo_id"] = $photo->id;
        }
        $input["password"] = Hash::make($request->password);

        User::create($input);
        return redirect()->route("users.index")->with(["message" => "User Created Successfully"]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view("admin.users.show");
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        return view("admin.users.edit",      [
            "users" => User::find($id),
            "roles" => Role::select("id", "name")->get(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserEditRequest $request, $id)
    {
        $user = User::find($id);
        if (trim($request->password) == '') {
            $input =  $request->except('password');
        } else {
            $input = $request->all();
            $input["password"] = Hash::make($request->password);
        }


        if ($file = $request->file("photo_id")) {
            if ($user->photo_id != null) {
                unlink(public_path() . $user->photo->file);
            }

            $imagename = time() . $file->getClientOriginalName();
            $file->move("images", $imagename);
            $photo = Photo::create(["file" => $imagename]);

            $input["photo_id"] = $photo->id;
        }


        $user->update($input);
        return redirect()->back()->with(["message" => "User Created Successfully"]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        unlink(public_path() . $user->photo->file);
        $user->delete();
        Session::flash('delete_user', 'Post Deleted Successfully');

        return redirect()->route('users.index');
    }
}
