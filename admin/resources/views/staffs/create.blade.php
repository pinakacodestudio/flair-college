@extends('layouts.app')

@section('title', 'Create Staff')

@section('stylesheet')
    <link href="{!! asset('assets/lib/select2/css/select2.min.css') !!}" rel="stylesheet">
@endsection

@section('content')
    <div class="pd-x-15 pd-t-15">
        <h3 class="tx-gray-800 mg-b-10">Create Staff</h3>
    </div>

    <div class="br-pagebody">
        <div class="br-section-wrapper pd-20">

            @include('includes/messages')

            <form action="{!! route('staffs.create') !!}" id="staff_create_form" method="post"
                  autocomplete="off" enctype="multipart/form-data">
                {!! csrf_field() !!}
                <div class="row mg-t-20_">
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label class="form-control-label">First name: <span class="tx-danger">*</span></label>
                            <input class="form-control" type="text" name="first_name" value="{!! old('first_name') !!}"
                                   placeholder="Enter first name" required>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label class="form-control-label">Last name: <span class="tx-danger">*</span></label>
                            <input class="form-control" type="text" name="last_name" value="{!! old('last_name') !!}"
                                   placeholder="Enter last name" required>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label class="form-control-label">Telephone number: <span class="tx-danger">*</span></label>
                            <input class="form-control" type="text" name="mobile" value="{!! old('mobile') !!}"
                                   placeholder="Enter telephone number" required>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="form-group">
                            <label class="form-control-label">Position: <span class="tx-danger">*</span></label>
                            <select class="form-control select2__" name="position" id="position"
                                    data-placeholder="Choose position" required>
                                <option value="">Select Position</option>
                                @foreach($staff_position as $key=>$value)
                                    <option {!! old('position')==$key?'selected="selected"':'' !!} value="{!! $key !!}">
                                        {!! $value !!}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="form-group">
                            <label class="form-control-label">Extension: </label>
                            <input class="form-control" type="text" name="extension" value="{!! old('extension') !!}"
                                   placeholder="Enter extension">
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label class="form-control-label">User signature Image: </label>
                            <div class="custom-file" style="display: block;">
                                <input type="file" id="signature_image"
                                       name="signature_image"
                                       accept="image/x-png,image/gif,image/jpeg" class="custom-file-input"
                                       style="width: 100%;">
                                <span class="custom-file-control"></span>
                            </div>
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
                            <a class="btn btn-outline-danger" href="{!! route('staffs') !!}">Cancel</a>
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

            $("#staff_create_form").parsley().on('form:validate', function (formInstance) {
                if (formInstance.validationResult) {
                    //$("#submit_btn").attr('disabled', 'disabled');
                }
            }).on('form:submit', function (formInstance) {
                $("#submit_btn").attr('disabled', 'disabled');
            });

            $('input[type="file"]').change(function (e) {
                var fileName = e.target.files[0].name;
                $(this).closest('.custom-file').find('.custom-file-control').html(fileName);
            });
        });
    </script>
@endsection
