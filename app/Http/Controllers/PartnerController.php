<?php

namespace App\Http\Controllers;

use App\Partner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PartnerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $partners = Partner::all()->sortByDesc('order_no');

        return view('admin.partner.index', compact('partners'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.partner.create');
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
            'partner_name' => 'required',
            'logo' => 'required'
        ));

        $statement = DB::select("SHOW TABLE STATUS LIKE 'partners'");
        $nextId = $statement[0]->Auto_increment;

        $partner = new Partner();
        $partner->partner_name = request('partner_name');
        $partner->slug = str_slug(request('partner_name'));
        $partner->url = request('url');
        $partner->status = request('status');
        $partner->order_no = $nextId;
        $partner->user_id = Auth::user()->id;

        if (!empty(request('logo'))) {
            if (request()->hasFile('logo')) {
                $this->validate(request(), array('logo' => 'image|mimes:png,jpg,jpeg,gif|max:2048'));
            }

            $file = request()->file('logo');
            $fileName = 'logo-' . str_slug(request('partner_name')) . '-' . time() . '.' . $file->extension();

            if ($file->isValid()) {
                $folder = 'uploads/partners';
                $file->move($folder, $fileName);
                $partner->logo = $fileName;
            }
        }

        $partner->save();

        if ($partner) {
            alert()
                ->success('İşlem tamamlandı!', 'Partner ekleme işlemi başarıyla tamamlanmıştır.')
                ->showConfirmButton()
                ->showCloseButton();

            return redirect()->route('partners.index');
        } else {
            alert()
                ->error('Hata!', 'Partner ekleme işlemi başarısız.')
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
        $partner = Partner::find($id);

        return view('admin.partner.edit', compact('partner'));
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
            'partner_name' => 'required'
        ));

        $partner = Partner::find($id);
        $partner->partner_name = request('partner_name');
        $partner->slug = str_slug(request('partner_name'));
        $partner->url = request('url');
        $partner->status = request('status');

        if (!empty(request('logo'))) {
            if (request()->hasFile('logo')) {
                $this->validate(request(), array('logo' => 'image|mimes:png,jpg,jpeg,gif|max:2048'));
            }

            $file = request()->file('logo');
            $fileName = 'logo-' . str_slug(request('partner_name')) . '-' . time() . '.' . $file->extension();

            if ($file->isValid()) {
                $folder = 'uploads/partners';
                $file->move($folder, $fileName);
                $partner->logo = $fileName;
            }
        }

        $partner->save();

        if ($partner) {
            alert()
                ->success('İşlem tamamlandı!', 'Partner güncelleme işlemi başarıyla tamamlanmıştır.')
                ->showConfirmButton()
                ->showCloseButton();

            return redirect()->route('partners.index');
        } else {
            alert()
                ->error('Hata!', 'Partner güncelleme işlemi başarısız.')
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
        $partner = Partner::destroy($id);

        if ($partner) {
            alert()
                ->success('İşlem tamamlandı!', 'Partner silme işlemi başarıyla tamamlanmıştır.')
                ->showConfirmButton()
                ->showCloseButton();

            return redirect()->route('partners.index');
        } else {
            alert()
                ->error('Hata!', 'Partner silme işlemi başarısız.')
                ->showConfirmButton()
                ->showCloseButton();

            return back();
        }
    }

    public function down($id)
    {
        $partner = Partner::find($id);
        $partner_prev = Partner::where('order_no', '<', $partner->order_no)->orderBy('order_no', 'desc')->first();

        $current_order = $partner->order_no;

        if (!empty($partner_prev)) {
            $partner->order_no = $partner_prev->order_no;
            $partner_prev->order_no = $current_order;
            $partner->save();
            $partner_prev->save();
        }

        return redirect()->route('partners.index');
    }

    public function up($id)
    {
        $partner = Partner::find($id);
        $partner_next = Partner::where('order_no', '>', $partner->order_no)->orderBy('order_no', 'asc')->first();

        $current_order = $partner->order_no;

        if (!empty($partner_next)) {
            $partner->order_no = $partner_next->order_no;
            $partner_next->order_no = $current_order;
            $partner->save();
            $partner_next->save();
        }

        return redirect()->route('partners.index');
    }

    public function active($id)
    {
        $find = Partner::find($id);
        $find->status = true;

        $find->save();

        return redirect()->route('partners.index');
    }

    public function passive($id)
    {
        $find = Partner::find($id);
        $find->status = false;

        $find->save();

        return redirect()->route('partners.index');
    }
}
