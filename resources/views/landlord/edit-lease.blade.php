@extends('layout.dashboard-parent-landlord')

@section('content')
    @parent <!-- Retain master layout content -->
    <main class="ease-soft-in-out xl:ml-68.5 relative h-full max-h-screen rounded-xl transition-all duration-200 p-4 sm:p-6 lg:p-8">
        <div class="max-w-3xl mx-auto bg-white rounded-lg shadow-md p-6 lg:p-8">
            <h2 class="text-2xl font-semibold text-gray-800 mb-6">Edit Lease</h2>
            
            @if ($errors->any())
                <div style="background-color: #fed7d7; border-color: #f5a094; color: #c53030; padding: 0.75rem; border-width: 1px; border-style: solid; border-radius: 0.375rem;" role="alert">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            
            <form class="w-full max-w-lg" method="POST" action="{{ route('leases.update', $lease) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="flex flex-wrap -mx-3 mb-6">
                    <div class="w-full md:w-1/2 px-3 mb-6 md:mb-3">
                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                            Tenant
                        </label>
                        <input type="text" class="form-input rounded-md shadow-sm mt-1 block w-full" value="{{ $lease->tenant->tenant_name }}" readonly>
                    </div>
                    <div class="w-full md:w-1/2 px-3 mb-6 md:mb-3">
                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                            Room Number
                        </label>
                        <input type="number" class="form-input rounded-md shadow-sm mt-1 block w-full" name="room_number" value="{{ $lease->room_number }}" required>
                    </div>
                    <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                            Start Date
                        </label>
                        <input type="date" class="form-input rounded-md shadow-sm mt-1 block w-full" name="start_date" value="{{ $lease->start_date }}" required>
                    </div>
                    <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                            End Date
                        </label>
                        <input type="date" class="form-input rounded-md shadow-sm mt-1 block w-full" name="end_date" value="{{ $lease->end_date }}" required>
                    </div>
                    <div class="w-full px-3 mb-6 md:mb-0">
                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                            Lease Agreement (PDF)
                        </label>
                        <input type="file" class="form-input rounded-md shadow-sm mt-1 block w-full" name="lease_agreement">
                    </div>
                </div>
                <div class="w-full px-3 mb-6 md:mb-0">
                    <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit" style="background-color: #3f87e5;">
                        Update Lease
                    </button>
                    <a href="/leases" class="bg-gray-500 hover:bg-gray-700 text-black font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline ml-2">Cancel</a>
                </div>
            </form>
        </div>
    </main>
@endsection
