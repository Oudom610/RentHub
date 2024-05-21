@extends('layout.dashboard-parent-tenant')

@section('content')
    @parent <!-- Retain master layout content -->

    <main class="ease-soft-in-out xl:ml-68.5 relative h-full max-h-screen rounded-xl transition-all duration-200 p-4 sm:p-6 lg:p-8">
        <div class="max-w-3xl mx-auto bg-white rounded-lg shadow-md p-6 lg:p-8">
            <h2 class="text-2xl font-semibold text-gray-800 mb-6">Your Rent Payment</h2>
            
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
            
            <table class="min-w-full divide-y divide-gray-200">
                <thead>
                    <tr>
                        {{-- <th class="px-6 py-3 bg-gray-50 text-xs font-medium text-gray-500 uppercase tracking-wider text-center">Landlord Name</th>
                        <th class="px-6 py-3 bg-gray-50 text-xs font-medium text-gray-500 uppercase tracking-wider text-center">Room Number</th> --}}
                        <th class="px-6 py-3 bg-gray-50 text-xs font-medium text-gray-500 uppercase tracking-wider text-center">Rent Due Date</th>
                        <th class="px-6 py-3 bg-gray-50 text-xs font-medium text-gray-500 uppercase tracking-wider text-center">Amount ($)</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse ($rentPayments as $payment)
                        <tr>
                            {{-- <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 text-center">{{ $payment->landlord->landlord_name }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 text-center">{{ $payment->lease->room_number }}</td> --}}
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 text-center">{{ $payment->payment_date }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 text-center">{{ $payment->amount }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-6 py-4 text-center text-sm text-gray-500">You have no rent payments!</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </main>
@endsection
