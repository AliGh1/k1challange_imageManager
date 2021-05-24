<x-master-layout>
    <div class="my-6 px-4 max-w-3xl mx-auto">
        <h3 class="font-semibold text-3xl text-purple-800">{{ $image->title }}</h3>
        <img src="{{ $image->image }}" alt="{{ $image->alt }}" class="rounded-lg shadow-lg mt-4 w-full">
    </div>
</x-master-layout>
