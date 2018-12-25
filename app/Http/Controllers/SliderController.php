<?php

namespace App\Http\Controllers;

use App\Setting;
use App\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $setting = Setting::get()->first();

        $sliders = Slider::all()->sortByDesc('order_no');

        return view('admin.slider.index', compact('sliders', 'setting'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $setting = Setting::get()->first();

        return view('admin.slider.create', compact('setting'));
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
            'image' => 'required'
        ));

        $statement = DB::select("SHOW TABLE STATUS LIKE 'sliders'");
        $nextId = $statement[0]->Auto_increment;

        $slider = new Slider();
        $slider->title = request('title');
        $slider->content = request('content');
        $slider->slug = str_slug(request('title'));
        $slider->is_show_content = request('is_show_content');
        $slider->status = request('status');
        $slider->order_no = $nextId;
        $slider->user_id = Auth::user()->id;

        if (!empty(request('image'))) {
            if (request()->hasFile('image')) {
                $this->validate(request(), array('image' => 'image|mimes:png,jpg,jpeg,gif|max:2048'));
            }

            $file = request()->file('image');
            $fileName = time() . '-' . str_slug(request('title')) . '.' . $file->extension();

            if ($file->isValid()) {
                $folder = 'uploads/sliders';
                $file->move($folder, $fileName);
                $slider->image = $fileName;
            }
        }

        $slider->save();

        if ($slider) {
            alert()
                ->success('İşlem tamamlandı!', 'Foto slide ekleme işlemi başarıyla tamamlanmıştır.')
                ->showConfirmButton()
                ->showCloseButton();

            return redirect()->route('sliders.index');
        } else {
            alert()
                ->error('Hata!', 'Foto slide ekleme işlemi başarısız.')
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

        $sliders = Slider::find($id);

        return view('admin.slider.edit', compact('sliders', 'setting'));
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
        $slider = Slider::find($id);
        $slider->title = request('title');
        $slider->content = request('content');
        $slider->slug = str_slug(request('title'));
        $slider->is_show_content = request('is_show_content');
        $slider->status = request('status');

        if (!empty(request('image'))) {
            if (request()->hasFile('image')) {
                $this->validate(request(), array('image' => 'image|mimes:png,jpg,jpeg,gif|max:2048'));
            }

            $file = request()->file('image');
            $fileName = time() . '-' . str_slug(request('title')) . '.' . $file->extension();

            if ($file->isValid()) {
                $folder = 'uploads/sliders';
                $file->move($folder, $fileName);
                $slider->image = $fileName;
            }
        }

        $slider->save();

        if ($slider) {
            alert()
                ->success('İşlem tamamlandı!', 'Foto slide güncelleme işlemi başarıyla tamamlanmıştır.')
                ->showConfirmButton()
                ->showCloseButton();

            return redirect()->route('sliders.index');
        } else {
            alert()
                ->error('Hata!', 'Foto slide güncelleme işlemi başarısız.')
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
        $slider = Slider::destroy($id);

        if ($slider) {
            alert()
                ->success('İşlem tamamlandı!', 'Foto slide silme işlemi başarıyla tamamlanmıştır.')
                ->showConfirmButton()
                ->showCloseButton();

            return redirect()->route('sliders.index');
        } else {
            alert()
                ->error('Hata!', 'Foto slide silme işlemi başarısız.')
                ->showConfirmButton()
                ->showCloseButton();

            return back();
        }
    }

    public function down($id)
    {
        $slider = Slider::find($id);
        $slider_prev = Slider::where('order_no', '<', $slider->order_no)->orderBy('order_no', 'desc')->first();

        $current_order = $slider->order_no;

        if (!empty($slider_prev)) {
            $slider->order_no = $slider_prev->order_no;
            $slider_prev->order_no = $current_order;
            $slider->save();
            $slider_prev->save();
        }

        return redirect()->route('sliders.index');
    }

    public function up($id)
    {
        $slider = Slider::find($id);
        $slider_next = Slider::where('order_no', '>', $slider->order_no)->orderBy('order_no', 'asc')->first();

        $current_order = $slider->order_no;

        if (!empty($slider_next)) {
            $slider->order_no = $slider_next->order_no;
            $slider_next->order_no = $current_order;
            $slider->save();
            $slider_next->save();
        }

        return redirect()->route('sliders.index');
    }

    public function active($id)
    {
        $find = Slider::find($id);
        $find->status = true;

        $find->save();

        return redirect()->route('sliders.index');
    }

    public function passive($id)
    {
        $find = Slider::find($id);
        $find->status = false;

        $find->save();

        return redirect()->route('sliders.index');
    }
}
