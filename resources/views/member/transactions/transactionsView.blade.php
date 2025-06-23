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
                        <th>Status</th>
                        <th>Mode</th>
                        <th>Amount</th>
                        <th>Discount</th>
                        <th>CGST</th>
                        <th>SGST</th>
                        <th>Pay Amt.</th>
                    </tr>
                </thead>
                <tbody>
                    @if (!empty($enrollmentReceiptGST))
                        @foreach ($enrollmentReceiptGST as $list)
                            <tr>
                                <td>{{ date_dmy($list->payment_date) }}</td>
                                <td>{{ $list->payment_no }}</td>
                                <td class="text-center">{{ $list->description }}</td>
                                <td>{{ $list->is_wave_receipt === 'Y' ? 'Yes' : 'No' }}</td>
                                <td>
                                    @if (!empty($list->IsActive) && $list->IsActive === 'N')
                                        <span class="status-badge badge-danger">
                                            Cancelled By {{ $list->cancelledBy ?? '' }}
                                            <br>
                                            Note: {{ $list->InActiveNote ?? '' }}
                                        </span>
                                    @endif
                                </td>
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
                        <th>Status</th>
                        <th>Mode</th>
                        <th>Amount</th>
                        <th>Discount</th>
                        <th>CGST</th>
                        <th>SGST</th>
                        <th>Pay Amt.</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td colspan="11" class="no-records">No security deposits found</td>
                    </tr>
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
                        <th>Status</th>
                        <th>Mode</th>
                        <th>Amount</th>
                        <th>CGST</th>
                        <th>SGST</th>
                        <th>Pay Amt.</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>09/06/2025</td>
                        <td>NGST/01094/25-26</td>
                        <td class="text-start">Junior Coaching Fees-Afternoon</td>
                        <td>Apr 2025</td>
                        <td>-</td>
                        <td><span class="status-badge badge-success">Paid</span></td>
                        <td>Cash</td>
                        <td class="currency">3,000.00</td>
                        <td>0.00</td>
                        <td>0.00</td>
                        <td class="currency">3,000.00</td>
                    </tr>
                    <tr>
                        <td>09/06/2025</td>
                        <td>NGST/01094/25-26</td>
                        <td class="text-start">Junior Coaching Fees-Afternoon</td>
                        <td>May 2025</td>
                        <td>-</td>
                        <td><span class="status-badge badge-success">Paid</span></td>
                        <td>Cash</td>
                        <td class="currency">3,000.00</td>
                        <td>0.00</td>
                        <td>0.00</td>
                        <td class="currency">3,000.00</td>
                    </tr>
                    <tr>
                        <td>09/06/2025</td>
                        <td>NGST/01094/25-26</td>
                        <td class="text-start">Junior Coaching Fees-Afternoon</td>
                        <td>Jun 2025</td>
                        <td>-</td>
                        <td><span class="status-badge badge-success">Paid</span></td>
                        <td>Cash</td>
                        <td class="currency">3,000.00</td>
                        <td>0.00</td>
                        <td>0.00</td>
                        <td class="currency">3,000.00</td>
                    </tr>
                    <tr class="total-row">
                        <td colspan="10" class="text-end">Total Amount</td>
                        <td class="currency">9,000.00</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
