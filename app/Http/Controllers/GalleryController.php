<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Gallery;
use Auth;
use Intervention\Image\Facades\Image;

class GalleryController extends Controller
{
    //

    public function __construct()
    {
    	$this->middleware('auth');
    }


    public function viewGalleryList()
    {
    	$galleries=Gallery::where('created_by',Auth::user()->id)->get();

    	return view('multiplegaleri')->with('galleries',$galleries);

    }

    public function saveGallery(Request $request)
    {
    	$this->validate($request, [
            'gallery_name' => 'required|min:3'
        ]);


    	$gallery = new Gallery;

    	$gallery->name=$request->input('gallery_name');
    	$gallery->created_by=Auth::user()->id;
    	$gallery->published=1;
    	$gallery->save();

    	return redirect()->back()->with('success','Galeri Adi Kaydedildi.');

    }

    public function viewGalleryPics($id)
    {
    	$gallery = Gallery::findOrFail($id);

    	return view('multiplegaleriview')->with('gallery',$gallery);
    }

    public function doImageUpload(Request $request)
    {
    	$file=$request->file('file');

    	$filename=uniqid().$file->getClientOriginalName();

        if (!file_exists('gallery/images/thumbs')) {
            mkdir('gallery/images/thumbs',0777,true);
        }
    	
        $file->move(public_path('gallery/images'), $filename);

        $thumb = Image::make('gallery/images/'.$filename)->resize(240,160)->save('gallery/images/thumbs/'.$filename,50);

    	$gallery=Gallery::find($request->input('gallery_id'));

    	$image=$gallery->images()->create([
    		'gallery_id'=>$request->input('gallery_id'),
    		'file_name'=>$filename,
    		'file_size'=>$file->getClientSize(),
    		'file_mime'=>$file->getClientMimeType(),
    		'file_path'=>'/gallery/images/'.$filename,
    		'created_by'=>Auth::user()->id
    	]);

    	return $image;

    }

    public function deleteGallery($id)
    {
        //galleryi yükle
        $currentGallery=Gallery::findOrFail($id);

        //kullanıcı kontrolü
        if($currentGallery->created_by!=Auth::user()->id)
        {
            abort('403','You are not allowed to delete this gallery');
        }

        //resimnleri al
        $images = $currentGallery->images();

        //silinecek resimleri
        foreach ($currentGallery->images as $image) {
            
            unlink(public_path($image->file_path));
            unlink(public_path('/gallery/images/thumbs/'.$image->file_name));
        }

        //resimlerden sil
        $currentGallery->images()->delete();

        //galeriden sil
        $currentGallery->delete();

        return redirect()->back();
    }
}
