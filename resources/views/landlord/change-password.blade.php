{{-- @extends('layout.dashboard-parent-landlord')

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
@endsection --}}

@extends('layout.dashboard-parent-landlord') <!-- Using tenant-specific layout -->

@section('content')
@parent <!-- Retain master layout content -->

<head>
    <style>
        .profile-input {
            display: none;
        }

        .btn-edit {
            background-color: #17a2b8;
            color: white;
            border: none;
        }

        .btn-save {
            background-color: #007bff;
            color: white;
            border: none;
        }

        .btn-cancel {
            background-color: #dc3545;
            color: white;
            border: none;
        }

        .card-header-custom {
            background-color: #007bff;
            color: white;
            padding: 10px;
            font-size: 1.25rem;
            border-bottom: 2px solid #0069d9;
        }

        .card-body-custom {
            background-color: #f8f9fa;
            padding: 20px;
        }

        .btn-space {
            margin-right: 5px;
        }

        .button-container {
            display: none;
        }

        .button-container.active {
            display: inline-flex;
            align-items: center;
        }

        .info-text {
            font-size: 1.1rem;
        }

        .error-message {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 15px;
        }

        .success-message {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 15px;
        }
    </style>
</head>

<!-- Main Content Area -->
<main
    class="ease-soft-in-out xl:ml-68.5 relative h-full max-h-screen rounded-xl transition-all duration-200 p-4 sm:p-6 lg:p-8">
    <div class="container mt-5">
        <div class="card shadow-sm">
            <div class="card-header bg-primary card-header-custom d-flex align-items-center">
                <h2 class="mb-0 text-white"><i class="fas fa-key text-white"></i> Change Password</h2>
            </div>
            <div class="card-body card-body-custom">
                <div class="row">
                    <div class="col-md-8 offset-md-2">

                        <!-- Display errors if validation fails -->
                        @if ($errors->any())
                            <div class="error-message">
                                <strong>Errors:</strong>
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <!-- Display success message -->
                        @if (session('success'))
                            <div class="success-message">
                                {{ session('success') }}
                            </div>
                        @endif

                        <!-- Form for changing password -->
                        <form action="{{ route('profile.change-password.update') }}" method="POST">
                            @csrf <!-- CSRF Protection -->

                            <div class="mb-4">
                                <label for="old_password" class="block text-gray-700">Old Password:</label>
                                <input type="password" name="old_password" id="old_password" required
                                    class="form-control">
                            </div>

                            <div class="mb-4">
                                <label for="new_password" class="block text-gray-700">New Password:</label>
                                <input type="password" name="new_password" id="new_password" required
                                    class="form-control">
                            </div>

                            <div class="mb-4">
                                <label for="new_password_confirmation" class="block text-gray-700">Confirm New
                                    Password:</label>
                                <input type="password" name="new_password_confirmation" id="new_password_confirmation"
                                    required class="form-control">
                            </div>

                            <div class="text-center">
                                <button type="submit" class="btn btn-primary">
                                    <b>Change Password</b>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection