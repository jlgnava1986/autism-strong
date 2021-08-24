<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
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
            if (!$gallery) {
         
                return abort(404);
        }
        
        return view('gallery.show')->with('gallery', $gallery);
    }

    public function destroy($id) {
        $gallery = Gallery::find($id);

        if (Storage::disk('local')->exists('public/gallery_covers/'.$gallery->cover_image)) {
            
            if (Storage::delete('public/gallery_covers/'.$gallery->cover_image)) {
            $gallery->delete();

            return redirect('/gallery')->with('success', 'Photo gallery deleted successfully.');
            }
        }

        return back()->with('danger', 'Error: File not found.');
    }
}
