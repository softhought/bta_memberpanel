$(function () {
    var base_url = $("#base_url").val();
    $(".datatables-basic").DataTable({ scrollX: true });
    $(".datatables-basic2").DataTable();
    $(".datatables-basic3").DataTable({ scrollX: true });

    $('.datepicker-component').datepicker({
        dateFormat: "dd-mm-yy",
        changeMonth: true,
        changeYear: true
    });

    getCommon();
    $(document).on('click', '.openModal', function (e) {
        e.preventDefault();

        var urlpath = $(this).attr('data-href');
        var id = $(this).attr('data-id');
        var title = $(this).attr('data-title');
        var type = "POST"; //for creating new resource

        $.ajax({
            url: urlpath,
            type: type,
            data: { id: id, title: title },
            async: false,
            success: function (response) {
                $('#commonModal').modal('show');
                $('#commonModal #bodyContent').html(response);
                $('#commonModal #header_title').text(title);
                getCommon();

            },
            error: function (xhr) {
                console.log(xhr.responseText);
                var errors = xhr.responseJSON.errors;
                if (errors) {
                    $.each(errors, function (field, messages) {
                        var errorHtml = '<ul class="list-unstyled">';
                        $.each(messages, function (index, message) {
                            errorHtml += '<li>' + message + '</li>';
                        });
                        errorHtml += '</ul>';
                        $('#my-form').find('[name="' + field + '"]').after(errorHtml);
                    });
                }
            }
        });

    });


    $(document).on('click', '.openFullModal', function (e) {
        e.preventDefault();

        var urlpath = $(this).attr('data-href');
        var id = $(this).attr('data-id');
        var title = $(this).attr('data-title');

        var type = "POST"; //for creating new resource

        $.ajax({
            url: urlpath,
            type: type,
            data: { id: id, title: title },
            async: false,
            success: function (response) {
                $('#commonFullModal').modal('show');
                $('#commonFullModal #bodyContent').html(response);
                $('#commonFullModal #header_title').text(title);
                getCommon();

            },
            error: function (xhr) {
                console.log(xhr.responseText);
                var errors = xhr.responseJSON.errors;
                if (errors) {
                    $.each(errors, function (field, messages) {
                        var errorHtml = '<ul class="list-unstyled">';
                        $.each(messages, function (index, message) {
                            errorHtml += '<li>' + message + '</li>';
                        });
                        errorHtml += '</ul>';
                        $('#my-form').find('[name="' + field + '"]').after(errorHtml);
                    });
                }
            }
        });

    });

    $(document).on('keyup change', 'input, select', function () {
        var inputValue = $(this).val();
        $("#error_msg").text('');
        $("#success_msg").text('');
        var id = $(this).attr('id');
        if (inputValue !== "") {
            $("#" + id + "_error").text("");
            $("#" + id).css('border', '1px solid #c7ccd0');
            $("#" + id).siblings('.select2-container').find('.select2-selection').css('border', '1px solid #c7ccd0');
        }
    });


    $(document).on('change', '.readUrl', function () {
        var imagePreview = $(this).attr('data-showImage');
        $(".upload-text").hide();
        readURL(this, imagePreview);
    });



    $(document).on('change', '#event_id', function () {

        var event_id = $("#event_id").val();
        var urlpath = base_url + '/event/categories';

        $.ajax({
            url: urlpath, // Replace with the actual URL of your endpoint
            method: 'POST',
            dataType: 'json',
            data: { event_id: event_id },
            success: function (response) {
                $("#event_category_id").html(response.data);
            },
            error: function (xhr, status, error) {
                console.error(error);
            }
        });


    });
    numberwithdecimal();
    onlynumber();

})

function numberwithdecimal() {
    $(".numberwithdecimal").bind("keyup paste", function () {
        this.value = this.value.replace(/[^0-9\.]/g, "");
    });
}
function onlynumber() {
    $(".onlynumber").bind("keyup paste", function () {
        this.value = this.value.replace(/[^0-9]/g, "");
    });
}

function calculateAge(birthdate) {
    var ageInYears = '';
    // Check if the birthdate is in valid format (dd-mm-yyyy)
    if (birthdate.match(/^\d{2}-\d{2}-\d{4}$/)) {
        // Split the birthdate string by "-" and rearrange it to "mm-dd-yyyy" format
        var parts = birthdate.split("-");
        var birthYear = parseInt(parts[2], 10); // Extract birth year
        var currentYear = (new Date()).getFullYear(); // Get current year
        // Calculate the age in years
        var ageInYears = currentYear - birthYear;

    }
    return ageInYears;
}



function showMsg(msg, icon, url, text = "") {
    var base_url = $("#base_url").val();
    Swal.fire({
        title: msg,
        text: text,
        icon: icon,
        width: 350,
        padding: '1em',
        confirmButtonColor: '#3085d6',
        confirmButtonText: 'Ok',
        customClass: {
            title: 'fs-5 text-center m-auto',
            content: 'alerttext',
            confirmButton: 'btn btn-primary btn-sm',
            icon: 'fs-8'
        },
        allowOutsideClick: false

    }).then((result) => {
        if (result.value) {
            if (url != "") {
                window.location.href = base_url + url;
            }

        }
    });
}

function getCommon() {

    $(function () {
        var t = $(".select2");
        t.length && t.each(function () {
            var e = $(this);
            e.wrap('<div class="position-relative"></div>').select2({ placeholder: "Select", dropdownParent: e.parent() })
        })
    });

    $(".numberwithdecimal").bind("keyup paste", function () {
        this.value = this.value.replace(/[^0-9\.]/g, "");
    });

    $(".onlynumber").bind("keyup paste", function () {
        this.value = this.value.replace(/[^0-9]/g, "");
    });

    $('.numberlength').on('keyup paste', function () {
        var maxLength = parseInt($(this).attr('maxlength'));
        var currentLength = $(this).val().length;

        if (currentLength > maxLength) {
            $(this).val($(this).val().substr(0, maxLength)); // Truncate the input
        }
    });

    $(".datatable").DataTable();


    document.addEventListener('DOMContentLoaded', function () {
        var noAutocompleteFields = document.querySelectorAll('.no-autocomplete');
        noAutocompleteFields.forEach(function (field) {
            field.setAttribute('autocomplete', 'new-password');
        });
    });

    $('.datepicker-component').datepicker({
        dateFormat: "dd-mm-yy",
        changeMonth: true,
        changeYear: true
    });

}

function readURL(input, imagePreview) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#' + imagePreview).attr('src', e.target.result).fadeIn('slow');
        }
        reader.readAsDataURL(input.files[0]);
    }
}


function numberwithdecimal() {
    $(".numberwithdecimal").bind("keyup paste", function () {
        this.value = this.value.replace(/[^0-9\.]/g, "");
    });
}
function onlynumber() {
    $(".onlynumber").bind("keyup paste", function () {
        this.value = this.value.replace(/[^0-9]/g, "");
    });
}

function onlydecimalnumber() {
    $(document).on("input paste", ".onlydecimalnumber", function () {
        this.value = this.value.replace(/[^0-9.]/g, "");

        if ((this.value.match(/\./g) || []).length > 1) {
            this.value = this.value.substring(0, this.value.lastIndexOf("."));
        }

        let regex = /^(\d{0,10})(\.\d{0,2})?$/;
        if (!regex.test(this.value)) {
            this.value = this.value.slice(0, -1);
        }
    });
}

function ajaxFormCall(formId, url, redirect) {

    const mode = $("#mode").val();

    $(document).on("submit", `#${formId}`, function (e) {
        e.preventDefault();
        e.stopImmediatePropagation();

        var formData = new FormData($(this)[0]);
        var csrfToken = $('meta[name="csrf-token"]').attr("content");

        var type = "POST";
        var urlpath = `${BASEURL}/${url}`;

        enableButton(true);

        $.ajax({
            url: urlpath,
            type: type,
            data: formData,
            processData: false,
            contentType: false,
            headers: {
                "X-CSRF-TOKEN": csrfToken,
            },
            success: function (response) {
                unblockUI();
                if (!$.isEmptyObject(response.errors)) {
                    $.each(response.errors, function (key, value) {
                        $("#" + key + "_error").text(value);
                        $("#" + key).css("border", "1px solid red");
                        $("#" + key)
                            .siblings(".select2-container")
                            .find(".select2-selection")
                            .css("border", "1px solid red");
                    });
                }

                if (response.status == "SUCCESS") {
                    if (mode == "Add") {
                        $(`#${formId}`)[0].reset();

                        showToast("Data successfully Saved.");

                        setTimeout(function () {
                            window.location.href = `${BASEURL}/${redirect}`;
                        }, 500);
                    } else {
                        showToast("Data successfully updated.");
                    }
                }

                enableButton(false);
            },
            error: function (xhr) {
                enableButton(false);
                unblockUI();
            },
        });
    });
}

function ajaxCall(formId, url, callback) {
    $(document).on("submit", `#${formId}`, function (e) {
        e.preventDefault();
        e.stopImmediatePropagation();

        var formData = new FormData($(this)[0]);
        var csrfToken = $('meta[name="csrf-token"]').attr("content");

        enableButton(true);

        $.ajax({
            url: `${BASEURL}/${url}`,
            type: "POST",
            data: formData,
            processData: false,
            contentType: false,
            headers: {
                "X-CSRF-TOKEN": csrfToken,
            },
            success: function (response) {
                if (!$.isEmptyObject(response.errors)) {
                    $.each(response.errors, function (key, value) {
                        $(`#${key}_error`).text(value);
                        $(`#${key}`).css("border", "1px solid red");
                        $(`#${key}`)
                            .siblings(".select2-container")
                            .find(".select2-selection")
                            .css("border", "1px solid red");
                    });
                }

                enableButton(false);
                unblockUI();
                if (response.status == "SUCCESS") {
                    callback(response);
                }
            },
            error: function (xhr) {
                console.log(xhr.responseText);
                enableButton(false);
                unblockUI();
            },
        });
    });
}


function ajaxRequest(url, data, callback, fails = null) {
    var csrfToken = $('meta[name="csrf-token"]').attr("content");

    if (fails === true) {
        blockUI();
    }

    $.ajax({
        url: `${BASEURL}/${url}`,
        type: "POST",
        data: data,
        timeout: 0,
        headers: {
            "X-CSRF-TOKEN": csrfToken,
        },
        success: function (response) {
            unblockUI();
            if (response.status == "SUCCESS") {
                getCommon();
                callback(response);
            }
        },
        error: function (xhr) {
            console.log(xhr.responseText);
            unblockUI();
            enableButton(false);

            if (typeof fails === "function") {
                fails({ status: "ERROR", error: xhr.responseText })
            }
        },
    });
}
