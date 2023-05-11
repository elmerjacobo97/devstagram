@extends('layouts.app')

@section('title')
    {{ $post->title }}
@endsection

@section('content')
    <div class="container mx-auto gap-10 md:flex md:justify-center">
        <div class="md:w-6/12">
            <div class="shadow-xl card bg-neutral">
                <figure>
                    <img src="{{ asset('uploads') . '/' . $post->image }}" alt="Shoes"/>
                </figure>
                <div class="card-body">
                    <div class="flex items-center">
                        @auth
                            <livewire:like-post :post="$post"/>
                        @endauth
                    </div>
                    <p>{{ $post->user->username }}</p>
                    <p>{{ $post->created_at->diffForHumans() }}</p>
                    <p>{{ $post->description }}</p>
                    @auth
                        {{-- La persona que está autenticada, es la misma que creó el post --}}
                        @if($post->user_id == auth()->user()->id)
                            <form method="POST" action="{{ route('posts.destroy', $post) }}"
                                  class="justify-end card-actions">
                                @method('DELETE') {{-- METHOD SPOOFING (permite agregar métodos que no soparta por defaul el navegador) --}}
                                @csrf
                                <button class="gap-2 btn btn-error">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                         stroke-width="1.5"
                                         stroke="currentColor" class="h-6 w-6">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                              d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0"/>
                                    </svg>
                                    Delete
                                </button>
                            </form>
                        @endif
                    @endauth
                </div>
            </div>
        </div>
        <div class="mt-5 md:mt-0 md:w-4/12">
            @auth
                <form method="POST" action="{{ route('comments.store', ['user' => $user, 'post' => $post]) }}">
                    @csrf
                    @if( session('success') )
                        <div id="alert-success" class="shadow-lg alert alert-success">
                            <div>
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 flex-shrink-0 stroke-current"
                                     fill="none" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                <span>{{ session('success') }}</span>
                            </div>
                        </div>
                    @endif
                    <div class="w-full form-control">
                        <label for="comment" class="label">Add Comment</label>
                        <textarea
                            id="comment"
                            name="comment"
                            class="textarea textarea-bordered textarea-lg w-full px-4 @error('comment') textarea-error @enderror"
                            placeholder="Add a comment..."
                        ></textarea>
                        @error('comment')
                        <label class="label">
                            <span class="label-text-alt text-error">{{ $message }}</span>
                        </label>
                        @enderror
                    </div>
                    <div class="mt-5 flex flex-col">
                        <button type="submit" class="btn btn-active btn-primary">
                            Comment
                        </button>
                    </div>
                </form>
            @endauth
            <div class="md:max-h-screen md:overflow-y-scroll">
                @if($post->comments->count())
                    @foreach($post->comments()->latest()->get() as $comment)
                        <div class="mt-5 chat chat-start">
                            <div class="chat-image avatar">
                                <div class="w-10 rounded-full">
                                    <img
                                        src="{{ $comment->user->image ? asset('profiles') . '/' . $comment->user->image : asset('img/usuario.svg') }}"
                                        alt="image avatar"/>
                                </div>
                            </div>
                            <a href="{{ route('posts.index', $comment->user) }}" class="chat-header">
                                {{ $comment->user->username }}
                            </a>
                            <div class="bg-gray-800 chat-bubble">{{ $comment->comment }}</div>
                            <div class="opacity-50 chat-footer">
                                {{ $comment->created_at->diffForHumans() }}
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="mt-5 text-center space-y-2">
                        <h2 class="text-2xl font-bold">No comments yet</h2>
                        <p>Start the conversation</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection


{{-- @if($post->checkLike(auth()->user()))
                                 Si like
                                <form method="POST" action="{{ route('posts.likes.destroy', $post) }}"
                                      class="flex items-center">
                                    @method('DELETE')
                                    @csrf

                                </form>
                            @else
                                 No like
                                <form method="POST" action="{{ route('posts.likes.store', $post) }}"
                                      class="flex items-center">
                                    @csrf
                                    <button class="gap-2 btn bg-neutral">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none"
                                             viewBox="0 0 24 24"
                                             stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                  d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                                        </svg>
                                    </button>
                                </form>
                            @endif --}}
