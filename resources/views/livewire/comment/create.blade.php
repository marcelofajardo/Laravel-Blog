<div>
  <form wire:submit.prevent="save" action="#" method="POST">
    {{-- BODY --}}
    <div class="mb-6">
      <textarea wire:model="body"
        class="w-full border px-4 py-2 text-gray-700 leading-tight rounded focus:border-blue-500 focus:shadow-outline outline-none"
        rows="5" name="body" placeholder="Comment something...?">{{ old('body') }}</textarea>
      <x-form.inline-error field="body"></x-form.inline-error>
    </div>

    {{-- CONTROLS --}}
    <div class="mb-6 text-right">
      <x-form.button label="Comment"></x-form.button>
    </div>
  </form>
</div>
