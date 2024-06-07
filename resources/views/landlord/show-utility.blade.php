@extends('layout.dashboard-parent-landlord')

@section('content')
    @parent <!-- Retain master layout content -->
    <main class="ease-soft-in-out xl:ml-68.5 relative h-full max-h-screen rounded-xl transition-all duration-200 p-4 sm:p-6 lg:p-8">
        <!-- Check for success message -->
        <!-- Success Message -->
        @if (session('success'))
                <div id="flash-message" style="background-color: #d4edda; border-color: #c3e6cb; color: #155724; padding: 0.75rem; border-width: 1px; border-style: solid; border-radius: 0.375rem;" role="alert">
                    {{ session('success') }}
                </div>
        @endif

        <!-- Pending Payments -->
        <h2 class="text-2xl font-semibold text-gray-800 mb-6">Pending Utility Bills</h2>
        <table class="min-w-full divide-y divide-gray-200 mb-10">
            <thead>
                <tr>
                    <th class="px-6 py-3 bg-gray-50 text-xs text-center font-medium text-gray-500 uppercase tracking-wider">Room Number</th>
                    <th class="px-6 py-3 bg-gray-50 text-xs text-center font-medium text-gray-500 uppercase tracking-wider">Tenant Name</th>
                    <th class="px-6 py-3 bg-gray-50 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Billing Date</th>
                    <th class="px-6 py-3 bg-gray-50 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Total Amount ($)</th>
                    <th class="px-6 py-3 bg-gray-50 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Proof of Meter Readings</th>
                    <th class="px-6 py-3 bg-gray-50 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Proof of Payment</th>
                    <th class="px-6 py-3 bg-gray-50 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse ($pendingPayments as $payment)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-center text-sm text-gray-900">{{ $payment->lease->room_number }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $payment->tenant->tenant_name }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-center text-sm text-gray-900">{{ $payment->billing_date }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-center text-sm text-gray-900">{{ $payment->total_amount }}</td>
                        
                        <td class="px-6 py-4 whitespace-nowrap text-center text-sm text-gray-900">
                            @if ($payment->proof_of_meter_reading)
                                @foreach (json_decode($payment->proof_of_meter_reading) as $proof)
                                    <a href="{{ asset('storage/' . $proof) }}" target="_blank">View</a><br>
                                @endforeach
                            @else
                                N/A
                            @endif
                        </td>

                        <td class="px-6 py-4 whitespace-nowrap text-center text-sm text-gray-900">
                            @if ($payment->proof_of_utility_payment)
                                <a href="{{ asset('storage/' . $payment->proof_of_utility_payment) }}" target="_blank">Click Here to View Payment Proof</a>
                            @else
                                N/A
                            @endif
                        </td>

                        <td class="px-6 py-4 whitespace-nowrap text-center text-sm text-gray-900">
                            <form action="{{ route('utility.updateStatus', $payment) }}" method="POST">
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
                        <td colspan="7" class="px-6 py-4 text-center text-sm text-gray-500">No pending utility bills found!</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <!-- Approved Payments -->
        <h2 class="text-2xl font-semibold text-gray-800 mb-6">Approved Utility Bills</h2>
        <table class="min-w-full divide-y divide-gray-200 mb-10">
            <thead>
                <tr>
                    <th class="px-6 py-3 bg-gray-50 text-xs text-center font-medium text-gray-500 uppercase tracking-wider">Room Number</th>
                    <th class="px-6 py-3 bg-gray-50 text-xs text-center font-medium text-gray-500 uppercase tracking-wider">Tenant Name</th>
                    <th class="px-6 py-3 bg-gray-50 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Billing Date</th>
                    <th class="px-6 py-3 bg-gray-50 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Total Amount ($)</th>
                    <th class="px-6 py-3 bg-gray-50 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Proof of Meter Readings</th>
                    <th class="px-6 py-3 bg-gray-50 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Proof of Payment</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse ($approvedPayments as $payment)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-center text-sm text-gray-900">{{ $payment->lease->room_number }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $payment->tenant->tenant_name }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-center text-sm text-gray-900">{{ $payment->billing_date }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-center text-sm text-gray-900">{{ $payment->total_amount }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-center text-sm text-gray-900">
                            @if ($payment->proof_of_meter_reading)
                                @foreach (json_decode($payment->proof_of_meter_reading) as $proof)
                                    <a href="{{ asset('storage/' . $proof) }}" target="_blank">View</a><br>
                                @endforeach
                            @else
                                N/A
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-center text-sm text-gray-900">
                            @if ($payment->proof_of_utility_payment)
                                <a href="{{ asset('storage/' . $payment->proof_of_utility_payment) }}" target="_blank">Click Here to View Payment Proof</a>
                            @else
                                N/A
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-6 py-4 text-center text-sm text-gray-500">No approved utility bills found!</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <!-- Declined Payments -->
        <h2 class="text-2xl font-semibold text-gray-800 mb-6">Declined Utility Bills</h2>
        <table class="min-w-full divide-y divide-gray -200 mb-10">
            <thead>
                <tr>
                    <th class="px-6 py-3 bg-gray-50 text-xs text-center font-medium text-gray-500 uppercase tracking-wider">Room Number</th>
                    <th class="px-6 py-3 bg-gray-50 text-xs text-center font-medium text-gray-500 uppercase tracking-wider">Tenant Name</th>
                    <th class="px-6 py-3 bg-gray-50 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Billing Date</th>
                    <th class="px-6 py-3 bg-gray-50 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Total Amount ($)</th>
                    <th class="px-6 py-3 bg-gray-50 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Proof of Meter Readings</th>
                    <th class="px-6 py-3 bg-gray-50 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Proof of Payment</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse ($declinedPayments as $payment)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-center text-sm text-gray-900">{{ $payment->lease->room_number }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $payment->tenant->tenant_name }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-center text-sm text-gray-900">{{ $payment->billing_date }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-center text-sm text-gray-900">{{ $payment->total_amount }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-center text-sm text-gray-900">
                            @if ($payment->proof_of_meter_reading)
                                @foreach (json_decode($payment->proof_of_meter_reading) as $proof)
                                    <a href="{{ asset('storage/' . $proof) }}" target="_blank">View</a><br>
                                @endforeach
                            @else
                                N/A
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-center text-sm text-gray-900">
                            @if ($payment->proof_of_utility_payment)
                                <a href="{{ asset('storage/' . $payment->proof_of_utility_payment) }}" target="_blank">Click Here to View Payment Proof</a>
                            @else
                                N/A
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-6 py-4 text-center text-sm text-gray-500">No declined utility bills found!</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
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
@endsection

