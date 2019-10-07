<?php

namespace App\Generals\Upload;

use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class Upload
{

    public function makeSimpleResize($image, $size, $path, $imageName)
    {
        return $this->simpleResize($image, $size, $path, $imageName);
    }




    public function makeResize($image, $size, $path)
    {
        return $this->resize($image, $size, $path);
    }




    public function makeResizeWithThumb($image, $size, $sizeThumb, $path, $pathThumb)
    {
        $fileName = md5(uniqid()) . '.' . $image->getClientOriginalExtension();
        return $this->resizeWithThumb($image, $size, $sizeThumb, $path, $pathThumb, $fileName);
    }




    private function simpleResize($image, $size, $path, $imageName)
    {
        try {
            $imageRealPath = $image->getRealPath();
            $thumbName = $imageName;
            $img = Image::make($imageRealPath);
            $img->resize(intval($size), null, function ($constraint) {
                $constraint->aspectRatio();
            });
            if (!Storage::disk('public_uploads')->exists($path)) {
                Storage::disk('public_uploads')->makeDirectory($path);
            }
            $img->save(public_path('uploads/' . $path) . '/' . $thumbName);
            return $thumbName;
        } catch (Exception $e) {
            //return $e->getMessage();
            return false;
        }
    }




    private function resize($image, $size, $path)
    {
        try {
            $imageRealPath = $image->getRealPath();
            $thumbName = md5(uniqid()) . '.' . $image->getClientOriginalExtension();
            $img = Image::make($imageRealPath);
            $img->resize(intval($size), null, function ($constraint) {
                $constraint->aspectRatio();
            });
            if (!Storage::disk('public_uploads')->exists($path)) {
                Storage::disk('public_uploads')->makeDirectory($path);
            }
            $img->save(public_path('uploads/' . $path) . '/' . $thumbName);
            return $thumbName;
        } catch (Exception $e) {
            //return $e->getMessage();
            return false;
        }
    }




    private function resizeWithThumb($image, $size, $sizeThumb, $path, $pathThumb, $fileName)
    {
        try {
            $imageRealPath = $image->getRealPath();
            $thumbName = $fileName;
            $img = Image::make($imageRealPath);
            $img->resize(intval($size), null, function ($constraint) {
                $constraint->aspectRatio();
            });
            $img->save(public_path($path) . '/' . $thumbName);

            //resize thumb
            $imgThumb = Image::make($imageRealPath);
            $imgThumb->resize(intval($sizeThumb), null, function ($constraint) {
                $constraint->aspectRatio();
            });
            $imgThumb->save(public_path($pathThumb) . '/' . $thumbName);
            return $thumbName;
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }


}
