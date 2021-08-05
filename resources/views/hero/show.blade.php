<x-app-layout>
  <x-slot name="header">Hero</x-slot>

  <div class="mb-6 rounded shadow p-2">
    <x-hero :hero="$hero"></x-hero>
  </div>


  <div class="rounded shadow">
    @livewire('post.index', [
      'hero' => $hero,
      'posts' => $posts
    ])
  </div>
</x-app-layout>
