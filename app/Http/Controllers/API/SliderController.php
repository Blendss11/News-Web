<?php

namespace App\Http\Controllers\API;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class SliderController extends Controller
{
    public function index()
    {
        try {

            $slider = Slider::latest()->paginate('10');

            if($slider)
            {
                return ResponseFormatter::success($slider, 'Data Slider Berhasil diambil');

            } else {
                return ResponseFormatter::error(null, 'Data Slider tidak ada', 404 );
            }
        } catch (\Error $error) {
            return ResponseFormatter::error([
                'message' => 'Something went wrong',
                'error' => $error
            ], 'Authentication Failed', 500);
        }
            
    }

    public function create(Request $request)
    {
        try {
            // validate request

            $this->validate($request, [
                'image' => 'required|mimes:png,jpg,jpeg'
            ]);

            // image

            $image = $request->file('image');
            $image->storeAs('public/sliders', $image->hashName());

           $slider = Slider::create([
                'url' => $request->url,
                'slug' => Str::slug($request->name, '-'),
                'image' => $image->hashName(),
            ]);

            if($slider)
            {
                return ResponseFormatter::success($slider, 'data Slider berhasil di tambahkan');
            }else{
                return ResponseFormatter::error(null, 'Data Slider gagal ditambahkan', 404 );
            }
            
        } catch (\Error $error) {
            return ResponseFormatter::error([
                'data' => null,
                'message' => 'Data gagal ditambahkan',
                'error' => $error
            ]);
        }
    }
    public function destroy($id)
    {
       try {
        $slider = Slider::findOrFail($id);
        Storage::disk('local')->delete('public/sliders/' . basename($slider->image));
        $slider->delete();

        if($slider)
            {
                return ResponseFormatter::success($slider, 'data slider berhasil di hapus');
            }else{
                return ResponseFormatter::error(null, 'Data slider gagal dihapus', 404 );
            }

       } catch (\Error $error) {
        return ResponseFormatter::error([
            'data' => null,
            'message' => 'Data gagal ditambahkan',
            'error' => $error
        ]);
       }
    }
}
