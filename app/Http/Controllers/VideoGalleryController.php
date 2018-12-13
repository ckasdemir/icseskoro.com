<?php

namespace App\Http\Controllers;

use App\VideoGallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VideoGalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $video_gallery = VideoGallery::all()->sortByDesc('created_at');

        return view('admin.video_gallery.index', compact('video_gallery'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.video_gallery.create');
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
            'title' => 'required'
        ));

        $video_gallery = new VideoGallery();
        $video_gallery->title = request('title');
        $video_gallery->slug = str_slug(request('title'));
        $video_gallery->description = request('description');
        $video_gallery->status = request('status');
        $video_gallery->user_id = Auth::user()->id;

        if (!empty(request('image'))) {
            if (request()->hasFile('image')) {
                $this->validate(request(), array('image' => 'image|mimes:png,jpg,jpeg,gif|max:2048'));
            }

            $file = request()->file('image');
            $fileName = time() . '-' . str_slug(request('title')) . '.' . $file->extension();

            if ($file->isValid()) {
                $folder = 'uploads/video_gallery/';
                $file->move($folder, $fileName);
                $video_gallery->image = $fileName;
            }
        }

        $video_gallery->save();

        if ($video_gallery) {
            alert()
                ->success('İşlem tamamlandı!', 'Video galeri ekleme işlemi başarıyla tamamlanmıştır.')
                ->showConfirmButton()
                ->showCloseButton();

            return redirect()->route('video_gallery.index');
        } else {
            alert()
                ->error('Hata!', 'Video galeri ekleme işlemi başarısız.')
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
        $video_gallery = VideoGallery::find($id);

        return view('admin.video_gallery.edit', compact('video_gallery'));
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
            'title' => 'required'
        ));

        $video_gallery = VideoGallery::find($id);
        $video_gallery->title = request('title');
        $video_gallery->slug = str_slug(request('title'));
        $video_gallery->description = request('description');
        $video_gallery->status = request('status');

        if (!empty(request('image'))) {
            if (request()->hasFile('image')) {
                $this->validate(request(), array('image' => 'image|mimes:png,jpg,jpeg,gif|max:2048'));
            }

            $file = request()->file('image');
            $fileName = time() . '-' . str_slug(request('title')) . '.' . $file->extension();

            if ($file->isValid()) {
                $folder = 'uploads/video_gallery/';
                $file->move($folder, $fileName);
                $video_gallery->image = $fileName;
            }
        }

        $video_gallery->save();

        if ($video_gallery) {
            alert()
                ->success('İşlem tamamlandı!', 'Video galeri güncelleme işlemi başarıyla tamamlanmıştır.')
                ->showConfirmButton()
                ->showCloseButton();

            return redirect()->route('video_gallery.index');
        } else {
            alert()
                ->error('Hata!', 'Video galeri güncelleme işlemi başarısız.')
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
        $find = VideoGallery::find($id);
        $galleryImage = $find->image;

        if ($find->video->count() > 0) {
            alert()
                ->error('Hata!', 'Video galeri silme işlemi başarısız. Lütfen önce galeri içerisindeki videoları siliniz.')
                ->showConfirmButton()
                ->showCloseButton();

            return back();
        } else {
            $video_gallery = VideoGallery::destroy($id);

            if ($video_gallery) {
                if (!empty($galleryImage)) {
                    unlink('uploads/video_gallery/' . $galleryImage);
                }

                alert()
                    ->success('İşlem tamamlandı! Video galeri silme işlemi başarıyla tamamlanmıştır.')
                    ->showConfirmButton()
                    ->showCloseButton();

                return redirect()->route('video_gallery.index');
            } else {
                alert()
                    ->error('Hata!', 'Video galeri silme işlemi başarısız.')
                    ->showConfirmButton()
                    ->showCloseButton();

                return back();
            }
        }
    }
}
