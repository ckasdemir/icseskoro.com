<?php

namespace App\Http\Controllers;

use App\Mail\ContactForm;
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

    public function sendToEmail(request $request)
    {
        $setting = Setting::get()->first();

        $this->validate(request(), array(
            'contact_name' => 'required',
            'contact_email' => 'required',
            'message' => 'required',
        ));

        $array = array(
            'name' => request('contact_name'),
            'email' => request('contact_email'),
            'phone' => request('contact_phone'),
            'subject' => request('contact_subject'),
            'message' => request('message'),
        );

        Mail::to($setting->email)->send(new ContactForm($array));

        alert()
            ->success('Mail Gönderildi!')
            ->showConfirmButton()
            ->showCloseButton();

        return redirect()->route('contact.index');
    }
}
