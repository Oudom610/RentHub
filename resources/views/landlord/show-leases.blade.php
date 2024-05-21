@extends('layout.dashboard-parent-landlord')

@section('content')
    @parent <!-- Retain master layout content -->
    <main class="ease-soft-in-out xl:ml-68.5 relative h-full max-h-screen rounded-xl transition-all duration-200 p-4 sm:p-6 lg:p-8">
        <!-- Check for success message -->
        @if (session('success'))
            <div id="flash-message" class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                <strong class="font-bold">Success!</strong>
                <span class="block sm:inline">{{ session('success') }}</span>
                <span class="absolute top-0 bottom-0 right-0 px-4 py-3 cursor-pointer" onclick="document.getElementById('flash-message').style.display='none';">
                    <svg class="fill-current h-6 w-6 text-green-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                        <title>Close</title>
                        <path d="M14.348 5.652a.5.5 0 010 .707L10.707 10l3.641 3.641a.5.5 0 01-.707.707L10 10.707l-3.641 3.641a.5.5 0 01-.707-.707L9.293 10 5.652 6.359a.5.5 0 01.707-.707L10 9.293l3.641-3.641a.5.5 0 01.707 0z"/>
                    </svg>
                </span>
            </div>
        @endif
        <table class=" min-w-full divide-y divide-gray-200">
            <thead>
                <tr>
                    <th class="px-6 py-3 bg-gray-50 text-xs text-center font-medium text-gray-500 uppercase tracking-wider">
                        Tenant Name
                    </th>
                    <th class="px-6 py-3 bg-gray-50 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Room Number
                    </th>
                    <th class="px-6 py-3 bg-gray-50 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Start Date
                    </th>
                    <th class="px-6 py-3 bg-gray-50 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                        End Date
                    </th>
                    <th class="px-6 py-3 bg-gray-50 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Lease Agreement
                    </th>
                    <th class="px-6 py-3 bg-gray-50 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Actions
                    </th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse ($leases as $lease)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                            {{ $lease->tenant->tenant_name }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-center text-sm text-gray-900">
                            {{ $lease->room_number }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-center text-sm text-gray-900">
                            {{ $lease->start_date }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-center text-sm text-gray-900">
                            {{ $lease->end_date }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-center text-sm text-gray-900">
                            <a href="{{ asset('storage/' . $lease->lease_agreement) }}" target="_blank">View Lease Agreement</a>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-center text-sm text-gray-900">
                            {{-- <a href="{{ route('leases.show', $lease) }}" class="text-blue-600 hover:text-blue-800">View</a>
                            <span class="mx-2">|</span> --}}
                            <a href="{{ route('leases.edit', $lease) }}" class="text-indigo-600 hover:text-indigo-800">Edit</a>
                            <span class="mx-2">|</span>
                            <form action="{{ route('leases.destroy', $lease) }}" method="POST" class="inline-block" onsubmit="return confirm('Are you sure you want to delete this lease?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-800">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-6 py-4 text-center text-sm text-gray-500">
                            No leases found!
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </main>
@endsection
