<?php

namespace App\Http\Controllers;

use App\Album;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AlbumController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $albums = Album::all()->sortByDesc('created_at');

        return view('admin.album.index', compact('albums'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.album.create');
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
            'album_name' => 'required'
        ));

        $folderName = time() . '-' . str_slug(request('album_name'));

        $album = new Album();
        $album->album_name = request('album_name');
        $album->slug = str_slug(request('album_name'));
        $album->description = request('description');
        $album->status = request('status');
        $album->user_id = Auth::user()->id;
        $album->folder_name = $folderName;

        mkdir('uploads/albums/' . $folderName, 644, true);
        mkdir('uploads/albums/' . $folderName . '/songs/', 644, true);

        if (!empty(request('image'))) {
            if (request()->hasFile('image')) {
                $this->validate(request(), array('image' => 'image|mimes:png,jpg,jpeg,gif|max:2048'));
            }

            $file = request()->file('image');
            $fileName = time() . '-' . str_slug(request('album_name')) . '.' . $file->extension();

            if ($file->isValid()) {
                $folder = 'uploads/albums/' . $folderName;
                $file->move($folder, $fileName);
                $album->image = $fileName;
            }
        }

        $album->save();

        if ($album) {
            alert()
                ->success('İşlem tamamlandı!', 'Albüm ekleme işlemi başarıyla tamamlanmıştır.')
                ->showConfirmButton()
                ->showCloseButton();

            return redirect()->route('albums.index');
        } else {
            alert()
                ->error('Hata!', 'Albüm ekleme işlemi başarısız.')
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
        $album = Album::find($id);

        return view('admin.album.edit', compact('album'));
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
            'album_name' => 'required'
        ));

        $folderName = time() . '-' . str_slug(request('album_name'));

        $album = Album::find($id);
        $album->album_name = request('album_name');
        $album->slug = str_slug(request('album_name'));
        $album->description = request('description');
        $album->status = request('status');
        $album->user_id = Auth::user()->id;
        $album->folder_name = $folderName;

        mkdir('uploads/albums/' . $folderName, 644, true);
        mkdir('uploads/albums/' . $folderName . '/songs/', 644, true);

        if (!empty(request('image'))) {
            if (request()->hasFile('image')) {
                $this->validate(request(), array('image' => 'image|mimes:png,jpg,jpeg,gif|max:2048'));
            }

            $file = request()->file('image');
            $fileName = time() . '-' . str_slug(request('album_name')) . '.' . $file->extension();

            if ($file->isValid()) {
                $folder = 'uploads/albums/' . $folderName;
                $file->move($folder, $fileName);
                $album->image = $fileName;
            }
        }

        $album->save();

        if ($album) {
            alert()
                ->success('İşlem tamamlandı!', 'Albüm güncelleme işlemi başarıyla tamamlanmıştır.')
                ->showConfirmButton()
                ->showCloseButton();

            return redirect()->route('albums.index');
        } else {
            alert()
                ->error('Hata!', 'Albüm güncelleme işlemi başarısız.')
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
        $path = 'uploads/albums/';

        $find = Album::find($id);
        $albumFolder = $find->folder_name;
        $albumImage = $find->image;

        if ($find->song->count() > 0) {
            alert()
                ->error('Hata!', 'Albüm silme işlemi başarısız. Lütfen önce albüm içerisindeki şarkıları siliniz.')
                ->showConfirmButton()
                ->showCloseButton();

            return back();
        } else {
            $album = Album::destroy($id);

            if ($album) {
                if (!empty($albumImage)) {
                    unlink($path . $albumFolder . '/' . $albumImage);
                }
                rmdir($path . $albumFolder . '/songs/');
                rmdir($path . $albumFolder);

                alert()
                    ->success('İşlem tamamlandı! Albüm silme işlemi başarıyla tamamlanmıştır.')
                    ->showConfirmButton()
                    ->showCloseButton();

                return redirect()->route('albums.index');
            } else {
                alert()
                    ->error('Hata!', 'Albüm silme işlemi başarısız.')
                    ->showConfirmButton()
                    ->showCloseButton();

                return back();
            }
        }
    }
}
