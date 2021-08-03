<div>
  @foreach ($post->comments as $comment)
  <div class="{{$loop->last ? 'mb-6' : 'border-b'}} border-gray-200 p-2 pb-6">
    @livewire('comment.show', ['comment' => $comment], key($comment->id))
  </div>
  @endforeach

  <div>
    @livewire('comment.create', ['post' => $post])
  </div>
</div>
