<x-master-layout>

    <x-slot name="title">
        Upload Image
    </x-slot>

    <x-card>

        <x-slot name="title">
            Upload Image
        </x-slot>

        <!-- Validation Errors -->
        <x-validation-errors :errors="$errors" />

        <form method="POST" action="{{ route('image.store') }}" enctype="multipart/form-data">
        @csrf

            <!-- Title -->
            <div>
                <x-label for="title" :value="'Title'" />

                <x-input id="title" class="block mt-1 w-full" type="text" name="title" :value="old('title')" required autofocus />
            </div>


            <!-- Alt -->
            <div class="mt-4">
                <x-label for="alt" :value="'Alt'" />

                <x-input id="alt" class="block mt-1 w-full" type="text" name="alt" :value="old('alt')" required />
            </div>

            <!-- Image -->
            <div class="mt-4">
                <x-label :value="'Upload Image'" />

                <div class="flex text-sm mt-1 items-center border rounded-md shadow-sm border-gray-300 focus:border-purple-300 focus:ring focus:ring-purple-200 focus:ring-opacity-50">
                    <label for="image" class="relative cursor-pointer bg-purple-100 p-2 rounded-md font-medium text-indigo-600 hover:text-indigo-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-indigo-500">
                        <span>Upload a file</span>
                        <input id="image" name="image" type="file" class="sr-only"
                               onchange="document.getElementById('file-chosen').textContent = this.files[0].name;" required>
                    </label>
                    <p class="pl-1 text-sm text-gray-400" id="file-chosen">No file chosen</p>
                </div>

                <p class="mt-2 text-xs text-gray-500">
                    PNG, JPG, GIF up to 2MB
                </p>

                <div class="flex items-center justify-end mt-4">
                    <x-button>
                        Upload
                    </x-button>
                </div>
            </div>

        </form>

    </x-card>


</x-master-layout>
