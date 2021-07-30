@extends('layouts.app')

@section('title', 'Student Applications')

@section('stylesheet')
    <link href="{!! asset('assets/lib/datatables/jquery.dataTables.css') !!}" rel="stylesheet">
    <link href="{!! asset('assets/lib/select2/css/select2.min.css') !!}" rel="stylesheet">
@endsection

@section('content')

    <div class="pd-x-15 pd-t-15">
        <h3 class="tx-gray-800 mg-b-10">Students applications</h3>
    </div>

    <div class="br-pagebody">
        <div class="br-section-wrapper pd-20">

            @include('includes/messages')

            {{--<h6 class="tx-gray-800 tx-uppercase tx-bold mg-b-15">Students applications</h6>--}}
            {{--<p class="mg-b-25 mg-lg-b-50">Searching, ordering and paging goodness will be immediately added to the
                table, as shown in this example.</p>--}}

            <div class="table-wrapper">
                <table id="datatable1" class="table display responsive nowrap">
                    <thead>
                    <tr>
                        <th class="wd-10p">Appli. No.</th>
                        <th class="wd-10p">Agent</th>
                        <th class="wd-20p">Name</th>
                        <th class="wd-20p">E-mail</th>
                        <th class="wd-15p">Qualification</th>
                        <th class="wd-10p">Country</th>
                        <th class="wd-15p">Program Interested In</th>
                        <th class="wd-15p">Status</th>
                        <th class="wd-20p">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($students_applications as $students_application)
                        <tr>
                            <td>{!! $students_application->application_no !!}</td>
                            <td>{!! $students_application->agent_name or '-' !!}</td>
                            <td>{!! $students_application->full_name !!}</td>
                            <td>{!! $students_application->email !!}</td>
                            <td>{!! $students_application->academic_qualification_name !!}</td>
                            <td>{!! $students_application->home_country !!}</td>
                            <td>
                                {!! implode(',<br/>',$students_application->program_interested_in) !!}
                            </td>
                            <td class="text-center_">
                                @if($students_application->admission_status == App\Helpers\Constant::ADMISSION_STATUS_DECLINE)
                                    <span class="badge badge-danger">Decline</span>
                                @elseif($students_application->admission_status == App\Helpers\Constant::ADMISSION_STATUS_PENDING)
                                    <span class="badge badge-warning">Pending</span>
                                @elseif($students_application->admission_status == App\Helpers\Constant::ADMISSION_STATUS_CONDITIONAL_LOA)
                                    <span class="badge badge-success">Conditional LOA</span>
                                @elseif($students_application->admission_status == App\Helpers\Constant::ADMISSION_STATUS_PENDING_FINAL_LOA)
                                    <span class="badge badge-info">Pending Final LOA</span>
                                @elseif($students_application->admission_status == App\Helpers\Constant::ADMISSION_STATUS_FINAL_LOA)
                                    <span class="badge badge-success">Final LOA</span>
                                @endif
                            </td>
                            <td>
                                <a class="btn btn-success btn-sm"
                                   href="{!! route('applications.view',['id'=>$students_application->id]) !!}"><i
                                            class="fa fa-eye"></i></a>`
                                {{--<a class="btn btn-warning btn-sm" href="{!! route('applications.edit') !!}"><i
                                            class="fa fa-pencil"></i></a>--}}

                                @if($students_application->admission_status == App\Helpers\Constant::ADMISSION_STATUS_PENDING)
                                    <a class="btn btn-danger btn-sm decline_application" href="javascript:"
                                       title="Decline Application" data-id="{!! $students_application->id !!}"><i
                                                class="fa fa-ban"></i></a>
                                @endif

                                @if($students_application->admission_status == App\Helpers\Constant::ADMISSION_STATUS_CONDITIONAL_LOA)
                                    <a class="btn btn-info btn-sm"
                                       title="Download Conditional LOA"
                                       href="{!! route('applications.download_conditional_loa',['id'=>$students_application->id]) !!}"><i
                                                class="fa fa-download"></i></a>
                                @elseif($students_application->admission_status == App\Helpers\Constant::ADMISSION_STATUS_FINAL_LOA)
                                    <a class="btn btn-info btn-sm"
                                       title="Download Final LOA"
                                       href="{!! route('applications.download_final_loa',['id'=>$students_application->id]) !!}"><i
                                                class="fa fa-download"></i></a>
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


            $(".decline_application").on('click', function (e) {
                e.preventDefault();

                var id = $(this).data('id');

                Swal.fire({
                    title: "Are you sure? You want to decline students application?",
                    text: '',
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, decline!'
                }).then((result) => {
                    if (result.value) {
                        Swal.fire({
                            title: "Processing...",
                            text: "Please wait",
                            showConfirmButton: false,
                            allowOutsideClick: false,
                            timer: 20000,
                        });
                        $.post(getUrl('ajax/decline_application'), {id: id}, function (data) {
                            Swal.fire(
                                'Declined!',
                                'Decline successfully.',
                                'success'
                            ).then(() => {
                                window.location.reload();
                            });
                        }).fail(function (data) {
                            Swal.fire(
                                'Decline fail',
                                'Something went wrong.',
                                'error'
                            )
                        }).done(function (data) {

                        });
                    }
                });
            });
        });
    </script>
@endsection
