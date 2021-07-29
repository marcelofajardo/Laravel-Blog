<div>
    <button wire:click="follow" class="px-5 py-2 mt-4 text-xs font-semibold
        {{ auth()->user()->following->contains($hero) ? 'bg-blue-500 text-white' : 'text-blue-400 border border-blue-400'}}
        rounded hover:bg-blue-400 hover:text-white">
        {{ auth()->user()->following->contains($hero) ? 'Unfollow' : 'follow' }}
    </button>
</div>
