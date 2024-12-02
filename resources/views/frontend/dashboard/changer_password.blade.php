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
                            <h4 class="font-weight-bold mt-0 mb-4">Change Password</h4>
                            <div class="bg-white card mb-4 order-list shadow-sm">
                                <div class="gold-members p-4">
                                    <form action="{{ route('user.password.update') }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div class="row">
                                            <div class="col-xl-12 col-lg-12">

                                                <div>
                                                    <div class="mt-3 mt-2">
                                                        <label for="old_password" class="form-label">Old Password</label>
                                                        <input class="form-control @error('old_password') is-invalid @enderror" type="text" name="old_password" value="" id="old_password">
                                                        @error('old_password')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                    </div>
                                                    <div class="mt-3 mt-2">
                                                        <label for="new_password" class="form-label">New Password</label>
                                                        <input class="form-control @error('new_password') is-invalid @enderror" type="text" name="new_password" value="" id="new_password">
                                                        @error('new_password')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
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
