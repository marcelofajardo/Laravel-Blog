<div class="flex px-2 text-xs text-gray-700">
  {{-- LIKE --}}
  <button wire:click="like" class="border border-gray-400 rounded-full px-3 flex items-center
      cursor-pointer hover:text-blue-400 hover:border-blue-400
      {{! $post->isOwned() ?: 'cursor-not-allowed' }}
      {{! $post->isLiked() ?: 'text-blue-700'}}">{{ $post->likes()->count() }}
    <span class="ml-1 mb-1">
      <x-icons.like></x-icons.like>
    </span>
  </button>

  {{-- COMMENTS --}}
  <p class="mx-2 border border-gray-400 rounded-full px-3 cursor-pointer hover:text-blue-400 hover:border-blue-400">
    {{ $post->comments()->count() }}
    <a href="{{$post->path('show')}}">Comments</a>
  </p>

  {{-- VIWES --}}
  <p class="border border-gray-400 rounded-full px-3">
    {{ $post->views_count }}
    <span>Views</span>
  </p>

  {{-- REDIRECT TO POST --}}
  <a href="{{$post->path('show')}}" class="ml-auto text-sm text-blue-700 hover:underline hover:text-blue-800">Read
    More
    <span>&rarr;</span>
  </a>
</div>
