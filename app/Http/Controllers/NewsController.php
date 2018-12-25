<?php

namespace App\Http\Controllers;

use App\News;
use App\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $setting = Setting::get()->first();

        $news = News::all()->sortByDesc('created_at');

        return view('admin.news.index', compact('news','setting'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $setting = Setting::get()->first();

        return view('admin.news.create',compact('setting'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate(request(), array(
            'title' => 'required',
            'content' => 'required'
        ));

        $news = new News();
        $news->title = request('title');
        $news->content = request('content');
        $news->slug = str_slug(request('title'));
        $news->status = request('status');
        $news->tags = request('tags');
        $news->user_id = Auth::user()->id;

        if (!empty(request('image'))) {
            if (request()->hasFile('image')) {
                $this->validate(request(), array('image' => 'image|mimes:png,jpg,jpeg,gif|max:2048'));
            }

            $file = request()->file('image');
            $fileName = time() . '-' . str_slug(request('title')) . '.' . $file->extension();

            if ($file->isValid()) {
                $folder = 'uploads/news';
                $file->move($folder, $fileName);
                $news->image = $fileName;
            }
        }

        $news->save();

        if ($news) {
            alert()
                ->success('İşlem tamamlandı!', 'Haber ekleme işlemi başarıyla tamamlanmıştır.')
                ->showConfirmButton()
                ->showCloseButton();

            return redirect()->route('news.index');
        } else {
            alert()
                ->error('Hata!', 'Haber ekleme işlemi başarısız.')
                ->showConfirmButton()
                ->showCloseButton();

            return back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $setting = Setting::get()->first();

        $news = News::find($id);

        return view('admin.news.edit', compact('news','setting'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate(request(), array(
            'title' => 'required',
            'content' => 'required'
        ));

        $news = News::find($id);
        $news->title = request('title');
        $news->content = request('content');
        $news->slug = str_slug(request('title'));
        $news->tags = request('tags');
        $news->status = request('status');

        if (!empty(request('image'))) {
            if (request()->hasFile('image')) {
                $this->validate(request(), array('image' => 'image|mimes:png,jpg,jpeg,gif|max:2048'));
            }

            $file = request()->file('image');
            $fileName = time() . '-' . str_slug(request('title')) . '.' . $file->extension();

            if ($file->isValid()) {
                $folder = 'uploads/news';
                $file->move($folder, $fileName);
                $news->image = $fileName;
            }
        }

        $news->save();

        if ($news) {
            alert()
                ->success('İşlem tamamlandı!', 'Haber güncelleme işlemi başarıyla tamamlanmıştır.')
                ->showConfirmButton()
                ->showCloseButton();

            return redirect()->route('news.index');
        } else {
            alert()
                ->error('Hata!', 'Haber güncelleme işlemi başarısız.')
                ->showConfirmButton()
                ->showCloseButton();

            return back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $news = News::destroy($id);

        if ($news) {
            alert()
                ->success('İşlem tamamlandı!', 'Haber silme işlemi başarıyla tamamlanmıştır.')
                ->showConfirmButton()
                ->showCloseButton();

            return redirect()->route('news.index');
        } else {
            alert()
                ->error('Hata!', 'Haber silme işlemi başarısız.')
                ->showConfirmButton()
                ->showCloseButton();

            return back();
        }
    }

    public function active($id)
    {
        $find = News::find($id);
        $find->status = true;

        $find->save();

        return redirect()->route('news.index');
    }

    public function passive($id)
    {
        $find = News::find($id);
        $find->status = false;

        $find->save();

        return redirect()->route('news.index');
    }
}
