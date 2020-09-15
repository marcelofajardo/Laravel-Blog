<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{$post->title}}
            </h2>
            <a class="py-1 px-3 border border-blue-400 text-blue-400
          hover:border-blue-500 hover:text-blue-500" href="/posts">All post</a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6">
                 <div>
                     <p>{{$post->body}}</p>
                     {{-- @include(__post-controls) --}}
                    </div>

                    <div>
                        {{-- comments/reply --}}
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>