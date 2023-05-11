<?php

namespace App\Http\Livewire;

use Livewire\Component;

class LikePost extends Component
{
    // Registrar las variables y métodos, se pasan a la vista
    public $post;
    public $isLiked = false;
    public $likes;

    // Ciclo de vida similar a un constructor
    public function mount($post): void
    {
        $this->isLiked = $post->checkLike(auth()->user());
        $this->likes = $post->likes->count();
    }

    public function like(): void
    {
        if ($this->post->checkLike(auth()->user())) {
            $this->post->likes()->where('user_id', auth()->user()->id)->delete();
            $this->isLiked = false;
            $this->likes--;
        } else {
            $this->post->likes()->create([
                'user_id' => auth()->user()->id
            ]);
            $this->isLiked = true;
            $this->likes++;
        }
    }

    public function render()
    {
        return view('livewire.like-post');
    }
}
