<?php

namespace App\Http\Controllers\API;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

class CategoryController extends Controller
{
    public function index()
    {
        try {

            $category = Category::latest()->paginate('10');

            if($category)
            {
                return ResponseFormatter::success($category, 'Data Category Berhasil diambil');

            } else {
                return ResponseFormatter::error(null, 'Data Category tidak ada', 404 );
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
                'name' => 'required|string|max:255',
                'image' => 'required|mimes:png,jpg,jpeg'
            ]);

            // image

            $image = $request->file('image');
            $image->storeAs('public/categories', $image->hashName());

            $category = Category::create([
                'name' => $request->name,
                'slug' => Str::slug($request->name, '-'),
                'image' => $image->hashName(),
            ]);

            if($category)
            {
                return ResponseFormatter::success($category, 'data category berhasil di tambahkan');
            }else{
                return ResponseFormatter::error(null, 'Data category gagal ditambahkan', 404 );
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
        $category = Category::findOrFail($id);
        Storage::disk('local')->delete('public/categories/' . basename($category->image));
        $category->delete();

        if($category)
            {
                return ResponseFormatter::success($category, 'data category berhasil di hapus');
            }else{
                return ResponseFormatter::error(null, 'Data category gagal dihapus', 404 );
            }

       } catch (\Error $error) {
        return ResponseFormatter::error([
            'data' => null,
            'message' => 'Data gagal ditambahkan',
            'error' => $error
        ]);
       }
    }

    public function updateCategory(Request $request, $id)
    {
        try {
            // validate
            $this->validate($request,[
                'name' => 'required|unique:categories,name,' . $id,
                'image' => 'mimes:png,jpg,jpeg|max:2000'
            ]);

            $category = Category::findOrFail($id);

            if($request->file('image') == '')
            {
                $category->update([
                    'name' => $request->name,
                    'slug' => Str::slug($request->name, '-')
                ]);

                if($category)
                {
                    return ResponseFormatter::success($category, 'Data category berhasil di update');

                } else {
                    return ResponseFormatter::error(null, 'Data category tidak ada', 404 );
                }
            } else {
                Storage::disk('local')->delete('public/categories/'. basename($category->image));

                $image = $request->file('image');
                $image->storeAs('public/categories', $image->hashName());

                $category->update([
                    'image' => $image->hashName(),
                    'name' => $request->name,
                    'slug' => Str::slug($request->name, '-')
                ]);
            }


        } catch (\Error $error) {
            return ResponseFormatter::error([
                'data' => null,
                'message' => 'Data gagal ditambahkan',
                'error' => $error
            ]);
        }
    }

    public function show($id)
    {
        try {
            $category = Category::findOrFail($id);

            if($category){
                return ResponseFormatter::success($category, 'Data category berhasil tampilkan');
            }else{
                return ResponseFormatter::error(null, 'Data category tidak dapat ditampilkan', 404 );
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
