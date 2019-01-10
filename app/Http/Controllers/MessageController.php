<?php

namespace App\Http\Controllers;

use App\Mail\ContactForm;
use App\Message;
use App\Setting;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $setting = Setting::get()->first();

        $messages = Message::all()->sortByDesc('created_at');

        return view('admin.message.index', compact('messages', 'setting'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $setting = Setting::get()->first();

        $users = User::where('status', '=', true)->get()->sortBy('name');

        return view('admin.message.create', compact('setting', 'users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $setting = Setting::get()->first();

        $array = request('to');

        $data = array(
            'name' => $setting->title,
            'email' => $setting->email,
            'phone' => $setting->mobile,
            'address' => $setting->address,
            'subject' => request('subject'),
            'message' => request('content'),
        );

        if (in_array("all", $array)) {
            $users = User::where('status', '=', true)->get()->sortBy('name');

            foreach ($users as $item) {
                if (!empty($item->email)) {
                    Mail::to($item->email)->send(new ContactForm($data, request('subject')));
                }
            }
        } else {
            foreach ($array as $item) {
                if (!empty($item)) {
                    Mail::to($item)->send(new ContactForm($data, request('subject')));
                }
            }
        }

        alert()
            ->success('İşlem tamamlandı!', 'Mesajınız başarıyla gönderilmiştir.')
            ->showConfirmButton()
            ->showCloseButton();

        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $setting = Setting::get()->first();

        $message = Message::find($id);

        $message->is_read = true;

        $message->save();

        return view('admin.message.show', compact('message', 'setting'));
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
        $message = Message::destroy($id);

        if ($message) {
            alert()
                ->success('İşlem tamamlandı!', 'Mesaj silme işlemi başarıyla tamamlanmıştır.')
                ->showConfirmButton()
                ->showCloseButton();

            return redirect()->route('messages.index');
        } else {
            alert()
                ->error('Hata!', 'Mesaj silme işlemi başarısız.')
                ->showConfirmButton()
                ->showCloseButton();

            return back();
        }
    }

    public function replay($id)
    {
        $setting = Setting::get()->first();

        $message = Message::find($id);

        $data = array(
            'name' => $setting->title,
            'email' => $setting->email,
            'phone' => $setting->mobile,
            'address' => $setting->address,
            'subject' => $message->subject,
            'message' => request('message'),
        );

        Mail::to($message->email)->send(new ContactForm($data, $message->subject));

        alert()
            ->success('İşlem tamamlandı!', 'Mesajınız başarıyla gönderilmiştir.')
            ->showConfirmButton()
            ->showCloseButton();

        return back();
    }

    public function readed($id)
    {
        $find = Message::find($id);
        $find->is_read = true;

        $find->save();

        return redirect()->route('messages.index');
    }

    public function unreaded($id)
    {
        $find = Message::find($id);
        $find->is_read = false;

        $find->save();

        return redirect()->route('messages.index');
    }
}
