<div class="px-4">
  <x-error-box></x-error-box>
  <form wire:submit.prevent="save" action="#" enctype="multipart/form-data" method="POST">
    @csrf

    <div class="flex">
      {{-- PREVIEW UPLOAD IMAGE --}}
      <div wire:loading wire:target="image">Uploading...</div>
      @if ($image)
      <img src="{{$image->temporaryUrl() ?? ''}}" alt="{{$uploaded_filename}}" class="h-32 mr-2 mb-2 rounded">
      @endif

      {{-- POST BODY --}}
      <div class="mb-6 flex-1">
        <textarea wire:model.defer="body" name="body" placeholder="Post something...?"
          class="h-32 w-full border px-4 py-2 text-gray-700 leading-tight rounded
          focus:border-blue-500 focus:shadow-outline outline-none"
          >{{ old('body') }}</textarea>
      </div>
    </div>

    {{-- CREATE POST CONTROLS --}}
    <div class="flex justify-between items-center mb-6">
      <div>
        <label for="file" class="px-4 py-2 text-gray-700 text-xs font-bold cursor-pointer
          border border-gray-400 rounded hover:border-blue-500 hover:text-blue-700"
          >Upload Image
        </label>
        <input wire:model="image" id="file" class="hidden" type="file" />
      </div>

      <button class="px-8 py-2 text-sm rounded text-white bg-blue-500
        focus:outline-none hover:bg-blue-400"
        >Post It!
      </button>
    </div>
  </form>
</div>
