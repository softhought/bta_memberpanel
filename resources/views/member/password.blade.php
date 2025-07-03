<div class="row gutters">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
        <div class="card custom-bdr">
            <div class="card-header d-flex justify-content-between align-items-center">
                <div>Reset Password</div>
            </div>

            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card p-4">
                            <form name="passwordForm" id="passwordForm" enctype="multipart/form-data" method="POST">
                                @csrf
                                <div class="row ">
                                    <x-input-component column="col-md-3" type="password" label="Current Password"
                                        name="current_password" id="current_password" class="custom-input-class"
                                        placeholder="Enter Current Password" value="" readonly="" />

                                    <x-input-component column="col-md-3" type="password" label="New Password" name="new_password"
                                        id="new_password" class="custom-input-class" placeholder="Enter New Password"
                                        value="" readonly="" />

                                    <x-input-component column="col-md-3" type="password" label="Confirm Password"
                                        name="confirm_password" id="confirm_password" class="custom-input-class"
                                        placeholder="Enter Confirm Password" value="" readonly="" />


                                    <div class="col-md-2 text-center" style="margin-top: 1.7rem;">
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
        ajaxCall('passwordForm', 'changePasswordAction', function(response) {
            showToast(response.message);
            window.location.reload();
        });
    });
</script>
