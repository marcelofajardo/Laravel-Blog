{{-- @switch($model)
  @case($model instanceOf App\Models\Hero)
    @php
    $url = 'hero.post';
    @endphp
    @break

  @default
@endswitch --}}

<div>
  @if ($post->image)
  <img class="object-cover h-20 w-full" src="{{$post->post_image}}" />
  @endif
</div>

<div class="px-4 py-4">
  <div class="text-xs text-gray-600 font-medium flex">
    @if ($post->title)
      <h3>{{$post->title}}</h3>
    @endif
    <span class="mx-1">&bull; Posted</span>
    <span>{{$post->created_at->diffForHumans()}}</span>
  </div>

  <p class="text-gray-700 my-2 text-sm">
    {{$post->body}}
  </p>

  <div class="text-sm text-gray-800 flex justify-between items-center mb-6">
    <a href="#" class="hover:underline">
      <div>
        <img class="w-8 h-8 rounded-full inline-block mr-2" src="{{$post->user->profile_photo_url}}"
          alt="{{$post->user->name}}" /> by
        {{'@'.$post->user->username}}
      </div>
    </a>
  </div>
  <div class="text-xs flex justify-between items-end">
    <div>
      <span>3
        <a class="ml-1 text-blue-500 hover:text-blue-500 hover:underline" href="#">Like</a>
      </span>
      <span>{{$post->comments->count()}}
        <a class="ml-1 text-blue-500 hover:text-blue-500 hover:underline"
          href="#">Comment</a>
      </span>
      <span>9
        <a class="ml-1 text-blue-500 hover:text-blue-500 hover:underline" href="#">Share</a>
      </span>
    </div>

    <div class="text-right">
      {{-- <a href="{{route($url.'.show', [$model->id, $post->id])}}" class="py-2 text-indigo-600 text-xs uppercase hover:underline"> Read More <span>&rarr;</span> </a> --}}
    </div>
  </div>
</div>