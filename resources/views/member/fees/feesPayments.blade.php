<style>
    .summary-box {
        max-width: 350px;
        margin-left: auto;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        font-size: 14px;
        color: #000;
    }

    .summary-box p {
        margin: 4px 0;
        display: flex;
        justify-content: space-between;
    }

    .summary-box p strong {
        min-width: 180px;
        text-align: right;
    }

    .summary-box .text-danger {
        color: rgb(251, 59, 59);
        font-style: italic;
    }

    .summary-box .highlight {
        color: rgb(251, 59, 59);
        font-style: italic;
    }

    .summary-box .highlight-green {
        color: green;
        font-style: italic;
    }

    .tabs-container {
        padding: 0;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        border-radius: 5px;
        overflow: hidden;
        box-shadow: 0 15px 35px rgba(0, 100, 0, 0.12);
        background: linear-gradient(to bottom, #f8fff8, #f0faf0);
    }

    .tabs-header {
        display: flex;
        background: linear-gradient(to right, #1a8811, #2a9d1f);
        position: relative;
    }

    .tab-button {
        flex: 1;
        text-align: center;
        background: transparent;
        color: rgba(255, 255, 255, 0.85);
        border: none;
        padding: 8px;
        font-size: 18px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.4s ease;
        position: relative;
        z-index: 1;
    }

    .tab-button:hover {
        color: #fff;
        background: rgba(255, 255, 255, 0.12);
    }

    .tab-button.active {
        color: #1a8811;
        background: #fff;
        box-shadow: 0 -5px 15px rgba(0, 0, 0, 0.08);
    }

    .tab-button.active::before {
        content: '';
        position: absolute;
        top: 0;
        left: 50%;
        transform: translateX(-50%);
        width: 25px;
        height: 5px;
        background: #ffb400;
        border-radius: 0 0 5px 5px;
    }

    .tabs-content {
        background-color: #fff;
        padding: 40px 30px;
        min-height: 380px;
        position: relative;
        overflow: hidden;
    }

    .tabs-content::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 6px;
        background: linear-gradient(to right, #ffb400, #ffd166);
    }

    .tab-pane {
        display: none;
        animation: fadeIn 0.5s ease;
    }

    .tab-pane.active {
        display: block;
    }

    .tab-icon {
        width: 70px;
        height: 70px;
        background: linear-gradient(135deg, #e9f7e8, #d0eccf);
        border-radius: 18px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 25px;
        font-size: 28px;
        color: #1a8811;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
    }

    .tab-title {
        font-size: 32px;
        font-weight: 700;
        color: #1a4d1a;
        margin: 0;
        letter-spacing: -0.5px;
    }

    .tab-subtitle {
        font-size: 18px;
        color: #5a8d5a;
        margin-top: 8px;
        font-weight: 500;
    }

    .tab-description {
        font-size: 17px;
        line-height: 1.7;
        color: #4a4a4a;
        margin-top: 10px;
        max-width: 800px;
    }

    .tab-stats {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
        gap: 25px;
        margin-top: 35px;
    }

    .stat-card {
        background: linear-gradient(to bottom right, #f7fdf7, #edf8ec);
        border-radius: 14px;
        padding: 25px;
        border-left: 5px solid #1a8811;
        box-shadow: 0 7px 20px rgba(0, 80, 0, 0.07);
        transition: transform 0.3s ease;
    }

    .stat-card:hover {
        transform: translateY(-5px);
    }

    .stat-value {
        font-size: 32px;
        font-weight: 800;
        color: #1a8811;
        margin-bottom: 10px;
        display: flex;
        align-items: center;
    }

    .stat-value i {
        margin-right: 12px;
        font-size: 26px;
    }

    .stat-label {
        font-size: 16px;
        color: #5a8d5a;
        font-weight: 600;
    }

    .tab-features {
        margin-top: 30px;
        padding-left: 25px;
    }

    .tab-features li {
        margin-bottom: 15px;
        font-size: 17px;
        color: #444;
        position: relative;
        padding-left: 35px;
    }

    .tab-features li::before {
        content: '✓';
        position: absolute;
        left: 0;
        top: 0;
        width: 26px;
        height: 26px;
        background: #e9f7e8;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #1a8811;
        font-weight: bold;
    }

    .no-program-wrapper {
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .no-program-box {
        background: linear-gradient(135deg, #fff0f0, #ffe5e5);
        border: 1px solid #f3c6c6;
        border-radius: 12px;
        padding: 11px 47px;
        box-shadow: 0 6px 12px rgba(0, 0, 0, 0.05);
        max-width: 400px;
        width: 100%;
        text-align: center;
    }

    .no-program-text {
        font-size: 18px;
        color: #c0392b;
        font-weight: 600;
        margin: 0;
    }

    .accordion-item {
        border: 1px solid #90d890;
        background: #f6ffe9;
        border-radius: 6px;
    }


    .section-header {
        background: #e6f7cb;
        padding: 10px 15px;
        font-weight: 600;
        font-size: 18px;
        color: #rgba(0, 0, 0, .85);
        border: 1px solid #b9e6b9;
    }

    .month-row {
        background: #f6fff6;
        padding: 5px 14px;
        border: 1px solid #d4e8d4;
        border-radius: 6px;
        margin: 10px;
    }

    .receipt-row {
        padding: 5px 14px;
        margin: 10px;
    }

    .validate-input .form-label {
        font-size: 12px;
        color: #666;
        font-weight: bold;
    }

    .p-text {
        color: rgb(26, 136, 17) !important;
    }

    .col-cu-1 {
        width: 10%;
        padding-left: 6px;
        padding-right: 6px;
    }

    .col-cu-2 {
        width: 14%;
        padding-left: 6px;
        padding-right: 6px;
    }

    .col-cu-1.cgst,
    .col-cu-1.sgst {
        width: 8%;
    }

    .col-cu-2.cgst-amt,
    .col-cu-2.sgst-amt {
        width: 12%;
    }

    .col-cu-1.payable {
        width: 16%;
    }

    hr {
        width: 95%;
    }

    @media (max-width: 768px) {
        .row {
            display: flex;
            flex-wrap: wrap;
        }

        .col-cu-1,
        .col-cu-2,
        .col-cu-1.cgst,
        .col-cu-1.sgst,
        .col-cu-2.cgst-amt,
        .col-cu-2.sgst-amt,
        .col-cu-1.payable {
            width: 80% !important;
            margin-left: 10%;
        }

        .month-row {
            padding: 10px;
        }

        .d-flex.align-items-center {
            flex-direction: column;
            align-items: flex-start;
        }

        .d-flex.align-items-center label,
        .d-flex.align-items-center span {
            margin: 6px 0;
        }
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(15px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @media (max-width: 768px) {
        .tabs-header {
            flex-wrap: wrap;
        }

        .tab-button {
            flex: 1 0 50%;
            padding: 16px 8px;
            font-size: 16px;
        }

        .tab-icon {
            margin-right: 0;
            margin-bottom: 20px;
        }

        .tab-stats {
            grid-template-columns: 1fr;
        }
    }
</style>


<div class="tabs-container">
    <div class="tabs-header">
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
