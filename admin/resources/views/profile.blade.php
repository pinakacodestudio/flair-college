@extends('layouts.app')

@section('title','Profile')

@section('stylesheet')
    <link href="{!! asset('assets/lib/select2/css/select2.min.css') !!}" rel="stylesheet">
@endsection

@section('content')
    <div class="pd-x-15 pd-t-15">
        <h3 class="tx-gray-800 mg-b-10">Profile</h3>
    </div>

    <div class="br-pagebody">
        <div class="br-section-wrapper pd-20">

            @include('includes/messages')

            <form action="{!! route('profile_update') !!}" id="profile_edit_form" method="post"
                  autocomplete="off">
                {!! csrf_field() !!}
                <div class="row mg-t-20_">
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label class="form-control-label">First name: <span class="tx-danger">*</span></label>
                            <input class="form-control" type="text" name="first_name" value="{!! $user->first_name !!}"
                                   placeholder="Enter first name" required>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label class="form-control-label">Last name: <span class="tx-danger">*</span></label>
                            <input class="form-control" type="text" name="last_name" value="{!! $user->last_name !!}"
                                   placeholder="Enter last name" required>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label class="form-control-label">Mobile: </label>
                            <input class="form-control" type="text" name="mobile" value="{!! $user->mobile !!}"
                                   placeholder="Enter mobile" required>
                        </div>
                    </div>
                </div>
                <div class="row">

                    <div class="col-lg-4">
                        <div class="form-group">
                            <label class="form-control-label">Email Address: <span class="tx-danger">*</span></label>
                            <input class="form-control" type="text" name="email" value="{!! $user->email !!}"
                                   placeholder="Enter email" required>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="form-group">
                            <label class="form-control-label">Gender:</label>
                            <div class="option-group">
                                <label class="rdiobox rdiobox-inline">
                                    <input name="gender" type="radio"
                                           value="male" {!! $user->gender=='male'?'checked="checked"':'' !!}/>
                                    <span>Male</span>
                                </label>
                                <label class="rdiobox rdiobox-inline">
                                    <input name="gender" type="radio"
                                           value="female" {!! $user->gender=='female'?'checked="checked"':'' !!}/>
                                    <span>Female</span>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">

                    <div class="col-lg-4">
                        <div class="form-group">
                            <label class="form-control-label">Address: </label>
                            <input class="form-control" type="text" name="address" value="{!! $user->address !!}"
                                   placeholder="Enter address">
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label class="form-control-label">City: </label>
                            <input class="form-control" type="text" name="city" value="{!! $user->city !!}"
                                   placeholder="Enter city">
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label class="form-control-label">Country: </label>
                            <input class="form-control" type="text" name="country" value="{!! $user->country !!}"
                                   placeholder="Enter country">
                        </div>
                    </div>
                </div>

                <div class="row mg-t-20">
                    <div class="col-lg-12">
                        <div class="form-group text-right">
                            <button type="submit" class="btn btn-info" id="submit_btn">Update Profile</button>
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
            $("#profile_edit_form").parsley().on('form:validate', function (formInstance) {
                if (formInstance.validationResult) {
                    //$("#submit_btn").attr('disabled', 'disabled');
                }
            }).on('form:submit', function (formInstance) {
                $("#submit_btn").attr('disabled', 'disabled');
            });
        });
    </script>
@endsection