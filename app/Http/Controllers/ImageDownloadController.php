<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Storage;


class ImageDownloadController extends Controller
{
    public function downloadImage($imageUrl, $fileName)
    {
        $client = new Client();
        $response = $client->get($imageUrl);
        $image = $response->getBody()->getContents();

        Storage::put("public/images/{$fileName}", $image);
    }
}

