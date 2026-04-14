<x-layout title="Add Book | Book Management">
    <style>
        @keyframes gradientFlow {
            0% {
                background-position: 0% 50%;
            }

            50% {
                background-position: 100% 50%;
            }

            100% {
                background-position: 0% 50%;
            }
        }

        .animate-mesh {
            background: linear-gradient(-45deg, #020617, #0f172a, #1e3a8a, #1e293b);
            background-size: 400% 400%;
            animation: gradientFlow 14s ease infinite;
        }

        .glass-card {
            background: rgba(15, 23, 42, 0.65);
            backdrop-filter: blur(18px);
            -webkit-backdrop-filter: blur(18px);
            border: 1px solid rgba(59, 130, 246, 0.15);
        }
    </style>

    <div class="min-h-screen animate-mesh py-16 px-4 sm:px-6 lg:px-8 flex items-start justify-center">
        <div class="w-full max-w-3xl">

            <!-- Card -->
            <div class="glass-card rounded-3xl shadow-2xl shadow-blue-900/40 overflow-hidden">

                <!-- Header -->
                <div class="px-10 pt-10 pb-6 border-b border-blue-800/30">
                    <div class="flex items-center gap-4">

                        <div class="p-3 bg-blue-500/10 rounded-2xl border border-blue-400/20">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-300" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                            </svg>
                        </div>

                        <div>
                            <h1 class="text-3xl font-extrabold text-white tracking-tight">
                                Add New Book
                            </h1>
                            <p class="text-blue-400/60 text-xs uppercase tracking-widest font-semibold mt-1">
                                Book Catalog System
                            </p>
                        </div>

                    </div>
                </div>

                <!-- Form -->
                <div class="px-10 py-8">

                    <form method="POST" action="{{ route('books.store') }}" enctype="multipart/form-data">
                        @csrf

                        @php $book = $book ?? null; @endphp

                        @if ($errors->any())
                            <div
                                class="mb-8 px-5 py-4 rounded-2xl bg-red-500/10 border border-red-500/20 text-red-300 text-sm shadow-inner">
                                <ul class="list-disc list-inside space-y-1">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                            {{-- Title --}}
                            <div>
                                <label
                                    class="block text-xs font-semibold text-blue-300/70 mb-2 ml-1 uppercase tracking-wider">Title
                                    *</label>
                                <input type="text" name="title" value="{{ old('title', $book?->title) }}" required
                                    placeholder="e.g. The Great Gatsby"
                                    class="w-full rounded-2xl bg-blue-950/40 border border-blue-800/40 text-blue-100 px-4 py-3 text-sm placeholder:text-blue-400/30 focus:outline-none focus:ring-2 focus:ring-blue-500/30 focus:border-blue-500 transition" />
                            </div>

                            {{-- Author --}}
                            <div>
                                <label
                                    class="block text-xs font-semibold text-blue-300/70 mb-2 ml-1 uppercase tracking-wider">Author
                                    *</label>
                                <input type="text" name="author" value="{{ old('author', $book?->author) }}"
                                    required placeholder="e.g. F. Scott Fitzgerald"
                                    class="w-full rounded-2xl bg-blue-950/40 border border-blue-800/40 text-blue-100 px-4 py-3 text-sm placeholder:text-blue-400/30 focus:outline-none focus:ring-2 focus:ring-blue-500/30 focus:border-blue-500 transition" />
                            </div>

                            {{-- Description --}}
                            <div class="md:col-span-2">
                                <label
                                    class="block text-xs font-semibold text-blue-300/70 mb-2 ml-1 uppercase tracking-wider">Description
                                    *</label>
                                <textarea name="description" rows="3" required placeholder="Brief summary of the book..."
                                    class="w-full rounded-2xl bg-blue-950/40 border border-blue-800/40 text-blue-100 px-4 py-3 text-sm placeholder:text-blue-400/30 focus:outline-none focus:ring-2 focus:ring-blue-500/30 focus:border-blue-500 transition resize-none">{{ old('description', $book?->description) }}</textarea>
                            </div>

                            {{-- Genre --}}
                            <div>
                                <label
                                    class="block text-xs font-semibold text-blue-300/70 mb-2 ml-1 uppercase tracking-wider">Genre
                                    *</label>
                                <select name="genre" required
                                    class="w-full rounded-2xl bg-blue-950/40 border border-blue-800/40 text-blue-100 px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500/30 focus:border-blue-500 transition">
                                    <option value="">-- Select Genre --</option>
                                    @foreach (['Fiction', 'Non-Fiction', 'Sci-Fi', 'Fantasy', 'Mystery', 'Romance', 'Horror', 'Biography', 'History', 'Other'] as $g)
                                        <option value="{{ $g }}"
                                            {{ old('genre', $book?->genre) == $g ? 'selected' : '' }}>
                                            {{ $g }}</option>
                                    @endforeach
                                </select>
                            </div>

                            {{-- ISBN --}}
                            <div>
                                <label
                                    class="block text-xs font-semibold text-blue-300/70 mb-2 ml-1 uppercase tracking-wider">ISBN
                                    *</label>
                                <input type="text" name="isbn" value="{{ old('isbn', $book?->isbn) }}" required
                                    placeholder="e.g. 978-3-16-148410-0"
                                    class="w-full rounded-2xl bg-blue-950/40 border border-blue-800/40 text-blue-100 px-4 py-3 text-sm placeholder:text-blue-400/30 focus:outline-none focus:ring-2 focus:ring-blue-500/30 focus:border-blue-500 transition" />
                            </div>

                            {{-- Published Year --}}
                            <div>
                                <label
                                    class="block text-xs font-semibold text-blue-300/70 mb-2 ml-1 uppercase tracking-wider">Published
                                    Year *</label>
                                <input type="number" name="published_year"
                                    value="{{ old('published_year', $book?->published_year) }}" required
                                    placeholder="e.g. 2024"
                                    class="w-full rounded-2xl bg-blue-950/40 border border-blue-800/40 text-blue-100 px-4 py-3 text-sm placeholder:text-blue-400/30 focus:outline-none focus:ring-2 focus:ring-blue-500/30 focus:border-blue-500 transition" />
                            </div>

                            {{-- Pages --}}
                            <div>
                                <label
                                    class="block text-xs font-semibold text-blue-300/70 mb-2 ml-1 uppercase tracking-wider">Pages
                                    *</label>
                                <input type="number" name="pages" value="{{ old('pages', $book?->pages) }}" required
                                    placeholder="e.g. 320"
                                    class="w-full rounded-2xl bg-blue-950/40 border border-blue-800/40 text-blue-100 px-4 py-3 text-sm placeholder:text-blue-400/30 focus:outline-none focus:ring-2 focus:ring-blue-500/30 focus:border-blue-500 transition" />
                            </div>

                            {{-- Language --}}
                            <div>
                                <label
                                    class="block text-xs font-semibold text-blue-300/70 mb-2 ml-1 uppercase tracking-wider">Language
                                    *</label>
                                <input type="text" name="language" value="{{ old('language', $book?->language) }}"
                                    required placeholder="e.g. English"
                                    class="w-full rounded-2xl bg-blue-950/40 border border-blue-800/40 text-blue-100 px-4 py-3 text-sm placeholder:text-blue-400/30 focus:outline-none focus:ring-2 focus:ring-blue-500/30 focus:border-blue-500 transition" />
                            </div>

                            {{-- Publisher --}}
                            <div>
                                <label
                                    class="block text-xs font-semibold text-blue-300/70 mb-2 ml-1 uppercase tracking-wider">Publisher
                                    *</label>
                                <input type="text" name="publisher"
                                    value="{{ old('publisher', $book?->publisher) }}" required
                                    placeholder="e.g. Penguin Books"
                                    class="w-full rounded-2xl bg-blue-950/40 border border-blue-800/40 text-blue-100 px-4 py-3 text-sm placeholder:text-blue-400/30 focus:outline-none focus:ring-2 focus:ring-blue-500/30 focus:border-blue-500 transition" />
                            </div>

                            {{-- Price --}}
                            <div>
                                <label
                                    class="block text-xs font-semibold text-blue-300/70 mb-2 ml-1 uppercase tracking-wider">Price
                                    (₱) *</label>
                                <input type="number" step="0.01" name="price"
                                    value="{{ old('price', $book?->price) }}" required placeholder="e.g. 299.99"
                                    class="w-full rounded-2xl bg-blue-950/40 border border-blue-800/40 text-blue-100 px-4 py-3 text-sm placeholder:text-blue-400/30 focus:outline-none focus:ring-2 focus:ring-blue-500/30 focus:border-blue-500 transition" />
                            </div>

                            {{-- Cover Image --}}
                            <div>
                                <label
                                    class="block text-xs font-semibold text-blue-300/70 mb-2 ml-1 uppercase tracking-wider">Cover
                                    Image</label>
                                <input type="file" name="cover_image" accept="image/*"
                                    class="w-full rounded-2xl bg-blue-950/40 border border-blue-800/40 text-blue-300 px-4 py-3 text-sm file:mr-4 file:py-1.5 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-blue-500/20 file:text-blue-300 hover:file:bg-blue-500/30 transition" />

                                @if ($book?->cover_image)
                                    <img src="{{ asset('storage/' . $book->cover_image) }}"
                                        class="mt-4 h-20 rounded-xl border border-blue-800/30 object-cover shadow"
                                        alt="Current cover">
                                @endif
                            </div>

                            {{-- Availability --}}
                            <div class="md:col-span-2 flex items-center gap-3 mt-2">
                                <input type="checkbox" name="is_available" id="is_available"
                                    {{ old('is_available', $book?->is_available ?? true) ? 'checked' : '' }}
                                    class="w-5 h-5 rounded-md bg-blue-900 border-blue-700 text-blue-500 focus:ring-blue-500/30" />

                                <label for="is_available" class="text-sm font-medium text-blue-200 cursor-pointer">
                                    Available for listing
                                </label>
                            </div>

                        </div>

                        <!-- Actions -->
                        <div class="mt-10 flex flex-col sm:flex-row justify-between items-center gap-4">

                            <!-- Back -->
                            <a href="{{ route('books.index') }}"
                                class="w-full sm:w-auto text-center px-6 py-3 rounded-2xl bg-blue-900/40 hover:bg-blue-800/50 text-blue-200 text-sm font-semibold transition">
                                ← Back to list
                            </a>

                            <!-- Submit -->
                            <button type="submit"
                                class="w-full sm:w-auto px-8 py-3 rounded-2xl bg-gradient-to-r from-blue-500 to-indigo-500 hover:from-blue-400 hover:to-indigo-400 text-white text-sm font-semibold shadow-lg shadow-blue-900/30 transition-all active:scale-95">
                                Save Book
                            </button>

                        </div>

                    </form>

                </div>
            </div>

        </div>
    </div>
</x-layout>
