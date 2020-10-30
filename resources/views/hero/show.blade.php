<x-master>
  <x-slot name="header">Hero</x-slot>
  <div class="mb-6 rounded shadow p-2">
    <x-hero :hero="$hero"></x-hero>
  </div>

  <div class="mb-6 p-2 rounded shadow">
    {{-- <x-post-create :hero="$hero">
    </x-post-create> --}}
    @livewire('create-post', ['model' => $hero])
  </div>

  <div class="rounded shadow">
    @foreach ($posts as $post)
    <div
      class="{{$loop->last ? '' : 'border-b'}} border-gray-200 p-2 pb-6">
      <x-post :post="$post"></x-post>
    </div>
    @endforeach
  </div>
</x-master>