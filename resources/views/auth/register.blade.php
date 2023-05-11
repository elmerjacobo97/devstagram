@extends('layouts.app')

@section('title')
    Sign up for Stagram
@endsection

@section('content')
    <div class="md:flex md:items-center md:justify-center md:gap-10">
        <div class="md:w-6/12">
            <img src="{{ asset('img/registrar.jpg') }}" alt="imagen registrar">
        </div>

        <div class="md:w-4/12">
            <form action="{{ route('register') }}" method="POST" novalidate>
                @csrf
                <div class="w-full form-control">
                    <label for="name" class="label">Name</label>
                    <input
                        type="text"
                        id="name"
                        name="name"
                        class="input input-bordered w-full @error('name') input-error @enderror"
                        value="{{ old('name') }}"
                        placeholder="John Doe"
                    />
                    @error('name')
                    <label class="label">
                        <span class="label-text-alt text-error">{{ $message }}</span>
                    </label>
                    @enderror
                </div>
                <div class="w-full form-control">
                    <label for="username" class="label">Username</label>
                    <input
                        type="text"
                        id="username"
                        name="username"
                        class="input input-bordered w-full @error('username') input-error @enderror"
                        value="{{ old('username') }}"
                        placeholder="codewithjohn"
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
                        value="{{ old('email') }}"
                        placeholder="email@example.com"
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
                        placeholder="your password"
                    />
                    @error('password')
                    <label class="label">
                        <span class="label-text-alt text-error">{{ $message }}</span>
                    </label>
                    @enderror
                </div>
                <div class="w-full form-control">
                    <label for="password_confirmation" class="label">Repeat Password</label>
                    <input
                        type="password"
                        id="password_confirmation"
                        name="password_confirmation"
                        class="w-full input input-bordered"
                        placeholder="repeat password"
                    />
                </div>
                <div class="mt-5 flex flex-col">
                    <button type="submit" class="btn btn-active btn-primary">
                        Sign up
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
