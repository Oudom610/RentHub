@extends('layout.dashboard-parent-landlord')

@section('content')

    @parent <!-- Retain master layout content -->

    <!-- Main Content Area -->
    <main class="ease-soft-in-out xl:ml-68.5 relative h-full max-h-screen rounded-xl transition-all duration-200 p-4 sm:p-6 lg:p-8">
    {{-- <main class="p-4 sm:p-6 lg:p-8"> --}}
        <!-- Form Container -->
        <div class="max-w-3xl mx-auto bg-white rounded-lg shadow-md p-6 lg:p-8">
            <!-- Form Title -->
            <h2 class="text-2xl font-semibold text-gray-800 mb-6">Register New Tenant</h2>
            
            @if ($errors->any())
            <div style="background-color: #fed7d7; border-color: #f5a094; color: #c53030; padding: 0.75rem; border-width: 1px; border-style: solid; border-radius: 0.375rem;" role="alert">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
            
            <form class="w-full max-w-lg" id="registrationForm" method="POST" action="{{ route('tenant.register.submit') }}">
                @csrf
                <div class="flex flex-wrap -mx-3 mb-6">
                    <div class="w-full md:w-1/2 px-3 mb-6 md:mb-3">
                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mt-2 mb-2">
                            Name
                        </label>
                        <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-red-500 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" name="tenant_name" type="text" required>
                    </div>
                    <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mt-2 mb-2">
                            Email
                        </label>
                        <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" name="email" type="email" required>
                    </div>
                    <div class="w-full md:w-1/2 px-3 mb-6 md:mb-3">
                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                            Contact Information
                        </label>
                        <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-red-500 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" name="contact_info" type="text" required>
                    </div>
                    <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                            Login Password
                        </label>
                        <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" name="password" type="password" required>
                    </div>

                    <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                        <!-- Submit button -->
                        <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit" style="background-color: #3f87e5;">
                            Submit
                        </button>
                        <!-- Cancel button -->
                        <button class="bg-gray-500 hover:bg-gray-700 text-black font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline ml-2" type="button" onclick="clearForm('registrationForm')">
                            Cancel
                        </button>
                    </div>
                    
                </div>
            </form>  
        </div>
    </main>
    <!-- End Main Content Area -->

@endsection
