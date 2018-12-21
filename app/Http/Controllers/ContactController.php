<?php

namespace App\Http\Controllers;

use App\Mail\ContactForm;
use App\Message;
use App\Page;
use App\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $setting = Setting::get()->first();

        $nav_pages = Page::where('status', '=', true)->get()->sortBy('order_no');

        return view('site.contact.index', compact('setting', 'nav_pages'));
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
        //
    }

    public function sendToMessage(request $request)
    {
        $this->validate(request(), array(
            'contact_name' => 'required',
            'contact_email' => 'required',
            'message' => 'required',
        ));

        $message = new Message();
        $message->name = request('contact_name');
        $message->email = request('contact_email');
        $message->phone = request('contact_phone');
        $message->subject = request('contact_subject');
        $message->message = request('message');
        $message->is_read = false;

        $message->save();

        if ($message) {
            alert()
                ->success('İşlem tamamlandı!', 'Mesajınız başarıyla gönderilmiştir.')
                ->showConfirmButton()
                ->showCloseButton();

            return redirect()->route('contact.index');
        } else {
            alert()
                ->error('Hata!', 'Mesaj gönderme işlemi başarısız.')
                ->showConfirmButton()
                ->showCloseButton();

            return back();
        }

        return redirect()->route('contact.index');
    }
}
