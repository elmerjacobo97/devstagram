@extends('layouts.app')

@section('title')
    Edit Profile: {{ auth()->user()->username }}
@endsection

@section('content')
    <div class="md:flex md:justify-center">
        <form method="POST" action="{{ route('profile.store', auth()->user()) }}" class="md:w-1/2"
              enctype="multipart/form-data">
            @csrf
            <div class="w-full form-control">
                <label for="username" class="label">Username</label>
                <input
                    type="text"
                    id="username"
                    name="username"
                    class="input input-bordered w-full @error('username') input-error @enderror"
                    value="{{ old(auth()->user()->username) }}"
                    placeholder="Your username"
                />
                @error('username')
                <label class="label">
                    <span class="label-text-alt text-error">{{ $message }}</span>
                </label>
                @enderror
            </div>
            <div class="w-full form-control">
                <label for="email" class="label">Email</label>
                <input
                    type="email"
                    id="email"
                    name="email"
                    class="input input-bordered w-full @error('email') input-error @enderror"
                    value="{{ old(auth()->user()->email) }}"
                    placeholder="Your new email"
                />
                @error('email')
                <label class="label">
                    <span class="label-text-alt text-error">{{ $message }}</span>
                </label>
                @enderror
            </div>
            <div class="w-full form-control">
                <label for="password" class="label">Password</label>
                <input
                    type="password"
                    id="password"
                    name="password"
                    class="input input-bordered w-full @error('password') input-error @enderror"
                    value="{{ old(auth()->user()->password) }}"
                    placeholder="Your new password"
                />
                @error('password')
                <label class="label">
                    <span class="label-text-alt text-error">{{ $message }}</span>
                </label>
                @enderror
            </div>
            <div class="w-full form-control">
                <label for="image" class="label">Image Profile</label>
                <input
                    type="file"
                    id="image"
                    name="image"
                    accept=".jpg, .jpeg, .png, .svg"
                />
            </div>
            <div class="mt-5 flex flex-col">
                <button type="submit" class="btn btn-active btn-primary">
                    Save Changes
                </button>
            </div>
        </form>
    </div>
@endsection
