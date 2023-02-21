<?php

namespace App\Http\Controllers;

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

    public function add(Request $request): RedirectResponse
    {      
        $news = News::create([
            'title' => $request->title,
            'description' => $request->description,
            'user_id' => $request->user->id,
        ]);

        return redirect()->back();
    }

    public function delete($news_id): RedirectResponse
    {
        $news = News::find($news_id);
        $news->delete();
        
        return redirect()->back();
    }
}
