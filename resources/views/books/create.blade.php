<x-app-layout>
    <div class="max-w-2xl mx-auto py-10">
        <h1 class="text-xl font-bold mb-6">Add a New Book</h1>

        <form id="bookForm" action="{{ route('books.store') }}" method="POST" class="space-y-6 relative">
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
                <small class="text-gray-500">Leave blank to auto-generate with AI ✨</small>
            </div>

            <div class="mb-4">
                <label for="tags" class="block font-medium text-sm text-gray-700">Tags</label>
                <input type="text" name="tags" id="tags"
                       class="form-input rounded-md shadow-sm mt-1 block w-full"
                       placeholder="e.g. fantasy, sci-fi, psychology" />
                <small class="text-gray-500">Leave blank to auto-generate with AI ✨</small>
            </div>

            <div class="flex justify-end">
                <a href="{{ route('books.index') }}" class="text-gray-500 hover:underline mr-4 py-2">Cancel</a>
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                    Save Book
                </button>
            </div>

            <div id="loader" class="absolute inset-0 bg-white/80 flex items-center justify-center z-10 rounded-md hidden">
                <svg class="animate-spin h-8 w-8 text-blue-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z"></path>
                </svg>
            </div>
        </form>
    </div>

    <script>
        document.getElementById('bookForm').addEventListener('submit', function() {
            document.getElementById('loader').classList.remove('hidden');
            document.querySelector('button[type="submit"]').disabled = true;
        });
    </script>
</x-app-layout>
