<x-master>
  <x-slot name="header">Edit Post</x-slot>
  <div class="mb-6 rounded shadow p-2">
    <form action="{{$post->path('update')}}"
      method="POST">
      @csrf
      @method('PUT')

      <x-error-box></x-error-box>

      <div class="mb-6">
        <textarea
          class="w-full h-full border px-4 py-2 text-gray-700 leading-tight rounded focus:border-blue-500 focus:shadow-outline outline-none"
          rows="15" name="body"
          placeholder="Post something...?"
          >{{ $post->body }}</textarea>
      </div>

      <div class="mb-6">
        <button class="px-8 py-2 text-sm rounded text-white bg-blue-500
        focus:outline-none hover:bg-blue-400">
          Update
        </button>
      </div>
    </form>
  </div>
</x-master>