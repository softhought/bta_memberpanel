<div class="row gutters">
    <div class="col-md-2"></div>
    <div class="col-xl-8 col-lg-8 col-md-8 col-sm-8">
        <div class="card custom-bdr">
            <div class="card-header d-flex justify-content-between align-items-center">
                <div>Profile Edit</div>
            </div>

            <div class="card-body">
                <div class="row">
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
                                        value="{{ $member->primary_email }}" readonly="" />

                                    <x-textarea-component column="col-md-12" type="text" label="Address"
                                        name="address" id="address" cols="" rows="2"
                                        class="custom-input-class" placeholder="Enter Address"
                                        value="{{ $member->address_one }}" />

                                    <div class="col-md-12 mt-3">
                                        <div
                                            class="d-flex flex-wrap justify-content-center justify-content-md-end gap-2">
                                            <a href="{{ url('/') }}" class="btn btn-sm btn-primary"
                                                style="width: 8rem; height: 2rem; padding-top: 6px;">
                                                Close
                                            </a>

                                            <button type="submit" id="savebtn" class="btn btn-sm btn-primary"
                                                style="width: 8rem; height: 2rem; margin-left: 1rem;">
                                                Update
                                            </button>
                                        </div>
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
