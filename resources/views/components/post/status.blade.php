<div class="flex px-2 text-xs text-gray-700 mb-6">
  {{-- LIKES --}}
  <button wire:click="like" class="flex items-center px-3 border border-gray-400 rounded-full
    hover:text-blue-400 hover:border-blue-400
    {{! $post->isOwned() ?: 'cursor-not-allowed' }}
    {{! $post->isLiked() ?: 'text-blue-700'}}">
    <span>{{ $post->likes()->count() }}</span>
    <span class="ml-1 mb-1">
      <x-icons.like></x-icons.like>
    </span>
  </button>

  {{-- COMMENTS --}}
  <a href="#"
    class="mx-2 border border-gray-400 rounded-full px-3 cursor-pointer hover:text-blue-400 hover:border-blue-400">
    {{ $post->comments()->count() }}
    <span>Comments</span>
  </a>

  {{-- VIEWS --}}
  <p class="border border-gray-400 rounded-full px-3">
    {{ $post->views_count }}
    <a href="#">Views</a>
  </p>
</div>
