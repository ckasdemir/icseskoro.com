<?php

namespace App\Http\Controllers;

use App\Video;
use App\VideoGallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VideoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $videos = Video::all()->sortByDesc('created_at');

        return view('admin.video.index', compact('videos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $video_gallery = VideoGallery::where('status', '=', true)->get()->sortBy('title');

        return view('admin.video.create', compact('video_gallery'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (VideoGallery::where('status', '=', true)->count() > 0) {
            $this->validate(request(), array(
                'title' => 'required',
                'video' => 'required',
                'video_gallery_id' => 'required',
                'channel' => 'required',
            ));

            $video = new Video();
            $video->title = request('title');
            $video->slug = str_slug(request('title'));
            $video->description = request('description');
            $video->video_gallery_id = request('video_gallery_id');
            $video->video = request('video');
            $video->channel = request('channel');
            $video->status = request('status');
            $video->user_id = Auth::user()->id;

            $video->save();

            if ($video) {
                alert()
                    ->success('İşlem tamamlandı!', 'Video ekleme işlemi başarıyla tamamlanmıştır.')
                    ->showConfirmButton()
                    ->showCloseButton();

                return redirect()->route('videos.index');
            } else {
                alert()
                    ->error('Hata!', 'Video ekleme işlemi başarısız.')
                    ->showConfirmButton()
                    ->showCloseButton();

                return back();
            }
        } else {
            alert()
                ->error('Hata!', 'Video ekleme işlemi başarısız. Lütfen önce video kategorisi ekleyiniz.')
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
        $video_gallery = VideoGallery::where('status', '=', true)->get()->sortBy('title');

        $video = Video::find($id);

        return view('admin.video.edit', compact('video', 'video_gallery'));
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
            'video_gallery_id' => 'required'
        ));

        $video = Video::find($id);
        $video->title = request('title');
        $video->slug = str_slug(request('title'));
        $video->description = request('description');
        $video->video_gallery_id = request('video_gallery_id');
        $video->video = request('video');
        $video->status = request('status');
        $video->channel = request('channel');

        $video->save();

        if ($video) {
            alert()
                ->success('İşlem tamamlandı!', 'Video güncelleme işlemi başarıyla tamamlanmıştır.')
                ->showConfirmButton()
                ->showCloseButton();

            return redirect()->route('videos.index');
        } else {
            alert()
                ->error('Hata!', 'Video güncelleme işlemi başarısız.')
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
        $video = Video::destroy($id);

        if ($video) {
            alert()
                ->success('İşlem tamamlandı! Video silme işlemi başarıyla tamamlanmıştır.')
                ->showConfirmButton()
                ->showCloseButton();

            return redirect()->route('videos.index');
        } else {
            alert()
                ->error('Hata!', 'Video silme işlemi başarısız.')
                ->showConfirmButton()
                ->showCloseButton();

            return back();
        }
    }

    public function active($id)
    {
        $find = Video::find($id);
        $find->status = true;

        $find->save();

        return redirect()->route('videos.index');
    }

    public function passive($id)
    {
        $find = Video::find($id);
        $find->status = false;

        $find->save();

        return redirect()->route('videos.index');
    }
}
