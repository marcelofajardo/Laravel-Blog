<x-app-layout>
    <x-slot name="header">Posts</x-slot>

    <div class="mb-6">
        @foreach ($posts as $post)
        <div class="{{$loop->last ? '' : 'border-b'}} border-gray-200 p-2 pb-6">
            @livewire('post.preview', ['post' => $post])
        </div>
        @endforeach

        <div>
            {{ $posts->links() }}
        </div>
    </div>
</x-app-layout>
