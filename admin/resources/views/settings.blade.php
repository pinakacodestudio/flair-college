@extends('layouts.app')

@section('title','College Settings')

@section('stylesheet')
    <link href="{!! asset('assets/lib/select2/css/select2.min.css') !!}" rel="stylesheet">
@endsection

@section('content')
    <div class="pd-x-15 pd-t-15">
        <h3 class="tx-gray-800 mg-b-10">College Settings</h3>
    </div>

    <div class="br-pagebody">
        <div class="br-section-wrapper pd-20">

            @include('includes/messages')

            <form action="{!! route('settings_update') !!}" id="settings_edit_form" method="post"
                  autocomplete="off">
                {!! csrf_field() !!}
                <div class="row mg-t-20_">
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label class="form-control-label">Full Name of institution: <span class="tx-danger">*</span></label>
                            <input class="form-control" type="text" name="name" value="{!! $college->name !!}"
                                   placeholder="Enter full name of institution" required>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label class="form-control-label">Designated learning institution number: <span
                                        class="tx-danger">*</span></label>
                            <input class="form-control" type="text" name="dli_number"
                                   value="{!! $college->dli_number !!}"
                                   placeholder="Enter designated learning institution number" required>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label class="form-control-label">Email: <span class="tx-danger">*</span></label>
                            <input class="form-control" type="text" name="email" value="{!! $college->email !!}"
                                   placeholder="Enter email" required>
                        </div>
                    </div>
                </div>

                <div class="row">

                    <div class="col-lg-4">
                        <div class="form-group">
                            <label class="form-control-label">P.O. Box: </label>
                            <input class="form-control" type="text" name="po_box" value="{!! $college->po_box !!}"
                                   placeholder="Enter P.O. Box">
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label class="form-control-label">Street No.: </label>
                            <input class="form-control" type="text" name="street_no" value="{!! $college->street_no !!}"
                                   placeholder="Enter street no.">
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label class="form-control-label">Street name: </label>
                            <input class="form-control" type="text" name="street_name"
                                   value="{!! $college->street_name !!}"
                                   placeholder="Enter street name">
                        </div>
                    </div>
                </div>

                <div class="row">

                    <div class="col-lg-4">
                        <div class="form-group">
                            <label class="form-control-label">City/Town: </label>
                            <input class="form-control" type="text" name="city" value="{!! $college->city !!}"
                                   placeholder="Enter city/town">
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label class="form-control-label">Province/Territory: </label>
                            <input class="form-control" type="text" name="province" value="{!! $college->province !!}"
                                   placeholder="Enter province/territory">
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label class="form-control-label">Postal Code: </label>
                            <input class="form-control" type="text" name="postcode" value="{!! $college->postcode !!}"
                                   placeholder="Enter postal code">
                        </div>
                    </div>
                </div>

                <div class="row">

                    <div class="col-lg-3">
                        <div class="form-group">
                            <label class="form-control-label">Telephone number: </label>
                            <input class="form-control" type="text" name="phone" value="{!! $college->phone !!}"
                                   placeholder="Enter telephone number">
                        </div>
                    </div>

                    <div class="col-lg-3">
                        <div class="form-group">
                            <label class="form-control-label">Extension: </label>
                            <input class="form-control" type="text" name="extension" value="{!! $college->extension !!}"
                                   placeholder="Enter Extension">
                        </div>
                    </div>

                    <div class="col-lg-3">
                        <div class="form-group">
                            <label class="form-control-label">Fax number: </label>
                            <input class="form-control" type="text" name="fax" value="{!! $college->fax !!}"
                                   placeholder="Enter fax number">
                        </div>
                    </div>

                    <div class="col-lg-3">
                        <div class="form-group">
                            <label class="form-control-label">Type of School/Institution:</label>
                            <div class="option-group">
                                <label class="rdiobox rdiobox-inline">
                                    <input name="institution_type" type="radio"
                                           value="public" {!! $college->institution_type=='public'?'checked="checked"':'' !!}/>
                                    <span>Public</span>
                                </label>
                                <label class="rdiobox rdiobox-inline">
                                    <input name="institution_type" type="radio"
                                           value="private" {!! $college->institution_type=='private'?'checked="checked"':'' !!}/>
                                    <span>Private</span>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="row mg-t-20">
                    <div class="col-lg-12">
                        <div class="form-group text-right">
                            <button type="submit" class="btn btn-info" id="submit_btn">Update Setting</button>
                            <a class="btn btn-outline-danger" href="{!! route('dashboard') !!}">Cancel</a>
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
            $("#settings_edit_form").parsley().on('form:validate', function (formInstance) {
                if (formInstance.validationResult) {
                    //$("#submit_btn").attr('disabled', 'disabled');
                }
            }).on('form:submit', function (formInstance) {
                $("#submit_btn").attr('disabled', 'disabled');
            });
        });
    </script>
@endsection