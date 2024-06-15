@extends('layout.dashboard-parent-tenant')

@section('content')
    @parent <!-- Retain master layout content -->

    <main class="ease-soft-in-out xl:ml-68.5 relative h-full max-h-screen rounded-xl transition-all duration-200 p-4 sm:p-6 lg:p-8">
        
        <!-- Check for success message -->
        @if (session('success'))
        <div id="flash-message" class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Success!</strong> {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @endif

        <!-- Check for error message -->
        @if (session('error'))
        <div id="flash-message" class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Error!</strong> {{ session('error') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @endif
        
        <!-- Pending Payments -->
        <div class="container">
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-warning">
                    <h2 class="mb-0 text-dark"><i class="fas fa-hourglass-half text-dark"></i> Pending Utility Bills</h2>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
                            <thead class="thead-dark">
                                <tr>
                                    <th class="text-center" style="white-space: nowrap;">Billing Date</th>
                                    <th class="text-center">Water Amount ($)</th>
                                    <th class="text-center">Electricity Amount ($)</th>
                                    <th class="text-center">Total Amount ($)</th>
                                    <th class="text-center">Proof of Meter Reading</th>
                                    <th class="text-center">Proof of Payment</th>
                                    <th class="text-center">Status</th>
                                    <th class="text-center">Upload Payment Proof</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($pendingPayments as $payment)
                                    @php
                                        $utilities = json_decode($payment->utilities, true);
                                        $waterAmount = $utilities['water']['amount'] ?? 0;
                                        $electricityAmount = $utilities['electricity']['amount'] ?? 0;
                                    @endphp
                                    <tr>
                                        <td class="text-center" style="white-space: nowrap;">{{ $payment->billing_date }}</td>
                                        <td class="text-center">{{ number_format($waterAmount, 2) }}</td>
                                        <td class="text-center">{{ number_format($electricityAmount, 2) }}</td>
                                        <td class="text-center">{{ number_format($payment->total_amount, 2) }}</td>
                                        <td class="text-center">
                                            @if ($payment->proof_of_meter_reading)
                                                @foreach (json_decode($payment->proof_of_meter_reading) as $proof)
                                                    <a href="{{ asset('storage/' . $proof) }}" target="_blank">View Reading Meter</a><br>
                                                @endforeach
                                            @else
                                                N/A
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            @if($payment->proof_of_utility_payment)
                                                <a href="{{ asset('storage/' . $payment->proof_of_utility_payment) }}" target="_blank">View Proof</a>
                                            @else
                                                N/A
                                            @endif
                                        </td>
                                        <td class="text-center">{{ ucfirst($payment->status) }}</td>
                                        <td class="text-center" style="white-space: nowrap;">
                                            <form action="{{ route('tenant.uploadUtilityProof', $payment->utility_bill_id) }}" method="POST" enctype="multipart/form-data" class="inline-block">
                                                @csrf
                                                <div class="d-flex align-items-center justify-content-center">
                                                    <input type="file" name="proof_of_payment" accept="application/pdf, image/png, image/jpeg, image/jpg" required class="form-control-file" style="width: auto; max-width: 200px;">
                                                    <button class="btn btn-primary btn-sm ml-2">
                                                        <i class="fas fa-upload"></i> Upload
                                                    </button>
                                                </div>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="8" class="text-center text-muted">You have no pending utility payments!</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        
            <!-- Approved Payments -->
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-success">
                    <h2 class="mb-0 text-white"><i class="fas fa-check-circle text-white"></i> Approved Utility Bills</h2>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
                            <thead class="thead-dark">
                                <tr>
                                    <th class="text-center">Billing Date</th>
                                    <th class="text-center">Water Amount ($)</th>
                                    <th class="text-center">Electricity Amount ($)</th>
                                    <th class="text-center">Total Amount ($)</th>
                                    <th class="text-center">Proof of Meter Reading</th>
                                    <th class="text-center">Proof of Payment</th>
                                    <th class="text-center">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($approvedPayments as $payment)
                                    @php
                                        $utilities = json_decode($payment->utilities, true);
                                        $waterAmount = $utilities['water']['amount'] ?? 0;
                                        $electricityAmount = $utilities['electricity']['amount'] ?? 0;
                                    @endphp
                                    <tr>
                                        <td class="text-center" style="white-space: nowrap;">{{ $payment->billing_date }}</td>
                                        <td class="text-center">{{ number_format($waterAmount, 2) }}</td>
                                        <td class="text-center">{{ number_format($electricityAmount, 2) }}</td>
                                        <td class="text-center">{{ number_format($payment->total_amount, 2) }}</td>
                                        <td class="text-center">
                                            @if ($payment->proof_of_meter_reading)
                                                @foreach (json_decode($payment->proof_of_meter_reading) as $proof)
                                                    <a href="{{ asset('storage/' . $proof) }}" target="_blank">View Reading Meter</a><br>
                                                @endforeach
                                            @else
                                                N/A
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            @if($payment->proof_of_utility_payment)
                                                <a href="{{ asset('storage/' . $payment->proof_of_utility_payment) }}" target="_blank">View Proof</a>
                                            @else
                                                N/A
                                            @endif
                                        </td>
                                        <td class="text-center">{{ ucfirst($payment->status) }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center text-muted">You have no approved utility payments!</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        
            <!-- Declined Payments -->
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-danger">
                    <h2 class="mb-0 text-white"><i class="fas fa-times-circle text-white"></i> Declined Utility Bills</h2>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
                            <thead class="thead-dark">
                                <tr>
                                    <th class="text-center" style="white-space: nowrap;">Billing Date</th>
                                    <th class="text-center">Water Amount ($)</th>
                                    <th class="text-center">Electricity Amount ($)</th>
                                    <th class="text-center">Total Amount ($)</th>
                                    <th class="text-center">Proof of Meter Reading</th>
                                    <th class="text-center">Proof of Payment</th>
                                    <th class="text-center">Status</th>
                                    <th class="text-center">Upload Payment Proof</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($declinedPayments as $payment)
                                    @php
                                        $utilities = json_decode($payment->utilities, true);
                                        $waterAmount = $utilities['water']['amount'] ?? 0;
                                        $electricityAmount = $utilities['electricity']['amount'] ?? 0;
                                    @endphp
                                    <tr>
                                        <td class="text-center">{{ $payment->billing_date }}</td>
                                        <td class="text-center">{{ number_format($waterAmount, 2) }}</td>
                                        <td class="text-center">{{ number_format($electricityAmount, 2) }}</td>
                                        <td class="text-center">{{ number_format($payment->total_amount, 2) }}</td>
                                        <td class="text-center">
                                            @if ($payment->proof_of_meter_reading)
                                                @foreach (json_decode($payment->proof_of_meter_reading) as $proof)
                                                    <a href="{{ asset('storage/' . $proof) }}" target="_blank">View Reading Meter</a><br>
                                                @endforeach
                                            @else
                                                N/A
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            @if($payment->proof_of_utility_payment)
                                                <a href="{{ asset('storage/' . $payment->proof_of_utility_payment) }}" target="_blank">View Proof</a>
                                            @else
                                                N/A
                                            @endif
                                        </td>
                                        <td class="text-center">{{ ucfirst($payment->status) }}</td>
                                        <td class="text-center">
                                            <form action="{{ route('tenant.uploadUtilityProof', $payment->utility_bill_id) }}" method="POST" enctype="multipart/form-data" class="inline-block">
                                                @csrf
                                                <div class="d-flex align-items-center justify-content-center">
                                                    <input type="file" name="proof_of_payment" accept="application/pdf, image/png, image/jpeg, image/jpg" required class="form-control-file" style="width: auto; max-width: 200px;">
                                                    <button class="btn btn-primary btn-sm ml-2">
                                                        <i class="fas fa-upload"></i> Upload
                                                    </button>
                                                </div>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="8" class="text-center text-muted">You have no declined utility payments!</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
