@extends('layout.dashboard-parent-landlord')

@section('content')
    @parent

    <div class="container mx-auto px-4 py-6">
        <h1 class="text-2xl font-bold mb-4">Change Password</h1>

        <!-- Display errors if validation fails -->
        @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative">
                <strong class="font-bold">Errors:</strong>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('profile.change-password.update') }}" method="POST">
            @csrf <!-- CSRF Protection -->

            <div class="mb-4">
                <label for="old_password" class="block text-gray-700">Old Password:</label>
                <input type="password" name="old_password" id="old_password" required class="border p-2 w-full">
            </div>

            <div class="mb-4">
                <label for="new_password" class="block text-gray-700">New Password:</label>
                <input type="password" name="new_password" id="new_password" required class="border p-2 w-full">
            </div>

            <div class="mb-4">
                <label for="new_password_confirmation" class="block text-gray-700">Confirm New Password:</label>
                <input type="password" name="new_password_confirmation" id="new_password_confirmation" required class="border p-2 w-full">
            </div>
            
            <button type="submit" style="background-color: #3b82f6; color: white; padding: 0.5rem 1rem; border-radius: 0.375rem; "">
               <b>Change Password</b> 
            </button>

            
            
        </form>
    </div>
@endsection
