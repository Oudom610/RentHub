@extends('layout.dashboard-parent-landlord')

@section('content')
@parent

<main
    class="ease-soft-in-out xl:ml-68.5 relative h-full max-h-screen rounded-xl transition-all duration-200 p-4 sm:p-6 lg:p-8">
    <div class="container mt-5">
        <div class="card shadow-sm">
            <div class="card-header bg-primary card-header-custom d-flex align-items-center">
                <h2 class="mb-0 text-white"><i class="fas fa-key text-white"></i> Change Password</h2>
            </div>
            <div class="card-body card-body-custom">
                <!-- Display errors if validation fails -->
                @if ($errors->any())
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4">
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
                        <input type="password" name="new_password_confirmation" id="new_password_confirmation" required
                            class="border p-2 w-full">
                    </div>

                    <button type="submit"
                        style="background-color: #3b82f6; color: white; padding: 0.5rem 1rem; border-radius: 0.375rem;">
                        <b>Change Password</b>
                    </button>
                </form>
            </div>
        </div>
    </div>
</main>
@endsection