<div>
    {{-- Knowing others is intelligence; knowing yourself is true wisdom. --}}
    <x-slot name="header">
        Post
    </x-slot>

    <div class="mb-6 rounded shadow p-2">
        <div class="flex justify-between items-center">
            {{-- POST AUTHOR INFO --}}
            <p class="text-xs text-gray-700 mb-2">
                <a href="{{ route('heroes.show', $post->author_id) }}" class="font-semibold hover:text-blue-400">
                    {{ $post->author_name }}
                </a>
                <span>&bull; Posted {{ $post->created_at }}</span>
            </p>

            {{-- POST CONTROLS --}}
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

        {{-- POST IMAGE --}}
        @if ($post->image)
        <div>
            <img src="{{$post->image_url}}" alt="post uploaded image" class="mb-2 object-cover h-48 w-full rounded" />
        </div>
        @endif

        {{-- POST BODY --}}
        @if ($isEdit_able)
        <div>
            <form wire:submit.prevent="update">
                <div class="mb-6">
                    <x-form.input-image :image="$image"></x-form.input-image>
                </div>
                <div class="mb-6">
                    <textarea wire:model="body" name="body" rows="15" class="w-full">{{$body}}</textarea>
                </div>
                <div class="text-right">
                    <x-form.button label="Update"></x-form.button>
                </div>
            </form>
        </div>
        @else
        <p class="px-2 mb-6 text-sm text-gray-900">{{$post->body}}</p>
        @endif

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
    </div>

    <div class="mb-6 rounded shadow p-2">
        @foreach ($post->comments as $comment)
        <div class="{{$loop->last ? 'mb-6' : 'border-b'}} border-gray-200 p-2 pb-6">
            <x-comment :comment="$comment">
            </x-comment>
        </div>
        @endforeach
        <x-comment-create :post="$post">
        </x-comment-create>
    </div>
</div>
