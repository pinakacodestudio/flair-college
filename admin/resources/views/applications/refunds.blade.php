@extends('layouts.app')

@section('title', 'All Refunds')

@section('stylesheet')
    <link href="{!! asset('assets/lib/datatables/jquery.dataTables.css') !!}" rel="stylesheet">
    <link href="{!! asset('assets/lib/select2/css/select2.min.css') !!}" rel="stylesheet">
@endsection

@section('content')
    <div class="pd-x-15 pd-t-15">
        <h3 class="tx-gray-800 mg-b-10">All refunds of student application
            <a href="{!! route('applications.view', [$students_application->id]) !!}">#{!! $students_application->application_no !!}</a>
            <a class="btn btn-outline-info btn-sm_ pull-right"
               href="{!! route('applications.payments',['id'=>$students_application->id]) !!}"><i
                        class="fa fa-list"></i>
                All Payments</a>
        </h3>
    </div>

    <div class="br-pagebody">
        <div class="row">
            <div class="col-lg-8">
                @include('includes/messages')

                <div class="bg-white rounded shadow-base pd-20">
                    {{--<h6 class="tx-gray-800 tx-uppercase tx-bold tx-14 mg-b-20">Payments</h6>--}}
                    {{--<p class="mg-b-25 mg-lg-b-50">Searching, ordering and paging goodness will be immediately added to the
                        table, as shown in this example.</p>--}}

                    @if(count($student_payment_refund))
                        <div class="table-wrapper">
                            <table id="datatable1" class="table display responsive nowrap">
                                <thead>
                                <tr>
                                    <th class="wd-10p">Amount</th>
                                    <th class="wd-10p">Refund mode</th>
                                    <th class="wd-10p">Reference no</th>
                                    <th class="wd-10p">Refund Date</th>
                                    <th class="wd-20p">Note</th>
                                    <th class="wd-10p">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($student_payment_refund as $payment)
                                    <tr>
                                        <td>{!! $payment->amount !!}</td>
                                        <td>{!! $payment->payment_mode !!}</td>
                                        <td>{{ $payment->reference_no }}</td>
                                        <td>{!! $payment->refund_at->format('Y-m-d') !!}</td>
                                        <td>{{ $payment->note }}</td>
                                        <td>
                                            <a href="javascript:;"
                                               data-refund_data="{{$payment->toJson()}}"
                                               data-refund_at="{{$payment->refund_at->format('Y-m-d')}}"
                                               class="btn btn-success btn-sm edit_student_payment_refund">
                                                <i class="fa fa-edit"></i> Edit
                                            </a>
                                            <a href="javascript:;"
                                               data-id="{!! $payment->id !!}"
                                               data-href="{!! route('applications.refund_delete',['id'=>$payment->id]) !!}"
                                               class="btn btn-danger btn-sm soft_delete_btn"><i class="fa fa-trash"></i>
                                                Delete</a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div><!-- table-wrapper -->
                    @else
                        No refund record found.
                    @endif
                </div>
            </div>
            <div class="col-lg-4">
                <div class="bg-white rounded shadow-base pd-20">
                    <h6 class="tx-gray-800 tx-uppercase tx-bold tx-14 mg-b-20">Add New Refund</h6>
                    {{--<p class="mg-b-25 mg-lg-b-50"></p>--}}
                    <form autocomplete="off" id="form_create_payment_refund" method="get">
                        <input type="hidden" name="student_admission_id" id="student_admission_id"
                               value="{!! $student_admission->id !!}">
                        <div class="form-group">
                            <label class="form-control-label">Amount: <span class="tx-danger">*</span></label>
                            <input class="form-control" type="text" name="amount" id="amount"
                                   value="{!! ($payment?$payment->amount:'') !!}"
                                   placeholder="Enter amount" required>
                        </div>
                        <div class="form-group">
                            <label class="form-control-label">Refund Mode: <span class="tx-danger">*</span></label>
                            <select class="form-control select2__" name="payment_mode" id="payment_mode"
                                    data-placeholder="Choose refund mode" required>
                                <option value="">Select refund mode</option>
                                @foreach($payment_modes as $value)
                                    <option value="{!! $value !!}">
                                        {!! $value !!}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="form-control-label">Reference no: <span class="tx-danger">*</span></label>
                            <input class="form-control" type="text" name="reference_no" id="reference_no" value=""
                                   placeholder="Enter reference no" required>
                        </div>
                        <div class="form-group">
                            <label class="form-control-label">Refund Date: <span class="tx-danger">*</span></label>
                            <input class="form-control fc-datepicker" type="text" name="refund_at" id="refund_at"
                                   value=""
                                   placeholder="Select payment date" required>
                        </div>
                        <div class="form-group">
                            <label class="form-control-label">Note: </label>
                            <input class="form-control" type="text" name="note" id="note" value=""
                                   placeholder="Enter note">
                        </div>
                        <div class="form-group text-right">
                            <button class="btn btn-info" id="submit_btn">Save</button>
                        </div>
                    </form>
                </div>
            </div><!-- br-section-wrapper -->
        </div>
        <div id="editStudentPaymentModal" class="modal fade">
            <div class="modal-dialog modal-dialog-vertical-center" role="document">
                <div class="modal-content bd-0 tx-14">
                    <form action="#" id="form_edit_payment_refund" method="post">
                        <div class="modal-header pd-y-20 pd-x-25">
                            <h6 class="tx-14 mg-b-0 tx-uppercase tx-inverse tx-bold">Edit Refund</h6>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body pd-25">
                            <div class="form-group">
                                <label class="form-control-label">Amount: <span class="tx-danger">*</span></label>
                                <input class="form-control" type="text" name="amount" id="amount_edit" value=""
                                       placeholder="Enter amount">
                            </div>
                            <div class="form-group">
                                <label class="form-control-label">Refund Mode: <span class="tx-danger">*</span></label>
                                <select class="form-control select2__" name="payment_mode" id="payment_mode_edit"
                                        data-placeholder="Choose refund mode" required>
                                    <option value="">Select refund mode</option>
                                    @foreach($payment_modes as $value)
                                        <option value="{!! $value !!}">
                                            {!! $value !!}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="form-control-label">Reference no: <span class="tx-danger">*</span></label>
                                <input class="form-control" type="text" name="reference_no" id="reference_no_edit"
                                       value=""
                                       placeholder="Enter reference no">
                            </div>
                            <div class="form-group">
                                <label class="form-control-label">Refund Date: <span class="tx-danger">*</span></label>
                                <input class="form-control fc-datepicker" type="text" name="refund_at"
                                       id="refund_at_edit"
                                       value=""
                                       placeholder="Select payment date">
                            </div>
                            <div class="form-group">
                                <label class="form-control-label">Note: </label>
                                <input class="form-control" type="text" name="note" id="note_edit" value=""
                                       placeholder="Enter note">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <input type="hidden" name="id" value="0" id="student_payment_refund_id"/>
                            <button type="submit"
                                    class="btn btn-primary tx-11 tx-uppercase pd-y-12 pd-x-25 tx-mont tx-medium student_payment_refund_update_btn">
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

            $('#datatable1_').DataTable({
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


            $("#form_create_payment_refund").on('submit', function (e) {
                e.preventDefault();
                $("#name").attr('disable', 'disable');
                $.ajax({
                    type: 'POST',
                    url: getUrl('ajax/create_payment_refund'),
                    data: $("#form_create_payment_refund").serialize(),
                    success: function (res) {
                        if (res.error === 1) {
                            /*swal.fire({
                                type: 'error',
                                title: 'Oops...',
                                text: res.message,
                            });*/
                            //alert(res.message);
                            Swal.fire(
                                'Payment create fail',
                                res.message,
                                'error'
                            );
                            $("#amount").focus();
                        } else {
                            window.location.reload();
                        }
                    },
                    error: function () {

                    },
                    done: function () {
                        $("#amount").removeAttr('disable');
                    }
                });
            });

            $("#form_edit_payment_refund").on('submit', function (e) {
                e.preventDefault();
                $(".student_payment_refund_update_btn").attr('disable', 'disable');
                $.ajax({
                    type: 'POST',
                    url: getUrl('ajax/edit_payment_refund'),
                    data: $("#form_edit_payment_refund").serialize(),
                    success: function (res) {
                        if (res.error === 1) {
                            /*swal.fire({
                                type: 'error',
                                title: 'Oops...',
                                text: res.message,
                            });*/
                            Swal.fire(
                                'Payment update fail',
                                res.message,
                                'error'
                            );
                            $("#editStudentPaymentModal").find("#name_edit").focus();
                            //alert(res.message);
                        } else {
                            window.location.reload();
                        }
                    },
                    error: function () {

                    },
                    done: function () {
                        $(".student_payment_refund_update_btn").removeAttr('disable');
                        $("#editStudentPaymentModal").modal('hide');
                    }
                });

            });

            $(".edit_student_payment_refund").on('click', function (e) {
                e.preventDefault();
                var refund_data = $(this).data('refund_data');
                var refund_at = $(this).data('refund_at');

                $("#editStudentPaymentModal").find("#amount_edit").val(refund_data.amount);
                $("#editStudentPaymentModal").find("#amount_edit").val(refund_data.amount);
                $("#editStudentPaymentModal").find("#payment_mode_edit").val(refund_data.payment_mode);
                $("#editStudentPaymentModal").find("#reference_no_edit").val(refund_data.reference_no);
                $("#editStudentPaymentModal").find("#refund_at_edit").val(refund_at);
                $("#editStudentPaymentModal").find("#note_edit").val(refund_data.note);

                $("#editStudentPaymentModal").find("#student_payment_refund_id").val(refund_data.id);
                $("#editStudentPaymentModal").modal('show');
            });
            $("#amount").focus();
        });
    </script>
@endsection