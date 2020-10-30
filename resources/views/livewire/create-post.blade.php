<form wire:submit.prevent="save"
  enctype="multipart/form-data"
  >
  <x-error-box></x-error-box>
<div class="flex">
     @if ($image)
        <img src="{{ $image->temporaryUrl() }}"
        class="h-32 mr-2 mb-2 rounded"
        >
        @endif
        <div class="mb-6 flex-1">
    <textarea name="body"
    class="h-32 w-full border px-4 py-2 text-gray-700 leading-tight rounded focus:border-blue-500 focus:shadow-outline outline-none"
    placeholder="Post something...?"
    wire:model="body"
    >{{ old('body') }}</textarea>
  </div>
</div>

  <div
    class="mb-6 flex justify-between items-center"
  >
    <label for="file"
    class="px-4 py-2 text-gray-700 text-xs font-bold cursor-pointer
    border border-gray-400 rounded hover:border-blue-500 hover:text-blue-700">Upload
    Image
  </label>
  <input id="file"
  class="hidden"
  type="file"
  wire:model="image"
  />

    <button
      class="px-8 py-2 text-sm rounded text-white bg-blue-500
        focus:outline-none hover:bg-blue-400">
      Post It!
    </button>
  </div>
</form>