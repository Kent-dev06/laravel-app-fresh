<x-layout>
<div class="min-h-screen bg-gray-100 py-10 px-4">
    <div class="max-w-7xl mx-auto space-y-8">

        <!-- HEADER -->
        <div>
            <h1 class="text-2xl font-bold text-gray-800">User Management</h1>
            <p class="text-sm text-gray-500">Register and manage users easily.</p>
        </div>

        <!-- FORM -->
        <div class="bg-white rounded-2xl shadow-lg border border-gray-200">
            <div class="px-6 py-4 border-b bg-gray-50 rounded-t-2xl">
                <h2 class="font-semibold text-gray-700">Add New User</h2>
            </div>

            <form action="/user_registration" method="POST" class="p-6 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @csrf

                <!-- INPUT TEMPLATE -->
                @php
                    $inputStyle = "w-full px-4 py-2 border border-gray-300 rounded-lg bg-white text-gray-900 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none";
                @endphp

                <div>
                    <label class="text-sm text-gray-600">First Name</label>
                    <input type="text" name="first_name" required class="{{ $inputStyle }}">
                </div>

                <div>
                    <label class="text-sm text-gray-600">Last Name</label>
                    <input type="text" name="last_name" required class="{{ $inputStyle }}">
                </div>

                <div>
                    <label class="text-sm text-gray-600">Middle Name</label>
                    <input type="text" name="middle_name" class="{{ $inputStyle }}">
                </div>

                <div>
                    <label class="text-sm text-gray-600">Nickname</label>
                    <input type="text" name="nickname" class="{{ $inputStyle }}">
                </div>

                <div class="md:col-span-2">
                    <label class="text-sm text-gray-600">Email</label>
                    <input type="email" name="email" required class="{{ $inputStyle }}">
                    @error('email')
                        <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="text-sm text-gray-600">Age</label>
                    <input type="number" name="age" required class="{{ $inputStyle }}">
                </div>

                <div>
                    <label class="text-sm text-gray-600">Contact</label>
                    <input type="text" name="contact_number" required class="{{ $inputStyle }}">
                </div>

                <div class="md:col-span-full">
                    <label class="text-sm text-gray-600">Address</label>
                    <input type="text" name="address" required class="{{ $inputStyle }}">
                </div>

                <div class="md:col-span-full flex justify-end">
                    <button type="submit"
                        class="px-6 py-2.5 bg-indigo-600 text-white rounded-lg font-medium hover:bg-indigo-700 active:scale-95 transition shadow">
                        Save User
                    </button>
                </div>
            </form>
        </div>

        <!-- TABLE -->
        <div class="bg-white rounded-2xl shadow-lg border border-gray-200">
            <div class="px-6 py-4 border-b flex justify-between items-center bg-gray-50 rounded-t-2xl">
                <h2 class="font-semibold text-gray-700">Users List</h2>
                <span class="text-xs bg-indigo-100 text-indigo-700 px-3 py-1 rounded-full">
                    {{ count($users) }} users
                </span>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead class="bg-gray-100 text-gray-600 uppercase text-xs">
                        <tr>
                            <th class="px-6 py-3 text-left">ID</th>
                            <th class="px-6 py-3 text-left">Name</th>
                            <th class="px-6 py-3 text-left">Email</th>
                            <th class="px-6 py-3 text-left">Age</th>
                            <th class="px-6 py-3 text-center">Actions</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y">
                        @forelse ($users as $user)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 text-gray-400">#{{ $user->id }}</td>

                            <td class="px-6 py-4">
                                <div class="font-medium text-gray-800">
                                    {{ $user->first_name }} {{ $user->last_name }}
                                </div>
                                <div class="text-xs text-gray-400">
                                    {{ $user->middle_name }}
                                </div>
                            </td>

                            <td class="px-6 py-4 text-indigo-600">
                                {{ $user->email }}
                            </td>

                            <td class="px-6 py-4">
                                <span class="bg-indigo-100 text-indigo-700 px-2 py-1 rounded text-xs">
                                    {{ $user->age }}
                                </span>
                            </td>

                            <td class="px-6 py-4 text-center space-x-3">
                                <a href="/user_registration/{{ $user->id }}/edit"
                                   class="text-indigo-600 hover:underline">
                                   Edit
                                </a>

                                <form action="/user_registration/{{ $user->id }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button class="text-red-500 hover:underline"
                                        onclick="return confirm('Delete this user?')">
                                        Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center py-10 text-gray-400">
                                No users yet.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>

                </table>
            </div>
        </div>

    </div>
</div>
</x-layout>