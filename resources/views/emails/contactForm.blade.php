@component('mail::layout')
    {{-- Header --}}
    @slot('header')
        @component('mail::header', ['url' => config('app.url')])

        @endcomponent
    @endslot

    {{-- Body --}}
    {{$mail_content['subject']}}<br/>
    {{$mail_content['message']}}<br/><br/>
    <p>
        {{$mail_content['name']}}<br/>
        {{$mail_content['email']}}<br/>
        {{$mail_content['phone']}}<br/>
        {{$mail_content['address']}}
    </p>

    {{-- Subcopy --}}
    @isset($subcopy)
        @slot('subcopy')
            @component('mail::subcopy')
                {{ $subcopy }}
            @endcomponent
        @endslot
    @endisset

    {{-- Footer --}}
    @slot('footer')
        @component('mail::footer')

        @endcomponent
    @endslot
@endcomponent
