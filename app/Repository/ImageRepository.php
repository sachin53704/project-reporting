<?php

namespace App\Repository;

use Illuminate\Support\Facades\Storage;

class ImageRepository{
    // function to store image by parameter
    public function storeImage($req, $reqFileName, $path, $fileName){
        $name = null;
        if($req->hasFile($reqFileName)) {
            $imageName = $fileName.'.'.$req->$reqFileName->getClientOriginalExtension();
            $req->file($reqFileName)->storeAs('public/'.$path, $imageName);
            $name = $path.'/' . $imageName;
        }
        return $name;
    }

    // function to update Image
    public function updateImage($req, $fileColumnName, $reqFileName, $path, $fileName){
        $name = $fileColumnName;
        if($req->hasFile($reqFileName)) {
            if($fileColumnName && $fileColumnName != "") {
                if (Storage::exists('public/'.$fileColumnName)){
                    Storage::delete('public/'.$fileColumnName);
                }
            }

            $imageName = $fileName.'.'.$req->$reqFileName->getClientOriginalExtension();
            $req->file($reqFileName)->storeAs('public/'.$path, $imageName);
            $name = $path.'/' . $imageName;
        }
        return $name;
    }
}
