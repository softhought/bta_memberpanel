@php
    $activeEnrollments = $member->programEnrollment->filter(fn ($enroll) => $enroll->is_active === 'Y');
@endphp

@if ($member->programEnrollment->isEmpty() || $activeEnrollments->isEmpty())
    <div class="row">
        <div class="col-md-4"></div>
        <div class="col-md-4">
            <div class="no-program-wrapper">
                <div class="no-program-box">
                    <p class="no-program-text">No active program enrollment</p>
                </div>
            </div>
        </div>
    </div>
    @php return; @endphp
@endif


<div class="tabs-container">

    {{-- <div class="tabs-header">
        <button class="tab-button active" data-tab="hp">
            <i class="fas fa-table-tennis"></i> HP
        </button>
        <button class="tab-button" data-tab="jhp">
            <i class="fas fa-table-tennis"></i> JHP
        </button>
        <button class="tab-button" data-tab="jcp">
            <i class="fas fa-table-tennis"></i> JCP
        </button>
        <button class="tab-button" data-tab="pf">
            <i class="fas fa-table-tennis"></i> PF
        </button>
    </div> --}}

    <div class="tabs-header">
        @php
            $firstActiveSet = false;
        @endphp

        @foreach ($member->programEnrollment as $enroll)
            @if ($enroll->is_active === 'Y' && $enroll->program->programme_name)
                @php
                    $tabName = strtolower($enroll->program->short_code);
                    $isActiveClass = !$firstActiveSet ? 'active' : '';
                    $firstActiveSet = true;
                @endphp

                <button class="tab-button {{ $isActiveClass }}" data-tab="{{ $tabName }}">
                    <i class="fas fa-table-tennis"></i> {{ $enroll->program->short_code }}
                </button>
            @endif
        @endforeach
    </div>

    <div class="tabs-content">
        <!-- High Performance Tab -->
        <div id="hp" class="tab-pane active">
            <div id="hp-container"></div>
        </div>

        <!-- Junior High Performance Tab -->
        <div id="jhp" class="tab-pane">
            <div id="jhp-container"></div>
        </div>

        <!-- Junior Coaching Program Tab -->
        <div id="jcp" class="tab-pane">
            <div id="jcp-container"></div>
        </div>

        <!-- Physical Fitness Tab -->
        <div id="pf" class="tab-pane">
            <div id="pf-container"></div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $(document).on('click', '.tab-button', function(event) {
            event.preventDefault();
            event.stopImmediatePropagation();

            $('.tab-button').removeClass('active');
            $('.tab-pane').removeClass('active');

            $(this).addClass('active');

            const tabId = $(this).data('tab');
            const tabPane = $('#' + tabId);

            $("#hp-container, #jhp-container, #jcp-container, #pf-container").html("");

            const container = $('#' + tabId + '-container');

            $('#global-tab-loader').show();
            container.html('');
            tabPane.addClass('active');

            const urlMap = {
                hp: 'fetchHPView',
                jhp: 'fetchJHPView',
                jcp: 'fetchJCPView',
                pf: 'fetchPFView'
            };

            if (urlMap[tabId]) {
                ajaxRequest(urlMap[tabId], {}, function(response) {
                    container.html(response.view);
                }, true);
            }
        });

        $('.tab-button.active').trigger('click');

        ajaxCall('paymentForm', 'ipayments', function(response) {
            window.location.href = response.encryptedUrl;
        });
    });

    function calculateSummary() {
        let totalAmount = 0;
        let totalDiscount = 0;
        let totalTaxable = 0;
        let totalCGST = 0;
        let totalSGST = 0;
        let totalPayable = 0;
        let bankCharges = 0;

        $('.month-row .row').each(function() {
            const row = $(this);

            totalAmount += parseFloat(row.find('.amount input').val()) || 0;
            totalDiscount += parseFloat(row.find('.discount input').val()) || 0;
            totalTaxable += parseFloat(row.find('.taxable input').val()) || 0;
            totalCGST += parseFloat(row.find('.cgst-amt input').val()) || 0;
            totalSGST += parseFloat(row.find('.sgst-amt input').val()) || 0;
            totalPayable += parseFloat(row.find('.payable input').val()) || 0;
        });

        // const selectedOption = $('#payment_mode option:selected');
        // const bankChargePercent = parseFloat(selectedOption.data('charges')) || 0;
        // bankCharges = (totalPayable * bankChargePercent) / 100;

        const netAmount = totalTaxable + totalCGST + totalSGST;
        const grossPayable = totalPayable + bankCharges;

        const roundedPayable = Math.round(grossPayable);
        const roundOff = (roundedPayable - grossPayable).toFixed(2);

        $('#total_amount').text(totalAmount.toFixed(2));
        $('#total_payable').text(roundedPayable.toFixed(2));

        // Update hidden inputs
        $('#total_amount_value').val(totalAmount);
        $('#total_payable_value').val(roundedPayable);
    }
</script>
