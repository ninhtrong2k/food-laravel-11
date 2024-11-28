<?php
namespace App\Traits;

use Illuminate\Support\Facades\File;
use Intervention\Image\Laravel\Facades\Image;

trait FileUploadTraits {
    public function uploadFile($request, $inputName, $path)
    {
        if ($request->hasFile($inputName)) {
            $file = $request->{$inputName};
            $ext = $file->getClientOriginalExtension();
            $fileName = 'media_'.uniqid().'.'.$ext;
            $file->move(public_path($path), $fileName);
            return $path.'/'.$fileName;
        }
    }
    public function uploadImgChangeSz($request, $inputName, $path,$width,$height)
    {
        if($request->hasFile($inputName)){
            $directoryPath = public_path($path);
            if (!is_dir($directoryPath)) {
                mkdir($directoryPath, 0755, true);
            }
            $imageFile = $request->file($inputName);
            $image = Image::read($imageFile);
            $image->resize($width, $height);
            $ext = $imageFile->getClientOriginalExtension();
            $fileName = 'media_'.uniqid().'.'.$ext;
            $url_image = $path.$fileName;
            $image->save(public_path($url_image));
            return $url_image;
        }
    }
    public function uploadMultiFile($request, $inputName, $path)
    {
        $filePaths = [];
        if($request->hasFile($inputName)){
            $files = $request->{$inputName};
            foreach($files as $file) {
                $ext = $file->getClientOriginalExtension();
                $fileName = 'media_'.uniqid().'.'.$ext;
                $file->move(public_path($path), $fileName);
                $filePaths[] = $path.'/'.$fileName;
            }
            return $filePaths;
        }
    }
    public function updateFile($request, $inputName, $path,$oldPath=null)
    {
        if($request->hasFile($inputName)){
            if(File::exists(public_path($oldPath))){
                File::delete(public_path($oldPath));
            }
            $file = $request->{$inputName};
            $ext = $file->getClientOriginalExtension();
            $fileName = 'media_'.uniqid().'.'.$ext;
            $file->move(public_path($path), $fileName);
            return $path.'/'.$fileName;
        }
        return false;
    }
    public function deleteFile($path){
        if(File::exists(public_path($path))){
            File::delete(public_path($path));
        }
    }
}