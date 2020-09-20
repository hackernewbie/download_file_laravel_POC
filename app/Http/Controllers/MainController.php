<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\File;

class MainController extends Controller
{

    public function index()
    {
        $allFiles   =   File::all();

        return view('home')->with('files', $allFiles);
    }

    public function FileUpload(Request $request){

        $arrFiles       =   $request['file-name'];

        if(count($arrFiles) > 0){
            foreach ($arrFiles as $file) { 
                $fullFileName                   = $file->getClientOriginalName();      

                $fileExtension                  = $file->getClientOriginalExtension();
                $path                           = $file->storeAs('public/files', $fullFileName);

                $docFileNameToStore             =   $fullFileName;

                $newFile                        = new File();
                $newFile->file_name             = $fullFileName;
                $newFile->save();

            }
            
            return redirect()->route('home')->with('success','File(s) uploaded successfully!');
        }
        else{
            return "No file selected";
        }
    }

    function FileDownload($file_id){
        $fileName   = File::find($file_id)->file_name;
        
        $filePath   =   "../public/storage/files/".$fileName;
        //dd($filePath);
        return response()->download($filePath);
    }
}
