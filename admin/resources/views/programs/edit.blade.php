@extends('layouts.app')

@section('title', 'Edit Program')

@section('stylesheet')
    <link href="{!! asset('assets/lib/select2/css/select2.min.css') !!}" rel="stylesheet">
@endsection

@section('content')
    <div class="pd-x-15 pd-t-15">
        <h3 class="tx-gray-800 mg-b-10">Edit Program</h3>
    </div>

    <div class="br-pagebody">
        <div class="br-section-wrapper pd-20">

            @include('includes/messages')

            {{--<h6 class="tx-gray-800 tx-uppercase tx-bold tx-14 mg-b-20">Edit Program</h6>--}}
            {{--<p class="mg-b-25 mg-lg-b-50"></p>--}}
            <form action="{!! route('programs.edit',['id'=>$program->id]) !!}" id="program_edit_form" method="post"
                  autocomplete="off">
                {!! csrf_field() !!}
                <div class="row mg-t-20_">
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label class="form-control-label">Program Name: <span class="tx-danger">*</span></label>
                            <input class="form-control" type="text" name="name" value="{!! $program->name !!}"
                                   placeholder="Enter program name" required>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label class="form-control-label">Level of Study: <span class="tx-danger">*</span></label>
                            <select class="form-control select2__" name="level_of_study" id="level_of_study"
                                    data-placeholder="Choose level of study" required>
                                {{--<option label="Choose level of study"></option>--}}
                                @foreach(config('app.level_of_study') as $key=>$value)
                                    <option {!! $program->level_of_study==$key?'selected="selected"':'' !!} value="{!! $key !!}">
                                        {!! $value !!}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label class="form-control-label">Type of Program: <span class="tx-danger">*</span></label>
                            <select class="form-control select2__" name="type_of_program" id="type_of_program"
                                    data-placeholder="Choose type of program" required>
                                {{--<option label="Choose type of program"></option>--}}
                                @foreach(config('app.type_of_program') as $key=>$value)
                                    <option {!! $program->type_of_program==$key?'selected="selected"':'' !!} value="{!! $key !!}">
                                        {!! $value!!}
                                    </option>
                                @endforeach
                            </select>
                            <input class="form-control mg-t-10" type="text" name="type_of_program_other"
                                   id="type_of_program_other" value="{!! $program->type_of_program_other !!}"
                                   placeholder="Enter other type of program"
                                    {!! $program->type_of_program!='other'?'style="display:none;"':'' !!}>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label class="form-control-label">Academic Status: <span class="tx-danger">*</span></label>
                            <select class="form-control select2__" name="academic_status" id="academic_status"
                                    data-placeholder="Choose academic status" required>
                                @foreach(config('app.academic_status') as $key=>$value)
                                    <option {!! $program->academic_status==$key?'selected="selected"':'' !!} value="{!! $key !!}">
                                        {!! $value!!}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="form-group">
                            <label class="form-control-label">Hours Per Week: <span class="tx-danger">*</span></label>
                            <input class="form-control" type="text" name="hours_per_week"
                                   value="{!! $program->hours_per_week !!}"
                                   placeholder="Select hours per week" required>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="form-group">
                            <label class="form-control-label">Total fees: <span class="tx-danger">*</span></label>
                            <input class="form-control" type="text" name="total_fees" id="total_fees"
                                   value="{!! $program->total_fees !!}"
                                   placeholder="Enter total fees" required>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="form-group">
                            <label class="form-control-label">Program Duration Weeks:</label>
                            <input class="form-control" type="text" name="program_duration_weeks"
                                   id="program_duration_weeks"
                                   value="{!! $program->program_duration_weeks !!}"
                                   placeholder="Enter program duration weeks">
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label class="form-control-label">Program Duration Years:</label>
                            <input class="form-control" type="text" name="program_duration_years"
                                   id="program_duration_years"
                                   value="{!! $program->program_duration_years !!}"
                                   placeholder="Enter program duration years">
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label class="form-control-label">Program Intakes:</label>
                            <select name="program_intakes[]" class="form-control select2"
                                    data-placeholder="Choose Intakes"
                                    multiple>
                                @foreach($intakes as $intake)
                                    <option {!! in_array($intake->id,old('program_intakes',$intake_ids))?'selected="selected"':'' !!} value="{!! $intake->id !!}">
                                        {!! $intake->name !!}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                </div>
                <div class="row mg-t-20">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="ckbox">
                                <input type="checkbox" name="status" id="status"
                                       {!! $program->status?'checked="checked"':'' !!}
                                       value="1"><span>Is Active</span>
                            </label>
                        </div>
                    </div>
                </div>
                <div class="row mg-t-20">
                    <div class="col-lg-12">
                        <div class="form-group text-right">
                            <button class="btn btn-info" id="submit_btn">Update</button>
                            <a class="btn btn-outline-danger" href="{!! route('programs') !!}">Cancel</a>
                        </div>
                    </div>
                </div>
            </form>
        </div><!-- br-section-wrapper -->
    </div><!-- br-pagebody -->
@endsection

@section('javascript')
    <script src="{!! asset('assets/lib/parsleyjs/parsley.js') !!}"></script>

    <script src="{!! asset('assets/lib/select2/js/select2.min.js') !!}"></script>

    <script>
        $(document).ready(function () {

            $("#program_edit_form").parsley().on('form:validate', function (formInstance) {
                if (formInstance.validationResult) {
                    //$("#submit_btn").attr('disabled', 'disabled');
                }
            }).on('form:submit', function (formInstance) {
                //return false;
                $("#submit_btn").attr('disabled', 'disabled');
            });

            $("#type_of_program").on('change', function (e) {
                var val = $(this).val();
                if (val == 'other') {
                    $("#type_of_program_other").show();
                } else {
                    $("#type_of_program_other").hide();
                }
            });
        });
    </script>
@endsection