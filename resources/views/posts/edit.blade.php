<x-app-layout>
  <x-slot name="header">
    <div class="flex justify-between items-center">
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Edit post
      </h2>
      <a
        class="py-1 px-3 border border-red-400 text-red-400
        hover:border-red-500 hover:text-red-500"
        href="/post"
        onclick="event.preventDefault();document.querySelector('#deletePost').submit()"
      >Delete Post</a>
          <form id="deletePost"
            class="hidden"
            action="/posts/{{$post->id}}"
            method="POST"
          >
          @method('DELETE')
          @csrf
          </form>
    </div>
  </x-slot>

  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
        <div class="p-6">

        <form action="/posts/{{$post->id}}" method="POST">
            @method('PUT')
            @csrf
            <div class="mb-6">
              <label class="mb-2 block text-sm font-bold text-gray-700 uppercase">Title</label>
              <input class="w-full py-4 px-2 text-gray-700 border" type="text" name="title" value="{{$post->title}}">
              @error('title')
              <span class="text-xs text-red-400 italic">{{$message}}</span>
              @enderror
            </div>

            <div class="mb-6">
              <label class="mb-2 block text-sm font-bold text-gray-700 uppercase">Body</label>
              <textarea class="py-4 px-2 w-full border text-gray-700" name="body" rows="10">{{$post->body}}</textarea>
              @error('body')
              <span class="text-xs text-red-400 italic">{{$message}}</span>
              @enderror
            </div>

            <div class="mb-6 flex items-center">
              <button class="bg-blue-400 text-white rounded py-2 px-8
                  hover:bg-blue-500" type="submit">Update
              </button>
              <a class="ml-4 text-red-400 hover:text-red-500" href="/posts">Cancel</a>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</x-app-layout>