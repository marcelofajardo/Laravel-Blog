<x-app-layout>
  <x-slot name="header">
    <div class="flex justify-between items-center">
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Posts
      </h2>
      <a class="py-1 px-3 border border-blue-400 text-blue-400
    hover:border-blue-500 hover:text-blue-500" href="/posts/create">Create Post</a>
    </div>

  </x-slot>

  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <div class="p-6 bg-white overflow-hidden shadow-xl sm:rounded-lg">
        @foreach ($posts as $post)
        <div class="{{$loop->last ? '' : 'border-b border-gray-200'}}">
          <div class="text-xs text-gray-700 flex justify-between items-center mb-2">
            <p>Posted {{$post->created_date}}</p>

          </div>

          <h2 class="text-xl font-semibold mb-2">
            <a class="hover:underline" href="{{$post->path('show')}}">{{ $post->title }}</a>
          </h2>

          <p class="text-gray-900 text-sm mb-2">{{ $post->body }}</p>

          <p class="text-xs text-gray-500 mb-2">Author:
            <a class="text-blue-400" href="#">{{$post->user->name}}</a>
          </p>

            {{-- @include(__post-controls) --}}
            <div class="flex items-center">
              <p
                class="mr-2 text-sm text-gray-600"
              >{{$post->views_count}}
                <a href="#">views</a>
              </p>

              <p
                class="mr-2 text-sm text-gray-600"
              >{{$post->comments_count}}
                <a href="#">comments</a>
              </p>

              <a
                class="mr-2 text-sm text-gray-600"
                href="#"
              >save</a>

              <a
                class="font-bold text-xl"
                href="#"
              >...</a>
            </div>
        </div>
        @endforeach
<p class="mt-6">
  {{$posts->links()}}
</p>
      </div>
    </div>
  </div>
</x-app-layout>