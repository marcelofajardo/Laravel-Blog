<div>
    {{-- HEADER --}}
    <div>
        <p class="text-xs text-gray-700">
            <a class="font-semibold hover:text-blue-400" href="#">{{$author_name}}</a>
            &bull;
            Posted {{$post->created_at}}
        </p>
    </div>

    {{-- POST UPLOADED IMAGE --}}
    @if ($post->image)
    <img class="mb-2 object-cover h-48 w-full rounded" src="{{ asset('storage/'.$post->image)}}"
        alt="post uploaded image" />
    @endif

    {{-- POST BODY --}}
    <p class="px-2 mb-2 text-sm text-gray-900">
        {{ Str::limit($post->body, 250) }}
    </p>

    {{-- POST BOX CONTROLS --}}
    @auth
    <div class="flex px-2 text-xs text-gray-700">
        {{-- LIKE --}}
        <button wire:click="like" class="border border-gray-400 rounded-full px-3 flex items-center
          cursor-pointer hover:text-blue-400 hover:border-blue-400">
            {{ $post->likes()->count() }}
            <span class="ml-1 mb-1">
                <x-icons.like></x-icons.like>
            </span>
        </button>
        {{-- COMMENTS --}}
        <p
            class="mx-2 border border-gray-400 rounded-full px-3 cursor-pointer hover:text-blue-400 hover:border-blue-400">
            {{ $post->comments()->count() }}
            <a href="#">Comments</a>
        </p>
        {{-- VIWES --}}
        <p class="border border-gray-400 rounded-full px-3">
            {{ $post->views_count }}
            <a href="#">Views</a>
        </p>

        {{-- REDIRECT TO POST --}}
        <a href="{{$post->path('show')}}" class="ml-auto text-sm text-blue-700 hover:underline hover:text-blue-800">Read
            More
            <span>&rarr;</span>
        </a>
    </div>
    @endauth
</div>
