@switch($model)
@case($model instanceOf App\Models\Post)
@php
$url = route('post.comments.store',[$model->id]);
@endphp
@break
@default
@endswitch

<form action="{{$url}}" method="POST">
  @csrf
  <div class="mb-6">
    <label class="mb-2 block text-sm font-semibold text-gray-500 uppercase">
      Comment
    </label>
    <textarea class="w-full px-4 py-2 rounded  text-gray-700 border @error('body') border-red-500 @enderror
            outline-none focus:border-blue-500 focus:shadow-outline" name="body" rows="5"
      placeholder="Comment something..">{{old('body')}}</textarea>
    @error('body')
    <p class="text-xs italic text-red-500 -mt-1">{{$message}}</p>
    @enderror
  </div>


  <div class="mb-6">
    <button class="px-8 py-2 text-white bg-blue-400 hover:bg-blue-500 rounded" type="submit">Comment
    </button>
  </div>
</form>