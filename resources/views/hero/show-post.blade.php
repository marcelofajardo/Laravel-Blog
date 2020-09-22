<x-app-layout>
  <x-slot name="header">
    <div class="flex justify-between">
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Hero
      </h2>
      <a class="px-3 py-1 rounded border border-blue-400 text-blue-400
        hover:text-blue-500 hover:border-blue-500" href="/user/hero/{{$hero->id}}">All Post</a>
    </div>
  </x-slot>

  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
        <div class="md:w-1/2 mx-auto">
          <div class="mb-6 rounded shadow p-6">
            @include('includes.posts.__show',['post' => $post, 'model' => $hero])
          </div>

          @if ($post->comments->isNotEmpty())
          <div class="mb-6 rounded shadow">
            @foreach ($post->comments as $comment)
            <div class="w-full px-8 pt-4 rounded overflow-hidden border-b border-transparent {{$loop->last ? '':'border-gray-200'}}">
              @include('includes.comments.__show',['post'=> $post, 'comment' => $comment])
            </div>
            @endforeach
          </div>
          @endif

          <div class="mb-6 p-6 rounded shadow">
            @include('includes.comments.__create',['model' => $post])
          </div>

        </div>
      </div>
    </div>
  </div>
</x-app-layout>