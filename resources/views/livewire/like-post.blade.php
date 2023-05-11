<div>
    <div class="flex items-center gap-2">
        <button
            class="gap-2 btn bg-neutral"
            wire:click="like"
        >
            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 {{ $isLiked ? 'animate__bounceIn' : '' }}" fill="{{ $isLiked ? '#F97272' : 'none' }}"
                 viewBox="0 0 24 24"
                 stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="{{ $isLiked ? '0' : '2' }}"
                      d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
            </svg>
        </button>
        <p>{{ strval($likes) }} {{ Str::plural('like', $likes )}}</p>
    </div>
</div>
