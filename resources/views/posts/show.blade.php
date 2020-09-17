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
                        <div class="flex justify-between items-center mb-2">
                            <h2 class="text-xl font-semibold">{{ $post->title }}</h2>
                            {{-- move to show --}}
                            @can('update', $post)
                            <a class="text-blue-400 hover:text-blue-500 text-xs" href="{{$post->path('edit')}}">Edit
                            </a>
                            @endcan
                        </div>
                        <p class="text-gray-900 text-sm mb-2">{{ $post->body }}</p>
                        <p class="text-xs text-gray-500 mb-2">Author:
                            <a class="text-blue-400" href="#">{{$post->user->name}}</a>
                        </p>
                        {{-- @include(__post-controls) --}}
                    </div>
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                @foreach ($comments as $comment)
                <div class="p-6 mb-4 w-full">
                    <div class="flex">
                        {{-- @include(__controls) --}}
                        <div class="flex flex-col justify-between h-32 items-center">
                            <div class="thumbs-up w-10 h-10 cursor-pointer p-2 mb-2">
                                <a class="hover:opacity-75" href="#"
                                    onclick="event.preventDefault();document.querySelector('#likeForm-{{$comment->id}}').submit()">
                                    <svg width="30" height="30">
                                        <path
                                            d="M11.0010436,0 C9.89589787,0 9.00000024,0.886706352 9.0000002,1.99810135 L9,8 L1.9973917,8 C0.894262725,8 0,8.88772964 0,10 L0,12 L2.29663334,18.1243554 C2.68509206,19.1602453 3.90195042,20 5.00853025,20 L12.9914698,20 C14.1007504,20 15,19.1125667 15,18.000385 L15,10 L12,3 L12,0 L11.0010436,0 L11.0010436,0 Z M17,10 L20,10 L20,20 L17,20 L17,10 L17,10 Z"
                                            id="Fill-97">
                                        </path>
                                    </svg>
                                </a>
                            </div>
                            <p class="{{ $comment->likes_count < 0 ? 'text-red-400' : 'text-green-400'}}">
                                {{$comment->likes_count ?? 0}}</p>

                            <div class="thumbs-down w-10 h-10 cursor-pointer p-2">
                                <a class="hover:opacity-75" href="#"
                            onclick="event.preventDefault();document.querySelector('#dislikeForm').submit()">
                                    <svg width="30" height="30">
                                        <path
                                            d="M11.0010436,20 C9.89589787,20 9.00000024,19.1132936 9.0000002,18.0018986 L9,12 L1.9973917,12 C0.894262725,12 0,11.1122704 0,10 L0,8 L2.29663334,1.87564456 C2.68509206,0.839754676 3.90195042,8.52651283e-14 5.00853025,8.52651283e-14 L12.9914698,8.52651283e-14 C14.1007504,8.52651283e-14 15,0.88743329 15,1.99961498 L15,10 L12,17 L12,20 L11.0010436,20 L11.0010436,20 Z M17,10 L20,10 L20,0 L17,0 L17,10 L17,10 Z"
                                            id="Fill-97">
                                        </path>
                                    </svg>
                                </a>
                            </div>
                            {{$comment->id}}
                        <form id="likeForm-{{$comment->id}}" action="{{route('comment.like', $comment->id)}}" method="POST"
                                class="hidden">
                                @csrf
                            </form>
                            <form id="dislikeForm" action="{{route('comment.dislike', $comment->id)}}" method="POST"
                                class="hidden">
                                @method('DELETE')
                                @csrf
                            </form>
                        </div>

                        <div class="comments p-2">
                            <div class="mb-6">
                                <div class="flex justify-end text-xs">
                                    @can('update-comment', $comment)
                                    <a class="mr-2 text-blue-400 hover:text-blue-500"
                                        href="{{route('post.comments.edit', [$post->id, $comment->id])}}">Edit</a>
                                    @endcan

                                    @can('delete-comment', $comment)
                                    <a class="text-red-400" href="#"
                                        onclick="event.preventDefault();document.querySelector('#deleteComment').submit()">Delete</a>
                                    <form id="deleteComment" class="hidden"
                                        action="{{route('post.comments.destroy', [$post->id, $comment->id])}}"
                                        method="POST">
                                        @method('DELETE')
                                        @csrf
                                    </form>
                                    @endcan
                                </div>
                                <p class="mb-2">
                                    {{ $comment->body }}
                                </p>
                                <p class="text-xs text-gray-700">Commented By: {{$comment->user->name}}</p>
                            </div>

                        </div>
                    </div>
                </div>
                @endforeach

                <div>

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
    </div>
</x-app-layout>