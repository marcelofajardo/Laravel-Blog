<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      Hero
    </h2>
  </x-slot>

  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">

        <div class="mb-6 rounded shadow p-2">
          <x-hero :hero="$hero"></x-hero>
        </div>

        <div class="mb-6 p-2 rounded shadow">
          <x-create-post :hero="$hero"></x-create-post>
        </div>

        <div class="rounded shadow">
          @foreach ($posts as $post)
          <div class="{{$loop->last ? '' : 'border-b'}} border-gray-200 p-2">
            <x-post :post="$post"></x-post>
          </div>
          @endforeach
        </div>

          {{-- <div class="mb-6 p-6 rounded shadow">
            @foreach ($hero->posts as $post)
            <div class="{{$loop->last ? '' : 'mb-2'}}">
              <x-post :post="$post"></x-post>
            </div>
            @endforeach
          </div> --}}

      </div>
    </div>
  </div>
</x-app-layout>