<div class="mb-8">
    <div class="flex flex-col md:flex-row md:items-center md:justify-between">
        <div>
            <h1 class="text-3xl font-bold text-gray-900 tracking-tight">{{ $title }}</h1>
            @if(isset($description))
                <p class="mt-2 text-xl text-gray-600">{{ $description }}</p>
            @endif
        </div>
        {{ $slot }}
    </div>
</div>

