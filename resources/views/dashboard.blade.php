@extends('layouts.app')

@section('title')
    {{ $user->name }}
@endsection

@section('content')
    <div class="flex flex-col items-center justify-center gap-5 sm:flex-row sm:gap-10">
        <div class="avatar">
            <div class="w-32 rounded-full ring ring-offset-2 ring-primary ring-offset-base-100">
                <img src="{{ $user->image ? asset('profiles') . '/' . $user->image : asset('img/usuario.svg') }}"
                     alt="imagen avatar"/>
            </div>
        </div>
        <div class="space-y-1">
            <div class="flex items-center gap-2">
                <p class="text-xl">{{ $user->username }}</p>
                @auth
                    @if($user->id === auth()->user()->id)
                        <a href="{{ route('profile.index', $user) }}" class="hover:text-gray-400">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                 class="h-5 w-5">
                                <path
                                    d="M21.731 2.269a2.625 2.625 0 00-3.712 0l-1.157 1.157 3.712 3.712 1.157-1.157a2.625 2.625 0 000-3.712zM19.513 8.199l-3.712-3.712-12.15 12.15a5.25 5.25 0 00-1.32 2.214l-.8 2.685a.75.75 0 00.933.933l2.685-.8a5.25 5.25 0 002.214-1.32L19.513 8.2z"/>
                            </svg>
                        </a>
                    @endif
                @endauth
            </div>
            <p class="text-sm">{{ $user->followers->count() }} @choice('Follower|Followers', $user->followers->count()) </p>
            <p class="text-sm">{{ $user->followers->count() }} Following</p>
            <p class="text-sm">{{ $user->posts->count() }} Posts</p>
            @auth
                @if($user->id !== auth()->user()->id)
                    @if(!$user->isFollowing(auth()->user()))
                        <form action="{{ route('users.follow', $user) }}" method="POST">
                            @csrf
                            <button type="submit" class="capitalize btn btn-sm btn-primary">Follow</button>
                        </form>
                    @else
                        <form action="{{ route('users.unfollow', $user) }}" method="POST">
                            @method('DELETE')
                            @csrf
                            <button type="submit" class="capitalize btn btn-sm btn-error">stop following</button>
                        </form>
                    @endif
                @endif
            @endauth
        </div>
    </div>
    <section>
        <h2 class="my-10 text-center text-2xl font-black">My posts</h2>
        <x-list-post :posts="$posts" />
        <div class="mt-5">
            {{ $posts->links('pagination::tailwind') }}
        </div>
    </section>
@endsection


{{--@forelse($array as $objeto_individual)--}}
{{--    <h1> {{ $objeto_individual }}</h1>--}}
{{--@empty--}}
{{--    <h1> Sin valores </h1>--}}
{{--    @forelse--}}
