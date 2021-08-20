<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Gallery;

class GalleryController extends Controller
{
    public function index() {
        $galleries = Gallery::get();
        return view('gallery')->with('galleries', $galleries);
    }

    public function create() {
        return view('gallery/create');
    }

    public function store(Request $request) {
        $this->validate($request, [
            'name' => 'required',
            'description' => 'required',
            'cover-image' => 'required|image'
        ]);

        $filenameWithExtension = $request->file('cover-image')->getClientOriginalName();
        $filename = pathinfo($filenameWithExtension, PATHINFO_FILENAME);
        $extension = $request->file('cover-image')->getClientOriginalExtension();
        $filenameToStore = $filename . '_' . time() . '.' . $extension;
        $request->file('cover-image')->storeAs('public/gallery_covers', $filenameToStore);

        $gallery = new Gallery();
        $gallery->name = $request->input('name');
        $gallery->description = $request->input('description');
        $gallery->cover_image = $filenameToStore;
        $gallery->save();

        return redirect('/gallery')->with('success', 'Photo Gallery created successfully!');
    }

    public function show($id) {
        $gallery = Gallery::with('photos')->find($id);
        return view('gallery.show')->with('gallery', $gallery);
    }
}
