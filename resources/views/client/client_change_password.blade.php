@extends('client.client_dashboard')
@section('client')
    <div class="page-content">
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">Profile</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Contacts</a></li>
                                <li class="breadcrumb-item active">Profile</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-xl-6 col-lg-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm order-2 order-sm-1">
                                    <div class="d-flex align-items-start mt-3 mt-sm-0">
                                        <div class="flex-shrink-0">
                                            <div class="avatar-xl me-3">
                                                <img src="{{ !empty($profileData->photo) ? asset($profileData->photo) : asset('upload/no_image.jpg') }}" alt="" class="img-fluid rounded-circle d-block">
                                            </div>
                                        </div>
                                        <div class="flex-grow-1">
                                            <div>
                                                <h5 class="font-size-16 mb-1">{{ $profileData->name }}</h5>
                                                <p class="text-muted font-size-13">{{ $profileData->email }}</p>

                                                <div class="d-flex flex-wrap align-items-start gap-2 gap-lg-3 text-muted font-size-13">
                                                    <div><i class="mdi mdi-circle-medium me-1 text-success align-middle"></i>{{ $profileData->phone }}</div>
                                                    <div><i class="mdi mdi-circle-medium me-1 text-success align-middle"></i>{{ $profileData->address }}</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <!-- end card body -->
                    </div>
                    <!-- end card -->
                    <!-- end tab content -->
                </div>
                <!-- end col -->
                <div class="col-xl-6 col-lg-6">
                    <form action="{{ route('client.password.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-xl-12 col-lg-12">
                                @foreach ($errors->all() as $error)
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        {{ $error }}
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>
                                @endforeach
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div>
                                                    <div class="mt-3 mt-2">
                                                        <label for="old_password" class="form-label">Old Password</label>
                                                        <input class="form-control @error('old_password') is-invalid @enderror" type="text" name="old_password" value="" id="old_password">
                                                    </div>
                                                    <div class="mt-3 mt-2">
                                                        <label for="new_password" class="form-label">New Password</label>
                                                        <input class="form-control @error('new_password') is-invalid @enderror" type="text" name="new_password" value="" id="new_password">
                                                    </div>
                                                    <div class="mt-3 mt-2">
                                                        <label for="new_password_confirmation" class="form-label">Confirm New Password</label>
                                                        <input class="form-control @error('new_password_confirmation') is-invalid @enderror" type="text" name="new_password_confirmation" value="" id="new_password_confirmation">
                                                    </div>
                                                    <div class="mt-3 mt-2">
                                                        <button type="submit" class="btn btn-primary">Save Changes</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- end row -->
                        </div> <!-- container-fluid -->
                    </form>
                </div>
            </div>

        </div>
    @endsection
