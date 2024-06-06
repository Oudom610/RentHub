@extends('layout.dashboard-parent-landlord')

@section('content')
    @parent <!-- Retain master layout content -->

    <!-- Main Content Area -->
    <main class="ease-soft-in-out xl:ml-68.5 relative h-full max-h-screen rounded-xl transition-all duration-200 p-4 sm:p-6 lg:p-8">
        {{-- <main class="container-fluid mt-4"> --}}
        <!-- Summary Cards -->
            <div class="row mb-4">
                <div class="col-md-4">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title">Total Tenants</h5>
                            <p class="card-text display-4">{{ $totalTenants }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title">Active Leases</h5>
                            <p class="card-text display-4">{{ $activeLeases }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title">Pending Payments</h5>
                            <p class="card-text display-4">{{ $pendingPayments }}</p>
                        </div>
                    </div>
                </div>
            </div>
    
            <!-- Quick Actions -->
            <div class="d-flex justify-content-between mb-4">
                <a href="{{ route('tenant.register') }}" class="btn btn-primary">Register New Tenant</a>
                <a href="{{ route('leases.create') }}" class="btn btn-primary">Create New Lease</a>
                <a href="{{ route('rent.create') }}" class="btn btn-primary">Create New Rent Entry</a>
            </div>
    
            <!-- Summary Tables -->
            <div class="card mb-4">
                <div class="card-header">
                    Pending Payments
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead class="thead-light">
                                <tr>
                                    <th>Tenant Name</th>
                                    <th>Room Number</th>
                                    <th>Rent Due Date</th>
                                    <th>Amount ($)</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($recentPendingPayments as $payment)
                                    <tr>
                                        <td>{{ $payment->tenant->tenant_name }}</td>
                                        <td>{{ $payment->lease->room_number }}</td>
                                        <td>{{ $payment->payment_date }}</td>
                                        <td>{{ $payment->amount }}</td>
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
    
            <div class="card mb-4">
                <div class="card-header">
                    Upcoming Lease Expirations
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead class="thead-light">
                                <tr>
                                    <th>Tenant Name</th>
                                    <th>Room Number</th>
                                    <th>End Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($upcomingLeaseExpirations as $lease)
                                    <tr>
                                        <td>{{ $lease->tenant->tenant_name }}</td>
                                        <td>{{ $lease->room_number }}</td>
                                        <td>{{ $lease->end_date }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" class="text-center">No upcoming lease expirations found!</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        {{-- </main> --}}
    </main>
    <!-- End Main Content Area -->
@endsection
