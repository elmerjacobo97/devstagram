@extends('layouts.app')
@section('title')
    Pagina principal
@endsection

@section('content')
    <x-list-post :posts="$posts" />
@endsection

{{--@if($posts->count())--}}
{{--    <p>Si hay posts</p>--}}
{{--@else--}}
{{--    <p>No hay posts</p>--}}
{{--@endif--}}

{{--Notas:--}}
{{--Un slot es como un children--}}

{{--<x-list-post>--}}
{{--    <x-slot:title>--}}
{{--        <header>Desde el header</header>--}}
{{--    </x-slot:title>--}}
{{--    <x-slot name="header">--}}
{{--        <header>Segundo header</header>--}}
{{--    </x-slot>--}}
{{--    <h1>Mostrando Post desde slot</h1>--}}
{{--</x-list-post>--}}

{{-- Ejemplo de variables dinámicas --}}
{{--<x-list-post :posts="$posts" />--}}
