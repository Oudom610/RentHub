@extends('layout.dashboard-parent-landlord')

@section('content')

    @parent <!-- Retain master layout content -->

    <!-- Main Content Area -->
    <main class="ease-soft-in-out xl:ml-68.5 relative h-full max-h-screen rounded-xl transition-all duration-200 p-4 sm:p-6 lg:p-8">
        <!-- Form Container -->
        <div class="max-w-3xl mx-auto bg-white rounded-lg shadow-md p-6 lg:p-8">
            <!-- Form Title -->
            <h2 class="text-2xl font-semibold text-gray-800 mb-6">Add Rent Payment</h2>
            
            <!-- Success Message -->
            @if (session('success'))
                <div id="flash-message" style="background-color: #d4edda; border-color: #c3e6cb; color: #155724; padding: 0.75rem; border-width: 1px; border-style: solid; border-radius: 0.375rem;" role="alert">
                    {{ session('success') }}
                </div>
            @endif

            {{-- Error message --}}
            @if ($errors->any())
                <div id="flash-message" style="background-color: #fed7d7; border-color: #f5a094; color: #c53030; padding: 0.75rem; border-width: 1px; border-style: solid; border-radius: 0.375rem;" role="alert">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            
            <form class="w-full max-w-lg" id="rentPaymentForm" method="POST" action="{{ route('rent.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="flex flex-wrap -mx-3 mb-6">
                    <div class="w-full md:w-1/2 px-3 mb-6 md:mb-3">
                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                            Tenant
                        </label>
                        <select name="tenant_name" id="tenant_name" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" required>
                            <option value="">Select a tenant</option>
                            @foreach ($tenantsWithActiveLeases as $tenant)
                                <option value="{{ $tenant->tenant_name }}">{{ $tenant->tenant_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    
                    <div class="w-full md:w-1/2 px-3 mb-6 md:mb-3">
                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                            Rent Due Date
                        </label>
                        <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" name="payment_date" type="date" placeholder="Select due date" required>
                    </div>
                    <div class="w-full md:w-1/2 px-3 mb-6 md:mb-3">
                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                            Amount ($)
                        </label>
                        <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" name="amount" type="number" step="0.01" placeholder="Enter amount" required>
                    </div>
                </div>
                <div class="w-full px-3 mb-6 md:mb-0">
                    <!-- Submit button -->
                    <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit" style="background-color: #3f87e5;">
                        Add Rent Payment
                    </button>
                    <!-- Cancel button -->
                    <button class="bg-gray-500 hover:bg-gray-700 text-black font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline ml-2" type="button" onclick="clearForm('rentPaymentForm')">
                        Cancel
                    </button>
                </div>
            </form>
        </div>
        <script>
            // Hide the flash message after 2 seconds
            setTimeout(function() {
                var flashMessage = document.getElementById('flash-message');
                if (flashMessage) {
                    flashMessage.style.display = 'none';
                }
            }, 2000); // 2000 milliseconds = 2 seconds
        </script>
    </main>
    <!-- End Main Content Area -->

@endsection
