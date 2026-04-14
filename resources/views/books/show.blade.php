<x-layout title="{{ $book->title }} | Book Management">
    <div class="max-w-3xl mx-auto mt-12 px-4 pb-20">

        <div class="flex items-center gap-4 mb-8">
            <a href="{{ route('books.index') }}"
               class="p-2 text-blue-300 hover:bg-white/10 rounded-xl transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
            </a>
            <div>
                <h1 class="text-3xl font-black text-white tracking-tight">{{ $book->title }}</h1>
                <p class="text-blue-200/60 text-sm mt-1">by {{ $book->author }}</p>
            </div>
        </div>

        <div class="bg-white/5 border border-white/10 backdrop-blur-md rounded-3xl shadow-2xl overflow-hidden">

            {{-- Cover + Key Info --}}
            <div class="flex flex-col sm:flex-row gap-6 p-8 border-b border-white/10">
                <div class="w-28 h-36 flex-shrink-0 rounded-xl overflow-hidden bg-white/5 border border-white/10 flex items-center justify-center">
                    @if($book->cover_image)
                        <img src="{{ asset('storage/' . $book->cover_image) }}" class="w-full h-full object-cover" alt="Cover">
                    @else
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-slate-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                        </svg>
                    @endif
                </div>
                <div class="flex-1 space-y-3">
                    <div class="flex flex-wrap gap-2">
                        <span class="bg-blue-400/10 text-blue-300 px-3 py-1 rounded-full text-xs border border-blue-400/20 font-medium">{{ $book->genre }}</span>
                        @if($book->is_available)
                            <span class="bg-green-500/10 text-green-400 px-3 py-1 rounded-full text-xs border border-green-500/20 font-medium">Available</span>
                        @else
                            <span class="bg-red-500/10 text-red-400 px-3 py-1 rounded-full text-xs border border-red-500/20 font-medium">Unavailable</span>
                        @endif
                    </div>
                    <p class="text-4xl font-black text-white font-mono">₱{{ number_format($book->price, 2) }}</p>
                    <p class="text-slate-400 text-sm leading-relaxed">{{ $book->description }}</p>
                </div>
            </div>

            {{-- Details Grid --}}
            <div class="grid grid-cols-2 md:grid-cols-3 divide-x divide-y divide-white/10">
                @foreach([
                    ['label' => 'ISBN', 'value' => $book->isbn],
                    ['label' => 'Publisher', 'value' => $book->publisher],
                    ['label' => 'Language', 'value' => $book->language],
                    ['label' => 'Year Published', 'value' => $book->published_year],
                    ['label' => 'Pages', 'value' => number_format($book->pages)],
                ] as $detail)
                    <div class="px-6 py-5">
                        <p class="text-xs text-slate-500 uppercase tracking-widest font-bold mb-1">{{ $detail['label'] }}</p>
                        <p class="text-white font-semibold text-sm">{{ $detail['value'] }}</p>
                    </div>
                @endforeach
            </div>

            {{-- Actions --}}
            <div class="px-8 py-5 bg-white/[0.02] border-t border-white/10 flex justify-end gap-3">
                <a href="{{ route('books.edit', $book) }}"
                   class="flex items-center gap-2 bg-amber-500/20 hover:bg-amber-500/30 text-amber-300 px-5 py-2.5 rounded-xl font-bold text-sm transition-all border border-amber-500/20">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                    </svg>
                    Edit
                </a>
                <form action="{{ route('books.destroy', $book) }}" method="POST" class="inline"
                      onsubmit="return confirm('Delete this book permanently?')">
                    @csrf @method('DELETE')
                    <button class="flex items-center gap-2 bg-red-500/20 hover:bg-red-500/30 text-red-400 px-5 py-2.5 rounded-xl font-bold text-sm transition-all border border-red-500/20">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                        </svg>
                        Delete
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-layout>