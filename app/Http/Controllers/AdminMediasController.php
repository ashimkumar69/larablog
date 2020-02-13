<?php

namespace App\Http\Controllers;

use App\Photo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AdminMediasController extends Controller
{
    public function index()
    {
        $photos = Photo::all();
        return view("admin.media.index", compact("photos"));
    }

    public function create()
    {
        $photos = Photo::all();
        return view("admin.media.create", compact("photos"));
    }

    public function store(Request $request)
    {
        $file = $request->file('file');
        $imagename = time() . $file->getClientOriginalName();
        $file->move("images", $imagename);
        Photo::create(["file" => $imagename]);
    }

    public function destroy($id)
    {
        $photo = Photo::find($id);
        unlink(public_path() . $photo->file);
        $photo->delete();
        Session::flash('delete_user', 'User Deleted Successfully');

        return redirect()->route('media.index');
    }

    public function deleteMedia(Request $request)
    {
        $photos = Photo::findOrFail($request->checkboxArray);
        foreach ($photos as $photo) {
            $photo->delete();
        }
        return redirect()->back();
    }
}
