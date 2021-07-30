@extends('layouts.app')

@section('title', 'Refund Report')

@section('stylesheet')
    <link href="{!! asset('assets/lib/datatables/jquery.dataTables.css') !!}" rel="stylesheet">
    <link href="{!! asset('assets/lib/select2/css/select2.min.css') !!}" rel="stylesheet">
@endsection

@section('content')
    <div class="pd-x-15 pd-t-15">
        <h3 class="tx-gray-800 mg-b-10">Refund Report</h3>

    </div>

    <div class="br-pagebody">
        <div class="br-section-wrapper pd-20">

            @include('includes/messages')

            {{--<h6 class="tx-gray-800 tx-uppercase tx-bold tx-14 mg-b-20">Programs</h6>--}}
            {{--<p class="mg-b-25 mg-lg-b-50"></p>--}}

            <div class="table-wrapper">
                <table id="datatable1" class="table display responsive nowrap">
                    <thead>
                    <tr>
                        <th class="wd-15p">Student Name</th>
                        <th class="wd-15p">Application No</th>
                        <th class="wd-15p">Program</th>
                        <th class="wd-10p">Intake</th>
                        <th class="wd-10p">Refund Amount</th>
                        <th class="wd-10p">Payment Mode</th>
                        <th class="wd-10p">Refund Date</th>
                        <th class="wd-20p">Reference No</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($student_payment_refunds as $student_payment_refund)
                        <tr>
                            <td>{!! $student_payment_refund->student_admission->students_application->full_name !!}</td>
                            <td>
                                <a href="{!! route('applications.view',['id'=>$student_payment_refund->student_admission->students_application_id]) !!}"
                                   target="_blank">#{!! $student_payment_refund->student_admission->students_application->application_no !!} <i class="fa fa-external-link"></i></a>
                            </td>
                            <td>{!! $student_payment_refund->student_admission->program->name !!}</td>
                            <td>{!! $student_payment_refund->student_admission->intake->name !!}</td>
                            <td>{!! $student_payment_refund->amount !!}</td>
                            <td>{!! $student_payment_refund->payment_mode !!}</td>
                            <td>{!! $student_payment_refund->refund_at->format('Y-m-d') !!}</td>
                            <td>
                                <a href="{!! route('applications.refunds',['id'=>$student_payment_refund->student_admission->students_application_id]) !!}"
                                   target="_blank">{!! $student_payment_refund->reference_no !!} <i class="fa fa-external-link"></i></a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div><!-- table-wrapper -->
        </div><!-- br-section-wrapper -->
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
                dom: "lfrtip",
                //dom: 'Bfrtip',
                /*buttons: [
                    'copyHtml5',
                    'excelHtml5',
                    'csvHtml5',
                    'pdfHtml5'
                ],*/
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

        });
    </script>
@endsection
