<x-layout title="Books | Book Management">
    <div class="max-w-7xl mx-auto mt-14 px-4 pb-24">

        <!-- Header -->
        <div class="flex flex-col md:flex-row justify-between md:items-center gap-6 mb-10">
            <div>
                <h1 class="text-4xl font-extrabold text-white tracking-tight">
                    Book Management
                </h1>
                <p class="text-blue-300/50 text-sm mt-2">
                    Organize and explore your collection effortlessly.
                </p>
            </div>

            <a href="{{ route('books.create') }}"
                class="inline-flex items-center gap-2 bg-gradient-to-r from-blue-500 to-indigo-500 hover:from-blue-400 hover:to-indigo-400 text-white px-6 py-3 rounded-2xl font-semibold text-sm shadow-xl shadow-blue-900/30 transition-all active:scale-95">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd"
                        d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" />
                </svg>
                Add Book
            </a>
        </div>

        @if (session('success'))
            <div
                class="mb-8 px-5 py-3 rounded-2xl bg-blue-500/10 border border-blue-400/20 text-blue-200 text-sm shadow-inner">
                {{ session('success') }}
            </div>
        @endif

        <div>
            <!-- Filters -->
            <div class="flex flex-col md:flex-row gap-3 mb-8">
                <form method="GET" action="{{ route('books.index') }}" class="flex flex-col md:flex-row gap-3 mb-6">
                    <input type="text" name="search" value="{{ request('search') }}"
                        placeholder="Search by title or author..."
                        class="flex-1 rounded-xl bg-white/5 border border-white/10 text-white px-4 py-2.5 text-sm placeholder:text-slate-500 focus:outline-none focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20 transition-all" />
                    <select name="genre"
                        class="rounded-xl bg-white/5 border border-white/10 text-white px-4 py-2.5 text-sm focus:outline-none focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20 transition-all">
                        <option value="">All Genres</option>
                        @foreach ($genre as $genre)
                            <option value="{{ $genre }}" {{ request('genre') == $genre ? 'selected' : '' }}>
                                {{ $genre }}</option>
                        @endforeach
                    </select>
                    <button type="submit"
                        class="bg-indigo-600 hover:bg-indigo-500 text-white px-6 py-2.5 rounded-xl font-bold text-sm transition-all active:scale-95">
                        Search
                    </button>
                    @if (request('search') || request('genre'))
                        <a href="{{ route('books.index') }}"
                            class="bg-white/10 hover:bg-white/20 text-slate-300 px-4 py-2.5 rounded-xl font-bold text-sm transition-all text-center">
                            Clear
                        </a>
                    @endif
                </form>

                @if (session('success'))
                    <div
                        class="mb-6 px-4 py-3 rounded-xl bg-green-500/10 border border-green-500/20 text-green-300 text-sm font-medium">
                        {{ session('success') }}
                    </div>
                @endif

            </div>

            <!-- Table Container -->
            <div class="space-y-4">
                @forelse($books as $book)
                    <!-- Card Row -->
                    <div
                        class="group bg-gradient-to-br from-blue-950/60 to-blue-900/40 border border-blue-800/30 rounded-2xl p-5 shadow-lg hover:shadow-blue-900/40 transition-all">

                        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">

                            <!-- Left -->
                            <div class="flex items-center gap-4">
                                <div
                                    class="w-12 h-12 rounded-xl bg-blue-500/10 border border-blue-400/20 flex items-center justify-center text-blue-300 font-bold">
                                    {{ substr($book->title, 0, 1) }}
                                </div>

                                <div>
                                    <div class="text-white font-semibold text-lg">
                                        {{ $book->title }}
                                    </div>
                                    <div class="text-blue-300/50 text-sm">
                                        {{ $book->author }}
                                    </div>
                                </div>
                            </div>

                            <!-- Middle Info -->
                            <div class="flex flex-wrap items-center gap-3 text-sm">

                                <span
                                    class="bg-blue-500/10 text-blue-300 px-3 py-1 rounded-full border border-blue-400/20">
                                    {{ $book->genre }}
                                </span>

                                <span class="text-blue-200/70 font-mono">
                                    ₱{{ number_format($book->price, 2) }}
                                </span>

                                <span class="text-blue-300/50">
                                    {{ $book->language }}
                                </span>

                                @if ($book->is_available)
                                    <span
                                        class="bg-blue-400/10 text-blue-300 px-3 py-1 rounded-full border border-blue-400/20">
                                        Available
                                    </span>
                                @else
                                    <span
                                        class="bg-blue-900/40 text-blue-500 px-3 py-1 rounded-full border border-blue-800/30">
                                        Unavailable
                                    </span>
                                @endif
                            </div>

                            <!-- Actions -->
                            <div class="flex items-center gap-2 opacity-0 group-hover:opacity-100 transition">
                                <a href="{{ route('books.show', $book) }}"
                                    class="p-2 rounded-lg bg-blue-500/10 hover:bg-blue-500/20 text-blue-300 transition">
                                    👁
                                </a>

                                <a href="{{ route('books.edit', $book) }}"
                                    class="p-2 rounded-lg bg-indigo-500/10 hover:bg-indigo-500/20 text-indigo-300 transition">
                                    ✏️
                                </a>

                                <form action="{{ route('books.destroy', $book) }}" method="POST"
                                    onsubmit="return confirm('Delete this book permanently?')">
                                    @csrf @method('DELETE')
                                    <button
                                        class="p-2 rounded-lg bg-red-500/10 hover:bg-red-500/20 text-red-400 transition">
                                        🗑
                                    </button>
                                </form>
                            </div>

                        </div>
                    </div>

                @empty
                    <div class="py-20 text-center bg-blue-950/40 border border-blue-800/30 rounded-2xl">
                        <p class="text-blue-300/40 italic">No books found.</p>
                    </div>
                @endforelse
            </div>

            <!-- Pagination -->
            <div class="mt-8">
                {{ $books->links() }}
            </div>
        </div>

    </div>
</x-layout>
