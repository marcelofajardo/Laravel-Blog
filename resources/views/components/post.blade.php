<p class="text-sm text-gray-700 mb-2">
  <a class="font-semibold hover:text-blue-400"
    href="#">{{'@'.$post->user->id}}</a> &bull;
  Posted {{$post->created_at->diffForHumans()}}
</p>

@if ($post->image)
<img class="mb-2 object-cover h-48 w-full rounded"
  src="https://picsum.photos/id/123/200"
  alt="cover" />
@endif

<p class="px-2 mb-2 text-sm text-gray-900">
  {{$post->body}}
</p>

<div class="flex px-2 text-xs text-gray-700">
  <p
    class="border border-gray-400 rounded-full px-3">
    12
    <a href="#">
      <svg viewBox="0 0 20 20" class="w-3">
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
    class="mx-2 border border-gray-400 rounded-full px-3">
    5
    <a href="#">Comments</a>
  </p>
  <p
    class="border border-gray-400 rounded-full px-3">
    {{ $post->views_count }}
    <a href="#">Views</a>
  </p>
  <a class="ml-auto text-sm text-blue-700 hover:underline hover:text-blue-800"
    href="#">Read More
    <span>&rarr;</span>
  </a>
</div>