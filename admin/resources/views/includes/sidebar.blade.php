<div class="br-logo"><a href="{!! route('dashboard') !!}">{!! config('app.name') !!}</a></div>
<div class="br-sideleft overflow-y-auto">
    <label class="sidebar-label pd-x-15 mg-t-20">Navigation</label>
    <div class="br-sideleft-menu">
        <a href="{!! route('dashboard') !!}" class="br-menu-link {{ request()->is('/') ? 'active' : '' }}">
            <div class="br-menu-item">
                <i class="menu-item-icon icon ion-ios-home-outline tx-22"></i>
                <span class="menu-item-label">Dashboard</span>
            </div>
        </a>
        @if(in_array(Auth::user()->user_type, ['super_admin','admin','agent']))
            <a href="{!! route('applications') !!}"
               class="br-menu-link {{ request()->is('applications*') ? 'active' : '' }}">
                <div class="br-menu-item">
                    <i class="menu-item-icon icon ion-ios-email-outline tx-24"></i>
                    <span class="menu-item-label">Student Applications</span>
                </div>
            </a>
            <a href="{!! route('users') !!}" class="br-menu-link {{ request()->is('users*') ? 'active' : '' }}">
                <div class="br-menu-item">
                    <i class="menu-item-icon icon ion-person-stalker tx-24"></i>
                    <span class="menu-item-label">Users</span>
                </div>
            </a>
            {{--<a href="{!! route('sub_agents') !!}" class="br-menu-link {{ request()->is('sub-agents*') ? 'active' : '' }}">
                <div class="br-menu-item">
                    <i class="menu-item-icon icon ion-person-stalker tx-24"></i>
                    <span class="menu-item-label">Sub Agents</span>
                </div>
            </a>--}}
        @endif
        @if(Auth::user()->user_type == 'super_admin')
            <a href="#" class="br-menu-link {{ request()->is('programs*') ? 'show-sub active' : '' }}">
                <div class="br-menu-item">
                    <i class="menu-item-icon icon ion-ios-book-outline tx-22"></i>
                    <span class="menu-item-label">Program Management</span>
                    <i class="menu-item-arrow fa fa-angle-down"></i>
                </div>
            </a>
            <ul class="br-menu-sub nav flex-column">
                <li class="nav-item">
                    <a href="{!! route('programs_intakes') !!}"
                       class="nav-link {{ request()->is('programs/intakes') ? 'active' : '' }}">Intake Management</a>
                </li>
                <li class="nav-item">
                    <a href="{!! route('programs') !!}"
                       class="nav-link {{ request()->is('programs') ? 'active' : '' }}">Program
                        Management</a>
                </li>
            </ul>
            <a href="javascript:;" data-href="{!! route('reports') !!}"
               class="br-menu-link {{ request()->is('reports*') ? 'show-sub active' : '' }}">
                <div class="br-menu-item">
                    <i class="menu-item-icon icon ion-ios-paper-outline tx-22"></i>
                    <span class="menu-item-label">Reports</span>
                    <i class="menu-item-arrow fa fa-angle-down"></i>
                </div>
            </a>
            <ul class="br-menu-sub nav flex-column">
                <li class="nav-item">
                    <a href="{!! route('reports.students') !!}"
                       class="nav-link {{ request()->is('reports/students') ? 'active' : '' }}">Students Report</a>
                </li>
                <li class="nav-item">
                    <a href="{!! route('reports.fees') !!}"
                       class="nav-link {{ request()->is('reports/fees') ? 'active' : '' }}">Fees Report</a>
                </li>
                <li class="nav-item">
                    <a href="{!! route('reports.refunds') !!}"
                       class="nav-link {{ request()->is('reports/refunds') ? 'active' : '' }}">Refunds Report</a>
                </li>
            </ul>
        @endif
    </div><!-- br-sideleft-menu -->

    <br>
</div><!-- br-sideleft -->
