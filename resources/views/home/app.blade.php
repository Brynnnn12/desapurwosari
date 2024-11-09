{{-- resources/views/home.blade.php --}}
@extends('home.layout')

@section('content')
    @include('home.partials.section')
    @include('home.partials.about')
    @include('home.partials.artikel')
    @include('home.partials.card')
    @include('home.partials.kontak')
@endsection
