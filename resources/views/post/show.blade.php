<x-app-layout>
  <x-slot name="header">Post</x-slot>

  <div class="mb-6 rounded shadow p-2">
    <div
      class="flex justify-between items-center">
      <p class="text-xs text-gray-700 mb-2">
        <a class="font-semibold hover:text-blue-400"
          href="{{ route('heroes.show', $post->postable->id) }}">{{'@'.$post->postable->username}}
        </a>
        &bull;
        Posted
        {{ $post->created_at }}
      </p>
      <div class="text-xs">
        @can('update', $post)
        <a class="text-blue-400
        hover:text-blue-500 hover:underline mr-1"
          href="{{ $post->path('edit')}}">Edit
        </a>
        @endcan

        @can('delete', $post)
        <a class="text-red-400
                    hover:text-red-500 hover:underline"
          href="#"
          onclick="event.preventDefault();
                      document.querySelector('#deletePost-{{$post->id}}').submit()">delete
        </a>
        <form id="deletePost-{{$post->id}}"
          class="hidden"
          action="{{$post->path('destroy')}}"
          method="POST">
          @csrf
          @method('DELETE')
        </form>
        @endcan
      </div>
    </div>

    @if ($post->image)
    <img
      class="mb-2 object-cover h-48 w-full rounded"
      src="https://picsum.photos/id/123/200"
      alt="cover" />
    @endif

    <p class="px-2 mb-2 text-sm text-gray-900">
      {{$post->body}}
    </p>

    <div
      class="flex px-2 text-xs text-gray-700 mb-6">

      <a href="#" class="flex items-center px-3 border border-gray-400 rounded-full
      hover:text-blue-400 hover:border-blue-400
      {{ $post->postable->id !== auth()->user()->id ?: 'cursor-not-allowed' }}
      {{! $post->isLiked() ?: 'text-blue-700'}}"
        onclick="event.preventDefault();
          document.querySelector('#postLikeForm').submit()">
        <span>
          {{ $post->likes()->count() }}
        </span>
        <svg viewBox="0 0 20 20"
          class="w-3 ml-1 mb-1">
          <g id="Page-1" stroke="none"
            stroke-width="1" fill="none"
            fill-rule="evenodd">
            <g class="fill-current">
              <path
                d="M11.0010436,0 C9.89589787,0 9.00000024,0.886706352 9.0000002,1.99810135 L9,8 L1.9973917,8 C0.894262725,8 0,8.88772964 0,10 L0,12 L2.29663334,18.1243554 C2.68509206,19.1602453 3.90195042,20 5.00853025,20 L12.9914698,20 C14.1007504,20 15,19.1125667 15,18.000385 L15,10 L12,3 L12,0 L11.0010436,0 L11.0010436,0 Z M17,10 L20,10 L20,20 L17,20 L17,10 L17,10 Z"
                id="Fill-97">
              </path>
            </g>
          </g>
        </svg>
      </a>
      @if ($post->postable->id !== auth()->user()->id)
      @can('like', $post)
      <form id="postLikeForm"
        action="{{$post->path('like')}}"
        method="POST">
        @csrf
      </form>
      @endcan
      @endif

      <p
        class="mx-2 border border-gray-400 rounded-full px-3 cursor-pointer hover:text-blue-400 hover:border-blue-400">
        {{ $post->comments()->count() }}
        <a href="#">Comments</a>
      </p>
      <p
        class="border border-gray-400 rounded-full px-3">
        {{ $post->views_count }}
        <a href="#">Views</a>
      </p>
    </div>
  </div>

  <div class="mb-6 rounded shadow p-2">
    @foreach ($comments as $comment)
    <div
      class="{{$loop->last ? 'mb-6' : 'border-b'}} border-gray-200 p-2 pb-6">
      <x-comment :comment="$comment">
      </x-comment>
    </div>
    @endforeach
    <x-comment-create :post="$post">
    </x-comment-create>
  </div>
</x-app-layout>
