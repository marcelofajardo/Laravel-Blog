<div class="relative">
  <img class="object-cover h-48 w-full rounded"
    src="https://picsum.photos/id/123/200"
    alt="cover" />
  <img
    class="rounded-full h-32 w-32 absolute bottom-0 transform -translate-x-1/2 translate-y-1/2"
    style="left: 50%" src="{{$hero->avatar}}"
    alt="user" />
</div>

<div
  class="flex justify-between items-start my-4">
  <div class="p-2" style="max-width: 150px">
    <p class="text-sm text-blue-400">@Lipsum</p>
    <h2 class="font-bold my-1">
      {{$hero->user->name}}</h2>
    <p class="text-xs text-gray-700">
      Joined
      {{$hero->created_at->diffForHumans()}}
    </p>
  </div>

  <a class="px-4 py-2 mt-4 text-xs font-semibold text-blue-400
    border border-blue-400 rounded hover:bg-blue-400 hover:text-white"
    href="{{$hero->path('edit')}}">Edit Profile
  </a>
</div>

<p class="mb-6 text-sm text-gray-600">
  {{$hero->bio ?? "Update your bio.."}}
</p>























{{-- <div class="relative">
  <img src="https://picsum.photos/400/200" alt=""
    class="mb-2">
  <img src="{{ $hero->avatar }}" alt=""
class="rounded-full mr-2 absolute bottom-0
transform -translate-x-1/2 translate-y-1/2"
style="left: 50%" width="100" height="100">
</div>
<div
  class="flex justify-between items-center mb-6">
  <div>
    <h2 class="font-bold text-2xl mt-8 mb-2">
      {{$hero->user->name}}
    </h2>
    <p class="text-xs text-gray-700">
      {{ '@'.$hero->user->username }}</p>
    <p class="text-xs text-gray-800">Joined
      {{ $hero->user->created_at->diffForHumans() }}
    </p>
  </div>

  <div class="flex">
    <a href="{{$hero->path('edit')}}"
      class="rounded border border-gray-300 py-2 px-4 text-black text-xs mr-2">
      Edit Profile
    </a>
  </div>
</div>

<p class="text-sm text-gray-900">
  {{$hero->bio ?? 'Update your bio..'}}
  Lorem ipsum dolor sit amet consectetur
  adipisicing elit. Corporis molestias iure porro!
  Consectetur, omnis reiciendis numquam, quaerat
  totam labore atque accusantium facere natus
  neque, amet error quibusdam maxime ut vel.
</p>
</div> --}}