<div>
  @foreach ($post->comments as $comment)
  <div class="{{$loop->last ? 'mb-6' : 'border-b'}} border-gray-200 p-2 pb-6">
    <x-comment :comment="$comment">
    </x-comment>
  </div>
  @endforeach
  <x-comment-create :post="$post">
  </x-comment-create>
</div>
