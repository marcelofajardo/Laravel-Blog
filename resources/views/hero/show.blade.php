<x-app-layout>
  <x-slot name="header">Hero</x-slot>

  <div class="mb-6 rounded shadow p-2">
    <x-hero :hero="$hero"></x-hero>
  </div>

  @auth
    @if ($hero->isOwned())
    <div class="mb-6 p-2 rounded shadow">
      @livewire('post.create', ['model' => $hero])
    </div>
    @endif
  @endauth

  <div class="rounded shadow">
    @foreach ($posts as $post)
    <div
      class="{{$loop->last ? '' : 'border-b'}} border-gray-200 p-2 pb-6">
      <x-post :post="$post"></x-post>
    </div>
    @endforeach
  </div>
</x-app-layout>
