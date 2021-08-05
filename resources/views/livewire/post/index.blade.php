<div>
  <div class="my-6 pb-6">
    @livewire('post.create', ['model' => $hero])
  </div>

  @forelse ($posts as $post)
    <div class="{{$loop->last ? '' : 'border-b'}} border-gray-200 p-2 pb-6">
      @livewire('post.preview', ['post' => $post], key($post->id))
    </div>

  @empty
    <p>No post available.</p>
  @endforelse
</div>
