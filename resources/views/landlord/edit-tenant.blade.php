@extends('layout.dashboard-parent-landlord')

@section('content')
    @parent <!-- Retain master layout content -->
    <main class="ease-soft-in-out xl:ml-68.5 relative h-full max-h-screen rounded-xl transition-all duration-200 p-4 sm:p-6 lg:p-8">
        
        <!-- Form Container -->
        <div class="container mt-5">
            <div class="card shadow-sm">
                <div class="card-header bg-primary">
                    <h2 class="mb-0 text-white"><i class="fas fa-edit text-white"></i> Edit Tenant</h2>
                </div>
                <div class="card-body">
                    <!-- Error Messages -->
                    @if ($errors->any())
                        <div class="alert alert-danger" role="alert">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <!-- Edit Tenant Form -->
                    <form id="editTenantForm" method="POST" action="{{ route('tenant.update', $tenant) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="tenantName" class="fw-bold text-dark">Tenant Name</label>
                                <input type="text" id="tenantName" class="form-control @error('tenant_name') is-invalid @enderror" name="tenant_name" value="{{ $tenant->tenant_name }}" required>
                                @error('tenant_name')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label for="email" class="fw-bold text-dark">Email</label>
                                <input type="email" id="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $tenant->email }}" required>
                                @error('email')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="contact_info" class="fw-bold text-dark">Contact Info</label>
                                <input type="text" id="contact_info" class="form-control @error('contact_info') is-invalid @enderror" name="contact_info" value="{{ $tenant->contact_info }}" required>
                                @error('contact_info')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <button type="submit" class="btn btn-primary"><i class="fas fa-check"></i> Update Tenant</button>
                                <a href="{{ route('tenant.show') }}" class="btn btn-secondary ml-2"><i class="fas fa-times"></i> Cancel</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </main>
@endsection
