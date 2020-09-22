{{-- edit/delete --}}
<div class="flex justify-end text-xs">
  @can('update-comment', $comment)
  <a class="mr-2 text-blue-400 hover:text-blue-500"
    href="{{route('hero.post.comments.edit', [$hero->id, $post->id, $comment->id])}}">Edit</a>
  @endcan

  @can('delete-comment', $comment)
  <a class="text-red-400" href="#"
    onclick="event.preventDefault();document.querySelector('#deleteComment-{{$comment->id}}').submit()">Delete</a>
  <form id="deleteComment-{{$comment->id}}" class="hidden"
    action="{{route('post.comments.destroy', [$post->id, $comment->id])}}" method="POST">
    @method('DELETE')
    @csrf
  </form>
  @endcan
</div>

{{-- comment text --}}
<div>
  <p class="mb-4 w-full text-gray-700 break-all">
    {{$comment->body}}
  </p>
  <div class="flex justify-between">
    <div class="mb-2 text-xs text-gray-600 flex items-center">
      <img class="w-8 h-8 rounded-full inline-block mr-2"
        src="https://raw.githubusercontent.com/vuetailwind/storage/master/avatars/avatar-boy-1.jpg"
        alt="Asian Girl Avatar" />
      by <a href="#" class="ml-1 hover:underline">Aki Lee</a>
      <span class="mx-1">&bull;</span>
      <span>May 4, 2020</span>
    </div>

    <div class="flex items-center text-xs">
      <button class="{{ $comment->isLiked(auth()->user()) ? 'text-blue-400 cursor-not-allowed' : 'text-gray-700' }} hover:text-blue-400"
        {{! $comment->isLiked(auth()->user()) ?: 'disabled'}}
        onclick="event.preventDefault();document.querySelector('#likeForm-{{$comment->id}}').submit()"
      >
        <svg viewBox="0 0 20 20" class="w-3">
          <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
            <g class="fill-current">
              <path
                d="M11.0010436,0 C9.89589787,0 9.00000024,0.886706352 9.0000002,1.99810135 L9,8 L1.9973917,8 C0.894262725,8 0,8.88772964 0,10 L0,12 L2.29663334,18.1243554 C2.68509206,19.1602453 3.90195042,20 5.00853025,20 L12.9914698,20 C14.1007504,20 15,19.1125667 15,18.000385 L15,10 L12,3 L12,0 L11.0010436,0 L11.0010436,0 Z M17,10 L20,10 L20,20 L17,20 L17,10 L17,10 Z"
                id="Fill-97">
              </path>
            </g>
          </g>
        </svg>
      </button>

      <p
        class="ml-2 mr-2 {{ $comment->likes_count < 0 ? 'text-red-500' : 'text-green-500'}} ">
        {{$comment->likes_count ?? 0}}
      </p>

      <button class="{{ $comment->isDisliked(auth()->user()) ? 'text-blue-400 cursor-not-allowed' : 'text-gray-700' }} hover:text-blue-400"
        {{! $comment->isDisliked(auth()->user()) ?: 'disabled'}} onclick="event.preventDefault();
        document.querySelector('#dislikeForm-{{$comment->id}}').submit()"
      >
        <svg viewBox="0 0 20 20" class="w-3">
          <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
            <g class="fill-current">
              <path
                d="M11.0010436,20 C9.89589787,20 9.00000024,19.1132936 9.0000002,18.0018986 L9,12 L1.9973917,12 C0.894262725,12 0,11.1122704 0,10 L0,8 L2.29663334,1.87564456 C2.68509206,0.839754676 3.90195042,8.52651283e-14 5.00853025,8.52651283e-14 L12.9914698,8.52651283e-14 C14.1007504,8.52651283e-14 15,0.88743329 15,1.99961498 L15,10 L12,17 L12,20 L11.0010436,20 L11.0010436,20 Z M17,10 L20,10 L20,0 L17,0 L17,10 L17,10 Z"
                id="Fill-97">
              </path>
            </g>
          </g>
        </svg>
      </button>

      <form id="likeForm-{{$comment->id}}" action="{{route('comment.like', $comment->id)}}" method="POST"
        class="hidden">
        @csrf
      </form>
      <form id="dislikeForm-{{$comment->id}}" action="{{route('comment.dislike', $comment->id)}}" method="POST"
        class="hidden">
        @method('DELETE')
        @csrf
      </form>
    </div>
  </div>
</div>