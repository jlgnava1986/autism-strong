<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Photo;

class PhotosController extends Controller
{
    public function create(int $galleryId) {
        return view('photos.create')->with('galleryId', $galleryId);
    }

    public function store(Request $request) {
        $this->validate($request, [
            'title' => 'required',
            'description' => 'required',
            'photo' => 'required|image'
        ]);

        $filenameWithExtension = $request->file('photo')->getClientOriginalName();
        $filename = pathinfo($filenameWithExtension, PATHINFO_FILENAME);
        $extension = $request->file('photo')->getClientOriginalExtension();
        $filenameToStore = $filename . '_' . time() . '.' . $extension;
        $request->file('photo')->storeAs('public/gallery/' . $request->input('gallery-id'), $filenameToStore);

        $photo = new Photo();
        $photo->title = $request->input('title');
        $photo->description = $request->input('description');
        $photo->photo = $filenameToStore;
        $photo->size = $request->file('photo')->getSize();
        $photo->gallery_id = $request->input('gallery-id');
        $photo->save();

        return redirect('/gallery/' . $request->input('gallery-id'))->with('success', 'Photo uploaded successfully!');
    }

    public function show($id) {
        $photo = Photo::find($id);

        return view('photos.show')->with('photo', $photo);
    }

    public function destroy($id) {
        $photo = Photo::find($id);

        if (Storage::delete('/storage/gallery/'.$photo->gallery_id.'/'.$photo->photo)) {
            $photo->delete();

        return redirect('/gallery')->with('success', 'Photo deleted successfully.');
        
        }
    }
}