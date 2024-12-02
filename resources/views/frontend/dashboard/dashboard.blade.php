@include('frontend.dashboard.header')
@php
    $id = Auth::user()->id;
    $profileData = App\Models\User::find($id);
@endphp
<section class="section pt-4 pb-4 osahan-account-page">
    <div class="container">
        <div class="row">
            @include('frontend.dashboard.sidebar')
            <div class="col-md-9">
                <div class="osahan-account-page-right rounded shadow-sm bg-white p-4 h-100">
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="orders" role="tabpanel" aria-labelledby="orders-tab">
                            <h4 class="font-weight-bold mt-0 mb-4">User Profile</h4>
                            <div class="bg-white card mb-4 order-list shadow-sm">
                                <div class="gold-members p-4">
                                    <form action="{{ route('profile.store') }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div class="row">
                                            <div class="col-xl-12 col-lg-12">
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
                                                                <img id="showImage" src="{{ !empty($profileData->photo) ? asset($profileData->photo) : asset('upload/no_image.jpg') }}" alt="" style="height: 100px ; width:100px" class="img-fluid rounded-circle d-block p-1 bg-primary">
                                                            </div>
                                                            <div class="mt-3 mt-2">
                                                                <button type="submit" class="btn btn-primary">Save Changes</button>
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
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@include('frontend.dashboard.footer')
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