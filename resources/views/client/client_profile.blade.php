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
                <div class="col-xl-12 col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm order-2 order-sm-1">
                                    <div class="d-flex align-items-start mt-3 mt-sm-0">
                                        <div class="flex-shrink-0">
                                            <div class="avatar-xl me-3">
                                                <img style="height: 85px ; width:100px" src="{{ !empty($profileData->photo) ? asset($profileData->photo) : asset('upload/no_image.jpg') }}" alt="" class="img-fluid rounded-circle d-block">
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
            </div>
            <form action="{{ route('client.profile.store') }}" method="POST" enctype="multipart/form-data">
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
                                    <div class="col-md-6">
                                        <div>
                                            <div class="mt-3 mt-2">
                                                <label for="name" class="form-label">Name</label>
                                                <input class="form-control" type="text" name="name" value="{{ old('name', $profileData->name) }}" id="name">
                                            </div>
                                            <div class="mt-3 mt-2">
                                                <label for="email" class="form-label">Email</label>
                                                <input class="form-control" type="text" name="email" value="{{ old('email', $profileData->email) }}" id="email">
                                            </div>
                                            <div class="mt-3 mt-2">
                                                <label for="phone" class="form-label">Phone</label>
                                                <input class="form-control" type="text" name="phone" value="{{ old('phone', $profileData->phone) }}" id="phone">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div>
                                            <div class="mt-3 mt-2">
                                                <label for="address" class="form-label">Address</label>
                                                <input class="form-control" type="text" name="address" value="{{ old('address', $profileData->address) }}" id="address">
                                            </div>
                                            <div class="mt-3 mt-2">
                                                <label for="image" class="form-label">Profile Image</label>
                                                <input class="form-control" type="file" name="photo" value="" id="image">
                                            </div>
                                            <div class="mt-3 mt-2">
                                                <img id="showImage" src="{{ !empty($profileData->photo) ? asset($profileData->photo) : asset('upload/no_image.jpg') }}" alt="" style="height: 90px ; width:100px" class="img-fluid rounded-circle d-block p-1 bg-primary">
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
    @endsection
    @push('scripts')
        <script>
            $(document).ready(function() {
                $("#image").change(function() {
                    var file = $(this)[0].files[0];
                    var reader = new FileReader();
                    reader.onload = function(event) {
                        $("#showImage").css("height", "100px");
                        $("#showImage").attr("src", event.target.result);
                    }
                    reader.readAsDataURL(file);
                });
            })
        </script>
    @endpush
