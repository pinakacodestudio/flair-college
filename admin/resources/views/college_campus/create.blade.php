@extends('layouts.app')

@section('title', 'Create campus')

@section('stylesheet')
    <link href="{!! asset('assets/lib/select2/css/select2.min.css') !!}" rel="stylesheet">
@endsection

@section('content')
    <div class="pd-x-15 pd-t-15">
        <h3 class="tx-gray-800 mg-b-10">Create campus</h3>
    </div>

    <div class="br-pagebody">
        <div class="br-section-wrapper pd-20">

            @include('includes/messages')

            <form action="{!! route('campus.create') !!}" id="campus_create_form" method="post"
                  autocomplete="off">
                {!! csrf_field() !!}
                <div class="row mg-t-20_">
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label class="form-control-label">Campus Name: <span class="tx-danger">*</span></label>
                            <input class="form-control" type="text" name="name" value="{!! old('name') !!}"
                                   placeholder="Enter campus name" required>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label class="form-control-label">Phone: </label>
                            <input class="form-control" type="text" name="phonewe" value="{!! old('phone') !!}"
                                   placeholder="Enter phone">
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label class="form-control-label">Select campus contact person: <span
                                        class="tx-danger">*</span></label>
                            <select class="form-control select2__" name="staff_id" id="staff_id"
                                    data-placeholder="Choose campus contact person">
                                @foreach($college_staffs as $college_staff)
                                    <option value="{!! $college_staff->id !!}"
                                            {!! old('staff_id')==$college_staff->id?'selected="selected"':'' !!}>
                                        {!! $college_staff->full_name !!}
                                        @if(isset($staff_position[$college_staff->position]))
                                            {!! '('.$staff_position[$college_staff->position].')' !!}
                                        @endif
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="form-group">
                            <label class="form-control-label">Campus Address: <span class="tx-danger">*</span></label>
                            <input class="form-control" type="text" name="address" value="{!! old('address') !!}"
                                   placeholder="Enter campus address" required>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label class="form-control-label">City: <span class="tx-danger">*</span></label>
                            <input class="form-control" type="text" name="city" value="{!! old('city') !!}"
                                   placeholder="Enter city" required>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label class="form-control-label">Postcode: </label>
                            <input class="form-control" type="text" name="postcode" value="{!! old('postcode') !!}"
                                   placeholder="Enter postcode">
                        </div>
                    </div>
                </div>
                <div class="row mg-t-10">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="ckbox">
                                <input type="checkbox" name="status" id="status"
                                       {!! old('status',1)?'checked="checked"':'' !!}
                                       value="1"><span>Is Active</span>
                            </label>
                        </div>
                    </div>
                </div>
                <div class="row mg-t-20">
                    <div class="col-lg-12">
                        <div class="form-group text-right">
                            <button class="btn btn-info" id="submit_btn">Create</button>
                            <a class="btn btn-outline-danger" href="{!! route('campus') !!}">Cancel</a>
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

            $("#campus_create_form").parsley().on('form:validate', function (formInstance) {
                if (formInstance.validationResult) {
                    //$("#submit_btn").attr('disabled', 'disabled');
                }
            }).on('form:submit', function (formInstance) {
                $("#submit_btn").attr('disabled', 'disabled');
            });

        });
    </script>
@endsection
