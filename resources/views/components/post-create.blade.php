<form action="{{$hero->path('post.store')}}"
  method="POST"
  enctype="multipart/form-data"
  >
  @csrf

  <x-error-box></x-error-box>

  <div class="mb-6">
    <textarea
      class="w-full border px-4 py-2 text-gray-700 leading-tight rounded focus:border-blue-500 focus:shadow-outline outline-none"
      rows="5"
      name="body"
      placeholder="Post something...?"
      >{{ old('body') }}</textarea>
  </div>

  <div
    class="mb-6 flex justify-between items-center"
  >
    <label for="file"
      class="px-4 py-2 text-gray-700 text-xs font-bold cursor-pointer
        border border-gray-400 rounded hover:border-blue-500 hover:text-blue-700">Upload
      Image
    </label>
    <input
      id="file"
      class="hidden"
      type="file"
      name="image"
    />

    <button
      class="px-8 py-2 text-sm rounded text-white bg-blue-500
        focus:outline-none hover:bg-blue-400">
      Post It!
    </button>
  </div>
</form>