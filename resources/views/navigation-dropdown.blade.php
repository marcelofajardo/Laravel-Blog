<nav class="bg-white px-4">
    <!-- DESKTOP-->
    <div class="hidden md:flex items-center h-16">
        <!-- Logo -->
        <div class="flex-shrink-0 flex items-end">
            <a href="/">
                <x-jet-application-mark
                    class="block h-9 w-auto" />
            </a>
        </div>
        <!-- MAIN NAV-->
        <div class="flex ml-4 text-gray-600">
            @auth
            <a href="/users/heroes/{{ auth()->user()->hero->id }}"
                class="py-1 px-2 border-b-2 border-transparent
            hover:border-blue-400">
                Hero
            </a>
            @endauth
            <a href="/users" class="py-1 px-2 border-b-2 border-transparent
                    hover:border-blue-400">
                Users
            </a>
            <a href="/posts" class="py-1 px-2 border-b-2 border-transparent
                    hover:border-blue-400">
                posts
            </a>
        </div>
    </div>

    <!-- MOBILE -->
    <div class="md:hidden pt-4">
        <!-- Logo -->
        <div class="flex-shrink-0 flex items-end">
            <a href="/">
                <x-jet-application-mark
                    class="block h-9 w-auto" />
            </a>
        </div>

        <div
            class="flex flex-col mt-4 text-gray-600">
            @auth
            <a href="/users/heroes/{{ auth()->user()->hero->id }}"
                class="py-1 border-b-2 border-transparent
            hover:border-blue-400">
                Hero
            </a>
            @endauth
            <a href="/users" class="py-1 border-b-2 border-transparent
                hover:border-blue-400">
                Users
            </a>
            <a href="/posts" class="py-1 border-b-2 border-transparent
                hover:border-blue-400">
                posts
            </a>
        </div>
    </div>
</nav>