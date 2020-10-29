<x-master>
  <x-slot name="header">Users</x-slot>

  <div class="mb-6 rounded shadow p-2">
    @foreach ($users as $user)
    <a href="/user/hero/{{ $user->hero->id }}"
      class="block mb-2 text-teal-400 hover:text-teal-500 hover:underline">
      {{ '@'. $user->username }}
    </a>
    @endforeach
  </div>
</x-master>