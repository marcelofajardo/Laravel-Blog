<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      Edit Profile
    </h2>
  </x-slot>

  <div>
    <form action="{{$hero->path('update')}}" method="POST">
      @method('PUT')
      @csrf

      {{-- BIO --}}
      <div class="mb-6">
        <label class="mb-2 block text-sm font-bold text-gray-700 uppercase">Body</label>
        <textarea name="bio" rows="10"
          class="w-full border px-4 py-2 rounded outline-none text-gray-700
          focus:border-blue-500 focus:shadow-outline"
          @error('bio') border-red-500 @enderror
          placeholder="Write something.."
          >{{$hero->bio}}</textarea>

          <x-form.inline-error field="bio"></x-form.inline-error>
      </div>

      {{-- EDIT CONTROLS --}}
      <div class="mb-6 flex items-center">
        <x-form.button label="Update"></x-form.button>
        <a href="/users/heroes/{{$hero->id}}"
          class="ml-4 text-red-400 hover:text-red-500"
          >Cancel
        </a>
      </div>
    </form>
  </div>
</x-app-layout>
