<div class="flex">
  <div
    class="flex justify-between items-center flex-col px-4 text-sm text-gray-700">
    <a class="hover:text-blue-700" href="#"><svg
        viewBox="0 0 20 20" class="w-4">
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

    <p
      class="my-2 {{ $comment->likes_count < 0 ? 'text-red-500' : 'text-green-500'}} ">
      {{$comment->likes_count ?? 0}}
    </p>

    <a href="#" class="hover:text-blue-700"><svg
        viewBox="0 0 20 20" class="w-4">
        <g id="Page-1" stroke="none"
          stroke-width="1" fill="none"
          fill-rule="evenodd">
          <g class="fill-current">
            <path
              d="M11.0010436,20 C9.89589787,20 9.00000024,19.1132936 9.0000002,18.0018986 L9,12 L1.9973917,12 C0.894262725,12 0,11.1122704 0,10 L0,8 L2.29663334,1.87564456 C2.68509206,0.839754676 3.90195042,8.52651283e-14 5.00853025,8.52651283e-14 L12.9914698,8.52651283e-14 C14.1007504,8.52651283e-14 15,0.88743329 15,1.99961498 L15,10 L12,17 L12,20 L11.0010436,20 L11.0010436,20 Z M17,10 L20,10 L20,0 L17,0 L17,10 L17,10 Z"
              id="Fill-97">
            </path>
          </g>
        </g>
      </svg>
    </a>

    <span class="mt-4 bg-gray-300 h-full w-1">
    </span>
  </div>

  <div class="w-full">
    <p class="mb-2 text-gray-700 text-sm">
      {{ $comment->body }}
    </p>
    <div
      class="flex justify-between items-center">
      <p class="text-xs text-gray-700">
        <a class="font-bold hover:text-blue-400"
          href="#">{{ '@'.$comment->user->name }}
        </a>
        &bull; 3 mins ago

      </p>
      <div class="text-xs">
        @can('update', $comment)
        <a class="text-blue-400
      hover:text-blue-500 hover:underline mr-1"
          href="{{ $comment->path('edit')}}">Edit
        </a>
        @endcan

        @can('delete', $comment)
        <a class="text-red-400
                    hover:text-red-500 hover:underline"
          href="#"
          onclick="event.preventDefault();
                                    document.querySelector('#deletePost-{{$comment->id}}').submit()">delete
        </a>
        <form id="deletePost-{{$comment->id}}"
          class="hidden"
          action="{{$comment->path('destroy')}}"
          method="POST">
          @csrf
          @method('DELETE')
        </form>
        @endcan
      </div>
    </div>
  </div>
</div>