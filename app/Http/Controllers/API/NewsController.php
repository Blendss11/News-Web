<?php

namespace App\Http\Controllers\API;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

class NewsController extends Controller
{
    public function index()
    {
        try {

            $news = News::latest()->paginate('10');

            if($news)
            {
                return ResponseFormatter::success($news, 'Data News Berhasil diambil');

            } else {
                return ResponseFormatter::error(null, 'Data News tidak ada', 404 );
            }
        } catch (\Error $error) {
            return ResponseFormatter::error([
                'message' => 'Something went wrong',
                'error' => $error
            ], 'Authentication Failed', 500);
        }
            
    }

    public function show($id)
    {
        try {
            $news = News::findOrFail($id);

            if($news){
                return ResponseFormatter::success($news, 'Data news berhasil tampilkan');
            }else{
                return ResponseFormatter::error(null, 'Data news tidak dapat ditampilkan', 404 );
            }
        } catch (\Error $error) {
            return ResponseFormatter::error([
                'message' => 'Data gagal ditambahkan',
                'error' => $error
            ], 'Authentication Failed', 500);
        }
    }
}
