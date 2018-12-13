<?php

namespace App\Http\Controllers;

use App\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pages = Page::all()->sortByDesc('order_no');

        return view('admin.page.index', compact('pages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.page.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $show_to_pages = Page::where('is_show_to_homepage', '=', true)->get()->count();

        if (($show_to_pages == 0 && request('is_show_to_homepage') == true) || ($show_to_pages > 0 && request('is_show_to_homepage') == false) || ($show_to_pages == 0 && request('is_show_to_homepage') == false)) {
            $this->validate(request(), array(
                'title' => 'required',
                'content' => 'required'
            ));

            $statement = DB::select("SHOW TABLE STATUS LIKE 'pages'");
            $nextId = $statement[0]->Auto_increment;

            $page = new Page();
            $page->title = request('title');
            $page->content = request('content');
            $page->slug = str_slug(request('title'));
            $page->status = request('status');
            $page->order_no = $nextId;
            $page->user_id = Auth::user()->id;
            $page->is_show_to_homepage = request('is_show_to_homepage');

            if (!empty(request('image'))) {
                if (request()->hasFile('image')) {
                    $this->validate(request(), array('image' => 'image|mimes:png,jpg,jpeg,gif|max:2048'));
                }

                $file = request()->file('image');
                $fileName = time() . '-' . str_slug(request('title')) . '.' . $file->extension();

                if ($file->isValid()) {
                    $folder = 'uploads/pages';
                    $file->move($folder, $fileName);
                    $page->image = $fileName;
                }
            }

            $page->save();

            if ($page) {
                alert()
                    ->success('İşlem tamamlandı!', 'İçerik ekleme işlemi başarıyla tamamlanmıştır.')
                    ->showConfirmButton()
                    ->showCloseButton();

                return redirect()->route('pages.index');
            } else {
                alert()
                    ->error('Hata!', 'İçerik ekleme işlemi başarısız.')
                    ->showConfirmButton()
                    ->showCloseButton();

                return back();
            }
        } else {
            alert()
                ->error('Hata!', 'İçerik anasayfada gösterilemez.')
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
        $pages = Page::find($id);

        return view('admin.page.edit', compact('pages'));
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
        $show_to_pages = Page::where('is_show_to_homepage', '=', true)->get()->count();

        if (($show_to_pages == 0 && request('is_show_to_homepage') == true) || ($show_to_pages > 0 && request('is_show_to_homepage') == false) || ($show_to_pages == 0 && request('is_show_to_homepage') == false)) {
            $this->validate(request(), array(
                'title' => 'required',
                'content' => 'required'
            ));

            $page = Page::find($id);
            $page->title = request('title');
            $page->content = request('content');
            $page->slug = str_slug(request('title'));
            $page->status = request('status');
            $page->is_show_to_homepage = request('is_show_to_homepage');

            if (!empty(request('image'))) {
                if (request()->hasFile('image')) {
                    $this->validate(request(), array('image' => 'image|mimes:png,jpg,jpeg,gif|max:2048'));
                }

                $file = request()->file('image');
                $fileName = time() . '-' . str_slug(request('title')) . '.' . $file->extension();

                if ($file->isValid()) {
                    $folder = 'uploads/pages';
                    $file->move($folder, $fileName);
                    $page->image = $fileName;
                }
            }

            $page->save();

            if ($page) {
                alert()
                    ->success('İşlem tamamlandı!', 'İçerik güncelleme işlemi başarıyla tamamlanmıştır.')
                    ->showConfirmButton()
                    ->showCloseButton();

                return redirect()->route('pages.index');
            } else {
                alert()
                    ->error('Hata!', 'İçerik güncelleme işlemi başarısız.')
                    ->showConfirmButton()
                    ->showCloseButton();

                return back();
            }
        } else {
            alert()
                ->error('Hata!', 'İçerik anasayfada gösterilemez.')
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
        $page = Page::destroy($id);

        if ($page) {
            alert()
                ->success('İşlem tamamlandı!', 'İçerik silme işlemi başarıyla tamamlanmıştır.')
                ->showConfirmButton()
                ->showCloseButton();

            return redirect()->route('pages.index');
        } else {
            alert()
                ->error('Hata!', 'İçerik silme işlemi başarısız.')
                ->showConfirmButton()
                ->showCloseButton();

            return back();
        }
    }

    public function down($id)
    {
        $page = Page::find($id);
        $page_prev = Page::where('order_no', '<', $page->order_no)->orderBy('order_no', 'desc')->first();

        $current_order = $page->order_no;

        if (!empty($page_prev)) {
            $page->order_no = $page_prev->order_no;
            $page_prev->order_no = $current_order;
            $page->save();
            $page_prev->save();
        }

        return redirect()->route('pages.index');
    }

    public function up($id)
    {
        $page = Page::find($id);
        $page_next = Page::where('order_no', '>', $page->order_no)->orderBy('order_no', 'asc')->first();

        $current_order = $page->order_no;

        if (!empty($page_next)) {
            $page->order_no = $page_next->order_no;
            $page_next->order_no = $current_order;
            $page->save();
            $page_next->save();
        }

        return redirect()->route('pages.index');
    }
}
