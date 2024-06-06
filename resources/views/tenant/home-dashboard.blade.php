@extends('layout.dashboard-parent-tenant')

@section('content')
    @parent <!-- Retain master layout content -->

    <!-- Main Content Area -->
    <main class="ease-soft-in-out xl:ml-68.5 relative h-full max-h-screen rounded-xl transition-all duration-200 p-4 sm:p-6 lg:p-8">
        {{-- <main class="container-fluid mt-4"> --}}
        <!-- Summary Cards -->
        <div class="row mb-4">
            <div class="col-md-6">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">Current Lease Details</h5>
                        @if ($currentLease)
                            <p class="card-text">Room Number: {{ $currentLease->room_number }}</p>
                            <p class="card-text">Lease Start Date: {{ $currentLease->start_date }}</p>
                            <p class="card-text">Lease End Date: {{ $currentLease->end_date }}</p>
                        @else
                            <p class="card-text">No current lease details available.</p>
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">Pending Payments (Rent)</h5>
                        <p class="card-text display-4">{{ $pendingRentPaymentsCount }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">Declined Payments (Rent)</h5>
                        <p class="card-text display-4">{{ $declinedRentPaymentsCount }}</p>
                        @if ($declinedRentPaymentsCount > 0)
                            <a href="{{ route('tenant.showRent') }}" class="btn btn-warning mt-3">Re-upload Proof of Payment</a>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- Summary Table -->
        <div class="card mb-4">
            <div class="card-header">
                Pending Payments (Rent)
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead class="thead-light">
                            <tr>
                                <th>Rent Due Date</th>
                                <th>Amount ($)</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($pendingRentPayments as $payment)
                                <tr>
                                    <td>{{ $payment->payment_date }}</td>
                                    <td>{{ $payment->amount }}</td>
                                    <td>{{ ucfirst($payment->status) }}</td>
                                    <td>
                                        <a href="{{ route('tenant.showRent') }}" class="btn btn-primary">Upload Proof of Payment</a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center">No pending payments found!</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>
    <!-- End Main Content Area -->

@endsection
