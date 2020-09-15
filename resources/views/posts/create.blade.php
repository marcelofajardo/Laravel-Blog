<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      Create new post
    </h2>
  </x-slot>

  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
        <div class="p-6">

          <form action="/posts" method="POST">
            @csrf
            <div class="mb-6">
              <label
                class="mb-2 block text-sm font-bold text-gray-700 uppercase"
              >Title</label>
              <input
                class="w-full py-4 px-2 text-gray-700 border"
                type="text"
                name="title"
              >
              @error('title')
              <span class="text-xs text-red-400 italic">{{$message}}</span>
              @enderror
            </div>

            <div class="mb-6">
              <label
                class="mb-2 block text-sm font-bold text-gray-700 uppercase"
              >Body</label>
              <textarea
                class="w-full border text-gray-700"
                name="body"
                rows="10"
              ></textarea>
              @error('body')
              <span class="text-xs text-red-400 italic">{{$message}}</span>
              @enderror
            </div>

            <div class="mb-6 flex items-center">
              <button
                class="bg-blue-400 text-white rounded py-2 px-8
                  hover:bg-blue-500"
                type="submit"
              >Post
              </button>
              <a
                class="ml-4 text-red-400 hover:text-red-500"
                href="/posts"
              >Cancel</a>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</x-app-layout>