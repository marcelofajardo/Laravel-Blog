<x-master>
  <x-slot name="header">Users</x-slot>

  <div class="mb-6">
    @foreach ($users as $user)
    <a href="/users/heroes/{{ $user->hero->id }}"
      class="block mb-2 text-teal-400 hover:text-teal-500 hover:underline">
      {{ '@'. $user->username }}
    </a>
    @endforeach
  </div>
</x-master>