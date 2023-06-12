<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\News;
use App\Models\Slider;
use Illuminate\Http\Request;

class FrontEndController extends Controller
{
    public function index()
    {
        $nav_category = Category::all();
        $title = "welcome to ZenBlog";
        $news     = News::latest()->get();
        $side_news = News::inRandomOrder()->limit(4)->get();
        $slider = Slider::all();

        return view('frontend.index', compact('nav_category', 'news', 'side_news', 'title', 'slider'));
    }

    public function detailCategory($slug)
    {
        
        $category = Category::where('slug', $slug)->first();
        $text = Category::findOrFail($category->id)->name;
        $title = "detail Category - $text";
        $news    = News::where('category_id', $category->id)->paginate(10);
        $nav_category = Category::all();
       
        $side_news = News::inRandomOrder()->limit(4)->get();
        return view('Frontend.detail-category', compact('news', 'nav_category', 'side_news','title'));
        
    }

    public function detailNews($slug)
    {
        
        $news = News::where('slug', $slug)->first();
        $text = News::findOrFail($news->id)->title;
        $title = "Berita - $text";
        $nav_category = Category::all();
        $side_news = News::inRandomOrder()->limit(4)->get();
        return view('Frontend.detail-news', compact('news', 'nav_category', 'side_news','title'));
    }


    public function searchNews(Request $request)
    {
        $keyword = $request->keyword;
        $news = News::where('title', 'like', '%' .  $keyword . '%')->paginate(10);
        $nav_category = Category::all();
        $title = "welcome to ZenBlog";
        $side_news = News::inRandomOrder()->limit(4)->get();
        $slider = Slider::all();

        return view('Frontend.index', compact('news', 'slider', 'title', 'side_news', 'nav_category'));
    }
}
