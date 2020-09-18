<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      Hero
    </h2>
  </x-slot>

  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">

        <div class="mb-6 relative md:w-1/2 mx-auto p-6 border">
          <div class="relative">
            <img src="https://picsum.photos/400/200" alt="" class="mb-2">

            <img src="{{ $hero->avatar }}" alt=""
              class="rounded-full mr-2 absolute bottom-0 transform -translate-x-1/2 translate-y-1/2" style="left: 50%"
              width="100">
          </div>

          <div class="flex justify-between items-center mb-6">
            <div style="max-width: 270px">
              <h2 class="font-bold text-2xl mb-0">{{ '@'.$hero->user->username }}</h2>
              <p class="text-sm">Joined {{ $hero->user->created_at->diffForHumans() }}</p>
            </div>

            <div class="flex">
              {{-- @can ('edit', $user) --}}
            <a href="{{$hero->path('edit')}}"
                class="rounded-full border border-gray-300 py-2 px-4 text-black text-xs mr-2">
                Edit Profile
              </a>
              {{-- @endcan --}}

            </div>
          </div>

          <p class="text-sm">
            {{$hero->bio ?? 'Update your bio..'}}
          </p>


        </div>
      </div>
    </div>
  </div>
</x-app-layout>