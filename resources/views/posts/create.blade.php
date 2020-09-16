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

        <form action="{{route('posts.store')}}" method="POST">
            @csrf
            <div class="mb-6">
              <label class="mb-2 block text-sm font-bold text-gray-700 uppercase">Title</label>
              <input
                class="w-full @error('title') border-red-500 @enderror border px-4 py-2 rounded focus:border focus:border-blue-500 focus:shadow-outline outline-none"
                type="text"
                name="title"
            value="{{old('title')}}"
                >
              @error('title')
              <span class="text-xs text-red-400 mt-1 italic">
                {{$message}}
              </span>
              @enderror
            </div>

            <div class="mb-6">
              <label class="mb-2 block text-sm font-bold text-gray-700 uppercase">Body</label>
              <textarea class="w-full border px-4 py-2 rounded outline-none
                      text-gray-700 @error('body') border-red-500 @enderror
            focus:border-blue-500 focus:shadow-outline" name="body" rows="10" placeholder="Write something..">{{old('body')}}</textarea>
              @error('body')
              <span class="text-xs text-red-400 mt-1 italic">
                {{$message}}
              </span>
              @enderror
            </div>

            <div class="mb-6 flex items-center">
              <button class="bg-blue-400 text-white rounded py-2 px-8
                  hover:bg-blue-500" type="submit">Post
              </button>
              <a class="ml-4 text-red-400 hover:text-red-500" href="/posts">Cancel</a>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</x-app-layout>