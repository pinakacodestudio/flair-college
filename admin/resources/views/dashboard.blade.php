@extends('layouts.app')

@section('title', 'Dashboard')

@section('stylesheet')

@endsection
@section('content')
    <div class="pd-15">
        <h4 class="tx-gray-800 mg-b-5">Dashboard</h4>
        <p class="mg-b-0">Students applications and LOA details</p>
    </div><!-- d-flex -->

    <div class="br-pagebody mg-t-0">
        <div class="row row-sm">
            <div class="col-sm-6 col-xl-3">
                <div class="bg-teal rounded overflow-hidden">
                    <div class="pd-25 d-flex align-items-center">
                        <i class="ion ion-calendar tx-60 lh-0 tx-white op-7"></i>
                        <div class="mg-l-20">
                            <p class="tx-10 tx-spacing-1 tx-mont tx-medium tx-uppercase tx-white-8 mg-b-10">Total
                                Applications</p>
                            <p class="tx-24 tx-white tx-lato tx-bold mg-b-2 lh-1">{!! $total_application !!}</p>
                            {{--<span class="tx-11 tx-roboto tx-white-6">24% higher yesterday</span>--}}
                        </div>
                    </div>
                </div>
            </div><!-- col-3 -->
            <div class="col-sm-6 col-xl-3 mg-t-20 mg-sm-t-0">
                <div class="bg-danger rounded overflow-hidden">
                    <div class="pd-25 d-flex align-items-center">
                        <i class="ion ion-ios-email-outline tx-60 lh-0 tx-white op-7"></i>
                        <div class="mg-l-20">
                            <p class="tx-10 tx-spacing-1 tx-mont tx-medium tx-uppercase tx-white-8 mg-b-10">New
                                Applications</p>
                            <p class="tx-24 tx-white tx-lato tx-bold mg-b-2 lh-1">{!! $new_application !!}</p>
                            {{--<span class="tx-11 tx-roboto tx-white-6">$390,212 before tax</span>--}}
                        </div>
                    </div>
                </div>
            </div><!-- col-3 -->
            <div class="col-sm-6 col-xl-3 mg-t-20 mg-xl-t-0">
                <div class="bg-primary rounded overflow-hidden">
                    <div class="pd-25 d-flex align-items-center">
                        <i class="ion ion-ios-paper-outline tx-60 lh-0 tx-white op-7"></i>
                        <div class="mg-l-20">
                            <p class="tx-10 tx-spacing-1 tx-mont tx-medium tx-uppercase tx-white-8 mg-b-10">Final
                                LOA</p>
                            <p class="tx-24 tx-white tx-lato tx-bold mg-b-2 lh-1">{!! $final_loa !!}</p>
                            {{--<span class="tx-11 tx-roboto tx-white-6">23% average duration</span>--}}
                        </div>
                    </div>
                </div>
            </div><!-- col-3 -->
            <div class="col-sm-6 col-xl-3 mg-t-20 mg-xl-t-0">
                <div class="bg-br-primary rounded overflow-hidden">
                    <div class="pd-25 d-flex align-items-center">
                        <i class="ion ion-clock tx-60 lh-0 tx-white op-7"></i>
                        <div class="mg-l-20">
                            <p class="tx-10 tx-spacing-1 tx-mont tx-medium tx-uppercase tx-white-8 mg-b-10">Pending
                                LOA</p>
                            <p class="tx-24 tx-white tx-lato tx-bold mg-b-2 lh-1">{!! $pending_loa !!}</p>
                            {{--<span class="tx-11 tx-roboto tx-white-6">65.45% on average time</span>--}}
                        </div>
                    </div>
                </div>
            </div><!-- col-3 -->
        </div><!-- row -->

    </div><!-- br-pagebody -->
@endsection

@section('javascript')
    {{--<script src="{!! asset('assets/js/dashboard.js') !!}"></script>--}}
@endsection