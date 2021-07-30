@extends('layouts.app')

@section('title', 'Student Report')

@section('stylesheet')
    <link href="{!! asset('assets/lib/datatables/jquery.dataTables.css') !!}" rel="stylesheet">
    <link href="{!! asset('assets/lib/select2/css/select2.min.css') !!}" rel="stylesheet">
@endsection

@section('content')
    <div class="pd-x-15 pd-t-15">
        <h3 class="tx-gray-800 mg-b-10">Student Report</h3>

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
                        <th class="wd-20p">Student Name</th>
                        <th class="wd-20p">Program</th>
                        <th class="wd-20p">Intake</th>
                        <th class="wd-20p">Agent Name</th>
                        <th class="wd-20p">LOA status</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($student_admissions as $student_admission)
                        <tr>
                            <td>{!! $student_admission->students_application->full_name !!}</td>
                            <td>{!! $student_admission->program->name !!}</td>
                            <td>{!! $student_admission->intake->name !!}</td>
                            <td>{!! $student_admission->students_application->agent or '-' !!}</td>
                            <td>
                                @if($student_admission->students_application->admission_status == App\Helpers\Constant::ADMISSION_STATUS_DECLINE)
                                    <span class="badge badge-danger">Decline</span>
                                @elseif($student_admission->students_application->admission_status == App\Helpers\Constant::ADMISSION_STATUS_PENDING)
                                    <span class="badge badge-warning">Pending</span>
                                @elseif($student_admission->students_application->admission_status == App\Helpers\Constant::ADMISSION_STATUS_CONDITIONAL_LOA)
                                    <span class="badge badge-success">Conditional LOA</span>
                                @elseif($student_admission->students_application->admission_status == App\Helpers\Constant::ADMISSION_STATUS_PENDING_FINAL_LOA)
                                    <span class="badge badge-info">Pending Final LOA</span>
                                @elseif($student_admission->students_application->admission_status == App\Helpers\Constant::ADMISSION_STATUS_FINAL_LOA)
                                    <span class="badge badge-success">Final LOA</span>
                                @endif
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
