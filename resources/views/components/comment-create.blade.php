<form action="{{$post->path('comment.store')}}"
  method="POST">
  @csrf

  <x-error-box></x-error-box>

  <div class="mb-6">
    <textarea
      class="w-full border px-4 py-2 text-gray-700 leading-tight rounded focus:border-blue-500 focus:shadow-outline outline-none"
      rows="5" name="body"
      placeholder="Comment something...?">{{ old('body') }}</textarea>
  </div>

  <div class="mb-6 text-right">
    <button class="px-8 py-2 text-sm rounded text-white bg-blue-500
        focus:outline-none hover:bg-blue-400"
        type="submit"
    >Comment
    </button>
  </div>
</form>