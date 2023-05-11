@extends('layouts.app')

@section('title')
    Create a new post
@endsection

{{-- Cargar hoja de estilos CDN solo en este archivo, definir @stack('styles') en app.blade.php --}}
@push('styles')
    <link href="https://unpkg.com/dropzone@6.0.0-beta.1/dist/dropzone.css" rel="stylesheet" type="text/css"/>
@endpush

@section('content')
    <div class="md:flex md:items-center md:justify-center md:gap-10">
        <div class="md:w-6/12">
            <form
                method="POST"
                action="{{ route('images.store') }}"
                enctype="multipart/form-data"
                id="dropzone"
                class="flex h-96 w-full items-center justify-center rounded-3xl border border-dashed border-gray-800 dropzone">
                @csrf
            </form>
        </div>
        <div class="md:w-4/12">
            <form method="POST" action="{{ route('posts.store') }}" novalidate>
                @csrf
                <div class="w-full form-control">
                    <label for="title" class="label">Title</label>
                    <input
                        type="text"
                        id="title"
                        name="title"
                        class="input input-bordered w-full @error('title') input-error @enderror"
                        value="{{ old('title') }}"
                        placeholder="¿What are you thinking?"
                    />
                    @error('title')
                    <label class="label">
                        <span class="label-text-alt text-error">{{ $message }}</span>
                    </label>
                    @enderror
                </div>
                <div class="w-full form-control">
                    <label for="description" class="label">Description</label>
                    <textarea
                        id="description"
                        name="description"
                        class="textarea textarea-bordered textarea-lg w-full px-4 @error('description') textarea-error @enderror"
                        placeholder="Add description..."
                    >{{ old('description') }}</textarea>
                    @error('description')
                    <label class="label">
                        <span class="label-text-alt text-error">{{ $message }}</span>
                    </label>
                    @enderror
                </div>
                {{-- Input hidden para el campo de imagen --}}
                <div class="w-full form-control">
                    <input type="hidden" name="image" value="{{ old('image') }}">
                    @error('image')
                    <label class="label">
                        <span class="label-text-alt text-error">{{ $message }}</span>
                    </label>
                    @enderror
                </div>
                <div class="mt-5 flex flex-col">
                    <button type="submit" class="btn btn-active btn-primary">
                        create post
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
