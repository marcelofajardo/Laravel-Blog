<div>
    @if ($hero->isOwned())
    <div class="my-6">
        @livewire('post.create', ['model' => $hero])
    </div>
    @endif

    {{-- FIXME: created_at doesn't update automatically --}}
    @foreach ($hero->posts as $post)
    <div class="{{$loop->last ? '' : 'border-b'}} border-gray-200 p-2 pb-6">
        @livewire('post.show', ['post' => $post], key($post->id))
    </div>
    @endforeach
</div>
