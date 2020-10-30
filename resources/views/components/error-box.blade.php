@if ($errors->any())
  <div class="mb-4 border-l-4 border-red-500 text-red-900 bg-red-100 rounded px-4 py-3">
    <div class="flex items-start">
      <div class="py-1">
        <svg class="fill-current h-6 w-6 mr-4 text-red-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
          <path d="M0 10a10 10 0 1 1 20 0 10 10 0 0 1-20 0zm16.32-4.9L5.09 16.31A8 8 0 0 0 16.32 5.09zm-1.41-1.42A8 8 0 0 0 3.68 14.91L14.91 3.68z" />
        </svg>
      </div>

      <div>
        <h3 class="font-semibold">Error Message</h3>
        @foreach ($errors->all() as $message)
        <li class="text-sm text-red-700">
          {{ $message }}
        </li>
        @endforeach
      </div>
    </div>
</div>
@endif

 @if (session()->has('success'))
<!-- Success -->
  <div class="mb-4 border-l-4 border-teal-500 text-teal-900 bg-teal-100 rounded px-4 py-3">
    <div class="flex items-start">
      <div class="py-1">
        <svg class="fill-current h-6 w-6 mr-4 text-teal-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
          <path d="M2.93 17.07A10 10 0 1 1 17.07 2.93 10 10 0 0 1 2.93 17.07zm12.73-1.41A8 8 0 1 0 4.34 4.34a8 8 0 0 0 11.32 11.32zM6.7 9.29L9 11.6l4.3-4.3 1.4 1.42L9 14.4l-3.7-3.7 1.4-1.42z" />
        </svg>
      </div>

      <div>
        <h3 class="font-semibold">Success Message</h3>

        <p class="text-sm text-teal-700">
        {{ session('success')}}
        </p>
      </div>
    </div>
  </div>
@endif