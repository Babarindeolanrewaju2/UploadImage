<?php

namespace App\Http\Controllers;

use App\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class ImageController extends Controller
{
    public function index()
    {
        return view('image');
    }

    public function save(Request $request)
    {
        request()->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($files = $request->file('image')) {
            $destinationPath = public_path('uploads/files'); // upload path
            $file = date('YmdHis') . "." . $files->getClientOriginalExtension();
            $files->move($destinationPath, $file);
        }
        $image = new Image;
        $image->nameOfImage = $file;
        $image->save();

        return Redirect::to("image")
            ->withSuccess('Great! file has been successfully uploaded.');

    }
}
