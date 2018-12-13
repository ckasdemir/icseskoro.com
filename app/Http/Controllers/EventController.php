<?php

namespace App\Http\Controllers;

use App\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $events = Event::all()->sortByDesc('created_at');

        return view('admin.event.index', compact('events'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.event.create');
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
            'location' => 'required',
            'event_date' => 'required',
            'event_start_time' => 'required'
        ));

        $event = New Event();
        $event->title = request('title');
        $event->slug = str_slug(request('title'));
        $event->location = request('location');
        $event->event_date = request('event_date');
        $event->event_start_time = request('event_start_time');
        $event->event_end_time = request('event_end_time');
        $event->address = request('address');
        $event->description = request('description');
        $event->tags = request('tags');
        $event->map = request('map');
        $event->is_free = request('is_free');
        $event->price = request('price');
        $event->status = request('status');
        $event->user_id = Auth::user()->id;

        if (!empty(request('image'))) {
            if (request()->hasFile('image')) {
                $this->validate(request(), array('image' => 'image|mimes:png,jpg,jpeg,gif|max:2048'));
            }

            $file = request()->file('image');
            $fileName = time() . '-' . str_slug(request('title')) . '.' . $file->extension();

            if ($file->isValid()) {
                $folder = 'uploads/events';
                $file->move($folder, $fileName);
                $event->image = $fileName;
            }
        }

        $event->save();

        if ($event) {
            alert()
                ->success('İşlem tamamlandı!', 'Etkinlik ekleme işlemi başarıyla tamamlanmıştır.')
                ->showConfirmButton()
                ->showCloseButton();

            return redirect()->route('events.index');
        } else {
            alert()
                ->error('Hata!', 'Etkinlik ekleme işlemi başarısız.')
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
        $events = Event::find($id);

        return view('admin.event.edit', compact('events'));
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
            'location' => 'required',
            'event_date' => 'required',
            'event_start_time' => 'required'
        ));

        $event = Event::find($id);
        $event->title = request('title');
        $event->slug = str_slug(request('title'));
        $event->location = request('location');
        $event->event_date = request('event_date');
        $event->event_start_time = request('event_start_time');
        $event->event_end_time = request('event_end_time');
        $event->address = request('address');
        $event->description = request('description');
        $event->tags = request('tags');
        $event->map = request('map');
        $event->is_free = request('is_free');
        $event->price = request('price');
        $event->status = request('status');

        if (!empty(request('image'))) {
            if (request()->hasFile('image')) {
                $this->validate(request(), array('image' => 'image|mimes:png,jpg,jpeg,gif|max:2048'));
            }

            $file = request()->file('image');
            $fileName = time() . '-' . str_slug(request('title')) . '.' . $file->extension();

            if ($file->isValid()) {
                $folder = 'uploads/events';
                $file->move($folder, $fileName);
                $event->image = $fileName;
            }
        }

        $event->save();

        if ($event) {
            alert()
                ->success('İşlem tamamlandı!', 'Etkinlik düzenleme işlemi başarıyla tamamlanmıştır.')
                ->showConfirmButton()
                ->showCloseButton();

            return redirect()->route('events.index');
        } else {
            alert()
                ->error('Hata!', 'Etkinlik düzenleme işlemi başarısız.')
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
        $event = Event::destroy($id);

        if ($event) {
            alert()
                ->success('İşlem tamamlandı!', 'Etkinlik silme işlemi başarıyla tamamlanmıştır.')
                ->showConfirmButton()
                ->showCloseButton();

            return redirect()->route('events.index');
        } else {
            alert()
                ->error('Hata!', 'Etkinlik silme işlemi başarısız.')
                ->showConfirmButton()
                ->showCloseButton();

            return back();
        }
    }
}
