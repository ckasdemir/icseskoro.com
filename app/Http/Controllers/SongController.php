<?php

namespace App\Http\Controllers;

use App\Album;
use App\Song;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SongController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $songs = Song::all()->sortByDesc('created_at');

        return view('admin.song.index', compact('songs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $albums = Album::where('status', '=', true)->get()->sortBy('album_name');

        return view('admin.song.create', compact('albums'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (Album::where('status', '=', true)->count() > 0) {
            $this->validate(request(), array(
                'song_name' => 'required',
                'album_id' => 'required'
            ));

            $albumFolder = Album::find(request('album_id'))->folder_name;

            $song = new Song();
            $song->album_id = request('album_id');
            $song->song_name = request('song_name');
            $song->slug = str_slug(request('song_name'));
            $song->status = request('status');
            $song->user_id = Auth::user()->id;

            if (!empty(request('document'))) {
                if (request()->hasFile('document')) {
                    $this->validate(request(), array('document' => 'mimes:doc,docx,pdf,png,jpg,jpeg,gif|max:2048'));
                }

                $file = request()->file('document');
                $fileName = time() . '-' . str_slug(request('song_name')) . '.' . $file->extension();

                if ($file->isValid()) {
                    $folder = 'uploads/albums/' . $albumFolder . '/songs/';
                    $file->move($folder, $fileName);
                    $song->document = $fileName;
                }
            }

            if (!empty(request('recording'))) {
                if (request()->hasFile('recording')) {
                    $this->validate(request(), array('recording' => 'mimes:wav,mpga|max:99999'));
                }

                $songFile = request()->file('recording');
                $songFileName = time() . '-' . str_slug(request('song_name')) . '.mp3';

                if ($songFile->isValid()) {
                    $folder = 'uploads/albums/' . $albumFolder . '/songs/';
                    $songFile->move($folder, $songFileName);
                    $song->recording = $songFileName;
                }
            }

            $song->save();

            if ($song) {
                alert()
                    ->success('İşlem tamamlandı!', 'Şarkı ekleme işlemi başarıyla tamamlanmıştır.')
                    ->showConfirmButton()
                    ->showCloseButton();

                return redirect()->route('songs.index');
            } else {
                alert()
                    ->error('Hata!', 'Şarkı ekleme işlemi başarısız.')
                    ->showConfirmButton()
                    ->showCloseButton();

                return back();
            }
        } else {
            alert()
                ->error('Hata!', 'Şarkı ekleme işlemi başarısız. Lütfen önce albüm ekleyiniz.')
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
        $albums = Album::where('status', '=', true)->get()->sortBy('album_name');

        $song = Song::find($id);

        return view('admin.song.edit', compact('song', 'albums'));
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
        $albumFolder = Album::find(request('album_id'))->folder_name;

        $song = Song::find($id);
        $song->album_id = request('album_id');
        $song->song_name = request('song_name');
        $song->slug = str_slug(request('song_name'));
        $song->status = request('status');

        if (!empty(request('document'))) {
            if (request()->hasFile('document')) {
                $this->validate(request(), array('document' => 'mimes:doc,docx,pdf,png,jpg,jpeg,gif|max:9999'));
            }

            $file = request()->file('document');
            $fileName = time() . '-' . str_slug(request('song_name')) . '.' . $file->extension();

            if ($file->isValid()) {
                $folder = 'uploads/albums/' . $albumFolder . '/songs/';
                $file->move($folder, $fileName);
                $song->document = $fileName;
            }
        }

        if (!empty(request('recording'))) {
            if (request()->hasFile('recording')) {
                $this->validate(request(), array('recording' => 'mimes:wav,mpga|max:99999'));
            }

            $songFile = request()->file('recording');
            $songFileName = time() . '-' . str_slug(request('song_name')) . '.mp3';

            if ($songFile->isValid()) {
                $folder = 'uploads/albums/' . $albumFolder . '/songs/';
                $songFile->move($folder, $songFileName);
                $song->recording = $songFileName;
            }
        }

        $song->save();

        if ($song) {
            alert()
                ->success('İşlem tamamlandı!', 'Şarkı ekleme işlemi başarıyla tamamlanmıştır.')
                ->showConfirmButton()
                ->showCloseButton();

            return redirect()->route('songs.index');
        } else {
            alert()
                ->error('Hata!', 'Şarkı ekleme işlemi başarısız.')
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
        $find = Song::find($id);
        $albumFolder = Album::find($find->album_id)->folder_name;

        $song = Song::destroy($id);

        if ($song) {
            unlink('uploads/albums/' . $albumFolder . '/songs/' . $find->document);
            unlink('uploads/albums/' . $albumFolder . '/songs/' . $find->recording);
            alert()
                ->success('İşlem tamamlandı!', 'Şarkı silme işlemi başarıyla tamamlanmıştır.')
                ->showConfirmButton()
                ->showCloseButton();

            return redirect()->route('songs.index');
        } else {
            alert()
                ->error('Hata!', 'Şarkı silme işlemi başarısız.')
                ->showConfirmButton()
                ->showCloseButton();

            return back();
        }
    }

    public function document($id)
    {
        $song = Song::find($id);

        if (!empty($song->document) && file_exists(public_path("/uploads/albums/" . $song->album->folder_name . '/songs/' . $song->document))) {
            $file = public_path("/uploads/albums/" . $song->album->folder_name . '/songs/' . $song->document);

            $headers = ['Content-Type: application/pdf', 'Content-Type: application/image', 'Content-Type: application/audio', 'Content-Type: application/vnd.openxmlformats-officedocument.wordprocessingml.document'];
        }
        return response()->download($file, $song->document, $headers);
    }

    public function recording($id)
    {
        $song = Song::find($id);

        if (!empty($song->recording) && file_exists(public_path("/uploads/albums/" . $song->album->folder_name . '/songs/' . $song->recording))) {
            $file = public_path("/uploads/albums/" . $song->album->folder_name . '/songs/' . $song->recording);

            $headers = ['Content-Type: application/pdf', 'Content-Type: application/image', 'Content-Type: application/audio', 'Content-Type: application/vnd.openxmlformats-officedocument.wordprocessingml.document'];
        }
        return response()->download($file, $song->recording, $headers);
    }

    public function active($id)
    {
        $find = Song::find($id);
        $find->status = true;

        $find->save();

        return redirect()->route('songs.index');
    }

    public function passive($id)
    {
        $find = Song::find($id);
        $find->status = false;

        $find->save();

        return redirect()->route('songs.index');
    }
}
