<?php

namespace App\Http\Controllers;

use App\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ImageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $images = Image::all()->sortByDesc('created_at');

        return view('admin.image.index', compact('images'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            'filename' => 'required'
        ));

        $image = new Image();
        $image->user_id = Auth::user()->id;

        if (!empty(request('filename'))) {
            if (request()->hasFile('filename')) {
                $this->validate(request(), array('filename' => 'image|mimes:png,jpg,jpeg,gif|max:2048'));
            }

            $file = request()->file('filename');
            $fileName = time() . '-' . str_slug(request('filename')) . '.' . $file->extension();

            if ($file->isValid()) {
                $folder = 'uploads/contents/';
                $file->move($folder, $fileName);
                $image->filename = $fileName;
            }
        }

        $image->save();

        if ($image) {
            alert()
                ->success('İşlem tamamlandı!', 'Resim ekleme işlemi başarıyla tamamlanmıştır.')
                ->showConfirmButton()
                ->showCloseButton();

            return redirect()->route('images.index');
        } else {
            alert()
                ->error('Hata!', 'Resim ekleme işlemi başarısız.')
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $find = Image::find($id);

        $image = Image::destroy($id);

        if ($image) {
            unlink('uploads/contents/' . $find->filename);

            alert()
                ->success('İşlem tamamlandı!', 'Resim silme işlemi başarıyla tamamlanmıştır.')
                ->showConfirmButton()
                ->showCloseButton();

            return redirect()->route('images.index');
        } else {
            alert()
                ->error('Hata!', 'Resim silme işlemi başarısız.')
                ->showConfirmButton()
                ->showCloseButton();

            return back();
        }
    }
}
