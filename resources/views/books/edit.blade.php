<x-app-layout>
    <div class="max-w-2xl mx-auto py-10">
        <h1 class="text-xl font-bold mb-6">Edit Book</h1>

        <form action="{{ route('books.update', $book) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')

            <div>
                <label class="block text-sm font-medium text-gray-700">Title</label>
                <input type="text" name="title" value="{{ old('title', $book->title) }}"
                       class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required />
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Author</label>
                <input type="text" name="author" value="{{ old('author', $book->author) }}"
                       class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required />
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Description</label>
                <textarea name="description" rows="4" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">{{ old('description', $book->description) }}</textarea>
                <small class="text-gray-500">Leave blank to auto-generate with AI ✨</small>
            </div>

            <div class="mb-4">
                <label for="tags" class="block font-medium text-sm text-gray-700">Tags (optional)</label>
                <input type="text" name="tags" id="tags"
                       class="form-input rounded-md shadow-sm mt-1 block w-full"
                       placeholder="e.g. fantasy, sci-fi, psychology"
                       value="{{ old('tags', is_array($book->tags) ? implode(', ', $book->tags) : $book->tags) }}"
                />
            </div>

            <div class="flex justify-end">
                <a href="{{ route('books.index') }}" class="text-gray-500 hover:underline mr-4 py-2">Cancel</a>
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                    Update Book
                </button>
            </div>
        </form>
    </div>
</x-app-layout>
