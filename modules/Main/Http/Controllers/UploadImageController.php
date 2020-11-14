<?php

namespace Modules\Main\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Storage;
use Barryvdh\Debugbar\Facade as Debugbar;
use Modules\Main\Http\Requests\ImageUploadRequest;

class UploadImageController extends Controller
{
    public function store(ImageUploadRequest $request)
    {
        Debugbar::disable();

        $file = $request->file('upload');

        $filename = \Auth::id() . '/' . str_random(4) . '_' . $file->getClientOriginalName();
        Storage::putFileAs('public/upload/images/', $file, $filename);
        $url = asset(Storage::url('upload/images/' . $filename));

        return [
            'uploaded'  => 1,
            'filename'  => $filename,
            'url'       => $url,
        ];

    }
}
