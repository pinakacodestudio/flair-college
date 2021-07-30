@extends('layouts.app')

@section('title','All Sub Agents')

@section('stylesheet')
    <link href="{!! asset('assets/lib/datatables/jquery.dataTables.css') !!}" rel="stylesheet">
    <link href="{!! asset('assets/lib/select2/css/select2.min.css') !!}" rel="stylesheet">
@endsection

@section('content')

    <div class="pd-x-15 pd-t-15">
        <h3 class="tx-gray-800 mg-b-10">Sub Agents <a class="btn btn-primary btn-sm_ pull-right"
                                                 href="{!! route('sub_agents.create') !!}"><i class="fa fa-plus"></i> Create
                Sub Agent</a></h3>

    </div>

    @include('includes/messages')

    <div class="br-pagebody">
        <div class="br-section-wrapper pd-20">
            {{--<h6 class="tx-gray-800 tx-uppercase tx-bold tx-14 mg-b-20">Sub Agents</h6>--}}
            {{--<p class="mg-b-25 mg-lg-b-50">Searching, ordering and paging goodness will be immediately added to the
                table, as shown in this example.</p>--}}

            <div class="table-wrapper">
                <table id="datatable1" class="table display responsive nowrap">
                    <thead>
                    <tr>
                        <th class="wd-20p">Full Name</th>
                        <th class="wd-20p">E-mail</th>
                        <th class="wd-15p">Mobile</th>
                        <th class="wd-10p">Country</th>
                        <th class="wd-10p">Status</th>
                        <th class="wd-20p">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($sub_agents as $sub_agent)
                        <tr>
                            <td>{!! $sub_agent->full_name  !!}</td>
                            <td><a href="mailto:{!! $sub_agent->email !!}">{!! $sub_agent->email !!}</a></td>
                            <td><a href="tel:{!! $sub_agent->mobile !!}">{!! $sub_agent->mobile !!}</a></td>
                            <td>{!! $sub_agent->country !!}</td>
                            <td>
                                @if($sub_agent->status == 1)
                                    <span class="badge badge-success">Active</span>
                                @else
                                    <span class="badge badge-danger">Deactive</span>
                                @endif
                            </td>
                            <td data-sort="{!! $sub_agent->created_at->timestamp or '' !!}">
                                <a href="{!! route('users.edit',['id'=>$sub_agent->id]) !!}"
                                   class="btn btn-success btn-sm">
                                    <i class="fa fa-pencil"></i> Edit
                                </a>
                                {{--<a data-href="{!! route('users.delete',['id'=>$sub_agent->id]) !!}"
                                   href="javascript:;"
                                   class="btn btn-danger btn-sm soft_delete_btn">
                                    <i class="fa fa-trash"></i> Delete
                                </a>--}}
                                @if($sub_agent->status == 1)
                                    <a data-action="deactive" data-id="{!! $sub_agent->id !!}"
                                       href="javascript:;"
                                       data-type="sub_agent"
                                       class="btn btn-danger btn-sm manage_status_btn">
                                        <i class="fa fa-archive"></i> Deactivate
                                    </a>
                                @else
                                    <a data-action="active" data-id="{!! $sub_agent->id !!}"
                                       href="javascript:;"
                                       data-type="sub_agent"
                                       class="btn btn-success btn-sm manage_status_btn">
                                        <i class="fa fa-archive"></i> Activate
                                    </a>
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
                //dom: "Bfrtip",
                //dom: "rtip",
                dom: "lfrtip",
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

        });
    </script>
@endsection