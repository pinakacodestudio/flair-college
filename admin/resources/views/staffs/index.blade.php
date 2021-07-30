@extends('layouts.app')

@section('title','All Staff')

@section('stylesheet')
    <link href="{!! asset('assets/lib/datatables/jquery.dataTables.css') !!}" rel="stylesheet">
    <link href="{!! asset('assets/lib/select2/css/select2.min.css') !!}" rel="stylesheet">
@endsection

@section('content')

    <div class="pd-x-15 pd-t-15">
        <h3 class="tx-gray-800 mg-b-10">All Staffs <a class="btn btn-outline-info btn-sm_ pull-right"
                                                      href="{!! route('staffs.create') !!}"><i class="fa fa-plus"></i>
                Create
                Staff</a></h3>
    </div>

    <div class="br-pagebody">
        <div class="br-section-wrapper pd-20">

            @include('includes/messages')


            <div class="table-wrapper">
                <table id="datatable1" class="table display responsive nowrap">
                    <thead>
                    <tr>
                        <th class="wd-20p">Full Name</th>
                        <th class="wd-15p">Mobile</th>
                        <th class="wd-20p">Position</th>
                        <th class="wd-15p">Extension</th>
                        <th class="wd-15p">Signature</th>
                        <th class="wd-10p">Status</th>
                        <th class="wd-20p">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($college_staffs as $staff)
                        <tr>
                            <td>{!! $staff->full_name  !!}</td>
                            <td><a href="tel:{!! $staff->mobile !!}">{!! $staff->mobile !!}</a></td>
                            <td>{!! $staff_position[$staff->position] or '' !!}</td>
                            <td>{!! $staff->extension !!}</td>
                            <td>
                                @if($staff->signature_filename)
                                    <img src="{!! route('storage_signature',['filename'=>$staff->signature_filename]); !!}" style="width: 100px;max-height: 100px;"/>
                                @else
                                    N/A
                                @endif
                            </td>
                            <td>
                                @if($staff->status == 1)
                                    <a data-action="deactive" data-id="{!! $staff->id !!}"
                                       href="javascript:"
                                       data-type="staff"
                                       class="badge badge-success manage_status_btn">
                                        Active
                                    </a>
                                @else
                                    <a data-action="active" data-id="{!! $staff->id !!}"
                                       href="javascript:"
                                       data-type="staff"
                                       class="badge badge-danger btn-sm manage_status_btn">
                                        Deactive
                                    </a>
                                @endif
                            </td>
                            <td data-sort="{!! $staff->created_at->timestamp or '' !!}">
                                <a href="{!! route('staffs.edit',['id'=>$staff->id]) !!}"
                                   class="btn btn-success btn-sm"
                                   title="Edit">
                                    <i class="fa fa-pencil"></i> Edit</a>
                                <a data-href="{!! route('staffs.delete',['id'=>$staff->id]) !!}"
                                   href="javascript:"
                                   class="btn btn-danger btn-sm soft_delete_btn">
                                    <i class="fa fa-trash"></i> Delete
                                </a>
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
        jQuery(document).ready(function () {
            /*$('#datatable').dataTable({
                // dom: "Bfrtip",
                // dom: "rtip",
                dom: '<"top"fl>rt<"bottom"ip>',
                "order": [[7, "desc"]],
                // select: true
            });*/
        });

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
