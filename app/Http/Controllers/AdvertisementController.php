<?php

namespace App\Http\Controllers;

use App\Advertisement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdvertisementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $advertisements = Advertisement::all()->sortByDesc('created_at');

        return view('admin.advertisement.index', compact('advertisements'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.advertisement.create');
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
            'image' => 'required'
        ));

        $advertisement = new Advertisement();
        $advertisement->title = request('title');
        $advertisement->slug = str_slug(request('title'));
        $advertisement->url = !empty(request('url')) ? request('url') : "#";
        $advertisement->status = request('status');
        $advertisement->user_id = Auth::user()->id;

        if (!empty(request('image'))) {
            if (request()->hasFile('image')) {
                $this->validate(request(), array('image' => 'image|mimes:png,jpg,jpeg,gif|max:2048'));
            }

            $file = request()->file('image');
            $fileName = time() . '-' . str_slug(request('title')) . '.' . $file->extension();

            if ($file->isValid()) {
                $folder = 'uploads/advertisements';
                $file->move($folder, $fileName);
                $advertisement->image = $fileName;
            }
        }

        $advertisement->save();

        if ($advertisement) {
            alert()
                ->success('İşlem tamamlandı!', 'Reklam ekleme işlemi başarıyla tamamlanmıştır.')
                ->showConfirmButton()
                ->showCloseButton();

            return redirect()->route('advertisements.index');
        } else {
            alert()
                ->error('Hata!', 'Reklam ekleme işlemi başarısız.')
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
        $advertisement = Advertisement::find($id);

        return view('admin.advertisement.edit', compact('advertisement'));
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

        $advertisement = Advertisement::find($id);
        $advertisement->title = request('title');
        $advertisement->slug = str_slug(request('title'));
        $advertisement->url = !empty(request('url')) ? request('url') : "#";
        $advertisement->status = request('status');
        $advertisement->user_id = Auth::user()->id;

        $old_image = $advertisement->image;

        if (!empty(request('image'))) {
            if (request()->hasFile('image')) {
                $this->validate(request(), array('image' => 'image|mimes:png,jpg,jpeg,gif|max:2048'));
            }

            $file = request()->file('image');
            $fileName = time() . '-' . str_slug(request('title')) . '.' . $file->extension();

            if ($file->isValid()) {
                $folder = 'uploads/advertisements';
                $file->move($folder, $fileName);
                $advertisement->image = $fileName;
            }

            unlink('uploads/advertisements/' . $old_image);
        }

        $advertisement->save();

        if ($advertisement) {
            alert()
                ->success('İşlem tamamlandı!', 'Reklam ekleme işlemi başarıyla tamamlanmıştır.')
                ->showConfirmButton()
                ->showCloseButton();

            return redirect()->route('advertisements.index');
        } else {
            alert()
                ->error('Hata!', 'Reklam ekleme işlemi başarısız.')
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
        $find = Advertisement::find($id);

        $advertisement = Advertisement::destroy($id);

        if ($advertisement) {
            unlink('uploads/advertisements/' . $find->image);

            alert()
                ->success('İşlem tamamlandı!', 'Reklam silme işlemi başarıyla tamamlanmıştır.')
                ->showConfirmButton()
                ->showCloseButton();

            return redirect()->route('advertisements.index');
        } else {
            alert()
                ->error('Hata!', 'Reklam silme işlemi başarısız.')
                ->showConfirmButton()
                ->showCloseButton();

            return back();
        }
    }
}
