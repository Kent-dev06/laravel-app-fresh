<x-layout>
<div class="min-h-screen bg-gray-100 flex items-center justify-center p-6">
    <div class="w-full max-w-3xl bg-white rounded-2xl shadow-lg border border-gray-200">

        <!-- HEADER -->
        <div class="bg-indigo-600 px-6 py-5 rounded-t-2xl">
            <h2 class="text-xl font-semibold text-white">Edit Profile</h2>
            <p class="text-indigo-100 text-sm">
                Update details for <span class="font-medium">{{ $user->first_name }}</span>
            </p>
        </div>

        <!-- FORM -->
        <form action="/user_registration/{{ $user->id }}" method="POST" class="p-6 space-y-6">
            @csrf
            @method("PATCH")

            @php
                $inputStyle = "w-full px-4 py-2 border border-gray-300 rounded-lg bg-white text-gray-900 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none";
            @endphp

            <!-- NAME -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                <div>
                    <label class="text-sm text-gray-600">First Name</label>
                    <input type="text" name="first_name" value="{{ $user->first_name }}" required class="{{ $inputStyle }}">
                </div>

                <div>
                    <label class="text-sm text-gray-600">Last Name</label>
                    <input type="text" name="last_name" value="{{ $user->last_name }}" required class="{{ $inputStyle }}">
                </div>

                <div>
                    <label class="text-sm text-gray-600">Middle Name</label>
                    <input type="text" name="middle_name" value="{{ $user->middle_name }}" class="{{ $inputStyle }}">
                </div>

                <div>
                    <label class="text-sm text-gray-600">Nickname</label>
                    <input type="text" name="nickname" value="{{ $user->nickname }}" class="{{ $inputStyle }}">
                </div>
            </div>

            <!-- CONTACT -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
                <div class="md:col-span-2">
                    <label class="text-sm text-gray-600">Email</label>
                    <input type="email" name="email" value="{{ $user->email }}" required class="{{ $inputStyle }}">
                </div>

                <div>
                    <label class="text-sm text-gray-600">Age</label>
                    <input type="number" name="age" value="{{ $user->age }}" required class="{{ $inputStyle }}">
                </div>
            </div>

            <div>
                <label class="text-sm text-gray-600">Contact Number</label>
                <input type="text" name="contact_number" value="{{ $user->contact_number }}" required class="{{ $inputStyle }}">
            </div>

            <div>
                <label class="text-sm text-gray-600">Address</label>
                <input type="text" name="address" value="{{ $user->address }}" required class="{{ $inputStyle }}">
            </div>

            <!-- ACTIONS -->
            <div class="flex justify-between items-center pt-4">
                <a href="/user_registration" class="text-sm text-gray-500 hover:text-gray-700">
                    Cancel
                </a>

                <button type="submit"
                    class="px-6 py-2.5 bg-indigo-600 text-white rounded-lg font-medium hover:bg-indigo-700 active:scale-95 transition shadow">
                    Update Profile
                </button>
            </div>
        </form>

    </div>
</div>
</x-layout>