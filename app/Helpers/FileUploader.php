<?php

namespace App\Helpers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FileUploader
{
    public static function upload(Request $request, $resources = [], $path = '', $name = '', $disk = null)
    {
        $uploadPaths = [];
        foreach ($resources as $fileName) {
            if ($request->hasFile($fileName)) {
                $url = '';
                if ($name && $name != '') {
                    $url = $request->file($fileName)->storeAs(
                        $path,
                        $name
                    );
                } else {
                    $url = $request->file($fileName)->store($path);
                }
                array_push($uploadPaths, $url);
            }
        }
        if (count($resources) == 1) return $uploadPaths[0];
        else return $uploadPaths;
    }

    public function delete($fileNames = [], $disk = null)
    {
        return Storage::delete($fileNames);
    }
}
