<div class="row gutters">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
        <div class="card custom-bdr">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="row">
                                <x-select-component :data="$memberList" arraykey="member_id" arrayValue="member_code"
                                    column="col-md-3" label="Select Member" name="member_code" id="member_code"
                                    class="custom-input-class" placeholder="" value="" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="transaction-view"></div>


<script>
    $(document).ready(function() {
        const container = $("#transaction-view");
        $(document).on('change', '#member_code', function(event) {
            event.preventDefault();
            event.stopImmediatePropagation();

            ajaxRequest('fetchUserTransactionView', {
                member_code: $("#member_code").val()
            }, function(response) {
                container.html(response.view);
            }, true);
        });
    });
</script>
