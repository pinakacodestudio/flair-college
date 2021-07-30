@extends('layouts.app')

@section('title', 'All Programs')

@section('stylesheet')
    <link href="{!! asset('assets/lib/datatables/jquery.dataTables.css') !!}" rel="stylesheet">
    <link href="{!! asset('assets/lib/select2/css/select2.min.css') !!}" rel="stylesheet">
@endsection

@section('content')
    <div class="pd-x-15 pd-t-15">
        <h3 class="tx-gray-800 mg-b-10">All Program
            <a class="btn btn-outline-info btn-sm_ pull-right"
               href="{!! route('programs.create') !!}"><i class="fa fa-plus"></i>
                Create Program</a>
        </h3>

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
                        <th class="wd-20p">Name</th>
                        <th class="wd-20p">Academic Status</th>
                        <th class="wd-20p">Level of Study</th>
                        <th class="wd-20p">Type of Program</th>
                        <th class="wd-20p">Hrs/Week</th>
                        <th class="wd-20p">Duration</th>
                        <th class="wd-20p">Fees</th>
                        <th class="wd-20p">Status</th>
                        <th class="wd-20p">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($programs as $program)
                        <tr>
                            <td>{!! $program->name !!}</td>
                            <td>{!! $academic_status[$program->academic_status] !!}</td>
                            <td>{!! $level_of_study[$program->level_of_study] !!}</td>
                            <td>
                                @if($program->type_of_program == 'other')
                                    {!! $program->type_of_program_other !!}
                                @else
                                    {!! $type_of_program[$program->type_of_program] !!}
                                @endif
                            </td>
                            <td>{!! $program->hours_per_week !!}</td>
                            <td>
                                @if($program->program_duration_weeks != '')
                                    {!! $program->program_duration_weeks . ' Week/s' !!}
                                @elseif($program->program_duration_years != '')
                                    {!! $program->program_duration_years . ' Year/s' !!}
                                @endif
                            </td>
                            <td>{!! $program->total_fees !!}</td>
                            <td>
                                {{--@if($program->status == 1)
                                    <span class="badge badge-success">Active</span>
                                @else
                                    <span class="badge badge-danger">Deactive</span>
                                @endif--}}
                                @if($program->status == 1)
                                    <a data-action="deactive" data-id="{!! $program->id !!}"
                                       href="javascript:"
                                       data-type="program"
                                       class="badge badge-success manage_status_btn">
                                        Active
                                    </a>
                                @else
                                    <a data-action="active" data-id="{!! $program->id !!}"
                                       href="javascript:"
                                       data-type="program"
                                       class="badge badge-danger btn-sm manage_status_btn">
                                        Deactive
                                    </a>
                                @endif
                            </td>
                            <td data-sort="{!! $program->created_at->timestamp or '' !!}">
                                <a href="{!! route('programs.edit',['id'=>$program->id]) !!}"
                                   class="btn btn-success btn-sm">
                                    <i class="fa fa-pencil"></i> Edit
                                </a>
                                {{--<a data-href="{!! route('users.delete',['id'=>$user->id]) !!}"
                                   href="javascript:;"
                                   class="btn btn-danger btn-sm soft_delete_btn">
                                    <i class="fa fa-trash"></i> Delete
                                </a>--}}
                                {{--@if($program->status == 1)
                                    <a data-action="deactive" data-id="{!! $program->id !!}"
                                       href="javascript:;"
                                       data-type="program"
                                       class="btn btn-danger btn-sm manage_status_btn">
                                        <i class="fa fa-archive"></i> Deactivate
                                    </a>
                                @else
                                    <a data-action="active" data-id="{!! $program->id !!}"
                                       href="javascript:;"
                                       data-type="program"
                                       class="btn btn-success btn-sm manage_status_btn">
                                        <i class="fa fa-archive"></i> Activate
                                    </a>
                                @endif--}}
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

        });
    </script>
@endsection