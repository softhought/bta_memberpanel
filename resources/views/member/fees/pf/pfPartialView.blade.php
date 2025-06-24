@if (!$isExists)
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

<div class="container">
    <div class="accordion-item">
        <div class="accordion-body">

            <div class="section-header">
                Monthly Payment
            </div>

            <div class="d-flex align-items-center">
                <label class="m-3">Monthly Slots for</label>

                <x-input-component column="col-md-2" type="text" label="" name="month" id="month"
                    class="custom-input-class onlynumber" placeholder="Enter month" value="" />

                <input type="hidden" name="last_paid_month_id" id="last_paid_month_id"
                    value="{{ $paymentMaster?->receipt?->receiptDetails->last()?->month?->id ?? 1 }}">
                <input type="hidden" name="last_paid_year" id="last_paid_year"
                    value="{{ $paymentMaster?->receipt?->receiptDetails->last()?->year ?? '2020' }}">

                @if ($paymentMaster?->receipt?->receiptDetails->last()?->month?->month_name)
                    <span>months <span class="text-success fw-bold p-text"><b>(You Paid up to
                                {{ $paymentMaster?->receipt?->receiptDetails->last()?->month?->month_name }}
                                {{ $paymentMaster?->receipt?->receiptDetails->last()?->year }})</b></span></span>
                @endif
            </div>

            <div id="month-container"></div>
        </div>
    </div>

    <div style="margin-right: -13px;">
        <div class="text-end">
            <input type="hidden" id="total_amount_value" value="0">
            <input type="hidden" id="total_payable_value" value="0">

            <div class="summary-box p-3 mt-4">
                <p><strong>Total Amount :</strong><span id="total_amount">0.00</span></p>
                <p class="highlight"><strong>Total Payable :</strong><span id="total_payable">0.00</span></p>
            </div>
        </div>

        <div class="row">
            <div class="col-md-11"></div>
            <div class="col-md-1">
                <div class="text-end">
                    <button type="submit" disabled id="paybtn" class="btn btn-sm btn-primary">Pay</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('.datepicker-component').datepicker({
            dateFormat: "dd-mm-yy",
            changeMonth: true,
            changeYear: true
        });

        $('#month').on('input', function(event) {
            const container = $("#month-container");

            event.preventDefault();
            event.stopImmediatePropagation();

            let monthCount = $("#month").val() || 0;
            let lastPaidMonthId = $("#last_paid_month_id").val();
            let lastPaidYear = $("#last_paid_year").val();

            ajaxRequest("fetchMonths", {
                monthCount: monthCount,
                lastPaidMonthId: lastPaidMonthId,
                lastPaidYear: lastPaidYear,
                program: 'PF'
            }, function(response) {
                container.html(response.view);
                calculateSummary();
            }, true);

            if (monthCount > 0) {
                $("#paybtn").prop('disabled', false);
            } else {
                $("#paybtn").prop('disabled', true);
            }
        });
    });
</script>
