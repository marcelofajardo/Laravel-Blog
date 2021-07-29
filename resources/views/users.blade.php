<x-app-layout>
    <x-slot name="header">Users</x-slot>

    <div class="mb-6">
        <div class="mb-6">
            @foreach ($users as $user)
            <a href="{{route('heroes.show',$user->hero->id)}}"
                class="block mb-2 text-teal-400 hover:text-teal-500 hover:underline">
                {{ '@'. $user->username }}
            </a>
            @endforeach
        </div>

        <div class="pb-6">
            {{$users->links()}}
        </div>
    </div>
</x-app-layout>
