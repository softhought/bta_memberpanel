<div class="month-row">
    @foreach ($upcomingMonthlyDetails as $list)
        <div class="row">
            <x-input-component readonly="readonly" column="col-cu-2 description" type="text" label="Month"
                name="description" id="description" class="custom-input-class onlynumber" placeholder="Month"
                value="{{ $list->month->short_name }} {{ $list->year }}" />

            <x-input-component readonly="readonly" column="col-cu-1 amount" type="text" label="Fees" name="amount"
                id="amount{{ $list->monthly_details_id }}" class="custom-input-class onlynumber" placeholder="Fees" value="{{ $list->amount }}" />

            <x-input-component readonly="readonly" column="col-cu-1 discount d-none" type="text" label="Discount"
                name="discount" id="discount{{ $list->monthly_details_id }}" class="custom-input-class onlynumber" placeholder="Discount"
                value="0" />

            <x-input-component readonly="readonly" column="col-cu-1 taxable d-none" type="text" label="Taxable"
                name="taxable" id="taxable{{ $list->monthly_details_id }}" class="custom-input-class onlynumber" placeholder="Taxable"
                value="{{ $list->amount }}" />

            <x-input-component readonly="readonly" column="col-cu-1 cgst d-none" type="text" label="CGST" name="cgst"
                id="cgst{{ $list->monthly_details_id }}" class="custom-input-class onlynumber" placeholder="CGST" value="0" />

            <x-input-component readonly="readonly" column="col-cu-1 sgst d-none" type="text" label="SGST" name="sgst"
                id="sgst{{ $list->monthly_details_id }}" class="custom-input-class onlynumber" placeholder="SGST" value="0" />

            <x-input-component readonly="readonly" column="col-cu-2 cgst-amt d-none" type="text" label="CGST Amt"
                name="cgst_amt" id="cgst_amt{{ $list->monthly_details_id }}" class="custom-input-class onlynumber" placeholder="CGST Amt"
                value="0" />

            <x-input-component readonly="readonly" column="col-cu-2 sgst-amt d-none" type="text" label="SGST Amt"
                name="sgst_amt" id="sgst_amt{{ $list->monthly_details_id }}" class="custom-input-class onlynumber" placeholder="SGST Amt"
                value="0" />

            <x-input-component readonly="readonly" column="col-cu-1 payable" type="text" label="Payable"
                name="payable" id="payable{{ $list->monthly_details_id }}" class="custom-input-class onlynumber" placeholder="Payable"
                value="{{ $list->amount }}" />
            <hr>
        </div>
    @endforeach
</div>
