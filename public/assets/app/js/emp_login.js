
$(document).ready(function () {

    // Generate random math CAPTCHA
    let num1 = Math.floor(Math.random() * 10) + 1;
    let num2 = Math.floor(Math.random() * 10) + 1;
    let correctAnswer = num1 + num2;
    $("#math_question").val(num1 + " + " + num2);

    // Reset CAPTCHA error on input
    $("#captcha_answer").on("input", function () {
        $("#captcha_error").text("");
    });


    $(document).on('keyup change', 'input, select', function () {
        var inputValue = $(this).val();
        var id = $(this).attr('id');
        if (inputValue !== "") {
            $("#" + id + "_error").text("");
        }
    });

    $(".onlynumber").bind("keyup paste", function () {
        this.value = this.value.replace(/[^0-9]/g, "");
    });

    var base_url = $("#base_url").val();

    $("#reload").click(function () {
        var urlpath = base_url + "/admin/reload-captach";
        var csrfToken = $('input[name="_token"]').val();
        $.ajax({
            type: "POST",
            url: urlpath,
            headers: {
                "X-CSRF-TOKEN": csrfToken,
            },
            success: function (data) {
                $("#captcha").val(data.operand1 + " + " + data.operand2);
            },
        });
    });

    $("#refresh_captcha").on("click", function (e) {
        e.preventDefault();
        num1 = Math.floor(Math.random() * 10) + 1;
        num2 = Math.floor(Math.random() * 10) + 1;
        correctAnswer = num1 + num2;
        $("#math_question").val(num1 + " + " + num2);
        $("#captcha_answer").val("");
        $("#captcha_error").text("");
    });

    $(document).on('submit', '#loginForm', function (e) {
        e.preventDefault();

        if (1) {

            // Check CAPTCHA first
            const userAnswer = parseInt($("#captcha_answer").val());
            if (isNaN(userAnswer) || userAnswer !== correctAnswer) {
                $("#captcha_error").text("Incorrect answer. Please try again.");
                return; // Prevent form submission
            }

            var formData = new FormData($(this)[0]);
            var csrfToken = $('input[name="_token"]').val();


            var type = "POST";
            var urlpath = base_url + '/member/auth';

            $("#errormsg").text('');

            $("#login_btn").html("Processing...");
            $("#login_btn").prop("disabled", true);

            $.ajax({
                url: urlpath,
                type: type,
                data: formData,
                processData: false,
                contentType: false,
                headers: {
                    'X-CSRF-TOKEN': csrfToken
                },
                success: function (response) {

                    if (!$.isEmptyObject(response.errors)) {
                        $.each(response.errors, function (key, value) {
                            $("#" + key + "_error").text(value);
                        });
                    }
                    if (response.msg_status == 2) {
                        $("#errormsg").text(response.msg_data);
                    }

                    $("#login_btn").html("Login");
                    $("#login_btn").prop("disabled", false);


                    if (response.msg_status == 1) {
                        window.location.href = base_url + "/member/dashboard";
                    }
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
        }
    });
});
