@extends('layouts.app')

@section('title','College Campus')

@section('stylesheet')
    <link href="{!! asset('assets/lib/datatables/jquery.dataTables.css') !!}" rel="stylesheet">
    <link href="{!! asset('assets/lib/select2/css/select2.min.css') !!}" rel="stylesheet">
@endsection

@section('content')

    <div class="pd-x-15 pd-t-15">
        <h3 class="tx-gray-800 mg-b-10">College Campus <a class="btn btn-outline-info btn-sm_ pull-right"
                                                          href="{!! route('campus.create') !!}"><i
                        class="fa fa-plus"></i>
                Create
                College Campus</a></h3>
    </div>

    <div class="br-pagebody">
        <div class="br-section-wrapper pd-20">

            @include('includes/messages')


            <div class="table-wrapper">
                <table id="datatable1" class="table display responsive nowrap">
                    <thead>
                    <tr>
                        <th class="wd-20p">Name</th>
                        <th class="wd-15p">Staff</th>
                        <th class="wd-15p">Phone</th>
                        <th class="wd-10p">Status</th>
                        <th class="wd-20p">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($college_campus as $col_campus)
                        <tr>
                            <td>{!! $col_campus->name  !!}</td>
                            <td>{!! $col_campus->staff?$col_campus->staff->full_name:'N/A' !!}</td>
                            <td><a href="tel:{!! $col_campus->phone !!}">{!! $col_campus->phone !!}</a></td>
                            <td>
                                @if($col_campus->status == 1)
                                    <a data-action="deactive" data-id="{!! $col_campus->id !!}"
                                       href="javascript:"
                                       data-type="campus"
                                       class="badge badge-success manage_status_btn">
                                        Active
                                    </a>
                                @else
                                    <a data-action="active" data-id="{!! $col_campus->id !!}"
                                       href="javascript:"
                                       data-type="campus"
                                       class="badge badge-danger btn-sm manage_status_btn">
                                        Deactive
                                    </a>
                                @endif
                            </td>
                            <td data-sort="{!! $col_campus->created_at->timestamp or '' !!}">
                                <a href="{!! route('campus.edit',['id'=>$col_campus->id]) !!}"
                                   class="btn btn-success btn-sm"
                                   title="Edit">
                                    <i class="fa fa-pencil"></i> Edit</a>
                                <a data-href="{!! route('campus.delete',['id'=>$col_campus->id]) !!}"
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
