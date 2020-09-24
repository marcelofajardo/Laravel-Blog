<x-app-layout>
  <x-slot name="header">
    <h2
      class="font-semibold text-xl text-gray-800 leading-tight">
      Post
    </h2>
  </x-slot>

  <div class="py-12">
    <div
      class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <div
        class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
        <div class="mb-6 rounded shadow p-2">

          <p class="text-xs text-gray-700 mb-2">
            <a class="font-semibold hover:text-blue-400"
              href="#">{{'@'.$post->postable->username}}</a>
            &bull;
            Posted
            {{$post->created_at->diffForHumans()}}
          </p>

          @if ($post->image)
          <img
            class="mb-2 object-cover h-48 w-full rounded"
            src="https://picsum.photos/id/123/200"
            alt="cover" />
          @endif

          <p
            class="px-2 mb-2 text-sm text-gray-900">
            {{$post->body}}
          </p>

          <div
            class="flex px-2 text-xs text-gray-700 mb-6">
            <p
              class="border border-gray-400 rounded-full px-3 flex items-center
cursor-pointer hover:text-blue-400 hover:border-blue-400">
              12
              <a class="ml-1 mb-1" href="#">
                <svg viewBox="0 0 20 20"
                  class="w-3">
                  <g id="Page-1" stroke="none"
                    stroke-width="1" fill="none"
                    fill-rule="evenodd">
                    <g class="fill-current">
                      <path
                        d="M11.0010436,0 C9.89589787,0 9.00000024,0.886706352 9.0000002,1.99810135 L9,8 L1.9973917,8 C0.894262725,8 0,8.88772964 0,10 L0,12 L2.29663334,18.1243554 C2.68509206,19.1602453 3.90195042,20 5.00853025,20 L12.9914698,20 C14.1007504,20 15,19.1125667 15,18.000385 L15,10 L12,3 L12,0 L11.0010436,0 L11.0010436,0 Z M17,10 L20,10 L20,20 L17,20 L17,10 L17,10 Z"
                        id="Fill-97">
                      </path>
                    </g>
                  </g>
                </svg>
              </a>
            </p>
            <p
              class="mx-2 border border-gray-400 rounded-full px-3 cursor-pointer hover:text-blue-400 hover:border-blue-400">
              {{-- {{$post->}} --}}
              <a href="#">Comments</a>
            </p>
            <p
              class="border border-gray-400 rounded-full px-3">
              {{ $post->views_count }}
              <a href="#">Views</a>
            </p>
          </div>
        </div>

        <div class="mb-6 rounded shadow">
          @foreach ($comments as $comment)
          <div
            class="{{$loop->last ? '' : 'border-b'}} border-gray-200 p-2 pb-6">
            <x-comment :comment="$comment">
            </x-comment>
          </div>
          @endforeach
        </div>
      </div>
    </div>
  </div>
</x-app-layout>