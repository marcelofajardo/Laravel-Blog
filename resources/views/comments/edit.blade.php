
<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      Edit comment
    </h2>
  </x-slot>

  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
        <div class="p-6">

        <form action="{{$comment->path('update',$post)}}" method="POST">
          @method('PUT')
          @csrf

            <div class="mb-6">
              <label class="mb-2 block text-sm font-bold text-gray-700 uppercase">Comment</label>
              <textarea class="w-full border px-4 py-2 rounded outline-none
                      text-gray-700 @error('body') border-red-500 @enderror
            focus:border-blue-500 focus:shadow-outline" name="body" rows="10" placeholder="Write something..">{{$comment->body}}</textarea>
              @error('body')
              <span class="text-xs text-red-400 mt-1 italic">
                {{$message}}
              </span>
              @enderror
            </div>

            <div class="mb-6 flex items-center">
              <button class="bg-blue-400 text-white rounded py-2 px-8
                  hover:bg-blue-500" type="submit">Submit
              </button>
            <a class="ml-4 text-red-400 hover:text-red-500" href="{{$post->path('show')}}">Cancel</a>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</x-app-layout>