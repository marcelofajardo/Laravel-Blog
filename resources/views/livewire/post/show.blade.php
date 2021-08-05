<div>
  {{-- HEADER --}}
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      Post
    </h2>
  </x-slot>

  <div class="mb-6 rounded shadow p-2">
    <x-feedback></x-feedback>

    {{-- POST AUTHOR INFO --}}
    <div class="flex justify-between items-center">
      <p class="text-xs text-gray-700 mb-2">
        <a href="{{ route('heroes.show', $post->author_id) }}" class="font-semibold hover:text-blue-400">
          {{ $post->author_name }}
        </a>
        <span>&bull; Posted {{ $post->created_at }}</span>
      </p>

      {{-- POST EDIT/DELETE --}}
      @if (!$isEdit_able)
        @can(['update', 'delete'], $post)
          <div class="text-xs">
            <button wire:click="showEdit" class="text-blue-400 hover:text-blue-500 hover:underline mr-1">Edit
            </button>

            <button wire:click="delete" class="text-red-400 hover:text-red-500 hover:underline">delete
            </button>
          </div>
        @endcan
      @endif
    </div>

    {{-- EDIT POST FORM --}}
    @if ($isEdit_able)
      <div>
        <form wire:submit.prevent="update">
          {{-- IMAGE --}}
          <div class="mb-6">
            <x-form.input-image :image="$image"></x-form.input-image>
          </div>

          {{-- BODY --}}
          <div class="mb-6">
            <textarea wire:model.defer="body" name="body" rows="15" class="w-full">{{$body}}</textarea>
            <x-form.inline-error field="body"></x-form.inline-error>
          </div>

          {{-- CONTROLS --}}
          <div class="text-right">
            <x-form.button label="Update"></x-form.button>
          </div>
        </form>
      </div>

    {{-- POST BODY --}}
    @else
      @if ($post->image)
      <div>
        <img src="{{$post->image_url}}" alt="post uploaded image" class="mb-2 object-cover h-48 w-full rounded" />
      </div>
      @endif
      <div>
        <p class="px-2 mb-6 text-sm text-gray-900">{{$post->body}}</p>
      </div>
      <x-post.status :post="$post"></x-post.status>
    @endif
  </div>

  {{-- COMMENTS --}}
  <div class="mb-6 rounded shadow p-2">
    @livewire('comment.index', ['post' => $post])
  </div>
</div>
