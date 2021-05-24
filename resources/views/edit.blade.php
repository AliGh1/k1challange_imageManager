<x-master-layout>

    <x-slot name="title">
        Edit Image
    </x-slot>

    <x-card>

        <x-slot name="title">
            Edit Image
        </x-slot>

        <!-- Validation Errors -->
        <x-validation-errors :errors="$errors" />

        <form method="POST" action="{{ route('image.update', compact('image')) }}">
        @csrf
        @method('patch')

            <!-- Title -->
            <div>
                <x-label for="title" :value="'Title'" />

                <x-input id="title" class="block mt-1 w-full" type="text" name="title" :value="old('title', $image->title)" required autofocus />
            </div>


            <!-- Alt -->
            <div class="mt-4">
                <x-label for="alt" :value="'Alt'" />

                <x-input id="alt" class="block mt-1 w-full" type="text" name="alt" :value="old('alt', $image->alt)" required />
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-button>
                    Update
                </x-button>
            </div>

        </form>

    </x-card>


</x-master-layout>
