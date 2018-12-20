<?php

namespace App\Http\Controllers;

use App\Photo;
use App\PhotoGallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PhotoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $photos = Photo::all()->sortByDesc('created_at');

        return view('admin.photo.index', compact('photos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $photo_gallery = PhotoGallery::where('status', '=', true)->get()->sortBy('title');

        return view('admin.photo.create', compact('photo_gallery'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (PhotoGallery::where('status', '=', true)->count() > 0) {
            $this->validate(request(), array(
                'title' => 'required',
                'image' => 'required',
                'photo_gallery_id' => 'required'
            ));

            $galleryFolder = PhotoGallery::find(request('photo_gallery_id'))->folder_name;

            $photo = new Photo();
            $photo->title = request('title');
            $photo->slug = str_slug(request('title'));
            $photo->description = request('description');
            $photo->photo_gallery_id = request('photo_gallery_id');
            $photo->status = request('status');
            $photo->user_id = Auth::user()->id;

            if (!empty(request('image'))) {
                if (request()->hasFile('image')) {
                    $this->validate(request(), array('image' => 'image|mimes:png,jpg,jpeg,gif|max:2048'));
                }

                $file = request()->file('image');
                $fileName = time() . '-' . str_slug(request('title')) . '.' . $file->extension();

                if ($file->isValid()) {
                    $folder = 'uploads/photo_gallery/' . $galleryFolder . '/photos';
                    $file->move($folder, $fileName);
                    $photo->image = $fileName;
                }
            }

            $photo->save();

            if ($photo) {
                alert()
                    ->success('İşlem tamamlandı!', 'Fotoğraf ekleme işlemi başarıyla tamamlanmıştır.')
                    ->showConfirmButton()
                    ->showCloseButton();

                return redirect()->route('photos.index');
            } else {
                alert()
                    ->error('Hata!', 'Fotoğraf ekleme işlemi başarısız.')
                    ->showConfirmButton()
                    ->showCloseButton();

                return back();
            }
        } else {
            alert()
                ->error('Hata!', 'Fotoğraf ekleme işlemi başarısız. Lütfen önce kategori ekleyiniz.')
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
        $photo_gallery = PhotoGallery::where('status', '=', true)->get()->sortBy('title');

        $photo = Photo::find($id);

        return view('admin.photo.edit', compact('photo', 'photo_gallery'));
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
            'photo_gallery_id' => 'required'
        ));

        $oldGalleryFolder = PhotoGallery::find(Photo::find($id)->photo_gallery_id)->folder_name;
        $galleryFolder = PhotoGallery::find(request('photo_gallery_id'))->folder_name;

        $photo = Photo::find($id);
        $photo->title = request('title');
        $photo->slug = str_slug(request('title'));
        $photo->description = request('description');
        $photo->photo_gallery_id = request('photo_gallery_id');
        $photo->status = request('status');

        if (!empty(request('image'))) {
            if (request()->hasFile('image')) {
                $this->validate(request(), array('image' => 'image|mimes:png,jpg,jpeg,gif|max:2048'));
            }

            $file = request()->file('image');
            $fileName = time() . '-' . str_slug(request('title')) . '.' . $file->extension();

            if ($file->isValid()) {
                $folder = 'uploads/photo_gallery/' . $galleryFolder . '/photos';
                $file->move($folder, $fileName);
                $photo->image = $fileName;
            }
        } else {
            rename('uploads/photo_gallery/' . $oldGalleryFolder . '/photos/' . $photo->image, 'uploads/photo_gallery/' . $galleryFolder . '/photos/' . $photo->image);
        }

        $photo->save();

        if ($photo) {
            alert()
                ->success('İşlem tamamlandı!', 'Fotoğraf güncelleme işlemi başarıyla tamamlanmıştır.')
                ->showConfirmButton()
                ->showCloseButton();

            return redirect()->route('photos.index');
        } else {
            alert()
                ->error('Hata!', 'Fotoğraf güncelleme işlemi başarısız.')
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
        $find = Photo::find($id);
        $galleryFolder = PhotoGallery::find($find->photo_gallery_id)->folder_name;

        $photo = Photo::destroy($id);

        if ($photo) {
            unlink('uploads/photo_gallery/' . $galleryFolder . '/photos/' . $find->image);

            alert()
                ->success('İşlem tamamlandı!', 'Fotoğraf silme işlemi başarıyla tamamlanmıştır.')
                ->showConfirmButton()
                ->showCloseButton();

            return redirect()->route('photos.index');
        } else {
            alert()
                ->error('Hata!', 'Fotoğraf silme işlemi başarısız.')
                ->showConfirmButton()
                ->showCloseButton();

            return back();
        }
    }

    public function active($id)
    {
        $find = Photo::find($id);
        $find->status = true;

        $find->save();

        return redirect()->route('photos.index');
    }

    public function passive($id)
    {
        $find = Photo::find($id);
        $find->status = false;

        $find->save();

        return redirect()->route('photos.index');
    }
}
