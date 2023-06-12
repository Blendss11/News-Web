<?php

namespace App\Http\Controllers;

use App\Models\Slider;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;


class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $slider = Slider::all();
        $title = "welcome to ZenBlog";
        return view('admin.slider.index', compact('slider', 'title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $image = $request->file('image');
        $image->storeAs('public/sliders/', $image->hashName());

        //save to DB
        Slider::create([
            'url' => $request->url,
            'slug' => Str::slug($request->name, '-'),
            'image' => $image->hashName(),
        ]);

        return redirect()->route('slider.index')->with([
            Alert::success(
                'Success Title', 
                'Success Message')
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Slider $slider)
    {
       

        if ($request->file('image') == ''){
            $slider = Slider::findOrFail($slider->id);
            $slider->update([
                'url' => $request->url,
                'slug' => Str::slug($request->name, '-')
            ]);
        } else {
            Storage::disk('local')->delete('public/sliders/'. basename($slider->image));

            $image = $request->file('image');
            $image->storeAs('public/categories', $image->hashName());

            $slider = Slider::findOrFail($slider->id);
            $slider->update([
                'image' => $image->hashName(),
                'url' => $request->url,
                'slug' => Str::slug($request->name, '-')
            ]);
        }

        return redirect()->route('slider.index')->with([
            Alert::success('Succes', 'Berhasil diupdate')
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $slider = Slider::findOrFail($id);
        Storage::disk('local')->delete('public/sliders/' . basename($slider->image));
        $slider->delete();

        return redirect()->route('slider.index')->with([
            Alert::success('Success', 'Berhasil dihapus')
        ]);
    }
}
