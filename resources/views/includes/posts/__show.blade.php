@switch($model)
  @case($model instanceOf App\Models\Hero)
    @php
    $url = 'hero.post';
    @endphp
    @break

  @default
@endswitch

<div>
    @if ($post->image)
    <img class="object-cover h-64 border rounded w-full" src="{{$post->post_image}}" />
    @endif
</div>

<div class="px-4 py-4">
    <div class="text-xs text-gray-600 font-medium flex">
        @if ($post->title)
        <a class="uppercase text-blue-400 hover:text-blue-500 hover:underline"
            href="{{route($url.'.show',[$model->id, $post->id])}}">
            <h3>{{$post->title}}</h3>
        </a>
        @endif
        <span class="mx-1">&bull; Posted</span>
        <span>{{$post->created_at->diffForHumans()}}</span>
        <span class="mx-1">&bull; {{$post->views_count}} Views</span>
    </div>

    <p class="text-gray-700 my-2 text-sm break-all">
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
    <div class="flex justify-between">
        <div class="text-xs">
            <span>3
                <a class=" text-blue-500 hover:text-blue-500 hover:underline" href="#">Like</a>
            </span>
            <span class="mx-1">{{$post->comments->count()}}
                <a class=" text-blue-500 hover:text-blue-500 hover:underline"
                    href="{{route($url.'.show',[$model->id, $post->id])}}">Comment</a>
            </span>
            <span>9
                <a class=" text-blue-500 hover:text-blue-500 hover:underline" href="#">Share</a>
            </span>
        </div>
        <div class="text-xs">
            <a class="mr-1 text-blue-400" href="{{route($url.'.edit', [$model->id, $post->id])}}">Edit</a>
            <a class="text-red-400" href="#"
                onclick="event.preventDefault();document.querySelector('#deletePost-{{$post->id}}').submit()">Delete</a>
            <form id="deletePost-{{$post->id}}" class="hidden"
                action="{{route($url.'.destroy', [$model->id, $post->id])}}" method="POST">
                @method('DELETE')
                @csrf
            </form>
        </div>
    </div>
</div>