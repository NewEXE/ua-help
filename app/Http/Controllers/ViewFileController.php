<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;

class ViewFileController extends Controller
{
    private static array $allowedFiles = [
        'VPN-advanced.txt',
    ];

    /**
     * Open file content.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string
     */
    public function __invoke(Request $request)
    {
        $validatedData = $request->validate([
            'f' => [
                'required',
                'string',
                Rule::in(self::$allowedFiles)
            ],
        ]);

        $file = $validatedData['f'];

        $content = Storage::disk('resources_files')->get($file);

        return "<pre>$content</pre>";
    }
}
