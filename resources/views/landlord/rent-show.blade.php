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

        <!-- Pending Payments -->
        <h2 class="text-2xl font-semibold text-gray-800 mb-6">Pending Payments</h2>
        <table class="min-w-full divide-y divide-gray-200 mb-10">
            <thead>
                <tr>
                    <th class="px-6 py-3 bg-gray-50 text-xs text-center font-medium text-gray-500 uppercase tracking-wider">
                        Room Number
                    </th>
                    <th class="px-6 py-3 bg-gray-50 text-xs text-center font-medium text-gray-500 uppercase tracking-wider">
                        Tenant Name
                    </th>
                    <th class="px-6 py-3 bg-gray-50 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Rent Due Date
                    </th>
                    <th class="px-6 py-3 bg-gray-50 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Amount ($)
                    </th>
                    <th class="px-6 py-3 bg-gray-50 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Proof of Payment
                    </th>
                    <th class="px-6 py-3 bg-gray-50 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Status
                    </th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse ($pendingPayments as $payment)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-center text-sm text-gray-900">
                            {{ $payment->lease->room_number }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                            {{ $payment->tenant->tenant_name }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-center text-sm text-gray-900">
                            {{ $payment->payment_date }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-center text-sm text-gray-900">
                            {{ $payment->amount }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-center text-sm text-gray-900">
                            @if ($payment->proof_of_payment)
                                <a href="{{ asset('storage/' . $payment->proof_of_payment) }}" target="_blank">Click Here to View Payment Proof</a>
                            @else
                                N/A
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-center text-sm text-gray-900">
                            <form action="{{ route('rent.updateStatus', $payment) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <select name="status" class="block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-2 px-4" required>
                                    <option value="pending" {{ $payment->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                    <option value="approved" {{ $payment->status == 'approved' ? 'selected' : '' }}>Approved</option>
                                    <option value="declined" {{ $payment->status == 'declined' ? 'selected' : '' }}>Declined</option>
                                </select>
                                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mt-2" style="background-color: #3f87e5;">Update Status</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-6 py-4 text-center text-sm text-gray-500">
                            No pending payments found!
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <!-- Approved Payments -->
        <h2 class="text-2xl font-semibold text-gray-800 mb-6">Approved Payments</h2>
        <table class="min-w-full divide-y divide-gray-200 mb-10">
            <thead>
                <tr>
                    <th class="px-6 py-3 bg-gray-50 text-xs text-center font-medium text-gray-500 uppercase tracking-wider">
                        Room Number
                    </th>
                    <th class="px-6 py-3 bg-gray-50 text-xs text-center font-medium text-gray-500 uppercase tracking-wider">
                        Tenant Name
                    </th>
                    <th class="px-6 py-3 bg-gray-50 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Rent Due Date
                    </th>
                    <th class="px-6 py-3 bg-gray-50 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Amount ($)
                    </th>
                    <th class="px-6 py-3 bg-gray-50 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Proof of Payment
                    </th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse ($approvedPayments as $payment)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-center text-sm text-gray-900">
                            {{ $payment->lease->room_number }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                            {{ $payment->tenant->tenant_name }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-center text-sm text-gray-900">
                            {{ $payment->payment_date }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-center text-sm text-gray-900">
                            {{ $payment->amount }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-center text-sm text-gray-900">
                            @if ($payment->proof_of_payment)
                                <a href="{{ asset('storage/' . $payment->proof_of_payment) }}" target="_blank">Click Here to View Payment Proof</a>
                            @else
                                N/A
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-6 py-4 text-center text-sm text-gray-500">
                            No approved payments found!
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <!-- Declined Payments -->
        <h2 class="text-2xl font-semibold text-gray-800 mb-6">Declined Payments</h2>
        <table class="min-w-full divide-y divide-gray-200 mb-10">
            <thead>
                <tr>
                    <th class="px-6 py-3 bg-gray-50 text-xs text-center font-medium text-gray-500 uppercase tracking-wider">
                        Room Number
                    </th>
                    <th class="px-6 py-3 bg-gray-50 text-xs text-center font-medium text-gray-500 uppercase tracking-wider">
                        Tenant Name
                    </th>
                    <th class="px-6 py-3 bg-gray-50 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Rent Due Date
                    </th>
                    <th class="px-6 py-3 bg-gray-50 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Amount ($)
                    </th>
                    <th class="px-6 py-3 bg-gray-50 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Proof of Payment
                    </th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse ($declinedPayments as $payment)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-center text-sm text-gray-900">
                            {{ $payment->lease->room_number }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                            {{ $payment->tenant->tenant_name }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-center text-sm text-gray-900">
                            {{ $payment->payment_date }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-center text-sm text-gray-900">
                            {{ $payment->amount }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-center text-sm text-gray-900">
                            @if ($payment->proof_of_payment)
                                <a href="{{ asset('storage/' . $payment->proof_of_payment) }}" target="_blank">Click Here to View Payment Proof</a>
                            @else
                                N/A
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-6 py-4 text-center text-sm text-gray-500">
                            No declined payments found!
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </main>
@endsection
