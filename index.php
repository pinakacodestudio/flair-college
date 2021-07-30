<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>FCMT College</title>

    <!-- Meta -->
    <meta name="description" content="Flair College of Management & Technology">
    <meta name="author" content="FCMT College">

    <!-- Favicons Icon -->
    <link rel="icon" href="favicon.png" type="image/x-icon"/>

    <!-- vendor css -->
    <link href="admin/assets/lib/font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="admin/assets/lib/Ionicons/css/ionicons.css" rel="stylesheet">
    <link href="admin/assets/lib/perfect-scrollbar/css/perfect-scrollbar.css" rel="stylesheet">
    <link href="admin/assets/lib/jquery-switchbutton/jquery.switchButton.css" rel="stylesheet">
    <link href="admin/assets/lib/rickshaw/rickshaw.min.css" rel="stylesheet">
    <link href="admin/assets/lib/sweetalert2/dist/sweetalert2.min.css" rel="stylesheet" type="text/css">
    <!--<link href="admin/assets/lib/chartist/chartist.css" rel="stylesheet">-->

    <!-- Bracket CSS -->
    <link rel="stylesheet" href="admin/assets/css/bracket.css">
    <style>
        .red {
            color: red;
        }
    </style>
</head>

<body>

<!-- ########## START: LEFT PANEL ########## -->
<!-- br-sideleft -->
<!-- ########## END: LEFT PANEL ########## -->

<!-- ########## START: HEAD PANEL ########## -->
<div class="ht-65 bd-b bg-gray-100 pd-x-20 d-flex align-items-center justify-content-start">
    <h4 class="mg-b-0 tx-uppercase_ tx-bold tx-spacing--2 tx-inverse mg-r-20 tx-poppins">FCMT College</h4>
    <ul class="nav nav-gray-600 active-info tx-uppercase tx-12 tx-medium tx-spacing-2 flex-column flex-sm-row"
        role="tablist">
        <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#" role="tab">Home</a></li>
        <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#" role="tab">About</a></li>
        <!--<li class="nav-item"><a class="nav-link" data-toggle="tab" href="#" role="tab">Services</a></li>-->
        <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#" role="tab">Contact</a></li>
    </ul>
    <div class="mg-l-auto">
        <!--<a href="" class="tx-gray-600 hover-dark tx-16"><i class="fa fa-search"></i></a>
        <a href="" class="tx-gray-600 hover-dark tx-16 mg-l-10"><i class="fa fa-facebook"></i></a>
        <a href="" class="tx-gray-600 hover-dark tx-16 mg-l-10"><i class="fa fa-twitter"></i></a>-->
    </div>
</div>
<!-- br-header -->
<!-- ########## END: HEAD PANEL ########## -->

<!-- ########## START: MAIN PANEL ########## -->
<div class="main-content">
    <section>
        <div class="container br-mainpanel_">
            <div class="pd-x-20 pd-sm-x-30 pd-t-20 pd-sm-t-30">
                <h4 class="tx-gray-800 mg-b-5 text-center">INTERNATIONAL STUDENTS APPLICATION FORM</h4>
                <!--<p class="mg-b-0">Do big things with Bracket, the responsive bootstrap 4 admin template.</p>-->
            </div>
            <!-- d-flex -->

            <div class="br-pagebody">
                <div class="br-section-wrapper pd-30">
                    <form autocomplete="off" id="form_student_application" method="post">
                        <div class="form-layout form-layout-1_">
                            <h6 class="tx-gray-800 tx-uppercase tx-bold tx-14 mg-b-10">Personal Details</h6>
                            <p class="mg-b-10 tx-gray-600">Name MUST be as it appears on Passport</p>

                            <div class="row mg-t-20">
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label class="form-control-label">First Name: <span
                                                    class="tx-danger">*</span></label>
                                        <input class="form-control" type="text" name="first_name" value=""
                                               placeholder="Enter first name">
                                    </div>
                                </div><!-- col-4 -->
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label class="form-control-label">Middle Name: <span
                                                    class="tx-danger">*</span></label>
                                        <input class="form-control" type="text" name="middle_name" value=""
                                               placeholder="Enter middle name">
                                    </div>
                                </div><!-- col-4 -->
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label class="form-control-label">Last Name: <span
                                                    class="tx-danger">*</span></label>
                                        <input class="form-control" type="text" name="last_name" value=""
                                               placeholder="Enter family name">
                                    </div>
                                </div><!-- col-4 -->
                            </div>
                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label class="form-control-label">Email address: <span
                                                    class="tx-danger">*</span></label>
                                        <input class="form-control" type="text" name="email" value=""
                                               placeholder="Enter email address">
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group mg-b-10-force">
                                        <label class="form-control-label">Country of Citizenship: <span
                                                    class="tx-danger">*</span></label>
                                        <input class="form-control" type="text" name="country_of_citizenship"
                                               maxlength="50"
                                               value="" placeholder="Enter country of citizenship">
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group mg-b-10-force">
                                        <label class="form-control-label">Passport Number: <span
                                                    class="tx-danger">*</span></label>
                                        <input class="form-control" type="text" name="passport_number"
                                               maxlength="30"
                                               value="" placeholder="Enter passport number">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label class="form-control-label">Gender: <span
                                                    class="tx-danger">*</span></label>
                                        <select class="form-control select2__" name="gender" id="gender"
                                                data-placeholder="Choose gender">
                                            <option label="Choose gender"></option>
                                            <option value="male">Male</option>
                                            <option value="female">Female</option>
                                            <option value="undeclared">Undeclared</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group mg-b-10-force">
                                        <label class="form-control-label">Date of Birth: <span
                                                    class="tx-danger">*</span></label>
                                        <input class="form-control fc-datepicker" type="text" name="dob"
                                               value="" placeholder="Select date of birth">
                                    </div>
                                </div>

                                <!--<div class="col-lg-6">
                                    <div class="form-group mg-b-10-force">
                                        <label class="form-control-label">Country: <span class="tx-danger">*</span></label>
                                        <select class="form-control select2" data-placeholder="Choose country">
                                            <option label="Choose country"></option>
                                            <option value="USA">United States of America</option>
                                            <option value="UK">United Kingdom</option>
                                            <option value="China">China</option>
                                            <option value="Japan">Japan</option>
                                        </select>
                                    </div>
                                </div>-->
                            </div>

                            <div class="row mg-t-10">
                                <div class="col-lg-12">
                                    <div class="form-group mg-b-10-force">
                                        <label class="form-control-label">Address in Home country: <span
                                                    class="tx-danger">*</span></label>
                                        <input class="form-control" type="text" name="home_address"
                                               value="" placeholder="Enter address in home country">
                                    </div>
                                </div>

                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label class="form-control-label">Postal Code: <span
                                                    class="tx-danger">*</span></label>
                                        <input class="form-control" type="text" name="home_postcode" value=""
                                               maxlength="20"
                                               placeholder="Enter Postal Code">
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group mg-b-10-force">
                                        <label class="form-control-label">Country: <span
                                                    class="tx-danger">*</span></label>
                                        <input class="form-control" type="text" name="home_country"
                                               maxlength="50"
                                               value="" placeholder="Enter country">
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group mg-b-10-force">
                                        <label class="form-control-label">Home Country Telephone Number: <span
                                                    class="tx-danger">*</span></label>
                                        <input class="form-control" type="text" name="home_phone"
                                               maxlength="20"
                                               value="" placeholder="Enter home country telephone number">
                                    </div>
                                </div>
                            </div>

                            <div class="row mg-t-10">
                                <div class="col-lg-8">
                                    <div class="form-group mg-b-10-force">
                                        <label class="form-control-label">Address in Canada (If In Canada): </label>
                                        <input class="form-control" type="text" name="secondary_address"
                                               value="" placeholder="Enter address in canada">
                                    </div>
                                </div>

                                <div class="col-lg-4">
                                    <div class="form-group mg-b-10-force">
                                        <label class="form-control-label">City: </label>
                                        <input class="form-control" type="text" name="secondary_city"
                                               maxlength="50"
                                               value="" placeholder="Enter city">
                                    </div>
                                </div>

                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label class="form-control-label">Postal Code: </label>
                                        <input class="form-control" type="text" name="secondary_postcode" value=""
                                               maxlength="20"
                                               placeholder="Enter Postal Code">
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group mg-b-10-force">
                                        <label class="form-control-label">Province: </label>
                                        <input class="form-control" type="text" name="secondary_province"
                                               maxlength="50"
                                               value="" placeholder="Enter Province">
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group mg-b-10-force">
                                        <label class="form-control-label">Telephone Number: </label>
                                        <input class="form-control" type="text" name="secondary_phone"
                                               maxlength="20"
                                               value="" placeholder="Enter telephone number">
                                    </div>
                                </div>
                            </div>

                            <h6 class="tx-gray-800 tx-uppercase tx-bold tx-14 mg-t-20">Agent OR Representative
                                Information</h6>
                            <!--<p class="mg-b-10 tx-gray-600"></p>-->

                            <div class="row mg-t-20">
                                <div class="col-lg-12">
                                    <label class="ckbox">
                                        <input type="checkbox" name="is_agent" id="is_agent" value="1"><span>Are you using an Agent or Someone else as a representative for this application?</span>
                                    </label>
                                </div>
                                <div class="col-lg-12 is_agent_block" style="display: none;">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group mg-b-10-force">
                                                <label class="form-control-label">Agent Name / Agent Company
                                                    Name: </label>
                                                <input class="form-control" type="text" name="agent_name"
                                                       value="" placeholder="Enter agent name / agent company name">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <h6 class="tx-gray-800 tx-uppercase tx-bold tx-14 mg-t-20">Education qualification</h6>
                            <!--<p class="mg-b-10 tx-gray-600"></p>-->

                            <div class="row mg-t-10">
                                <div class="col-lg-8">
                                    <div class="form-group mg-b-10-force">
                                        <label class="form-control-label">Highest Academic Qualification Completed:
                                            <span
                                                    class="tx-danger">*</span></label>
                                        <input class="form-control" type="text" name="academic_qualification_name"
                                               value="" placeholder="Enter academic name">
                                    </div>
                                </div>

                                <div class="col-lg-4">
                                    <div class="form-group mg-b-10-force">
                                        <label class="form-control-label">Year Completed: <span
                                                    class="tx-danger">*</span></label>
                                        <input class="form-control" type="text" name="academic_qualification_year"
                                               maxlength="10"
                                               value="" placeholder="Enter year completed">
                                    </div>
                                </div>

                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label class="form-control-label">Is English your first language? <span
                                                    class="tx-danger">*</span></label>
                                        <div>
                                            <label class="rdiobox rdiobox-inline">
                                                <input name="is_english_first_language" type="radio" value="1"
                                                       checked="checked">
                                                <span>Yes</span>
                                            </label>
                                            <label class="rdiobox rdiobox-inline mg-l-15">
                                                <input name="is_english_first_language" type="radio" value="0">
                                                <span>No</span>
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-8">
                                    <div class="form-group">
                                        <label class="form-control-label">If NO, Have you taken any English Tests (i.e.,
                                            IELTS, TOEFL, CAEL)</label>
                                        <div>
                                            <label class="rdiobox rdiobox-inline">
                                                <input name="is_english_test_given" class="is_english_test_given"
                                                       type="radio" value="1" checked="checked">
                                                <span>Yes</span>
                                            </label>
                                            <label class="rdiobox rdiobox-inline mg-l-15">
                                                <input name="is_english_test_given" class="is_english_test_given"
                                                       type="radio" value="0">
                                                <span>No</span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12 is_english_test_given_block" style="display: block;">
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <div class="form-group mg-b-10-force">
                                                <label class="form-control-label">Name of English Test Taken:</label>
                                                <input class="form-control" type="text" name="english_test_name"
                                                       value="" placeholder="Enter name of english test taken">
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="form-group mg-b-10-force">
                                                <label class="form-control-label">English Test Score:</label>
                                                <input class="form-control" type="text" name="english_test_score"
                                                       maxlength="10"
                                                       value="" placeholder="Enter english test score">
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="form-group mg-b-10-force">
                                                <label class="form-control-label">Date Test Taken:</label>
                                                <input class="form-control fc-datepicker" type="text"
                                                       name="english_test_date"
                                                       value="" placeholder="Enter date test taken">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <h6 class="tx-gray-800 tx-uppercase tx-bold tx-14 mg-t-20 mg-b-10">Postsecondary
                                Program</h6>
                            <p class="mg-b-10 tx-gray-600">Please Choose the program you are interested in</p>

                            <div class="row mg-t-20" id="programs">

                            </div>

                            <h6 class="tx-gray-800 tx-uppercase tx-bold tx-14 mg-t-20">Please Select the Intake you are
                                Interested In.</h6>
                            <!--<p class="mg-b-10 tx-gray-600"></p>-->

                            <div class="row mg-t-20" id="intakes">

                            </div>

                            <h6 class="tx-gray-800 tx-uppercase tx-bold tx-14 mg-t-20">Document Checklist: Please submit
                                the following applicable documents:</h6>
                            <!--<p class="mg-b-10 tx-gray-600"></p>-->
                            <div class="row mg-t-10">
                                <div class="col-lg-12">
                                    <ul>
                                        <li>Completed and Signed “International Students Application Form</li>
                                        <li>English Language Test Result Sheet</li>
                                        <li>Certified copies of Academic Qualification/s</li>
                                        <li>For documents not in English, certified Translated copies</li>
                                        <li>Non-Refundable Application Fee</li>
                                    </ul>
                                </div>
                            </div>
                            <h6 class="tx-gray-800 tx-uppercase tx-bold tx-14 mg-t-20">Declaration</h6>
                            <!--<p class="mg-b-10 tx-gray-600">IN SIGNING THIS APPLICATION FOR ENROLMENT:</p>-->
                            <div class="row mg-t-10">
                                <div class="col-lg-12">
                                    <p class="mg-b-10 tx-light">I declare that the information contained in this
                                        application is
                                        true and valid. I authorize Flair College to release and obtain information
                                        related to
                                        study permit from Citizenship and Immigration Canada. I have read and understood
                                        the
                                        terms and conditions of Enrolment, and the Postsecondary Program information
                                        that I am
                                        seeking admission into. I understand that it is mandatory to inform the college
                                        about
                                        any change in my personal information within 7 days of occurring that includes
                                        phone
                                        number, email address and mailing address. I have the financial capacity to meet
                                        tuition
                                        fees and agree to pay fees as they become due.</p>
                                    <label class="ckbox">
                                        <input name="i_agreed" class="i_agreed" id="i_agreed"
                                               type="checkbox" value="1">
                                        <span>I agreed above declaration</span>
                                    </label>
                                </div>
                            </div>

                            <div class="form-layout-footer text-right mg-t-25">
                                <button class="btn btn-info" id="submit_btn" disabled="disabled">Submit</button>
                                <!--<button class="btn btn-secondary">Cancel</button>-->
                            </div><!-- form-layout-footer -->
                        </div><!-- form-layout -->
                    </form>
                </div><!-- br-section-wrapper -->
            </div><!-- br-pagebody -->

            <footer class="br-footer">
                <div class="footer-left">
                    <div class="mg-b-2">Copyright ©<?php echo date('Y') ?> FCMT Collage. All Rights Reserved</div>
                    <!--<div></div>-->
                </div>
                <div class="footer-right d-flex align-items-center">
                    <!--<span class="tx-uppercase mg-r-10">Share:</span>-->
                    <a target="_blank" class="pd-x-5"
                       href="https://www.facebook.com/"><i
                                class="fa fa-facebook tx-20"></i></a>
                    <a target="_blank" class="pd-x-5"
                       href="https://twitter.com/"><i
                                class="fa fa-twitter tx-20"></i></a>
                </div>
            </footer>
        </div>
        <!-- container -->
    </section>
</div>
<!-- ########## END: MAIN PANEL ########## -->

<script src="admin/assets/lib/jquery/jquery.js"></script>
<script src="admin/assets/lib/popper.js/popper.js"></script>
<script src="admin/assets/lib/bootstrap/bootstrap.js"></script>
<script src="admin/assets/lib/perfect-scrollbar/js/perfect-scrollbar.jquery.js"></script>
<script src="admin/assets/lib/moment/moment.js"></script>
<script src="admin/assets/lib/jquery-ui/jquery-ui.js"></script>
<script src="admin/assets/lib/jquery-switchbutton/jquery.switchButton.js"></script>
<script src="admin/assets/lib/peity/jquery.peity.js"></script>
<!--<script src="admin/assets/lib/chartist/chartist.js"></script>-->
<script src="admin/assets/lib/jquery.sparkline.bower/jquery.sparkline.min.js"></script>
<script src="admin/assets/lib/d3/d3.js"></script>
<script src="admin/assets/lib/rickshaw/rickshaw.min.js"></script>
<script src="admin/assets/lib/sweetalert2/dist/sweetalert2.js"></script>
<!--<script src="admin/assets/js/bracket.js"></script>-->
<script src="admin/assets/js/ResizeSensor.js"></script>
<!--<script src="admin/assets/js/dashboard.js"></script>-->
<script>
    function loadIntakes() {
        $.getJSON('admin/api-request/intakes', {}, function (data) {
            console.log('data', data);
            var intakesHtml = '';
            var intakes = data.intakes;
            if (data.error == 0 && Object.keys(intakes).length > 0) {
                for (var i in intakes) {
                    var intake = intakes[i];

                    intakesHtml += '<div class="col-lg-2">' +
                        '<label class="ckbox">' +
                        '<input type="checkbox" name="intakes[' + i + ']" id="intakes_' + i + '" value="' + i + '"><span>' + intake + '</span>' +
                        '</label>' +
                        '</div>';
                }
            } else {
                intakesHtml = '<div class="col-md-12 red">No Intakes Found</div>';
            }
            $("#intakes").html(intakesHtml);
        });
    }

    function loadPrograms() {
        $.getJSON('admin/api-request/programs', {}, function (data) {
            console.log('data', data);
            var programsHtml = '';
            var programs = data.programs;
            if (data.error == 0 && Object.keys(programs).length > 0) {
                for (var i in programs) {
                    var program = programs[i];

                    programsHtml += '<div class="col-lg-6">' +
                        '<label class="ckbox">' +
                        '<input type="checkbox" name="programs[' + i + ']" id="programs_' + i + '" value="' + i + '"><span>' + program + '</span>' +
                        '</label>' +
                        '</div>';
                }
            } else {
                programsHtml = '<div class="col-md-12 red">No Programs Found</div>';
            }
            $("#programs").html(programsHtml);
        });
    }

    $(document).ready(function () {
        'use strict';

        $("#form_student_application").on('submit', function (e) {
            e.preventDefault();
            Swal.fire({
                title: "Processing...",
                text: "Please wait",
                showConfirmButton: false,
                allowOutsideClick: false,
                timer: 20000,
            });
            $.post('admin/api-request/saveApplication', $(this).serialize(), function (res) {
                console.log(res);
                if (res.error == 1) {
                    Swal.fire(
                        'Invalid request data',
                        res.message,
                        'error'
                    );
                } else {
                    Swal.fire(
                        'Application sent successfully',
                        res.message,
                        'success'
                    ).then(function () {
                        window.location.reload();
                    });
                }
                //alert('Application sent successfully');
            }).always(function () {
                //Swal.close();
            });
        });

        // Datepicker
        $('.fc-datepicker').datepicker({
            dateFormat: 'yy-mm-dd',
            //showOtherMonths: true,
            //selectOtherMonths: true
        });

        $("#is_agent").on('change', function (e) {
            //e.preventDefault();
            if ($(this).is(':checked')) {
                $(".is_agent_block").show();
            } else {
                $(".is_agent_block").hide();
            }
        });

        $("#i_agreed").on('change', function (e) {
            //e.preventDefault();
            if ($(this).is(':checked')) {
                $("#submit_btn").removeAttr('disabled');
            } else {
                $("#submit_btn").attr('disabled', 'disabled');
            }
        });

        $(".is_english_test_given").on('click', function (e) {
            //e.preventDefault();

            if ($(this).val() == 1) {
                $(".is_english_test_given_block").show();
            } else {
                $(".is_english_test_given_block").hide();
            }
        });

        loadIntakes();
        loadPrograms();
    });
</script>
</body>
</html>
