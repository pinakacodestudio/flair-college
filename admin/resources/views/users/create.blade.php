@extends('layouts.app')

@section('title', 'Create User')

@section('stylesheet')
    <link href="{!! asset('assets/lib/select2/css/select2.min.css') !!}" rel="stylesheet">
@endsection

@section('content')
    <div class="pd-x-15 pd-t-15">
        <h3 class="tx-gray-800 mg-b-10">Create User</h3>
    </div>

    <div class="br-pagebody">
        <div class="br-section-wrapper pd-20">

            @include('includes/messages')

            {{--<h6 class="tx-gray-800 tx-uppercase tx-bold tx-14 mg-b-20">Create New User</h6>--}}
            {{--<p class="mg-b-25 mg-lg-b-50"></p>--}}
            <form action="{!! route('users.create') !!}" id="user_create_form" method="post"
                  autocomplete="off">
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
                            <label class="form-control-label">Mobile: <span class="tx-danger">*</span></label>
                            <input class="form-control" type="text" name="mobile" value="{!! old('mobile') !!}"
                                   placeholder="Enter mobile" required>
                        </div>
                    </div>


                    <div class="col-lg-4">
                        <div class="form-group">
                            <label class="form-control-label">Email Address: <span class="tx-danger">*</span></label>
                            <input class="form-control" type="text" name="email" value="{!! old('email') !!}"
                                   placeholder="Enter email" required>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label class="form-control-label">Role: <span class="tx-danger">*</span></label>
                            <select class="form-control select2__" name="user_type" id="user_type"
                                    data-placeholder="Choose role" required>
                                @foreach($user_types as $key=>$value)
                                    <option {!! old('user_type')==$key?'selected="selected"':'' !!} value="{!! $key !!}">
                                        {!! $value !!}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="form-group">
                            <label class="form-control-label">Gender:</label>
                            <div class="option-group">
                                <label class="rdiobox rdiobox-inline">
                                    <input name="gender" type="radio"
                                           value="male" {!! old('gender','male')=='male'?'checked="checked"':'' !!} />
                                    <span>Male</span>
                                </label>
                                <label class="rdiobox rdiobox-inline">
                                    <input name="gender" type="radio"
                                           value="female" {!! old('gender')=='female'?'checked="checked"':'' !!}/>
                                    <span>Female</span>
                                </label>
                            </div>
                        </div>
                    </div>


                    <div class="col-lg-4">
                        <div class="form-group">
                            <label class="form-control-label">Address: <span class="tx-danger">*</span></label>
                            <input class="form-control" type="text" name="address" value="{!! old('address') !!}"
                                   placeholder="Enter address">
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label class="form-control-label">City: <span class="tx-danger">*</span></label>
                            <input class="form-control" type="text" name="city" value="{!! old('city') !!}"
                                   placeholder="Enter city">
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label class="form-control-label">Country: <span class="tx-danger">*</span></label>
                            <input class="form-control" type="text" name="country" value="{!! old('country') !!}"
                                   placeholder="Enter country">
                        </div>
                    </div>

                    {{--<div class="col-lg-4">
                        <div class="form-group">
                            <label class="form-control-label">Password: <span class="tx-danger">*</span></label>
                            <input class="form-control" type="password" name="password" value=""
                                   placeholder="Create a password" required>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label class="form-control-label">Confirm password: <span class="tx-danger">*</span></label>
                            <input class="form-control" type="text" name="password_confirmation" value=""
                                   placeholder="Confirm password" required>
                        </div>
                    </div>--}}
                </div>
                {{--<div class="row mg-t-20">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="ckbox">
                                <input type="checkbox" name="status" id="status"
                                       {!! old('status',1)?'checked="checked"':'' !!}
                                       value="1"><span>Is Active</span>
                            </label>
                        </div>
                    </div>
                </div>--}}
                <div class="row mg-t-20">
                    <div class="col-lg-12">
                        <div class="form-group text-right">
                            <button class="btn btn-info" id="submit_btn">Create</button>
                            <a class="btn btn-outline-danger" href="{!! route('users') !!}">Cancel</a>
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

            $("#user_create_form").parsley().on('form:validate', function (formInstance) {
                if (formInstance.validationResult) {
                    //$("#submit_btn").attr('disabled', 'disabled');
                }
            }).on('form:submit', function (formInstance) {
                $("#submit_btn").attr('disabled', 'disabled');
            });

        });
    </script>
@endsection