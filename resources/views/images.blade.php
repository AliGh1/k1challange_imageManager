<x-master-layout>
    <div class="flex flex-col max-w-3xl mx-auto my-6 px-4">

        @if (session('status') !== null)
            <div class="font-medium text-sm text-green-600 p-4 w-full bg-green-200 rounded-lg mb-4 shadow-md">
                {{ session('status') }}
            </div>
        @endif

        <div class="mb-4">
            <a href="{{ route('image.create') }}" class="inline-flex items-center px-4 py-2 bg-purple-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-purple-700 active:bg-purple-900 focus:outline-none focus:border-purple-900 focus:ring ring-purple-300 disabled:opacity-25 transition ease-in-out duration-150">
                Upload New Image
            </a>
        </div>


        <div class="overflow-x-auto">
            <div class="align-middle inline-block min-w-full">
                <div class="shadow overflow-hidden border-b border-gray-200 rounded-lg">
                    <table class="min-w-full divide-y divide-gray-200">

                        <thead class="bg-purple-200">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">
                                Image
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">
                                Title
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">
                                Size
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">
                                Dimensions
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">
                                Role
                            </th>
                        </tr>
                        </thead>

                        <tbody class="bg-white divide-y divide-gray-200">

                            @foreach($images as $image)
                                <tr>

                                   <td class="p-4">
                                        <div>
                                            <img src="{{ $image->thumbnail }}" alt="{{ $image->alt }}" class="rounded-lg max-h-16 md:max-h-20">
                                        </div>
                                    </td>

                                    <td class="p-4 whitespace-nowrap text-sm font-medium">
                                        {{ $image->title }}
                                    </td>

                                    <td class="p-4 whitespace-nowrap text-sm font-medium">
                                        {{ $image->size }} kb
                                    </td>

                                    <td class="p-4 whitespace-nowrap text-sm font-medium">
                                        {{ $image->dimensions }}
                                    </td>

                                    <td class="p-4 whitespace-nowrap text-sm font-medium space-x-4">
                                        <a href="{{ route('image.show', compact('image')) }}" class="text-purple-600 hover:text-purple-900">Show</a>

                                        <a href="{{ route('image.edit', compact('image')) }}" class="text-yellow-500 hover:text-yellow-800">Edit</a>

                                        <form method="post" class="inline" action="{{ route('image.destroy', compact('image')) }}">
                                            @csrf
                                            @method('delete')
                                            <button type="submit"  class="text-red-600 hover:text-red-900">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach

                        </tbody>

                    </table>
                </div>
            </div>
        </div>

        <div class="mt-4">
            {{ $images->render() }}
        </div>

    </div>
</x-master-layout>
