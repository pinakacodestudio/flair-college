@extends('layouts.app')

@section('title', 'Edit Staff')

@section('stylesheet')
    <link href="{!! asset('assets/lib/select2/css/select2.min.css') !!}" rel="stylesheet">
    <style>
        .signature_preview {
            margin-top: 5px;
        }

        .signature_preview_image {
            display: inline-block;
        }

        .signature_preview img {
            width: 200px;
            max-height: 200px;
            padding: 5px;
            border: 1px solid #ccc;
        }

        .remove_signature_image {
            cursor: pointer;
            color: red !important;
            font-size: 24px;
            margin-left: 10px;
        }

        .undo_signature_image {
            cursor: pointer;
            color: orange !important;
            font-size: 24px;
            margin-left: 10px;
        }
    </style>
@endsection

@section('content')
    <div class="pd-x-15 pd-t-15">
        <h3 class="tx-gray-800 mg-b-10">Edit Staff</h3>
    </div>

    <div class="br-pagebody">
        <div class="br-section-wrapper pd-20">

            @include('includes/messages')

            <form action="{!! route('staffs.edit',['id'=>$college_staff->id]) !!}" id="staff_edit_form" method="post"
                  autocomplete="off" enctype="multipart/form-data">
                {!! csrf_field() !!}
                <div class="row mg-t-20_">
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label class="form-control-label">First name: <span class="tx-danger">*</span></label>
                            <input class="form-control" type="text" name="first_name"
                                   value="{!! $college_staff->first_name !!}"
                                   placeholder="Enter first name" required>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label class="form-control-label">Last name: <span class="tx-danger">*</span></label>
                            <input class="form-control" type="text" name="last_name"
                                   value="{!! $college_staff->last_name !!}"
                                   placeholder="Enter last name" required>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label class="form-control-label">Telephone number: <span class="tx-danger">*</span></label>
                            <input class="form-control" type="text" name="mobile" value="{!! $college_staff->mobile !!}"
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
                                    <option {!! $college_staff->position==$key?'selected="selected"':'' !!} value="{!! $key !!}">
                                        {!! $value !!}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="form-group">
                            <label class="form-control-label">Extension: </label>
                            <input class="form-control" type="text" name="extension"
                                   value="{!! $college_staff->extension !!}"
                                   placeholder="Enter extension">
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label class="form-control-label">User signature Image:(Only for edit) </label>
                            <div class="custom-file" style="display: block;">
                                <input type="file" id="signature_image"
                                       name="signature_image"
                                       accept="image/x-png,image/gif,image/jpeg" class="custom-file-input"
                                       style="width: 100%;">
                                <span class="custom-file-control"></span>
                            </div>
                            <input type="hidden" name="remove_signature_image" id="remove_signature_image" value="0">
                            <div class="signature_preview">

                                @if($college_staff->signature_filename)
                                    <div class="signature_preview_image">
                                        <img src="{!! route('storage_signature',['filename'=>$college_staff->signature_filename]); !!}"/>
                                    </div>
                                    <a class="remove_signature_image" title="Remove signature"
                                       href="javascript:;"><i
                                                class="fa fa-times"></i></a>
                                    <a class="undo_signature_image" title="Undo"
                                       href="javascript:;" style="display:none;"><i
                                                class="fa fa-undo"></i></a>
                                @else
                                    Signature Image not uploaded.
                                @endif
                            </div>

                        </div>
                    </div>
                </div>
                <div class="row mg-t-10">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="ckbox">
                                <input type="checkbox" name="status" id="status"
                                       {!! $college_staff->status?'checked="checked"':'' !!}
                                       value="1"><span>Is Active</span>
                            </label>
                        </div>
                    </div>
                </div>
                <div class="row mg-t-20">
                    <div class="col-lg-12">
                        <div class="form-group text-right">
                            <button class="btn btn-info" id="submit_btn">Update</button>
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

            $("#staff_edit_form").parsley().on('form:validate', function (formInstance) {
                if (formInstance.validationResult) {
                    //$("#submit_btn").attr('disabled', 'disabled');
                }
            }).on('form:submit', function (formInstance) {
                $("#submit_btn").attr('disabled', 'disabled');
            });

            $(".remove_signature_image").on('click', function () {
                if (confirm('Are you sure remove signature?')) {
                    $("#remove_signature_image").val(1);
                    $(".signature_preview_image").hide();

                    $(".remove_signature_image").hide();
                    $(".undo_signature_image").show();
                }
            });

            $(".undo_signature_image").on('click', function () {
                $("#remove_signature_image").val(0);
                $(".signature_preview_image").show();

                $(".remove_signature_image").show();
                $(".undo_signature_image").hide();
            });

            $('input[type="file"]').change(function (e) {
                var fileName = e.target.files[0].name;
                $(this).closest('.custom-file').find('.custom-file-control').html(fileName);
            });
        });
    </script>
@endsection
