<div>
  {{-- HEADER --}}
  <div>
    <p class="text-xs text-gray-700">
      <a class="font-semibold hover:text-blue-400" href={{"/users/heroes/{$post->author_id}"}}>{{$post->author_name}}</a>
      &bull; Posted {{$post->created_at}}
    </p>
  </div>

  {{-- POST UPLOADED IMAGE --}}
  @if ($post->image)
    <img src="{{ asset('storage/'.$post->image)}}" alt="post uploaded image"
      class="mb-2 object-cover h-48 w-full rounded" />
  @endif

  {{-- POST BODY --}}
  <p class="px-2 mb-2 text-sm text-gray-900">
    {{ Str::limit($post->body, 250) }}
  </p>

  {{-- POST BOX CONTROLS --}}
  @auth
    <x-post.preview-status :post="$post"></x-post.preview-status>
  @endauth
</div>
