<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\File;
use Symfony\Component\HttpKernel\Tests\Debug\FileLinkFormatterTest;
use Validator;
use Illuminate\Support\Facades\Storage;

class FilesController extends Controller
{
    /**
    *Dosya Yükleme Ekranı
	*
	*@return 
    */
    public function files(){

    	return view('files');
    }

    /**
     * List Uploaded files
     *
     * @return array
     */
    public function listFiles()
    {
        //$files=File::all()
        $files=array();

        $files=File::all();
        return $files;
    }


    public function listFileId($id)
    {
        $files=File::find($id);
        return $files;

    }

    /**
     * Upload new File
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function upload(Request $request)
    {
        $validator = Validator::make($request->file(), [
            'image_file.*' => 'required|image|max:10000',
        ]);

        if ($validator->fails()) {

            $errors = [];
            foreach ($validator->messages()->all() as $error) {
                array_push($errors, $error);
            }

            return response()->json(['errors' => $errors, 'status' => 400], 400);
        }


        //$src = $request->file('image_file')->getClientOriginalName().'.jpg';
        if($request->hasFile('image_file')){

            foreach ($request->file('image_file') as $image) {
                 $file = File::create([
                    'name' => $image->getClientOriginalName(),
                    'type' => $image->extension(),
                    'size' => $image->getClientSize(),
                    'src' => '',
                ]);

                $src=['src'=>$file->id . '.' . $file->type];

                File::where('id', $file->id)
                    ->update($src);

                $image->move(__DIR__ . '/../../../public/image_uploads/', $file->id . '.' . $file->type);
            }
        }
       

        return response()->json(['errors' => [], 'files' => File::all(), 'status' => 200], 200);
    }

    /**
     * Delete existing file from the server
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete(Request $request)
    {
        Storage::delete(__DIR__ . '/../../../public/image_uploads/' . $request->input('id'));

        File::find($request->input('id'))->delete();

        return response()->json(['errors' => [], 'message' => 'File Successfully deleted!', 'status' => 200], 200);
    }

}
