<div class="flex">

  {{-- LIKE/DISLIKE --}}
  <div class="flex justify-between items-center flex-col px-4 text-sm text-gray-700">
    <button wire:click="like" class="hover:text-blue-700 {{! $comment->isLiked() ?: 'text-blue-700'}}">
      <x-icons.like></x-icons.like>
    </button>

    <p class="my-2 {{ $comment->total_likes < 0 ? 'text-red-500' : 'text-green-500'}} ">
      {{$comment->total_likes ?? 0}}
    </p>

    <button wire:click="dislike" class="hover:text-red-700 {{! $comment->isDisliked() ?: 'text-red-700'}}">
      <x-icons.dislike></x-icons.dislike>
    </button>

    {{-- long post indicator --}}
    <span class="mt-4 bg-gray-300 h-full w-1">
    </span>
  </div>

  {{-- COMMENT BODY --}}
  <div class="w-full">
    @if (!$isEdit_able)
    <p class="mb-2 text-gray-700 text-sm">
      {{ $comment->body }}
    </p>
    <div class="flex justify-between items-center">
      <p class="text-xs text-gray-700">
        <a class="font-bold hover:text-blue-400" href="#">{{ '@'.$comment->user->name }}
        </a>
        &bull; 3 mins ago
      </p>

      {{-- COMMENT CONTROLS --}}
      <div class="text-xs">
        @can(['update','delete'], $comment)
        <button wire:click="showEdit" class="text-blue-400 hover:text-blue-500 hover:underline mr-1">
          Edit
        </button>

        <button wire:click="delete" class="text-red-400 over:text-red-500 hover:underline">
          Delete
        </button>
        @endcan
      </div>
    </div>
    @else
    <form wire:submit.prevent="update" action="#">
      <div class="mb-6">
        <label for="body" class="block mb-1 text-sm font-bold text-gray-500">Comment</label>
        <textarea wire:model="body" name="body" id="body" class="w-full p-2 border rounded"
          rows=10>{{$this->comment->body}}</textarea>
        @error('body') <span class="text-sm text-red-500">{{ $message }}</span> @enderror
      </div>
      <div class="text-right">
        <x-form.button label="Update"></x-form.button>
      </div>
    </form>
    @endif
  </div>
</div>
