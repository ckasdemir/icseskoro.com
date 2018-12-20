<?php

namespace App\Http\Controllers;

use App\User;
use App\VoiceType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all()->sortBy('name')->sortBy('role');

        return view('admin.user.index', compact('users'));
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
        $user = User::find($id);

        $voice_types = VoiceType::all()->sortBy('type_name');

        return view('admin.user.edit', compact('user', 'voice_types'));
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
            'name' => 'required',
            'email' => 'required',
        ));

        $user = User::find($id);
        $user->name = request('name');
        $user->voice_type_id = request('voice_type_id');
        $user->gender = request('gender');
        $user->email = request('email');
        $user->phone = request('phone');

        if (!empty(request('password'))) {
            $user->password = Hash::make(request('password'));
        }

        if (!empty(request('image'))) {
            if (request()->hasFile('image')) {
                $this->validate(request(), array('image' => 'image|mimes:png,jpg,jpeg,gif|max:2048'));
            }

            $file = request()->file('image');
            $fileName = time() . '-' . str_slug(request('image')) . '.' . $file->extension();

            if ($file->isValid()) {
                $folder = 'uploads/users/';
                $file->move($folder, $fileName);
                $user->image = $fileName;
            }
        }

        $user->save();

        if ($user) {
            alert()
                ->success('İşlem tamamlandı!', 'Profil bilgileriniz başarıyla güncellenmiştir.')
                ->showConfirmButton()
                ->showCloseButton();

            return back();
        } else {
            alert()
                ->error('Hata!', 'Profil güncelleme işlemi başarısız.')
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
        if (Auth::user()->id != $id) {
            $user = User::destroy($id);

            if ($user) {
                alert()
                    ->success('İşlem tamamlandı!', 'Kullanıcı silme işlemi başarıyla tamamlanmıştır.')
                    ->showConfirmButton()
                    ->showCloseButton();

                return redirect()->route('users.index');
            } else {
                alert()
                    ->error('Hata!', 'Kullanıcı silme işlemi başarısız.')
                    ->showConfirmButton()
                    ->showCloseButton();

                return back();
            }
        } else {
            alert()
                ->error('Hata!', 'Kendi kullanıcınızı silemezsiniz.')
                ->showConfirmButton()
                ->showCloseButton();

            return back();
        }
    }

    public function role($id)
    {
        $msg = "";
        $user = User::find($id);

        if ($user->role == "admin") {
            $user->role = "user";
            $msg = "USER";
        } else {
            $user->role = "admin";
            $msg = "ADMIN";
        }

        $user->save();

        if ($user) {
            alert()
                ->success('İşlem tamamlandı!', 'Kullanıcı rolü ' . $msg . ' olarak başarıyla güncellenmiştir.')
                ->showConfirmButton()
                ->showCloseButton();

            return redirect()->route('users.index');
        } else {
            alert()
                ->error('Hata!', 'Kullanıcı durumu güncelleme işlemi başarısız.')
                ->showConfirmButton()
                ->showCloseButton();

            return back();
        }
    }

    public function active($id)
    {
        $find = User::find($id);
        $find->status = true;

        $find->save();

        return redirect()->route('users.index');
    }

    public function passive($id)
    {
        $find = User::find($id);
        $find->status = false;

        $find->save();

        return redirect()->route('users.index');
    }
}
