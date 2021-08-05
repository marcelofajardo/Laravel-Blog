<div class="flex">
  @if ($image)
  <img src="{{$image->temporaryUrl() ?? ''}}" class="h-32 mr-2 mb-2 rounded">
  @endif

  <div wire:loading wire:target="image">Uploading...</div>

  <div>
    <label for="file" class="px-4 py-2 text-gray-700 text-xs font-bold
      cursor-pointer border border-gray-400 rounded
      hover:border-blue-500 hover:text-blue-700"
      >Upload Image
    </label>
    <input wire:model="image" id="file" class="hidden" type="file" />
    @error('image') <span class="text-sm text-red-700">{{ $message }}</span> @enderror
  </div>
</div>
