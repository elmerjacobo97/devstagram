<div class="grid gap-4 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-5">
    @forelse($posts as $post)
        <div class="shadow-xl card card-compact bg-neutral">
            <a href="{{ route('posts.show', ['user' => $post->user, 'post' => $post]) }}">
                <figure>
                    <img src="{{ asset('uploads') . '/' . $post->image }}"
                         alt="Image post {{ $post->username }}"/>
                </figure>
            </a>
        </div>
    @empty
        <div class="col-span-full text-center">
            <p>You don't have posts yet</p>
        </div>
    @endforelse
</div>
