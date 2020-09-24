@if ($errors->any())
<div class="mt-2 mb-1 text-red-500 text-xs italic">
  @foreach ($errors->all() as $message)
  <p>{{ $message }}</p>
  @endforeach
</div>
@endif