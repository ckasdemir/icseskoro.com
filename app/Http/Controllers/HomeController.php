<?php

namespace App\Http\Controllers;

use App\Advertisement;
use App\Album;
use App\Event;
use App\News;
use App\Page;
use App\Partner;
use App\Photo;
use App\PhotoGallery;
use App\Setting;
use App\Slider;
use App\Song;
use App\User;
use App\Video;
use App\VideoGallery;
use App\VoiceType;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('admin');
        setlocale(LC_TIME, "Turkish");
        setlocale(LC_ALL, 'Turkish');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $setting = Setting::get()->first();

        $nav_pages = Page::where('status', '=', true)->get()->sortBy('order_no');

        $pages = Page::where('status', '=', true)->where('is_show_to_homepage', '=', true)->limit(1)->get();

        $sliders = Slider::where('status', '=', true)->get()->sortBy('order_no');

        $next_event = Event::where('status', '=', true)->where('event_date', '>=', date('Y-m-d'))->first();

        $events = Event::where('status', '=', true)->where('event_date', '>=', date('Y-m-d'))->take(4)->get()->sortBy('event_date');

        $isShowToUser = User::where('status', '=', true)->where('is_show_to_homepage', '=', true)->take(1)->get();

        $users = User::inRandomOrder()->where('status', '=', true)->where('is_show_to_homepage', '=', false)->take(2)->get();

        $news = News::where('status', '=', true)->limit(5)->get()->sortByDesc('created_at');

        $photos = Photo::where('status', '=', true)->inRandomOrder()->limit(10)->get();

        $partners = Partner::where('status', '=', true)->limit(6)->get()->sortBy('order_no');

        return view('site.home.index', compact('next_event', 'nav_pages', 'events', 'users', 'isShowToUser', 'sliders', 'news', 'photos', 'partners', 'setting', 'pages'));
    }

    public function event()
    {
        $setting = Setting::get()->first();

        $nav_pages = Page::where('status', '=', true)->get()->sortBy('order_no');

        $advertisements = Advertisement::inRandomOrder()->where('status', '=', true)->take(3)->get();

        $events = Event::where('status', '=', true)->where('event_date', '>=', date('Y-m-d'))->get()->sortBy('event_date');

        return view('site.event.index', compact('events', 'setting', 'nav_pages', 'advertisements'));
    }

    public function eventDetail($id)
    {
        $setting = Setting::get()->first();

        $nav_pages = Page::where('status', '=', true)->get()->sortBy('order_no');

        $advertisements = Advertisement::inRandomOrder()->where('status', '=', true)->take(3)->get();

        $event = Event::find($id);

        $tags = explode(',', $event->tags);

        $photos = Photo::where('status', '=', true)->inRandomOrder()->limit(6)->get();

        $albums = Album::where('status', '=', true)->take(4)->get()->sortByDesc('created_at');

        return view('site.event.detail', compact('event', 'setting', 'albums', 'tags', 'photos', 'nav_pages', 'advertisements'));
    }

    public function photoGallery()
    {
        $setting = Setting::get()->first();

        $nav_pages = Page::where('status', '=', true)->get()->sortBy('order_no');

        $photo_gallery = PhotoGallery::where('status', '=', true)->get()->sortByDesc('created_at');

        return view('site.photo_gallery.index', compact('photo_gallery', 'setting', 'nav_pages'));
    }

    public function photoGalleryDetail($id)
    {
        $setting = Setting::get()->first();

        $nav_pages = Page::where('status', '=', true)->get()->sortBy('order_no');

        $photo_gallery = PhotoGallery::find($id);
        $photo_gallery_name = $photo_gallery->title;

        $photos = Photo::where('status', '=', true)->where('photo_gallery_id', '=', $id)->get()->sortByDesc('created_at');

        return view('site.photo_gallery.detail', compact('photos', 'photo_gallery_name', 'setting', 'nav_pages'));
    }

    public function videoGallery()
    {
        $setting = Setting::get()->first();

        $nav_pages = Page::where('status', '=', true)->get()->sortBy('order_no');

        $video_gallery = VideoGallery::where('status', '=', true)->get()->sortByDesc('created_at');

        return view('site.video_gallery.index', compact('video_gallery', 'setting', 'nav_pages'));
    }

    public function videoGalleryDetail($id)
    {
        $setting = Setting::get()->first();

        $nav_pages = Page::where('status', '=', true)->get()->sortBy('order_no');

        $video_gallery = VideoGallery::find($id);
        $video_gallery_name = $video_gallery->title;

        $videos = Video::where('status', '=', true)->where('video_gallery_id', '=', $id)->get()->sortByDesc('created_at');

        return view('site.video_gallery.detail', compact('videos', 'video_gallery_name', 'setting', 'nav_pages'));
    }

    public function album()
    {
        $setting = Setting::get()->first();

        $nav_pages = Page::where('status', '=', true)->get()->sortBy('order_no');

        $albums = Album::where('status', '=', true)->get()->sortByDesc('created_at');

        return view('site.album.index', compact('albums', 'setting', 'nav_pages'));
    }

    public function albumDetail($id)
    {
        $setting = Setting::get()->first();

        $nav_pages = Page::where('status', '=', true)->get()->sortBy('order_no');

        $advertisements = Advertisement::inRandomOrder()->where('status', '=', true)->take(2)->get();

        $album = Album::find($id);

        $songs = Song::where('status', '=', true)->where('album_id', '=', $id)->get()->sortByDesc('created_at');

        $users = User::inRandomOrder()->where('status', '=', true)->where('is_show_to_homepage', '=', false)->take(3)->get();

        $new_albums = Album::where('status', '=', true)->take(4)->get()->sortByDesc('created_at');

        return view('site.album.detail', compact('album', 'songs', 'setting', 'nav_pages', 'users', 'new_albums', 'advertisements'));
    }

    public function news()
    {
        $setting = Setting::get()->first();

        $nav_pages = Page::where('status', '=', true)->get()->sortBy('order_no');

        $advertisements = Advertisement::inRandomOrder()->where('status', '=', true)->take(3)->get();

        $news = News::where('status', '=', true)->get()->sortByDesc('created_at');

        return view('site.news.index', compact('news', 'setting', 'nav_pages', 'advertisements'));
    }

    public function newsDetail($id)
    {
        $setting = Setting::get()->first();

        $nav_pages = Page::where('status', '=', true)->get()->sortBy('order_no');

        $advertisements = Advertisement::inRandomOrder()->where('status', '=', true)->take(3)->get();

        $news = News::find($id);

        $recent_news = News::where('status', '=', true)->where('id', '<>', $news->id)->take(5)->get()->sortByDesc('created_at');

        $tags = explode(',', $news->tags);

        return view('site.news.detail', compact('news', 'setting', 'recent_news', 'tags', 'nav_pages', 'advertisements'));
    }

    public function page($id)
    {
        $setting = Setting::get()->first();

        $nav_pages = Page::where('status', '=', true)->get()->sortBy('order_no');

        $advertisements = Advertisement::inRandomOrder()->where('status', '=', true)->take(3)->get();

        $page = Page::find($id);

        $users = User::inRandomOrder()->where('status', '=', true)->where('is_show_to_homepage', '=', false)->take(3)->get();

        return view('site.page.detail', compact('page', 'setting', 'users', 'nav_pages', 'advertisements'));
    }

    public function profile()
    {
        if (!Auth::check()) {
            return redirect()->route('/');
        } else {

            $setting = Setting::get()->first();

            $nav_pages = Page::where('status', '=', true)->get()->sortBy('order_no');

            $voice_types = VoiceType::all()->sortBy('type_name');

            $user = Auth::user()->id;
            $profile = User::find($user);

            return view('site.profile.index', compact('profile', 'setting', 'nav_pages', 'voice_types'));
        }
    }

    public function profileUpdate($id)
    {
        $user = User::find($id);
        $user->name = request('name');
        $user->email = request('email');
        $user->phone = request('phone');
        $user->gender = request('gender');
        $user->voice_type_id = request('voice_type_id');

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

            return redirect()->route('site.profile');
        } else {
            alert()
                ->error('Hata!', 'Profil güncelleme işlemi başarısız.')
                ->showConfirmButton()
                ->showCloseButton();

            return back();
        }
    }

    public function logout()
    {
        auth()->logout();
        return redirect('/');
    }
}
