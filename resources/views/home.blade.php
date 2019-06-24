@extends('layouts.app')

@section('content')
<div class="container">
    <div class="columns">
        <div class="column">
            <div class="card ">
                <div class="card-image is-centered">
                    <figure class="image profile-image force-center mt-4">
                        <img class="is-rounded " src="/images/static/anon.jpg" alt="{{Auth::user()->fullname() }}">
                    </figure>
                </div>
                <div class="card-content">
                    <div class="media-content ">
                        <h1 class="title centering-text">{{Auth::user()->fullname() }}</h1>
                        <p class="subtile centering-text">{{ Auth::user()->email}}</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="column"></div>
    </div>
</div>
@endsection
