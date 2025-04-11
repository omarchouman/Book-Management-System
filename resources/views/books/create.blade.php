<x-app-layout>
    <div class="max-w-2xl mx-auto py-10">
        <h1 class="text-xl font-bold mb-6">Add a New Book</h1>

        <form action="{{ route('books.store') }}" method="POST" class="space-y-6">
            @csrf

            <div>
                <label class="block text-sm font-medium text-gray-700">Title</label>
                <input type="text" name="title" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required />
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Author</label>
                <input type="text" name="author" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required />
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Description</label>
                <textarea name="description" rows="4" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"></textarea>
            </div>

            <div class="flex justify-end">
                <a href="{{ route('books.index') }}" class="text-gray-500 hover:underline mr-4 py-2">Cancel</a>
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                    Save Book
                </button>
            </div>
        </form>
    </div>
</x-app-layout>
