<x-master>
  <x-slot name="header">Posts</x-slot>

  <div class="mb-6">
     @foreach ($posts as $post)
    <div
      class="{{$loop->last ? '' : 'border-b'}} border-gray-200 p-2 pb-6">
      <x-post :post="$post"></x-post>
    </div>
    @endforeach
  </div>
</x-master>