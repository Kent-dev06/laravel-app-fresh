<x-layout title="Edit Book | Book Management">
    <style>
        @keyframes gradientFlow {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
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
                            <svg xmlns="http://www.w3.org/2000/svg"
                                 class="h-6 w-6 text-blue-300"
                                 fill="none"
                                 viewBox="0 0 24 24"
                                 stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                            </svg>
                        </div>

                        <div>
                            <h1 class="text-3xl font-extrabold text-white tracking-tight">
                                Edit Book
                            </h1>
                            <p class="text-blue-400/60 text-xs uppercase tracking-widest font-semibold mt-1">
                                {{ $book->title }}
                            </p>
                        </div>

                    </div>
                </div>

                <!-- Form -->
                <div class="px-10 py-8">

                    <form method="POST" action="{{ route('books.update', $book) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <!-- Fields -->
                        <div class="space-y-6">
                            @include('books._form')
                        </div>

                        <!-- Actions -->
                        <div class="mt-10 flex flex-col sm:flex-row justify-between items-center gap-4">

                            <!-- Back -->
                            <a href="{{ route('books.index') }}"
                               class="w-full sm:w-auto text-center px-6 py-3 rounded-2xl bg-blue-900/40 hover:bg-blue-800/50 text-blue-200 text-sm font-semibold transition">
                                ← Back to list
                            </a>

                            <!-- Update -->
                            <button type="submit"
                                    class="w-full sm:w-auto px-8 py-3 rounded-2xl bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-500 hover:to-indigo-500 text-white text-sm font-semibold shadow-lg shadow-blue-900/30 transition-all active:scale-95">
                                Update Book
                            </button>

                        </div>

                    </form>

                </div>
            </div>

        </div>
    </div>
</x-layout>