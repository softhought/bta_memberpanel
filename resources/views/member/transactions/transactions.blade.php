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

            const programMap = {
                hp: 'HP',
                jhp: 'JHP',
                jcp: 'JCP',
                pf: 'PF'
            };

            if (programMap[tabId]) {
                ajaxRequest('fetchTransactions', { program: programMap[tabId]}, function(response) {
                    container.html(response.view);
                }, true);
            }
        });

        $('.tab-button.active').trigger('click');
    });
</script>
