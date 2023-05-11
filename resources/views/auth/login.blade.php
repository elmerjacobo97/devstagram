@extends('layouts.app')

@section('title')
    Log in to Stagram
@endsection

@section('content')
    <div class="md:flex md:items-center md:justify-center md:gap-10">
        <div class="md:w-6/12">
            <img src="{{ asset('img/login.jpg') }}" alt="imagen login">
        </div>

        <div class="md:w-4/12">
            <form method="POST" action="{{ route('login') }}" novalidate>
                @csrf

                @if(session('error'))
                    <div class="shadow-lg alert alert-error animate__animated animate__fadeIn">
                        <div>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 flex-shrink-0 stroke-current"
                                 fill="none" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            <span>{{ session('error') }}</span>
                        </div>
                    </div>
                @endif

                <div class="w-full form-control">
                    <label for="email" class="label">Email</label>
                    <input
                        type="email"
                        id="email"
                        name="email"
                        class="input input-bordered w-full @error('email') input-error @enderror"
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
                <div class="form-control">
                    <label class="cursor-pointer justify-start gap-2 label">
                        <input type="checkbox" name="remember" checked="checked" class="checkbox checkbox-secondary" />
                        <span class="label-text">Remember me</span>
                    </label>
                </div>
                <div class="mt-5 flex flex-col">
                    <button type="submit" class="btn btn-active btn-primary">
                        Log in
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
