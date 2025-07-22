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

<div class="row mb-3">
    <div class="col-md-12" style="text-align: center;">
        <a href="http://btaportal.in/custom/report/otherreport/printpdfenrolment/{{ $enrollment->enrollment_id }}/{{ $yearId }}"
            target="_blank"
            style="background-color: #28a745; color: #fff; padding: 6px 14px; font-size: 14px; border-radius: 8px; text-decoration: none; display: inline-block;">
            <i class="fas fa-download"></i> Download Transaction History
        </a>
    </div>
</div>

<div class="payment-container">
    <!-- Admission & Others -->
    <div class="section-card">
        <h6 class="section-title">
            <span>
                <span class="icon icon-admission"></span>
                Admission & Others
            </span>
        </h6>
        <div class="table-container">
            <table class="payment-table">
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Payment No.</th>
                        <th>Particular</th>
                        <th>Waive</th>
                        <th>Mode</th>
                        <th>Amount</th>
                        <th>Discount</th>
                        <th>CGST</th>
                        <th>SGST</th>
                        <th>Pay Amt.</th>
                    </tr>
                </thead>
                <tbody>
                    @if (!$enrollmentReceiptGST->isEmpty())
                        @foreach ($enrollmentReceiptGST as $list)
                            <tr>
                                <td>{{ date_dmy($list->payment_date) }}</td>
                                <td>{{ $list->payment_no }}</td>
                                <td class="text-center">{{ $list->description }}</td>
                                <td>{{ $list->is_wave_receipt === 'Y' ? 'Yes' : 'No' }}</td>
                                <td>{{ $list->payment_mode }}</td>
                                <td class="currency">{{ number_format($list->item_amount, 2) }}</td>
                                <td>{{ number_format($list->discount, 2) }}</td>
                                <td>{{ number_format($list->cgst_amount, 2) }}</td>
                                <td>{{ number_format($list->sgst_amount, 2) }}</td>
                                <td>{{ number_format($list->item_amount + $list->sgst_amount + $list->cgst_amount, 2) }}
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="11" class="text-center">No data available</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>

    <!-- Security -->
    <div class="section-card">
        <h6 class="section-title">
            <span>
                <span class="icon icon-security"></span>
                Security
            </span>
        </h6>
        <div class="table-container">
            <table class="payment-table">
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Payment No.</th>
                        <th>Particular</th>
                        <th>Waive</th>
                        <th>Mode</th>
                        <th>Amount</th>
                        <th>Discount</th>
                        <th>CGST</th>
                        <th>SGST</th>
                        <th>Pay Amt.</th>
                    </tr>
                </thead>
                <tbody>
                    @if (!$enrollmentReceiptSecurityGST->isEmpty())
                        @foreach ($enrollmentReceiptSecurityGST as $list)
                            <tr>
                                <td>{{ date_dmy($list->payment_date) }}</td>
                                <td>{{ $list->payment_no }}</td>
                                <td class="text-center">{{ $list->description }}</td>
                                <td>{{ $list->is_waiver === 'Y' ? 'Yes' : 'No' }}</td>
                                <td>{{ $list->payment_mode }}</td>
                                <td class="currency">{{ number_format($list->total_amount, 2) }}</td>
                                <td>{{ number_format($list->total_discount, 2) }}</td>
                                <td>{{ number_format($list->total_cgst_amount, 2) }}</td>
                                <td>{{ number_format($list->total_sgst_amount, 2) }}</td>
                                <td>{{ number_format($list->net_amount + $list->total_cgst_amount + $list->total_cgst_amount, 2) }}
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="11" class="no-records">No security deposits found</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>

    <!-- Monthly -->
    <div class="section-card">
        <h6 class="section-title">
            <span>
                <span class="icon icon-monthly"></span>
                Monthly
            </span>
        </h6>
        <div class="table-container">
            <table class="payment-table">
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Payment No.</th>
                        <th>Particular</th>
                        <th>Month/Year</th>
                        <th>Waive</th>
                        <th>Mode</th>
                        <th>Amount</th>
                        {{-- <th>CGST</th>
                        <th>SGST</th> --}}
                        <th>Pay Amt.</th>
                        <th>Receipt</th>
                    </tr>
                </thead>
                <tbody>
                    @if (!$enrollmentReceiptMonthly->isEmpty())
                        @foreach ($enrollmentReceiptMonthly as $list)
                            <tr>
                                <td>{{ date_dmy($list->payment_date) }}</td>
                                <td>{{ $list->payment_no }}</td>
                                <td class="text-center">{{ $list->description }}</td>
                                <td class="text-center">{{ "{$list->short_name} {$list->year}" }}</td>
                                <td>{{ $list->is_waiver === 'Y' ? 'Yes' : 'No' }}</td>
                                <td>{{ $list->payment_mode }}</td>
                                <td class="currency">{{ number_format($list->taxable_amount, 2) }}</td>
                                {{-- <td>{{ number_format($list->cgst_amount, 2) }}</td>
                                <td>{{ number_format($list->sgst_amount, 2) }}</td> --}}
                                <td>{{ number_format($list->taxable_amount + $list->cgst_amount + $list->sgst_amount, 2) }}
                                </td>
                                <td>
                                    <a href="http://btaportal.in/custom/report/taxinvoice/receiptpdf/{{ $list->enrollment_id }}/{{ $list->receipt_master_id }}/{{ $list->payment_id }}/1"
                                        target="_blank" title="View PDF Receipt">
                                        <i class="fas fa-file-pdf fa-lg currency"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="11" class="text-center">No data available</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>
