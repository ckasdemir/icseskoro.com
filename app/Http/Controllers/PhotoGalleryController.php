<?php

namespace App\Http\Controllers;

use App\PhotoGallery;
use App\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class PhotoGalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $setting = Setting::get()->first();

        $photo_gallery = PhotoGallery::all()->sortByDesc('created_at');

        return view('admin.photo_gallery.index', compact('photo_gallery', 'setting'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $setting = Setting::get()->first();

        return view('admin.photo_gallery.create', compact('setting'));
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

        $folderName = time() . '-' . str_slug(request('title'));

        $photo_gallery = new PhotoGallery();
        $photo_gallery->title = request('title');
        $photo_gallery->slug = str_slug(request('title'));
        $photo_gallery->description = request('description');
        $photo_gallery->status = request('status');
        $photo_gallery->user_id = Auth::user()->id;
        $photo_gallery->folder_name = $folderName;

        mkdir('uploads/photo_gallery/' . $folderName, 755, true);
        mkdir('uploads/photo_gallery/' . $folderName . '/photos/', 755, true);

        if (!empty(request('image'))) {
            if (request()->hasFile('image')) {
                $this->validate(request(), array('image' => 'image|mimes:png,jpg,jpeg,gif|max:2048'));
            }

            $file = request()->file('image');
            $fileName = time() . '-' . str_slug(request('title')) . '.' . $file->extension();

            if ($file->isValid()) {
                $folder = 'uploads/photo_gallery/' . $folderName;
                $file->move($folder, $fileName);
                $photo_gallery->image = $fileName;
            }
        }

        $photo_gallery->save();

        if ($photo_gallery) {
            alert()
                ->success('İşlem tamamlandı!', 'Foto galeri ekleme işlemi başarıyla tamamlanmıştır.')
                ->showConfirmButton()
                ->showCloseButton();

            return redirect()->route('photo_gallery.index');
        } else {
            alert()
                ->error('Hata!', 'Foto galeri ekleme işlemi başarısız.')
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

        $photo_gallery = PhotoGallery::find($id);

        return view('admin.photo_gallery.edit', compact('photo_gallery','setting'));
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

        $photo_gallery = PhotoGallery::find($id);

        if ($photo_gallery->slug != str_slug(request('title'))) {
            $folderName = time() . '-' . str_slug(request('title'));
            rename("uploads/photo_gallery/" . $photo_gallery->folder_name, "uploads/photo_gallery/" . $folderName);
        } else {
            $folderName = $photo_gallery->folder_name;
        }

        $photo_gallery->title = request('title');
        $photo_gallery->slug = str_slug(request('title'));
        $photo_gallery->description = request('description');
        $photo_gallery->status = request('status');
        $photo_gallery->folder_name = $folderName;

        if (!empty(request('image'))) {
            if (request()->hasFile('image')) {
                $this->validate(request(), array('image' => 'image|mimes:png,jpg,jpeg,gif|max:2048'));
            }

            $file = request()->file('image');
            $fileName = time() . '-' . str_slug(request('title')) . '.' . $file->extension();

            if ($file->isValid()) {
                $folder = 'uploads/photo_gallery/' . $folderName;
                $file->move($folder, $fileName);
                $photo_gallery->image = $fileName;
            }
        }

        $photo_gallery->save();

        if ($photo_gallery) {
            alert()
                ->success('İşlem tamamlandı!', 'Foto galeri güncelleme işlemi başarıyla tamamlanmıştır.')
                ->showConfirmButton()
                ->showCloseButton();

            return redirect()->route('photo_gallery.index');
        } else {
            alert()
                ->error('Hata!', 'Foto galeri güncelleme işlemi başarısız.')
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
        $path = 'uploads/photo_gallery/';

        $find = PhotoGallery::find($id);
        $galleryFolder = $find->folder_name;
        $galleryImage = $find->image;

        if ($find->photo->count() > 0) {
            alert()
                ->error('Hata!', 'Foto galeri silme işlemi başarısız. Lütfen önce galeri içerisindeki fotoğrafları siliniz.')
                ->showConfirmButton()
                ->showCloseButton();

            return back();
        } else {
            $photo_gallery = PhotoGallery::destroy($id);

            if ($photo_gallery) {
                if (!empty($galleryImage)) {
                    unlink($path . $galleryFolder . '/' . $galleryImage);
                }
                rmdir($path . $galleryFolder . '/photos/');
                rmdir($path . $galleryFolder);

                alert()
                    ->success('İşlem tamamlandı! Foto galeri silme işlemi başarıyla tamamlanmıştır.')
                    ->showConfirmButton()
                    ->showCloseButton();

                return redirect()->route('photo_gallery.index');
            } else {
                alert()
                    ->error('Hata!', 'Foto galeri silme işlemi başarısız.')
                    ->showConfirmButton()
                    ->showCloseButton();

                return back();
            }
        }
    }

    public function active($id)
    {
        $find = PhotoGallery::find($id);
        $find->status = true;

        $find->save();

        return redirect()->route('photo_gallery.index');
    }

    public function passive($id)
    {
        $find = PhotoGallery::find($id);
        $find->status = false;

        $find->save();

        return redirect()->route('photo_gallery.index');
    }
}
