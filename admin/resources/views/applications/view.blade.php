@extends('layouts.app')

@section('title', 'Student Application')

@section('stylesheet')
    <link href="{!! asset('assets/lib/select2/css/select2.min.css') !!}" rel="stylesheet">
    <style>
        input[type="checkbox"][readonly] {
            pointer-events: none;
        }
    </style>
@endsection
@section('content')
    <div class="pd-x-15 pd-t-15">
        <h3 class="tx-gray-800 mg-b-10">Student Application - {!! $students_application->application_no !!}
            @if($students_application->admission_status > App\Helpers\Constant::ADMISSION_STATUS_PENDING)
                <div class="dropdown pull-right" style="display: block;">
                    <a href="" class="btn btn-outline-info btn-sm_ " data-toggle="dropdown" aria-expanded="false">
                        <i class="icon ion-plus"></i> Payment
                    </a>
                    <div class="dropdown-menu dropdown-menu-header pd-0-force">
                        <a href="{!! route('applications.payments',['id'=>$students_application->id]) !!}"
                           class="media-list-link">
                            <div class="media pd-x-20 pd-y-15">
                                <p class="mg-b-0 tx-medium tx-gray-800 tx-14">
                                    <i class="fa fa-check-circle-o"></i> Payment</p>
                            </div>
                        </a>
                        <a href="{!! route('applications.refunds',['id'=>$students_application->id]) !!}"
                           class="media-list-link">
                            <div class="media pd-x-20 pd-y-15">
                                <p class="mg-b-0 tx-medium tx-gray-800 tx-14">
                                    <i class="fa fa-undo"></i> Refund</p>
                            </div>
                        </a>
                    </div><!-- dropdown-menu -->
                </div>
            @endif
        </h3>
    </div>

    <div class="br-pagebody">
        <div class="br-section-wrapper pd-20">

            @include('includes/messages')

            {{--<h6 class="tx-gray-800 tx-uppercase tx-bold  mg-b-20">Application Form</h6>--}}
            {{--<p class="mg-b-25 mg-lg-b-50">Searching, ordering and paging goodness will be immediately added to the
                table, as shown in this example.</p>--}}

            <form autocomplete="off" id="form_student_application" method="post">
                <input type="hidden" name="application_id" id="application_id"
                       value="{!! $students_application->id !!}">
                <div class="form-layout form-layout-1_">
                    <div class="row mg-t-20_">
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="form-control-label">Family Name: <span
                                            class="tx-danger">*</span></label>
                                <input class="form-control" type="text" name="last_name"
                                       value="{!! $students_application->last_name !!}"
                                       placeholder="Enter family name">
                            </div>
                        </div><!-- col-4 -->
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="form-control-label">First Name: <span
                                            class="tx-danger">*</span></label>
                                <input class="form-control" type="text" name="first_name"
                                       value="{!! $students_application->first_name !!}"
                                       placeholder="Enter first name">
                            </div>
                        </div><!-- col-4 -->
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="form-control-label">Middle Name: <span
                                            class="tx-danger">*</span></label>
                                <input class="form-control" type="text" name="middle_name"
                                       value="{!! $students_application->middle_name !!}"
                                       placeholder="Enter middle name">
                            </div>
                        </div><!-- col-4 -->

                    </div>
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="form-control-label">Email address: <span
                                            class="tx-danger">*</span></label>
                                <input class="form-control" type="text" name="email"
                                       value="{!! $students_application->email !!}"
                                       placeholder="Enter email address">
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group mg-b-10-force">
                                <label class="form-control-label">Country of Citizenship: <span
                                            class="tx-danger">*</span></label>
                                <input class="form-control" type="text" name="country_of_citizenship"
                                       value="{!! $students_application->country_of_citizenship !!}"
                                       placeholder="Enter country of citizenship">
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group mg-b-10-force">
                                <label class="form-control-label">Passport Number: <span
                                            class="tx-danger">*</span></label>
                                <input class="form-control" type="text" name="passport_number"
                                       value="{!! $students_application->passport_number !!}"
                                       placeholder="Enter passport number">
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
                                    <option {!! $students_application->gender=='male'?'selected="selected"':'' !!} value="male">
                                        Male
                                    </option>
                                    <option {!! $students_application->gender=='female'?'selected="selected"':'' !!} value="female">
                                        Female
                                    </option>
                                    <option {!! $students_application->gender=='undeclared'?'selected="selected"':'' !!} value="undeclared">
                                        Undeclared
                                    </option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group mg-b-10-force">
                                <label class="form-control-label">Date of Birth: <span
                                            class="tx-danger">*</span></label>
                                <input class="form-control fc-datepicker" type="text" name="dob"
                                       value="{!! $students_application->dob ? $students_application->dob->format('Y-m-d') :'' !!}"
                                       placeholder="Select date of birth">
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
                                       value="{!! $students_application->home_address !!}"
                                       placeholder="Enter address in home country">
                            </div>
                        </div>

                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="form-control-label">Postal Code: <span
                                            class="tx-danger">*</span></label>
                                <input class="form-control" type="text" name="home_postcode"
                                       value="{!! $students_application->home_postcode !!}"
                                       placeholder="Enter Postal Code">
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group mg-b-10-force">
                                <label class="form-control-label">Country: <span
                                            class="tx-danger">*</span></label>
                                <input class="form-control" type="text" name="home_country"
                                       value="{!! $students_application->home_country !!}" placeholder="Enter country">
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group mg-b-10-force">
                                <label class="form-control-label">Home Country Telephone Number: <span
                                            class="tx-danger">*</span></label>
                                <input class="form-control" type="text" name="home_phone"
                                       value="{!! $students_application->home_phone !!}"
                                       placeholder="Enter home country telephone number">
                            </div>
                        </div>
                    </div>

                    <div class="row mg-t-10">
                        <div class="col-lg-8">
                            <div class="form-group mg-b-10-force">
                                <label class="form-control-label">Address in Canada (If In Canada): </label>
                                <input class="form-control" type="text" name="secondary_address"
                                       value="{!! $students_application->secondary_address !!}"
                                       placeholder="Enter address in canada">
                            </div>
                        </div>

                        <div class="col-lg-4">
                            <div class="form-group mg-b-10-force">
                                <label class="form-control-label">City: </label>
                                <input class="form-control" type="text" name="secondary_city"
                                       value="{!! $students_application->secondary_city !!}" placeholder="Enter city">
                            </div>
                        </div>

                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="form-control-label">Postal Code: </label>
                                <input class="form-control" type="text" name="secondary_postcode"
                                       value="{!! $students_application->secondary_postcode !!}"
                                       placeholder="Enter Postal Code">
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group mg-b-10-force">
                                <label class="form-control-label">Province: </label>
                                <input class="form-control" type="text" name="secondary_province"
                                       value="{!! $students_application->secondary_province !!}"
                                       placeholder="Enter Province">
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group mg-b-10-force">
                                <label class="form-control-label">Telephone Number: </label>
                                <input class="form-control" type="text" name="secondary_phone"
                                       value="{!! $students_application->secondary_phone !!}"
                                       placeholder="Enter telephone number">
                            </div>
                        </div>
                    </div>

                    <h6 class="tx-gray-800 tx-uppercase tx-bold tx-14 mg-t-20">Agent OR Representative
                        Information</h6>
                    <!--<p class="mg-b-10 tx-gray-600"></p>-->

                    <div class="row mg-t-20">
                        <div class="col-lg-12">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group mg-b-10-force">
                                        <label class="form-control-label">Agent Name / Agent Company
                                            Name: </label>
                                        <input class="form-control" type="text" name="agent_name"
                                               value="{!! $students_application->agent_name !!}"
                                               placeholder="Enter agent name / agent company name">
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
                                       value="{!! $students_application->academic_qualification_name !!}"
                                       placeholder="Enter academic name">
                            </div>
                        </div>

                        <div class="col-lg-4">
                            <div class="form-group mg-b-10-force">
                                <label class="form-control-label">Year Completed: <span
                                            class="tx-danger">*</span></label>
                                <input class="form-control" type="text" name="academic_qualification_year"
                                       value="{!! $students_application->academic_qualification_year !!}"
                                       placeholder="Enter year completed">
                            </div>
                        </div>

                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="form-control-label">Is English your first language? <span
                                            class="tx-danger">*</span></label>
                                <div>
                                    <label class="rdiobox rdiobox-inline">
                                        <input name="is_english_first_language" type="radio" value="1"
                                                {!! $students_application->is_english_first_language==1?'checked="checked"':'' !!}>
                                        <span>Yes</span>
                                    </label>
                                    <label class="rdiobox rdiobox-inline mg-l-15">
                                        <input name="is_english_first_language" type="radio" value="0"
                                                {!! $students_application->is_english_first_language==0?'checked="checked"':'' !!}>
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
                                               type="radio" value="1"
                                                {!! $students_application->is_english_test_given==1?'checked="checked"':'' !!}>
                                        <span>Yes</span>
                                    </label>
                                    <label class="rdiobox rdiobox-inline mg-l-15">
                                        <input name="is_english_test_given" class="is_english_test_given"
                                               type="radio"
                                               value="0" {!! $students_application->is_english_test_given==0?'checked="checked"':'' !!}>
                                        <span>No</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12 is_english_test_given_block" style="display: block;">
                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="form-group mg-b-10-force">
                                        <label class="form-control-label">Name of English Test Taken: <span
                                                    class="tx-danger">*</span></label>
                                        <input class="form-control" type="text" name="english_test_name"
                                               value="{!! $students_application->english_test_name !!}"
                                               placeholder="Enter name of english test taken">
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group mg-b-10-force">
                                        <label class="form-control-label">English Test Score: <span
                                                    class="tx-danger">*</span></label>
                                        <input class="form-control" type="text" name="english_test_score"
                                               value="{!! $students_application->english_test_score !!}"
                                               placeholder="Enter english test score">
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group mg-b-10-force">
                                        <label class="form-control-label">Date Test Taken: <span
                                                    class="tx-danger">*</span></label>
                                        <input class="form-control fc-datepicker" type="text" name="english_test_date"
                                               value="{!! $students_application->english_test_date !!}"
                                               placeholder="Enter date test taken">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <h6 class="tx-gray-800 tx-uppercase tx-bold tx-14 mg-t-20 mg-b-10">Postsecondary
                        Program</h6>
                    <p class="mg-b-10 tx-gray-600">Selected programs interested in</p>

                    <div class="row mg-t-20" id="programs">
                        @foreach($programs as $program_arr)
                            <div class="col-lg-4">
                                <label class="ckbox">
                                    <input type="checkbox" name="programs[{!! $program_arr->id !!}]"
                                           id="programs_{!! $program_arr->id !!}"
                                           value="{!! $program_arr->id !!}"

                                            {!! ($students_application->admission_status == App\Helpers\Constant::ADMISSION_STATUS_FINAL_LOA)?'disabled="disabled"':'' !!}
                                            {!! in_array($program_arr->id, $programs_ids)?'checked="checked"':'' !!}>
                                    <span>{!! $program_arr->name !!}</span>
                                </label>
                            </div>
                        @endforeach
                        {{--<div class="col-lg-6">
                            <label class="ckbox">
                                <input type="checkbox"
                                       checked="checked"
                                       name="program"><span>Diploma in Business Management</span>
                            </label>
                        </div>--}}

                    </div>

                    <h6 class="tx-gray-800 tx-uppercase tx-bold tx-14 mg-t-20">Selected Intakes interested in</h6>
                    <!--<p class="mg-b-10 tx-gray-600"></p>-->

                    <div class="row mg-t-20" id="intakes">
                        @foreach($intakes as $id=>$intake)
                            <div class="col-lg-2">
                                <label class="ckbox">
                                    <input type="checkbox" name="intakes[{!! $id !!}]"
                                           id="intakes_{!! $id !!}"
                                           value="{!! $id !!}"
                                            {!! ($students_application->admission_status == App\Helpers\Constant::ADMISSION_STATUS_FINAL_LOA)?'disabled="disabled"':'' !!}
                                            {!! in_array($id, $intake_ids)?'checked="checked"':'' !!}>
                                    <span>{!! $intake !!}</span>
                                </label>
                            </div>
                        @endforeach
                    </div>

                    @if($students_application->updated_user_id)
                        <div class="row mg-t-20">
                            <div class="col-md-12 text-right">
                                Last edited at
                                <strong>{!! $students_application->updated_at->format('M d, Y h:i A') !!}</strong> by
                                <strong>{!! $updated_user->full_name !!}</strong>
                            </div>
                        </div>
                    @endif

                    <div class="form-layout-footer text-right mg-t-25">
                        @if($students_application->admission_status == App\Helpers\Constant::ADMISSION_STATUS_PENDING)
                            <button type="button" class="btn btn-outline-success" id="generate_conditional_loa_btn">
                                Generate Conditional LOA
                            </button>
                        @elseif($students_application->admission_status == App\Helpers\Constant::ADMISSION_STATUS_CONDITIONAL_LOA)
                            <a href="{!! route('applications.download_conditional_loa',['id'=>$students_application->id]) !!}"
                               class="btn btn-outline-success" id="download_conditional_loa_btn">
                                <i class="fa fa-download"></i> Download Conditional LOA
                            </a>
                            <button type="button" class="btn btn-outline-warning" id="verify_conditional_loa_btn">
                                <i class="fa fa-upload"></i> Upload Signed Conditional LOA
                            </button>
                        @elseif($students_application->admission_status == App\Helpers\Constant::ADMISSION_STATUS_PENDING_FINAL_LOA)
                            <a href="{!! route('applications.download_signed_conditional_loa',['id'=>$students_application->id]) !!}"
                               class="btn btn-outline-warning" id="download_signed_conditional_loa_btn">
                                <i class="fa fa-download"></i> Download Signed Conditional LOA
                            </a>
                            @if($student_admission && $program)
                                <a href="javascript:" class="btn btn-outline-success" id="generate_final_loa_btn">
                                    Generate Final LOA
                                </a>
                            @endif
                        @elseif($students_application->admission_status == App\Helpers\Constant::ADMISSION_STATUS_FINAL_LOA)
                            <a href="{!! route('applications.download_final_loa',['id'=>$students_application->id]) !!}"
                               class="btn btn-outline-success" id="download_final_loa_btn">
                                <i class="fa fa-download"></i> Download Final LOA
                            </a>
                        @endif
                        <button type="submit" class="btn btn-info" id="submit_btn" disabled1="disabled">Save</button>
                        <a class="btn btn-danger" href="{!! route('applications') !!}">Cancel</a>
                    </div><!-- form-layout-footer -->
                </div><!-- form-layout -->
            </form>
        </div><!-- br-section-wrapper -->
    </div><!-- br-pagebody -->


    @if($students_application->admission_status == App\Helpers\Constant::ADMISSION_STATUS_PENDING)
        <div id="generateConditionalLoaModal" class="modal fade">
            <div class="modal-dialog modal-lg mn-wd-md-50p" role="document">
                <div class="modal-content tx-size-sm">
                    <form autocomplete="off" id="form_generate_conditional_loa" method="post">

                        <input type="hidden" name="loa_type" id="loa_type" value="generate"/>
                        <div class="modal-header pd-x-20">
                            <h6 class="tx-14 mg-b-0 tx-uppercase tx-inverse tx-bold">Generate Conditional LOA</h6>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body pd-20">
                            <h6 class="lh-3 mg-b-10">PROGRAM INFORMATION</h6>

                            <div class="form-group">
                                <label class="form-control-label">Select program: <span
                                            class="tx-danger">*</span></label>
                                <select class="form-control select2__" name="program_id" id="program_id"
                                        data-placeholder="Choose program">
                                    <option label="Choose program"></option>
                                    @foreach($programs as $program_arr)
                                        @if(in_array($program_arr->id,$programs_ids))
                                            <option value="{!! $program_arr->id !!}"
                                                    data-cost="{!! $program_arr->total_fees !!}">{!! $program_arr->name !!}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="form-control-label">Select program intake: <span
                                            class="tx-danger">*</span></label>
                                <select class="form-control select2__" name="intake_id" id="intake_id"
                                        data-placeholder="Choose program intake">
                                    <option label="Choose program"></option>
                                </select>
                            </div>

                            <div class="form-group">
                                Level of Study : <strong class="level_of_study">-</strong>
                            </div>
                            <div class="form-group">
                                Type of Program : <strong class="type_of_program">-</strong>
                            </div>
                            <div class="form-group">
                                Academic Status : <strong class="academic_status">-</strong>
                            </div>
                            <div class="form-group">
                                Hours of Instruction Per Week : <strong class="hours_per_week">-</strong>
                            </div>
                            <div class="form-group">
                                Program Start Date : <strong class="program_start_date">-</strong>
                            </div>
                            <div class="form-group">
                                Expected Completion Date : <strong class="program_end_date">-</strong>
                            </div>
                            <div class="form-group">
                                Program Duration : <strong class="program_duration">-</strong>
                            </div>
                            <div class="form-group">
                                Total Fees (All Fees in CAD) : <strong class="program_total_fees">-</strong>
                            </div>

                            <label class="mg-t-20 ckbox">
                                <input name="doc_verified" class="doc_verified" id="doc_verified"
                                       type="checkbox" value="1">
                                <span>Student application and documents are verified</span>
                            </label>
                        </div><!-- modal-body -->
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary tx-size-xs submit_ola_btn"
                                    disabled="disabled">Generate Conditional LOA
                            </button>
                            <button type="button" class="btn btn-secondary tx-size-xs" data-dismiss="modal">Close
                            </button>
                        </div>
                    </form>
                </div>
            </div><!-- modal-dialog -->
        </div><!-- modal -->

    @elseif($students_application->admission_status == App\Helpers\Constant::ADMISSION_STATUS_CONDITIONAL_LOA)
        <div id="verifyConditionalLoaModal" class="modal fade">
            <div class="modal-dialog modal-lg mn-wd-md-50p" role="document">
                <div class="modal-content tx-size-sm">
                    <form autocomplete="off" id="form_verify_conditional_loa" class="" method="post">
                        <div class="modal-header pd-x-20">
                            <h6 class="tx-14 mg-b-0 tx-uppercase tx-inverse tx-bold">Upload Signed Conditional LOA</h6>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body pd-20">
                            <h6 class="lh-3 mg-b-10">UPLOAD SIGNED CONDITIONAL LOA</h6>

                            <div class="form-group">
                                <label class="form-control-label">Select signed Conditional LOA Pdf file: <span
                                            class="tx-danger">*</span></label>
                                <div class="custom-file" style="display: block;">
                                    <input type="file" id="signed_conditional_loa"
                                           name="signed_conditional_loa"
                                           accept="application/pdf" class="custom-file-input"
                                           style="width: 100%;">
                                    <span class="custom-file-control"></span>
                                </div>
                            </div>

                            <label class="mg-t-20 ckbox">
                                <input name="doc_verified" class="doc_verified" id="doc_verified"
                                       type="checkbox" value="1">
                                <span>Student application and documents are verified</span>
                            </label>
                        </div><!-- modal-body -->
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary tx-size-xs submit_ola_btn"
                                    disabled="disabled">Verify Conditional LOA
                            </button>
                            <button type="button" class="btn btn-secondary tx-size-xs" data-dismiss="modal">Close
                            </button>
                        </div>
                    </form>
                </div>
            </div><!-- modal-dialog -->
        </div><!-- modal -->

    @elseif($students_application->admission_status == App\Helpers\Constant::ADMISSION_STATUS_PENDING_FINAL_LOA)
        @if($student_admission && $program)
            <div id="generateFinalLoaModal" class="modal fade">
                <div class="modal-dialog modal-lg mn-wd-md-50p" role="document">
                    <div class="modal-content tx-size-sm">
                        <form autocomplete="off" id="form_generate_final_loa" class="" method="post">

                            <input type="hidden" name="loa_type" id="loa_type" value="final"/>
                            <div class="modal-header pd-x-20">
                                <h6 class="tx-14 mg-b-0 tx-uppercase tx-inverse tx-bold">Generate Final LOA</h6>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body pd-20">
                                <h6 class="lh-3 mg-b-5">PERSONAL INFORMATION</h6>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group mg-t-0-force">
                                            <label class="form-control-label">Name</label>
                                            <input class="form-control" type="text" name="full_name"
                                                   value="{!! $students_application->full_name !!}"
                                                   readonly="readonly"
                                                   placeholder="Enter Name">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mg-t-0-force">
                                            <label class="form-control-label">Student ID Number</label>
                                            <input class="form-control" type="text" name="student_id_number"
                                                   value="{!! $student_id_number !!}"
                                                   placeholder="Enter Student ID Number">
                                        </div>
                                    </div>
                                </div>

                                <h6 class="lh-3 mg-b-5 mg-t-15">PROGRAM INFORMATION</h6>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-control-label">Select program: <span
                                                        class="tx-danger">*</span></label>
                                            <select class="form-control select2__" name="program_id" id="program_id"
                                                    data-id="{!! $student_admission->program_id !!}"
                                                    data-placeholder="Choose program">
                                                <option label="Choose program"></option>
                                                @foreach($programs as $program_arr)
                                                    @if(in_array($program_arr->id,$programs_ids))
                                                        <option value="{!! $program_arr->id !!}"
                                                                {!! $student_admission->program_id==$program_arr->id?'selected="selected"':'' !!}
                                                                data-cost="{!! $program_arr->total_fees !!}">{!! $program_arr->name !!}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-control-label">Select program intake: <span
                                                        class="tx-danger">*</span></label>
                                            <select class="form-control select2__" name="intake_id"
                                                    id="intake_id"
                                                    data-id="{!! $student_admission->intake_id !!}"
                                                    data-placeholder="Choose program intake">
                                                <option label="Choose program"></option>
                                                @if(count($current_intakes))
                                                    @foreach($current_intakes as $current_intake)
                                                        <option value="{!! $current_intake->id !!}"
                                                                {!! $student_admission->intake_id==$current_intake->id?'selected="selected"':'' !!}>{!! $current_intake->name !!}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group mg-t-0-force">
                                            <label class="form-control-label">Program Name</label>
                                            <input class="form-control" type="text" name="program_name"
                                                   id="program_name"
                                                   value="{!! $program->name !!}"
                                                   readonly="readonly"
                                                   placeholder="Program name">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group mg-t-0-force">
                                            <label class="form-control-label">Program intake</label>
                                            <input class="form-control" type="text" name="intake_name"
                                                   id="intake_name"
                                                   value="{!! ($student_admission->intake?$student_admission->intake->name:'-') !!}"
                                                   readonly="readonly"
                                                   placeholder="Intake name">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group mg-t-0-force">
                                            <label class="form-control-label">Hours of instruction per week</label>
                                            <input class="form-control" type="text" name="hours_per_week"
                                                   id="hours_per_week"
                                                   value="{!! $program->hours_per_week !!} Hours per week"
                                                   readonly="readonly"
                                                   placeholder="Hours per week">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group mg-t-0-force">
                                            <label class="form-control-label">Academic status</label>
                                            <input class="form-control" type="text" name="academic_status"
                                                   id="academic_status"
                                                   value="{!! $academic_status[$program->academic_status] !!}"
                                                   readonly="readonly"
                                                   placeholder="Academic status">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group mg-t-0-force">
                                            <label class="form-control-label">Level of study</label>
                                            <input class="form-control" type="text" name="level_of_study"
                                                   id="level_of_study"
                                                   value="{!! $student_admission->level_of_study !!}"
                                                   readonly="readonly"
                                                   placeholder="Level_of study">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group mg-t-0-force">
                                            <label class="form-control-label">Type of program</label>
                                            <input class="form-control" type="text" name="type_of_program"
                                                   id="type_of_program"
                                                   value="{!! $student_admission->type_of_program !!}"
                                                   readonly="readonly"
                                                   placeholder="Type of program">
                                        </div>
                                    </div>
                                </div>
                                <hr/>
                                <div class="row">

                                    <div class="col-md-6">
                                        <div class="form-group mg-t-0-force">
                                            <label class="form-control-label">Estimated tuition fee for the first
                                                academic year</label>
                                            <input class="form-control" type="text" name="first_year_fees"
                                                   id="first_year_fees"
                                                   value="{!! $program->total_fees !!}"
                                                   placeholder="Estimated tuition fee for the first academic year">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group mg-t-0-force">
                                            <label class="form-control-label">Fees prepaid</label>
                                            <select class="form-control select2__" name="fees_prepaid"
                                                    id="fees_prepaid">
                                                <option value="1" selected="selected">Yes</option>
                                                <option value="0">No</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group mg-t-0-force">
                                            <label class="form-control-label">Exchange program</label>
                                            <select class="form-control select2__" name="exchange_program"
                                                    id="exchange_program">
                                                <option value="1">Yes</option>
                                                <option value="0" selected="selected">No</option>
                                            </select>
                                        </div>
                                    </div>

                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group mg-t-0-force">
                                            <label class="form-control-label">Scholarship/Teaching assistantship/Other
                                                financial aid</label>
                                            <select class="form-control select2__" name="is_scholarship"
                                                    id="is_scholarship">
                                                <option value="1">Yes</option>
                                                <option value="0" selected="selected">No</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mg-t-0-force">
                                            <label class="form-control-label"></label>
                                            <input class="form-control mg-t-5" type="text" name="scholarship"
                                                   id="scholarship"
                                                   placeholder="Specify scholarship" style="display: none;">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group mg-t-0-force">
                                            <label class="form-control-label">Internship/Work practicum</label>
                                            <select class="form-control select2__" name="is_internship"
                                                    id="is_internship">
                                                <option value="1">Yes</option>
                                                <option value="0" selected="selected">No</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group mg-t-0-force">
                                            <label class="form-control-label">Length</label>
                                            <input class="form-control" type="text" name="internship_length"
                                                   id="internship_length"
                                                   placeholder="Internship length">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group mg-t-0-force">
                                            <label class="form-control-label">Field of work</label>
                                            <input class="form-control" type="text" name="internship_work"
                                                   id="internship_work"
                                                   placeholder="Internship work">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group mg-t-0-force">
                                            <label class="form-control-label">Conditions of acceptance specified as
                                                clearly as possible</label>
                                            <input class="form-control" type="text" name="conditions_of_acceptance"
                                                   id="conditions_of_acceptance"
                                                   placeholder="Enter conditions of acceptance specified as clearly as possible">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group mg-t-0-force">
                                            <label class="form-control-label">Start date</label>
                                            <input class="form-control" type="text" name="start_at" name="start_at"
                                                   id="start_at"
                                                   value="{!! $student_admission->start_at->format('Y-m-d') !!}"
                                                   readonly="readonly"
                                                   placeholder="Start date">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group mg-t-0-force">
                                            <label class="form-control-label">Completion date</label>
                                            <input class="form-control" type="text" name="completion_at"
                                                   id="completion_at"
                                                   value="{!! $student_admission->completion_at->format('Y-m-d') !!}"
                                                   readonly="readonly"
                                                   placeholder="Completion date">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mg-t-0-force">
                                            <label class="form-control-label">Expiration of latter of acceptance</label>
                                            <input class="form-control fc-datepicker" type="text" name="expiration_at"
                                                   id="expiration_at"
                                                   value="{!! $expiration_at->format('Y-m-d') !!}"
                                                   placeholder="Select expiration of latter of acceptance">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group mg-t-0-force">
                                            <label class="form-control-label">Other relevant information</label>
                                            <input class="form-control" type="text" name="other_information"
                                                   id="other_information"
                                                   placeholder="Enter other relevant information">
                                        </div>
                                    </div>
                                </div>
                                <hr/>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-control-label">Select college campus: <span
                                                        class="tx-danger">*</span></label>
                                            <select class="form-control select2__" name="college_campus_id" id="college_campus_id"
                                                    data-placeholder="Choose college campus">
                                                @foreach($college_campus as $col_campus)
                                                    <option value="{!! $col_campus->id !!}"
                                                            {!! $student_admission->college_campus_id==$col_campus->id?'selected="selected"':'' !!}>
                                                        {!! $col_campus->name !!}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    {{--<div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-control-label">Select contact person: <span
                                                        class="tx-danger">*</span></label>
                                            <select class="form-control select2__" name="staff1_id" id="staff1_id"
                                                    data-placeholder="Choose contact person">
                                                @foreach($college_staffs as $college_staff)
                                                    <option value="{!! $college_staff->id !!}"
                                                            {!! $student_admission->staff1_id==$college_staff->id?'selected="selected"':'' !!}>
                                                        {!! $college_staff->full_name !!}
                                                        @if(isset($staff_position[$college_staff->position]))
                                                            {!! '('.$staff_position[$college_staff->position].')' !!}
                                                        @endif
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-control-label">Select alternate contact person: </label>
                                            <select class="form-control select2__" name="staff2_id" id="staff2_id"
                                                    data-placeholder="Choose alternate contact person">
                                                <option label="Choose alternate contact person"></option>
                                                @foreach($college_staffs as $college_staff)
                                                    <option value="{!! $college_staff->id !!}"
                                                            {!! $student_admission->staff2_id==$college_staff->id?'selected="selected"':'' !!}>
                                                        {!! $college_staff->full_name !!}
                                                        @if(isset($staff_position[$college_staff->position]))
                                                            {!! '('.$staff_position[$college_staff->position].')' !!}
                                                        @endif
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>--}}
                                </div>

                                <label class="mg-t-20 ckbox">
                                    <input name="doc_verified" class="doc_verified" id="doc_verified"
                                           type="checkbox" value="1">
                                    <span>Student signed conditional LOA and documents are verified</span>
                                </label>
                            </div><!-- modal-body -->
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary tx-size-xs submit_ola_btn"
                                        disabled="disabled">Generate Final LOA
                                </button>
                                <button type="button" class="btn btn-secondary tx-size-xs" data-dismiss="modal">Close
                                </button>
                            </div>
                        </form>
                    </div>
                </div><!-- modal-dialog -->
            </div><!-- modal -->
        @endif
    @endif
@endsection

@section('javascript')

    <script src="{!! asset('assets/lib/datatables/jquery.dataTables.js') !!}"></script>
    <script src="{!! asset('assets/lib/datatables-responsive/dataTables.responsive.js') !!}"></script>
    <script src="{!! asset('assets/lib/select2/js/select2.min.js') !!}"></script>

    <script src="{!! asset('assets/js/applications.js?v='.config('app.js_version')) !!}"></script>

    <script>
        $(function () {
            'use strict';

            //$("#generateFinalLoaModal").modal('show');

            $('#datatable1').DataTable({
                responsive: true,
                language: {
                    searchPlaceholder: 'Search...',
                    sSearch: '',
                    lengthMenu: '_MENU_ items/page',
                }
            });

            // Select2 // temp
            $('.dataTables_length select').select2({minimumResultsForSearch: Infinity});

            // Datepicker
            $('.fc-datepicker').datepicker({
                dateFormat: 'yy-mm-dd',
                //showOtherMonths: true,
                //selectOtherMonths: true
            });

            $('input[type="file"]').change(function (e) {
                var fileName = e.target.files[0].name;
                $(this).closest('.custom-file').find('.custom-file-control').html(fileName);
            });
        });
    </script>
@endsection
