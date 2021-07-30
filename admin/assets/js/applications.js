var form_generate_conditional_loa = $("#form_generate_conditional_loa");
var form_verify_conditional_loa = $("#form_verify_conditional_loa");
var form_generate_final_loa = $("#form_generate_final_loa");

$(document).ready(function () {
    $("#verify_conditional_loa_btn").on('click', function (e) {
        e.preventDefault();

        $("#verifyConditionalLoaModal").modal('show');
    });

    $("#generate_conditional_loa_btn").on('click', function (e) {
        e.preventDefault();

        $("#generateConditionalLoaModal").modal('show');
    });

    $("#generate_final_loa_btn").on('click', function (e) {
        e.preventDefault();

        $("#generateFinalLoaModal").modal('show');

        if ($("#program_id").length > 0) {
            $("#program_id").change();
        }
    });

    $("#doc_verified").on('click', function (e) {
        if ($(this).is(':checked')) {
            $(".submit_ola_btn").removeAttr('disabled');
        } else {
            $(".submit_ola_btn").attr('disabled', 'disabled');
        }
    });

    $("#is_scholarship").on('change', function (e) {
        if ($(this).val() == 1) {
            $("#scholarship").show();
        } else {
            $("#scholarship").hide();
        }
    });

    $("#program_id").on('change', function (e) {
        var cost = $(this).children("option:selected").data('cost');

        $(".program_cost").html(cost);
    });

    form_generate_conditional_loa.on('submit', function (e) {
        e.preventDefault();

        $("#program_id").attr('disabled', 'disabled');
        $("#intake_id").attr('disabled', 'disabled');

        Swal.fire({
            title: "Generating...",
            text: "Please wait",
            showConfirmButton: false,
            allowOutsideClick: false,
            timer: 20000,
        });

        var application_id = $("#application_id").val();
        var program_id = $("#program_id").val();
        var intake_id = $("#intake_id").val();
        $.ajax({
            type: 'POST',
            url: getUrl('applications/' + application_id + '/generate_conditional_loa'),
            data: {program_id: program_id, intake_id: intake_id},
            success: function (res) {
                if (res.error === 1) {
                    Swal.fire(
                        res.message,
                        '',
                        'error'
                    );
                } else {
                    Swal.close();
                    window.location.reload();
                }
            },
            error: function () {

            },
            complete: function () {
                $("#program_id").removeAttr('disabled');
                $("#intake_id").removeAttr('disabled');
            }
        });

    });

    form_generate_final_loa.on('submit', function (e) {
        e.preventDefault();

        var program_id = $("#program_id").val();
        var intake_id = $("#intake_id").val();

        var is_valid = true;
        if (program_id === '' || program_id === 0) {
            $(".submit_ola_btn").attr('disabled', 'disabled');
            is_valid = false;
        }
        if (intake_id === '' || intake_id === 0) {
            $(".submit_ola_btn").attr('disabled', 'disabled');
            is_valid = false;
        }

        if (is_valid === false) {
            Swal.fire(
                'Select any program or intake',
                '',
                'error'
            );
            return;
        }

        Swal.fire({
            title: "Generating Final LOA...",
            text: "Please wait",
            showConfirmButton: false,
            allowOutsideClick: false,
            timer: 20000,
        });

        var application_id = $("#application_id").val();

        $.ajax({
            type: 'POST',
            url: getUrl('applications/' + application_id + '/generate_final_loa'),
            data: form_generate_final_loa.serialize(),
            success: function (res) {
                if (res.error === 1) {
                    Swal.fire(
                        res.message,
                        '',
                        'error'
                    );
                } else {
                    Swal.close();
                    window.location.reload();
                }
            },
            error: function () {

            },
            complete: function () {

            }
        });
    });

    $("#form_student_application").on('submit', function (e) {
        e.preventDefault();

        $("#submit_btn").attr('disabled', 'disabled');

        var application_id = $("#application_id").val();
        Swal.fire({
            title: "Saving...",
            text: "Please wait",
            showConfirmButton: false,
            allowOutsideClick: false,
            timer: 20000,
        });
        $.ajax({
            type: 'POST',
            url: getUrl('applications/' + application_id + '/update'),
            data: $(this).serialize(),
            success: function (res) {
                if (res.error === 1) {
                    Swal.fire(
                        res.message,
                        '',
                        'error'
                    );
                } else {
                    Swal.close();
                    window.location.reload();
                }
            },
            error: function () {

            },
            complete: function () {
                $("#submit_btn").removeAttr('disabled');
            }
        });
    });

    form_verify_conditional_loa.on('submit', function (e) {
        e.preventDefault();

        $(".submit_ola_btn").attr('disabled', 'disabled');
        //form.submit();

        //$(".form-data-error").hide();
        var thisForm = $(this)[0];
        var application_id = $("#application_id").val();
        Swal.fire({
            title: "Verifying...",
            text: "Please wait",
            showConfirmButton: false,
            allowOutsideClick: false,
            timer: 20000,
        });
        $.ajax({
            type: 'POST',
            url: getUrl('applications/' + application_id + '/verify_conditional_loa'),
            data: new FormData(thisForm),
            dataType: 'JSON',
            contentType: false,
            cache: false,
            processData: false,
            async: false,
            success: function (res) {
                //Swal.close();
                if (res.error === 1) {
                    Swal.fire(
                        'Conditional LOA verifying fail, try again.',
                        res.message,
                        'error'
                    );
                } else {
                    Swal.fire({
                        type: 'success',
                        title: 'Success',
                        text: res.message,
                        allowOutsideClick: false
                    }).then(function () {
                        Swal.close();
                        window.location.reload();
                    });
                }
            },
            error: function () {

            },
            complete: function () {
                $(".submit_ola_btn").removeAttr('disabled');
            }
        });
    });

    $("#program_id, #intake_id").on('change', function (e) {
        e.preventDefault();

        $("#program_id").attr('disabled', 'disabled');
        $("#intake_id").attr('disabled', 'disabled');

        var loa_type = $("#loa_type").val();

        if (loa_type === 'final') {
            form_generate_final_loa.find('#program_name').val('-');
            form_generate_final_loa.find('#intake_name').val('-');
            form_generate_final_loa.find('#academic_status').val('-');
            form_generate_final_loa.find('#hours_per_week').val('-');
            form_generate_final_loa.find('#level_of_study').val('-');
            form_generate_final_loa.find('#type_of_program').val('-');
            form_generate_final_loa.find('#first_year_fees').val('');
            form_generate_final_loa.find('#start_at').val('-');
            form_generate_final_loa.find('#completion_at').val('-');
        }

        var program_id = $("#program_id").val();
        var intake_id = $("#intake_id").val();

        var is_valid = true;
        /*if (program_id === '' || program_id === 0) {
            is_valid = false;
        }
        if (intake_id === '' || intake_id === 0) {
            is_valid = false;
        }*/

        if (is_valid === true) {
            Swal.fire({
                title: "Loading...",
                text: "Please wait",
                showConfirmButton: false,
                allowOutsideClick: false,
                timer: 20000,
            });

            $.ajax({
                type: 'POST',
                url: getUrl('ajax/get_program_intake'),
                data: {'program_id': program_id, 'intake_id': intake_id, 'loa_type': loa_type},
                success: function (res) {
                    Swal.close();
                    $("#intake_id").html('<option label="Choose program"></option>');
                    if (res.error === 1) {
                        /*Swal.fire(
                            res.message,
                            '',
                            'error'
                        );*/
                    } else {
                        var program = res.program;
                        var intakes = res.intakes;

                        var intakeOptions = '';
                        if (intakes.length) {
                            intakeOptions = '<option label="Choose intake"></option>';
                            for (var i in intakes) {
                                var intake = intakes[i];
                                intakeOptions += '<option ' + (intake_id == intake.id ? 'selected="selected"' : '') + ' value="' + intake.id + '">' + intake.name + '</option>';
                            }
                        } else {
                            intakeOptions = '<option label="Not any intake assign in program"></option>';
                        }

                        $("#intake_id").html(intakeOptions);

                        if (loa_type === 'generate') {
                            form_generate_conditional_loa.find('.level_of_study').html(program.level_of_study || '-');
                            form_generate_conditional_loa.find('.type_of_program').html(program.type_of_program || '-');
                            form_generate_conditional_loa.find('.academic_status').html(program.academic_status || '-');
                            form_generate_conditional_loa.find('.hours_per_week').html(program.hours_per_week || '-');
                            form_generate_conditional_loa.find('.program_start_date').html(program.program_start_date || '-');
                            form_generate_conditional_loa.find('.program_end_date').html(program.program_end_date || '-');
                            form_generate_conditional_loa.find('.program_duration').html(program.program_duration || '-');
                            form_generate_conditional_loa.find('.program_total_fees').html(program.total_fees || '-');
                        } else if (loa_type === 'final') {

                            form_generate_final_loa.find('#program_name').val(program.name || '');
                            form_generate_final_loa.find('#intake_name').val(program.intake_name || '');
                            form_generate_final_loa.find('#academic_status').val(program.academic_status || '');
                            form_generate_final_loa.find('#hours_per_week').val((program.hours_per_week || '') + ' Hours per week');
                            form_generate_final_loa.find('#level_of_study').val(program.level_of_study || '');
                            form_generate_final_loa.find('#type_of_program').val(program.type_of_program || '');
                            form_generate_final_loa.find('#first_year_fees').val(program.total_fees || '');
                            form_generate_final_loa.find('#start_at').val(program.program_start_date);
                            form_generate_final_loa.find('#completion_at').val(program.program_end_date);
                        }
                    }
                },
                error: function () {

                },
                complete: function () {
                    $("#program_id").removeAttr('disabled');
                    $("#intake_id").removeAttr('disabled');

                    $(".submit_ola_btn").removeAttr('disabled');
                }
            });
        }
    });
});
