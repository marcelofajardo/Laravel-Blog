<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Laravel
            </h2>
            <a class="py-2 px-4 border border-blue-400 text-blue-400 rounded
          hover:border-blue-500 hover:text-blue-500" href="/posts">All post</a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg mb-6">
                <div class="p-6">
                    <div>
                        <h2 class="text-xl font-semibold mb-2">{{ $post->title }}</h2>
                        <p class="text-gray-900 text-sm mb-2">{{ $post->body }}</p>
                        <p class="text-xs text-gray-500 mb-2">Author:
                            <a class="text-blue-400" href="#">{{$post->user->name}}</a>
                        </p>
                        {{-- @include(__post-controls) --}}
                    </div>
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 mb-4 w-full">
                    <div class="comments p-2">
                        @foreach ($comments as $comment)
                        <div class="mb-6">
                            <div class="flex justify-end text-xs">
                                <a
                                    class="mr-2 text-blue-400 hover:text-blue-500"
                            href="{{$comment->path('edit', $post)}}"
                                >Edit</a>
                                <a
                                    class="text-red-400"
                                    href="#"
                                    onclick="event.preventDefault();document.querySelector('#deleteComment').submit()"
                                >Delete</a>
                            <form id="deleteComment" class="hidden" action="{{$comment->path('destroy',$post)}}" method="POST">
                                    @method('DELETE')
                                    @csrf
                                </form>
                            </div>
                            <p class="mb-2">
                                {{ $comment->body }}
                            </p>
                            <p class="text-xs text-gray-700">Commented By: {{$comment->user->name}}</p>
                        </div>
                        @endforeach

                    </div>
                    <form action="{{route('post.comments.store', $post)}}" method="POST">
                        @csrf
                        <div class="mb-6">
                            <textarea id="textarea1" class="w-full border px-4 py-2 rounded outline-none
                      text-gray-700 @error('body') border-red-500 @enderror
                      focus:border-blue-500 focus:shadow-outline" rows="5" name="body"
                                placeholder="Comment something..."></textarea>
                            @error('body')
                            <span class="text-xs text-red-400 mt-1 italic">
                                {{$message}}
                            </span>
                            @enderror
                        </div>
                        <div class="mb-6">
                            <button class="mb-2 px-4 py-2 rounded text-white bg-blue-500
                            focus:outline-none hover:bg-blue-400">Comment
                            </button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>