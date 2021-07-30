@extends('layouts.app')

@section('title', 'Users')

@section('stylesheet')
    <link href="{!! asset('assets/lib/datatables/jquery.dataTables.css') !!}" rel="stylesheet">
    <link href="{!! asset('assets/lib/select2/css/select2.min.css') !!}" rel="stylesheet">
@endsection
@section('content')
    <div class="pd-x-20 pd-sm-x-30 pd-t-20 pd-sm-t-30">
        <h4 class="tx-gray-800 mg-b-5">Users <a class="btn btn-primary btn-sm pull-right" href="{!! route('users.create') !!}"><i class="fa fa-plus"></i> Create User</a></h4>

    </div>

    @include('includes/messages')

    <div class="br-pagebody">
        <div class="br-section-wrapper pd-30">
            <h6 class="tx-gray-800 tx-uppercase tx-bold tx-14 mg-b-20">Users</h6>
            {{--<p class="mg-b-25 mg-lg-b-50">Searching, ordering and paging goodness will be immediately added to the
                table, as shown in this example.</p>--}}

            <div class="table-wrapper">
                <table id="datatable1" class="table display responsive nowrap">
                    <thead>
                    <tr>
                        <th class="wd-20p">Name</th>
                        <th class="wd-20p">E-mail</th>
                        <th class="wd-15p">Role</th>
                        <th class="wd-10p">Country</th>
                        <th class="wd-20p">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>Admin User</td>
                        <td>admin.user@example.com</td>
                        <td>Admin</td>
                        <td>Canada</td>
                        <td>
                            <a class="btn btn-primary btn-sm" href="{!! route('users') !!}"><i
                                        class="fa fa-pencil"></i> Edit</a>
                            <a class="btn btn-danger btn-sm" href="javascript:;"><i class="fa fa-trash"></i> Delete</a>
                        </td>
                    </tr>
                    <tr>
                        <td>Agent User</td>
                        <td>agent.user@example.com</td>
                        <td>Agent</td>
                        <td>US</td>
                        <td>
                            <a class="btn btn-primary btn-sm" href="{!! route('users') !!}"><i
                                        class="fa fa-pencil"></i> Edit</a>
                            <a class="btn btn-danger btn-sm" href="javascript:;"><i class="fa fa-trash"></i> Delete</a>
                        </td>
                    </tr>
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
                responsive: true,
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