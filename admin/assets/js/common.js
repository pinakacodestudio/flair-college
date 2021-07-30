function calculateAge(dateString) { // birthday is a date
    console.log(dateString);
    var birthday = new Date(dateString);
    console.log(birthday);
    var ageDifMs = Date.now() - birthday.getTime();
    var ageDate = new Date(ageDifMs); // miliseconds from epoch
    var age = (ageDate.getUTCFullYear() - 1970); //Math.abs
    if (!isNaN(age) && age >= 0) {
        return age;
    }
    return '';
}

var rangeOptions = {};
if (typeof moment === 'function') {
    rangeOptions = {
        ranges: {
            'Today': [moment(), moment()],
            'Yesterday': [moment().subtract('days', 1), moment().subtract('days', 1)],
            'Last 7 Days': [moment().subtract('days', 6), moment()],
            'Last 30 Days': [moment().subtract('days', 29), moment()],
            'This Month': [moment().startOf('month'), moment().endOf('month')],
            'Last Month': [moment().subtract('month', 1).startOf('month'), moment().subtract('month', 1).endOf('month')],
            'This Year': [moment().startOf('year'), moment().endOf('year')],
        },
        /*startDate: moment().subtract('days', 29),
        endDate: moment(),*/
        /*startDate: moment().startOf('month'),
        endDate: moment().endOf('month'),*/
        opens: 'left',
        locale: {
            applyLabel: 'Ok'
        },
    };
}

/** added */

function numberSeparatorClean(value) {
    console.log('call numberSeparatorClean:', value, ':isNaN:', isNaN(value));
    if (value === undefined || value === null || !isNaN(value)) {
        return value;
    }

    //var new_value = value_temp.replaceAll(',', '');
    var new_value = value.replace(/,/gi, ''); // fix on 190720
    console.log(new_value, ':isNaN:', isNaN(new_value));

    if (isNaN(new_value) || new_value.trim() === '') return value;

    return new_value;
}

function numberSeparator(value) {
    //console.log('call numberSeparator:', value);
    if (value === undefined || value === null) return value;
    return parseFloat((value.toString()).replace(/,/g, '')).toLocaleString('en')
}


$(document).ready(function () {

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(document).ajaxComplete(function (event, xhr, settings) {
        console.log(arguments);
        if (xhr.status !== 200) {
            alert(xhr.statusText + ' : ' + 'Reload page and try again.');
        }
    });

    $(document).on('click', ".soft_delete_btn", function (e) {
        e.preventDefault();
        var delete_url = $(this).data('href');
        var message = $(this).data('message');

        var text_message = 'This action cannot be undone';
        if (message !== undefined && message !== '') {
            text_message = message;
        }
        Swal.fire({
            title: "Are you sure? You want to Delete?",
            text: text_message,
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.value) {
                Swal.fire({
                    title: "Deleting...",
                    text: "Please wait",
                    showConfirmButton: false,
                    allowOutsideClick: false,
                    timer: 20000,
                });
                $.post(delete_url, function (data) {
                    Swal.fire(
                        'Deleted!',
                        'Delete successfully.',
                        'success'
                    ).then(() => {
                        window.location.reload();
                    });
                }).fail(function (data) {
                    Swal.fire(
                        'Deleted fail',
                        'Something went wrong.',
                        'error'
                    )
                }).done(function (data) {

                });
            }
        })
    });

    $(document).on('click', ".manage_status_btn", function (e) {
        e.preventDefault();
        var id = $(this).data('id');
        var type = $(this).data('type');
        var action = $(this).data('action');
        var message = '';
        if (action === 'active') {
            message = 'You want to Activate?';
        } else {
            message = 'You want to Deactivate?';
        }
        Swal.fire({
            title: 'Are you sure? ' + message,
            //text: "This action cannot be undone",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes!'
        }).then((result) => {
            if (result.value) {
                Swal.fire({
                    title: "Processing...",
                    text: "Please wait",
                    showConfirmButton: false,
                    allowOutsideClick: false,
                    timer: 20000,
                });
                $.post(getUrl('/ajax/status/' + type + '/' + id + '/' + action), function (data) {
                    if (data.error == 0) {
                        Swal.fire(
                            'Success!',
                            data.message,
                            'success'
                        ).then(() => {
                            window.location.reload();
                        });
                    } else {
                        Swal.fire(
                            'Error',
                            data.message,
                            'error'
                        )
                    }
                }).fail(function (data) {
                    Swal.fire(
                        'Fail',
                        'Something went wrong.',
                        'error'
                    )
                }).done(function (data) {

                });
            }
        })
    });

    if ($.isFunction($.fn.dataTable)) {
        $.extend(true, $.fn.dataTable.defaults, {
            "lengthMenu": [
                [10, 25, 50, 100, -1],
                [10, 25, 50, 100, "All"] // change per page values here
            ],
            pageLength: 10
        });
    }

    if ($.isFunction($.datepicker)) {
        $.datepicker.setDefaults({
            dateFormat: 'yy-mm-dd'
        });
    }

    /*if ($(window).width() <= 1086) {
        $(".dashboard-page").addClass('sb-l-m');
    } else {
        $(".dashboard-page").addClass('sb-l-o');
    }*/

    /** added 2506020 */
    /*$(document).on('input', '.number-separator', function (e) {
        if (/^[0-9.,]+$/.test($(this).val())) {
            $(this).val(
                parseFloat($(this).val().replace(/,/g, '')).toLocaleString('en')
            );
        } else {
            $(this).val(
                $(this)
                    .val()
                    .substring(0, $(this).val().length - 1)
            );
        }
    });

    $('.number-separator').trigger('input');

    $(document).on('change', 'input', function (e) {
        setTimeout(function () {
            console.log('trigger number-separator');
            $('.number-separator').trigger('input');
        }, 0);

    });*/

});

// from dashboard
/*
$(function () {
    'use strict'

    // FOR DEMO ONLY
    // menu collapsed by default during first page load or refresh with screen
    // having a size between 992px and 1299px. This is intended on this page only
    // for better viewing of widgets demo.
    $(window).resize(function () {
        minimizeMenu();
    });

    minimizeMenu();

    function minimizeMenu() {
        if (window.matchMedia('(min-width: 992px)').matches && window.matchMedia('(max-width: 1299px)').matches) {
            // show only the icons and hide left menu label by default
            $('.menu-item-label,.menu-item-arrow').addClass('op-lg-0-force d-lg-none');
            $('body').addClass('collapsed-menu');
            $('.show-sub + .br-menu-sub').slideUp();
        } else if (window.matchMedia('(min-width: 1300px)').matches && !$('body').hasClass('collapsed-menu')) {
            $('.menu-item-label,.menu-item-arrow').removeClass('op-lg-0-force d-lg-none');
            $('body').removeClass('collapsed-menu');
            $('.show-sub + .br-menu-sub').slideDown();
        }
    }
});*/
