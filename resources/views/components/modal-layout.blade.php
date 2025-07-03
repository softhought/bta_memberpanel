<style>
    .modal-body {
        max-height: calc(100vh - 120px);
        overflow-y: auto;
        padding: 20px;
    }

    .modal.fade.right .modal-dialog {
        position: fixed;
        top: 0;
        right: 0;
        width: 35%;
        height: 100%;
        margin: 0;
        transform: translateX(100%);
        transition: transform 0.3s ease-out;
    }

    .modal.fade.right.show .modal-dialog {
        transform: translateX(0);
    }

    .modal-content {
        height: 100%;
        border-radius: 0;
    }

    .custom-close-btn {
        position: absolute;
        top: 23px;
        right: 12px;
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

    .custom-close-btn:before {
        content: '\00d7';
        font-weight: bold;
        color: #fff;
    }

    .custom-close-btn:hover {
        transform: translateY(-1px);
    }

    @media (max-width: 768px) {
        .modal.fade.right .modal-dialog {
            width: 100%;
            height: 100%;
        }
    }
</style>

<!-- Modal Structure -->
<div class="modal fade right" id="{{ isset($id) ? $id : '' }}" tabindex="-1" aria-hidden="true" data-bs-backdrop="static">
    <div class="modal-dialog {{ isset($dialogclass) ? $dialogclass : '' }}">
        <div class="modal-content card">
            <div class="card-header">
                <h5 class="modal-title" id="header_title"
                    style="font-size: 1rem; font-weight: 600; color: #eaf0fb; line-height: 3;">
                    {{ isset($title) ? $title : '' }}
                </h5>
                <button type="button" class="btn btn-close custom-close-btn" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body {{ isset($bodyclass) ? $bodyclass : '' }}" id="bodyContent">
                {{ $slot }}
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('[data-bs-dismiss="modal"]').on('click', function () {
            var modal = $(this).closest('.modal');
            modal.modal('hide');
        });
    });
</script>
