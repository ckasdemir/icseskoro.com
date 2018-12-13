<?php

namespace App\Http\Controllers;

use App\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $setting = Setting::all()->sortByDesc('created_at')->first();

        return view('admin.setting.index', compact('setting'));
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
        //
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
        $setting = Setting::find($id);
        $setting->title = request('title');
        $setting->keywords = request('keywords');
        $setting->description = request('description');
        $setting->facebook = request('facebook');
        $setting->twitter = request('twitter');
        $setting->instagram = request('instagram');
        $setting->youtube = request('youtube');
        $setting->vimeo = request('vimeo');
        $setting->soundcloud = request('soundcloud');
        $setting->address = request('address');
        $setting->mobile = request('mobile');
        $setting->email = request('email');
        $setting->map = request('map');
        $setting->work_days_1 = request('work_days_1');
        $setting->work_days_2 = request('work_days_2');
        $setting->work_days_3 = request('work_days_3');
        $setting->work_days_4 = request('work_days_4');
        $setting->work_days_5 = request('work_days_5');
        $setting->work_days_6 = request('work_days_6');
        $setting->work_days_7 = request('work_days_7');
        $setting->work_start_time = request('work_start_time');
        $setting->work_end_time = request('work_end_time');

        if (!empty(request('logo'))) {
            if (request()->hasFile('logo')) {
                $this->validate(request(), array('logo' => 'image|mimes:png,jpg,jpeg,gif|max:2048'));
            }

            $file = request()->file('logo');
            $fileName = 'logo-' . str_slug(request('title')) . '-' . time() . '.' . $file->extension();

            if ($file->isValid()) {
                $folder = 'site/assets/images/';
                $file->move($folder, $fileName);
                $setting->logo = $fileName;
            }
        }

        $setting->save();

        if ($setting) {
            alert()
                ->success('İşlem tamamlandı!', 'Ayarlar başarıyla kaydedilmiştir.')
                ->showConfirmButton()
                ->showCloseButton();

            return redirect()->route('settings.index');
        } else {
            alert()
                ->error('Hata!', 'Ayarlar güncellenemedi.')
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
        //
    }
}
