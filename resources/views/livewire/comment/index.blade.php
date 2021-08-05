<div>
  @forelse ($post->comments as $comment)
    <div class="{{$loop->last ? 'mb-6' : 'border-b'}} border-gray-200 p-2 pb-6">
      @livewire('comment.show', ['comment' => $comment], key($comment->id))
    </div>

  @empty
    <p>No comment available.</p>
  @endforelse

  <div>
    @livewire('comment.create', ['post' => $post])
  </div>
</div>
