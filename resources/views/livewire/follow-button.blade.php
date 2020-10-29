<div>
    {{-- Stop trying to control. --}}

    <button
    class="px-5 py-2 mt-4 text-xs font-semibold text-blue-400
    border border-blue-400 rounded hover:bg-blue-400 hover:text-white"
   wire:click="follow"
  ">
    {{auth()->user()->following->contains($hero) ? 'Unfollow' : 'follow'}}
</button>
</div>
