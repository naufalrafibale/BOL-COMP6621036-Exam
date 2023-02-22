<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\News;

class NewsController extends Controller
{
    public function view_guest(): View
    {
        $news = News::all()->sortBy('created_at');
        
        return view('app.news', [
            'news' => $news,
        ]);
    }

    public function view_manager(): View
    {
        $news = News::all()->sortBy('created_at');
        
        return view('app.news-management', [
            'news' => $news,
        ]);
    }

    public function add(Request $request): RedirectResponse
    {      
        $news = News::create([
            'title' => $request->title,
            'description' => $request->description,
            'user_id' => $request->user()->id,
        ]);

        return redirect()->back();
    }

    public function update(Request $request): RedirectResponse
    {
        $news = News::find($request->id);
        $news->title = $request->title;
        $news->description = $request->description;
        $news->save();

        return redirect()->back();
    }

    public function destroy($news_id): RedirectResponse
    {
        $news = News::find($news_id);
        $news->delete();
        
        return redirect()->back();
    }
}
