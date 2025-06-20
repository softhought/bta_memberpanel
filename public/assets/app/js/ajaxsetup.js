$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

function getCommon() {

    $(function () {
        var t = $(".select2");
        t.length && t.each(function () {
            var e = $(this);
            e.wrap('<div class="position-relative"></div>').select2({ placeholder: "Select value", dropdownParent: e.parent() })
        })
    });

    $(".numberwithdecimal").bind("keyup paste", function () {
        this.value = this.value.replace(/[^0-9\.]/g, "");
    });

    $(".onlynumber").bind("keyup paste", function () {
        this.value = this.value.replace(/[^0-9]/g, "");
    });

    $(".onlydecimalnumber").bind("keyup paste", function () {
        this.value = this.value.replace(/[^0-9.]/g, "");

        if ((this.value.match(/\./g) || []).length > 1) {
            this.value = this.value.substring(0, this.value.lastIndexOf("."));
        }

        let regex = /^(\d{0,10})(\.\d{0,2})?$/;
        if (!regex.test(this.value)) {
            this.value = this.value.slice(0, -1);
        }
    });


    $('.numberlength').on('keyup paste', function () {
        var maxLength = parseInt($(this).attr('maxlength'));
        var currentLength = $(this).val().length;

        if (currentLength > maxLength) {
            $(this).val($(this).val().substr(0, maxLength));
        }
    });

    document.addEventListener('DOMContentLoaded', function () {
        var noAutocompleteFields = document.querySelectorAll('.no-autocomplete');
        noAutocompleteFields.forEach(function (field) {
            field.setAttribute('autocomplete', 'new-password');
        });
    });

    $(".datepicker").flatpickr({ dateFormat: "d/m/Y" });
    $(".datetimepicker").flatpickr({
        enableTime: true,
        dateFormat: "d/m/Y h:i K",
    });
    $(".datatable").DataTable();
    $(".selectpicker").selectpicker();

    onlynumber();
}

function showToast(msg, error = 0) {
    if (error) {
        Swal.fire({
            icon: 'error',
            title: 'Error',
            html: '<span>' + msg + '</span>',
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            background: '#f8d7da',
            iconColor: '#dc3545',
            customClass: {
                popup: 'animate__animated animate__bounceIn'
            }
        });
    } else {
        Swal.fire({
            icon: 'success',
            title: 'Success',
            html: '<span>' + msg + '</span>',
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            background: '#d4edda',
            iconColor: '#28a745',
            customClass: {
                popup: 'animate__animated animate__bounceIn'
            }
        });
    }
}


function showtoast(msg, error = 0) {
    const e = document.querySelector(".toast-ex");
    let a, n, i, l, r;
    if (error) {
        $(function () {
            l && c(l),
                (a = "bg-danger"),
                (n = "animate__bounceIn"),
                e.classList.add(a, n),
                (l = new bootstrap.Toast(e)).show();
        });
        $("#toast_body_content").html(
            '<i class="fa-solid fa-close fs-4"></i>&emsp;<span>' +
            msg +
            "</span>"
        );
    } else {
        $(function () {
            l && c(l),
                (a = "bg-green"),
                (n = "animate__bounceIn"),
                e.classList.add(a, n),
                (l = new bootstrap.Toast(e)).show();
        });
        $("#toast_body_content").html(
            '<i class="fa-solid fa-check fs-4"></i>&emsp;<span>' +
            msg +
            "</span>"
        );
    }
}

function refreshData(container = "mainContainer") {
    $.ajax({
        url: window.location.href,
        method: "GET",
        success: function (response) {
            var specificDivData = $(response).find(`#${container}`).html();
            $("#mainContainer").html(specificDivData);
            getCommon();
        },
        error: function (xhr) {
        },
    });
}


function removeError(input) {
    $(input).closest('.validate-input').removeClass('form_error');
}

function validateData() {
    let isValid = true;
    $(".validate-input").removeClass("form_error");

    $(".validate-field").each(function () {
        if ($(this).val() === "") {
            $(this).closest('.validate-input').addClass('form_error');
            isValid = false;
        }
    });

    return isValid;
}

function enableButton(status, mode = 'Save') {
    if (status) {
        $("#savebtn").html("Processing...");
        $("#savebtn").prop("disabled", true);
    } else {
        if(mode == "Add") {
            var text = "Save";
        } else {
            var text = "Update";
        }
        $("#savebtn").html(text);
        $("#savebtn").prop("disabled", false);
    }
}