<?php
namespace app\Http\Controllers;
use Illuminate\Http\UploadedFile;
trait imageuploadfile {
 function upload($file){
    if ( $file instanceof UploadedFile) {

        $file_name = time() . '_' . $file->getClientOriginalName();
        $path = "images/properties/" ;
        $file_full_name = $path  . $file_name;
        $file->storeAs($path, $file_name,'public');

        return asset('storage/' . $file_full_name);
    }

    return  'images/def.jpg';
 }
}
