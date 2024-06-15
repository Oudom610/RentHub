@extends('layout.dashboard-parent-tenant')

@section('content')
@parent <!-- Retain master layout content -->

<head>
    <!-- Add jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<style>
    .profile-input {
        display: none;
    }

    .btn-edit {
        background-color: #17a2b8;
        color: white;
        border: none;
    }

    .btn-save {
        background-color: #007bff;
        color: white;
        border: none;
    }

    .btn-cancel {
        background-color: #dc3545;
        color: white;
        border: none;
    }

    .card-header-custom {
        background-color: #007bff;
        color: white;
        padding: 10px;
        font-size: 1.25rem;
        border-bottom: 2px solid #0069d9;
    }

    .card-body-custom {
        background-color: #f8f9fa;
        padding: 20px;
    }

    .btn-space {
        margin-right: 5px;
    }

    .button-container {
        display: none;
    }

    .button-container.active {
        display: inline-flex;
        align-items: center;
    }

    .info-text {
        font-size: 1.1rem;
        /* Adjust this size as needed */
    }

    /* Modal styling */
    .modal-body {
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    .modal-body .form-group {
        width: 100%;
        text-align: center;
    }

    .modal-body .d-flex {
        justify-content: center;
        width: 100%;
    }
</style>

<!-- Main Content Area -->
<main
    class="ease-soft-in-out xl:ml-68.5 relative h-full max-h-screen rounded-xl transition-all duration-200 p-4 sm:p-6 lg:p-8">
    <!-- Profile Card and Modal within Main Section -->
    <main class="container mt-5">
        <div class="card shadow-sm">
            <div class="card-header bg-primary card-header-custom d-flex align-items-center">
                <h2 class="mb-0 text-white"><i class="fas fa-user text-white"></i> Profile Information</h2>
            </div>
            <div class="card-body card-body-custom">
                <div class="row">
                    <!-- Profile Picture Column -->
                    <div class="col-md-5 d-flex flex-column align-items-center bg-light p-5 rounded-left">
                        @php
                            $profileImagePath = $tenant->profile_picture ? 'storage/' . $tenant->profile_picture : 'assets/img/Default-icon.png';
                        @endphp
                        <img class="rounded-circle mb-4" src="{{ asset($profileImagePath) }}" id="currentProfilePic"
                            alt="Profile Picture" style="width: 225px; height: 225px; object-fit: cover;">
                        <button onclick="openModal('{{ asset($profileImagePath) }}')"
                            class="btn btn-primary">Upload</button>
                    </div>
                    <!-- Information Column -->
                    <div class="col-md-7 p-5 rounded-right d-flex flex-column justify-content-center info-text">
                        <div class="mb-4 row align-items-center">
                            <label class="col-sm-3 col-form-label font-weight-bold">Name:</label>
                            <div class="col-sm-5">
                                <span id="value-tenant_name"
                                    class="form-control-plaintext">{{ $tenant->tenant_name }}</span>
                            </div>
                        </div>
                        <div class="mb-4 row align-items-center">
                            <label class="col-sm-3 col-form-label font-weight-bold">Email:</label>
                            <div class="col-sm-5">
                                <span id="value-email" class="form-control-plaintext">{{ $tenant->email }}</span>
                            </div>
                        </div>
                        <form id="form-contact_info" action="{{ route('tenant.profile.update') }}" method="POST">
                            @csrf
                            <div class="mb-4 row align-items-center">
                                <label class="col-sm-3 col-form-label font-weight-bold">Contact:</label>
                                <div class="col-sm-5">
                                    <span id="value-contact_info"
                                        class="form-control-plaintext">{{ $tenant->contact_info }}</span>
                                    <input type="text" name="value" id="input-contact_info"
                                        class="form-control profile-input" value="{{ $tenant->contact_info }}">
                                    <input type="hidden" name="field" value="contact_info">
                                </div>
                                <div class="col-sm-3 text-right">
                                    <div id="buttons-contact_info" class="button-container">
                                        <button type="submit" id="save-button-contact_info"
                                            class="btn btn-save btn-space">Save</button>
                                        <button type="button" onclick="cancel('contact_info')"
                                            id="cancel-button-contact_info" class="btn btn-cancel">Cancel</button>
                                    </div>
                                    <button type="button" onclick="enableEdit('contact_info')"
                                        id="edit-button-contact_info" class="btn btn-edit btn-space">Edit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal for Uploading Profile Picture -->
        <div id="uploadModal" class="modal fade" tabindex="-1" aria-labelledby="uploadModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="uploadModalLabel">Upload Profile Picture</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <img id="imagePreview" class="rounded-circle mb-3"
                            src="{{ asset('assets/img/Default-icon.png') }}" alt="Profile Preview"
                            style="width: 200px; height: 200px; object-fit: cover;">
                        <form id="profilePicForm" action="{{ route('tenant.profile.upload') }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <input type="file" name="profile_picture" id="profile_picture" class="form-control-file"
                                    onchange="previewImage();" required>
                            </div>
                            <div class="d-flex justify-content-center">
                                <button type="submit" class="btn btn-primary mr-2">Upload</button>
                                <button type="button" class="btn btn-danger"
                                    onclick="submitRemoveProfilePictureForm()">Remove</button>
                            </div>
                        </form>
                        <form id="removeProfilePicForm" action="{{ route('tenant.profile.remove') }}" method="POST"
                            style="display:none;">
                            @csrf
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script>
        if (typeof jQuery !== 'undefined') {
            console.log('jQuery is loaded!');
        } else {
            console.log('jQuery is not loaded!');
        }

        function openModal(profilePicPath) {
            document.getElementById('imagePreview').setAttribute('src', profilePicPath);
            $('#uploadModal').modal('show');
        }

        function closeModal() {
            $('#uploadModal').modal('hide');
        }

        function previewImage() {
            var file = document.getElementById('profile_picture').files;
            if (file.length > 0) {
                var fileReader = new FileReader();

                fileReader.onload = function (event) {
                    document.getElementById('imagePreview').setAttribute('src', event.target.result);
                };

                fileReader.readAsDataURL(file[0]);
            } else {
                document.getElementById('imagePreview').setAttribute('src', '{{ asset('assets/img/Default-icon.png') }}');
            }
        }

        function enableEdit(field) {
            document.getElementById('value-' + field).style.display = 'none';
            document.getElementById('input-' + field).style.display = 'block';
            document.getElementById('edit-button-' + field).style.display = 'none';

            document.getElementById('buttons-' + field).classList.add('active');
        }

        function cancel(field) {
            document.getElementById('input-' + field).style.display = 'none';
            document.getElementById('value-' + field).style.display = 'block';
            document.getElementById('edit-button-' + field).style.display = 'inline-block';
            document.getElementById('buttons-' + field).classList.remove('active');
        }

        function submitRemoveProfilePictureForm() {
            document.getElementById('removeProfilePicForm').submit();
        }
    </script>
    @endsection