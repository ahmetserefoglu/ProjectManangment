<?php

namespace App\Http\Controllers;

use App\FileUpload;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Storage;
use App\Upload;
use App\Gallery;
use App\Proje;

class FileUploadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function fileekle()
    {
        

        $fileuploads=FileUpload::where('user_id',Auth::user()->id)->get();
        
        if(Auth::user()->rolename=='User'){
            $projeler = Proje::where('Kisiler',Auth::user()->id)->get();
        }else{
           $projeler = Proje::all();
        }

       

        return view('projedurum.projedurumekle',['page_title'=>'Proje Durum','fileuploads'=>$fileuploads,'projeler'=>$projeler]);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function filelist()
    {
        $fileuploads=FileUpload::where('user_id',Auth::user()->id)->get();
        return view('projedurum.index',['page_title'=>'Proje Dosyalar','fileuploads'=>$fileuploads]);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $proje=Proje::where('ProjeAdi',$request->get('title'))->get();

        $request->validate([
        'title' => 'required:max:255',
        'overview' => 'required',
        'durumu'  => 'required'
      ]);

      auth()->user()->files()->create([
        'title' => $request->get('title'),
        'durumu' => $request->get('durumu'),
        'proje_id' => $proje[0]->id,
        'overview' => $request->get('overview')
      ]);

      if(Auth::user()->rolename=='User'){
            $proje = Proje::where('id', $proje[0]->id)->get();
         $input = [
            'Durumu' =>$request->get('durumu'),
        ];

        Proje::where('id', $proje[0]->id)
            ->update($input);
            
        }

      $fileuploads=FileUpload::where('user_id',Auth::user()->id)->get();

      return view('projedurum.index',['message'=>'Dosya Kaydedildi','fileuploads'=>$fileuploads]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\FileUpload  $fileUpload
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $gallery = FileUpload::findorFail($id);

        return view('projedurum.projeupload')->with('gallery',$gallery);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\FileUpload  $fileUpload
     * @return \Illuminate\Http\Response
     */
    public function edit(FileUpload $fileUpload)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\FileUpload  $fileUpload
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, FileUpload $fileUpload)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\FileUpload  $fileUpload
     * @return \Illuminate\Http\Response
     */
    public function destroy(FileUpload $fileUpload)
    {
        //
    }

    public function upload(Request $request)
    {
      $uploadedFile = $request->file('file');
      $filename = time().$uploadedFile->getClientOriginalName();

      Storage::disk('local')->putFileAs(
        'files/'.$filename,
        $uploadedFile,
        $filename
      );

      $uploadedFile->move(public_path('gallery/images'), $filename);

      $gallery=FileUpload::find($request->input('file_id'));

        $upload=$gallery->uploads()->create([
            'file_upload_id'=>$request->input('file_id'),
            'filename'=>$filename,
            'file_size'=>$uploadedFile->getClientSize(),
            'file_path'=>'/gallery/images/'.$filename,
            'user_id'=>Auth::user()->id
        ]);

        

      $upload->save();
      return response()->json([
        'id' => $upload->id,
        'message' => 'Başarıyla Kaydedildi'
      ]);
    }
}
