@extends('layouts.app')

@section('title', 'All Intakes')

@section('stylesheet')
    <link href="{!! asset('assets/lib/datatables/jquery.dataTables.css') !!}" rel="stylesheet">
    <link href="{!! asset('assets/lib/select2/css/select2.min.css') !!}" rel="stylesheet">
@endsection

@section('content')
    <div class="pd-x-15 pd-t-15">
        <h3 class="tx-gray-800 mg-b-10">All Intakes</h3>
    </div>

    <div class="br-pagebody">
        <div class="row">
            <div class="col-lg-8">
                @include('includes/messages')

                <div class="bg-white rounded shadow-base pd-20">
                    {{--<h6 class="tx-gray-800 tx-uppercase tx-bold tx-14 mg-b-20">Intakes</h6>--}}
                    {{--<p class="mg-b-25 mg-lg-b-50">Searching, ordering and paging goodness will be immediately added to the
                        table, as shown in this example.</p>--}}

                    <div class="table-wrapper">
                        <table id="datatable1" class="table display responsive nowrap">
                            <thead>
                            <tr>
                                <th class="wd-20p">Name</th>
                                <th class="wd-15p">Start Date</th>
                                <th class="wd-10p">Status</th>
                                <th class="wd-20p">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($intakes as $intake)
                                <tr>
                                    <td>{!! $intake->name !!}</td>
                                    <td>{!! $intake->start_date->format('Y-m-d') !!}</td>
                                    <td>
                                        {{--@if($intake->status == 1)
                                            <span class="badge badge-success">Active</span>
                                        @else
                                            <span class="badge badge-danger">Deactive</span>
                                        @endif--}}
                                        @if($intake->status == 1)
                                            <a data-action="deactive" data-id="{!! $intake->id !!}"
                                               href="javascript:;"
                                               data-type="intake"
                                               class="badge badge-success manage_status_btn">
                                                Active
                                            </a>
                                        @else
                                            <a data-action="active" data-id="{!! $intake->id !!}"
                                               href="javascript:;"
                                               data-type="intake"
                                               class="badge badge-danger btn-sm manage_status_btn">
                                                Deactive
                                            </a>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="javascript:;"
                                           data-id="{{$intake->id}}"
                                           data-name="{{$intake->name}}"
                                           data-start_date="{{$intake->start_date->format('Y-m-d')}}"
                                           class="btn btn-success btn-sm edit_intake">
                                            <i class="fa fa-edit"></i> Edit
                                        </a>
                                        {{--<a href="javascript:;"
                                           data-id="{!! $intake->id !!}"
                                           data-href="{!! route('programs_intakes.delete',['id'=>$intake->id]) !!}"
                                           class="btn btn-danger btn-sm soft_delete_btn"><i class="fa fa-trash"></i>
                                            Delete</a>--}}

                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div><!-- table-wrapper -->
                </div>
            </div>
            <div class="col-lg-4">
                <div class="bg-white rounded shadow-base pd-20">
                    <h6 class="tx-gray-800 tx-uppercase tx-bold tx-14 mg-b-20">Create New Intakes</h6>
                    {{--<p class="mg-b-25 mg-lg-b-50"></p>--}}
                    <form autocomplete="off" id="form_create_intake" method="get">
                        <div class="form-group">
                            <label class="form-control-label">Name: <span class="tx-danger">*</span></label>
                            <input class="form-control" type="text" name="name" id="name" value=""
                                   placeholder="Enter intake name">
                        </div>
                        <div class="form-group">
                            <label class="form-control-label">Start Date: <span class="tx-danger">*</span></label>
                            <input class="form-control fc-datepicker" type="text" name="start_date" id="start_date"
                                   value=""
                                   placeholder="Select start date">
                        </div>
                        <div class="form-group text-right">
                            <button class="btn btn-info" id="submit_btn">Create</button>
                        </div>
                    </form>
                </div>
            </div><!-- br-section-wrapper -->
        </div>
        <div id="editIntakeModal" class="modal fade">
            <div class="modal-dialog modal-dialog-vertical-center" role="document">
                <div class="modal-content bd-0 tx-14">
                    <form action="#" id="intake_edit_form" method="post">
                        <div class="modal-header pd-y-20 pd-x-25">
                            <h6 class="tx-14 mg-b-0 tx-uppercase tx-inverse tx-bold">Edit Intake</h6>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body pd-25">
                            <div class="form-group">
                                <label class="form-control-label">Name: <span class="tx-danger">*</span></label>
                                <input class="form-control" type="text" name="name" id="name_edit" value=""
                                       placeholder="Enter intake name">
                            </div>
                            <div class="form-group">
                                <label class="form-control-label">Start Date: <span class="tx-danger">*</span></label>
                                <input class="form-control fc-datepicker" type="text" name="start_date"
                                       id="start_date_edit"
                                       value=""
                                       placeholder="Select start date">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <input type="hidden" name="id" value="0" id="intake_id"/>
                            <button type="submit"
                                    class="btn btn-primary tx-11 tx-uppercase pd-y-12 pd-x-25 tx-mont tx-medium intake_update_btn">
                                Update
                            </button>
                            <button type="button"
                                    class="btn btn-secondary tx-11 tx-uppercase pd-y-12 pd-x-25 tx-mont tx-medium"
                                    data-dismiss="modal">Cancel
                            </button>
                        </div>
                    </form>
                </div>
            </div><!-- modal-dialog -->
        </div><!-- modal -->
    </div><!-- br-pagebody -->
@endsection

@section('javascript')

    <script src="{!! asset('assets/lib/datatables/jquery.dataTables.js') !!}"></script>
    <script src="{!! asset('assets/lib/datatables-responsive/dataTables.responsive.js') !!}"></script>
    <script src="{!! asset('assets/lib/select2/js/select2.min.js') !!}"></script>

    <script>
        $(function () {
            'use strict';

            $('#datatable1').DataTable({
                //dom: "Bfrtip",
                //dom: "rtip",
                //dom: '<"top"fl>rt<"bottom"ip>',
                responsive: false,
                scrollX: true,
                language: {
                    searchPlaceholder: 'Search...',
                    sSearch: '',
                    lengthMenu: '_MENU_ items/page',
                }
            });

            // Select2 // temp
            $('.dataTables_length select').select2({minimumResultsForSearch: Infinity});

            $('.fc-datepicker').datepicker({
                dateFormat: 'yy-mm-dd',
                //showOtherMonths: true,
                //selectOtherMonths: true
            });


            $("#form_create_intake").on('submit', function (e) {
                e.preventDefault();
                $("#name").attr('disable', 'disable');
                $.ajax({
                    type: 'POST',
                    url: getUrl('ajax/create_intake'),
                    data: $("#form_create_intake").serialize(),
                    success: function (res) {
                        if (res.error === 1) {
                            /*swal.fire({
                                type: 'error',
                                title: 'Oops...',
                                text: res.message,
                            });*/
                            //alert(res.message);
                            Swal.fire(
                                'Intake create fail',
                                res.message,
                                'error'
                            );
                            $("#intake").focus();
                        } else {
                            window.location.reload();
                        }
                    },
                    error: function () {

                    },
                    done: function () {
                        $("#intake").removeAttr('disable');
                    }
                });
            });

            $("#intake_edit_form").on('submit', function (e) {
                e.preventDefault();
                $(".intake_update_btn").attr('disable', 'disable');
                $.ajax({
                    type: 'POST',
                    url: getUrl('ajax/edit_intake'),
                    data: $("#intake_edit_form").serialize(),
                    success: function (res) {
                        if (res.error === 1) {
                            /*swal.fire({
                                type: 'error',
                                title: 'Oops...',
                                text: res.message,
                            });*/
                            Swal.fire(
                                'Intake update fail',
                                res.message,
                                'error'
                            );
                            $("#editIntakeModal").find("#name_edit").focus();
                            //alert(res.message);
                        } else {
                            window.location.reload();
                        }
                    },
                    error: function () {

                    },
                    done: function () {
                        $(".intake_update_btn").removeAttr('disable');
                        $("#editIntakeModal").modal('hide');
                    }
                });

            });

            $(".edit_intake").on('click', function (e) {
                e.preventDefault();
                var name = $(this).data('name');
                var id = $(this).data('id');
                var start_date = $(this).data('start_date');
                $("#editIntakeModal").find("#name_edit").val(name);
                $("#editIntakeModal").find("#start_date_edit").val(start_date);
                $("#editIntakeModal").find("#intake_id").val(id);
                $("#editIntakeModal").modal('show');

            });

        });
    </script>
@endsection