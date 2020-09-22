@switch($model)
    @case($model instanceOf App\Models\Hero)
        @php
           $url = $model->path('post.store');
        @endphp
        @break
    @default
@endswitch

<form action="{{$url}}" method="POST" enctype="multipart/form-data">
  @csrf

      @foreach ($errors->all() as $message)
        <li class="text-red-400 mb-2 text-xs italic">
          {{$message}}
        </li>
      @endforeach

  <div class="mb-6">
    <label class="mb-2 block text-sm font-semibold text-gray-500 uppercase">
      Title
    </label>
    <input
      class="w-full px-4 py-2 rounded border @error('title') border-red-500 @enderror
        focus:border focus:border-blue-500 focus:shadow-outline outline-none"
      type="text"
      name="title"
      placeholder="Title..">
  </div>

  <div class="mb-6">
    <label class="mb-2 block text-sm font-semibold text-gray-500 uppercase">
      Body
    </label>
    <textarea
      class="w-full px-4 py-2 rounded  text-gray-700 border @error('body') border-red-500 @enderror
            outline-none focus:border-blue-500 focus:shadow-outline" name="body" rows="10"
      placeholder="Write something..">{{old('body')}}</textarea>
  </div>

  <div class="mb-6">
    <label class="mb-2 block text-sm font-semibold text-gray-500 uppercase">
      Add image
    </label>
    <input
    class="cursor-pointer"
    type="file"
    name="image">
  </div>

  <div class="mb-6">
    <button
      class="px-8 py-2 text-white bg-blue-400 hover:bg-blue-500"
      type="submit"
      >Post
    </button>
  </div>
</form>