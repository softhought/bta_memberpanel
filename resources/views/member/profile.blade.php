<div class="row gutters">
    <div class="col-md-2"></div>
    <div class="col-xl-8 col-lg-8 col-md-8 col-sm-8">
        <div class="card custom-bdr">
            <div class="card-header d-flex justify-content-between align-items-center">
                <div>Profile</div>
            </div>

            <div class="card-body">
                <div class="row" style="zoom: 90%">
                    <div class="col-md-12">
                        <div class="card p-4">
                            <form name="profileForm" id="profileForm" enctype="multipart/form-data" method="POST">
                                @csrf
                                <div class="row ">
                                    <x-input-component column="col-md-6" type="text" label="Number" name="number"
                                        id="number" class="custom-input-class" placeholder="Enter Number"
                                        value="{{ $member->primary_mobile }}" readonly="" />

                                    <x-input-component column="col-md-6" type="text" label="Email" name="email"
                                        id="email" class="custom-input-class" placeholder="Enter Email"
                                        value="" readonly="{{ $member->primary_email }}" />

                                    <x-textarea-component column="col-md-12" type="text" label="Address" name="address"
                                        id="address" cols="" rows="2" class="custom-input-class" placeholder="Enter Address"
                                        value="{{ $member->address_one }}" />

                                    <div class="col-md-7"></div>

                                    <div class="col-md-2 text-center close-btn">
                                        <a href="{{ url('/') }}" style="width: 8rem; padding-top: 6px; height: 2rem; margin-left: 2.5rem; color: white;"
                                            class="btn btn-sm btn-primary">Close</a>
                                    </div>

                                    <div class="col-md-2 text-center password-btn">
                                        <button type="submit" id="savebtn" style="width: 8rem;height: 2rem;"
                                            class="btn btn-sm btn-primary">Update</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        ajaxCall('profileForm', 'profileAction', function(response) {
            showToast(response.message);
        });
    });
</script>
