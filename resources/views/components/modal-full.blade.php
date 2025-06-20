<style>
    .custom-close-btn-full {
        position: absolute;
        top: -8px;
        right: -8px;
        width: 25px;
        height: 25px;
        border: none;
        background-color: #438601;
        font-size: 1.2rem;
        cursor: pointer;
        outline: none;
        transition: transform 0.3s ease, color 0.3s ease;
        display: flex;
        justify-content: center;
        align-items: center;
        border-radius: 18%;
    }

    .custom-close-btn-full:before {
        content: '\00d7';
        font-weight: bold;
        color: #fff;
    }

    .custom-close-btn-full:hover {
        transform: translateY(-3px);
    }
</style>
<div class="modal fade" id="{{ $id }}" tabindex="-1" aria-hidden="true" data-bs-backdrop="static">
    <div class="modal-dialog {{ $dialogclass }}">
        <div class="modal-content card" style="border-radius: 5px;">
            <div class="card-header" style="height: 2.6rem !important;">
                <h5 class="modal-title" id="header_title" style="font-size: 1rem; font-weight: 600; color: #eaf0fb;">
                    {{ $title }}</h5>
                <button type="button" class="btn btn-close custom-close-btn-full" data-bs-dismiss="modal"
                    aria-label="Close"></button>

            </div>
            <div class="modal-body {{ $bodyclass }}" id="bodyContent">
                {{ $slot }}
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('[data-bs-dismiss="modal"]').on('click', function() {
            var modal = $(this).closest('.modal');
            modal.modal('hide');
        });
    });
</script>
