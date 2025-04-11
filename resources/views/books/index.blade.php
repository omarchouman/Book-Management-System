<x-app-layout>
    <div class="max-w-7xl mx-auto py-10">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold">Books</h1>
            <a href="{{ route('books.create') }}" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                + Add Book
            </a>
        </div>

        <!-- Search -->
        <form method="GET" action="{{ route('books.index') }}" class="mb-4">
            <input type="text" name="search" placeholder="Search..." value="{{ request('search') }}"
                   class="px-4 py-2 border rounded w-full md:w-1/2 focus:outline-none focus:ring focus:border-blue-300" />
        </form>

        @if(session('success'))
            <div class="mb-4 p-4 bg-green-100 text-green-800 rounded">
                {{ session('success') }}
            </div>
        @endif

        <!-- Book List -->
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white border rounded shadow">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-6 py-3 text-left">Title</th>
                        <th class="px-6 py-3 text-left">Author</th>
                        <th class="px-6 py-3 text-left">Status</th>
                        <th class="px-6 py-3 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($books as $book)
                        <tr class="border-t">
                            <td class="px-6 py-4">{{ $book->title }}</td>
                            <td class="px-6 py-4">{{ $book->author }}</td>
                            <td class="px-6 py-4">
                                <span class="{{ $book->is_checked_out ? 'text-red-600' : 'text-green-600' }}">
                                    {{ $book->is_checked_out ? 'Checked Out (Returned)' : 'Checked In (Borrowed)' }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-right space-x-2">
                                @if($book->is_checked_out)
                                    <form action="{{ route('books.checkIn', $book) }}" method="POST" class="inline">
                                        @csrf
                                        <button class="text-blue-600 hover:underline">Check In</button>
                                    </form>
                                @else
                                    <form action="{{ route('books.checkOut', $book) }}" method="POST" class="inline">
                                        @csrf
                                        <button class="text-yellow-600 hover:underline">Check Out</button>
                                    </form>
                                @endif

                                <a href="{{ route('books.edit', $book) }}" class="text-indigo-600 hover:underline">Edit</a>

                                <form action="{{ route('books.destroy', $book) }}" method="POST" class="inline"
                                      onsubmit="return confirm('Are you sure?');">
                                    @csrf @method('DELETE')
                                    <button class="text-red-600 hover:underline">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-6 py-4 text-center text-gray-500">No books found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            {{ $books->links() }}
        </div>
    </div>
</x-app-layout>
