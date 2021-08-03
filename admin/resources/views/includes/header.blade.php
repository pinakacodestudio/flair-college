<div class="br-header">
    <div class="br-header-left">
        <div class="navicon-left hidden-md-down"><a id="btnLeftMenu" href="#"><i class="icon ion-navicon-round"></i></a>
        </div>
        <div class="navicon-left hidden-lg-up"><a id="btnLeftMenuMobile" href="#"><i class="icon ion-navicon-round"></i></a>
        </div>
    {{--<div class="input-group hidden-xs-down wd-170 transition">
        <input id="searchbox" type="text" class="form-control" placeholder="Search">
        <span class="input-group-btn">
        <button class="btn btn-secondary" type="button"><i class="fa fa-search"></i></button>
      </span>
    </div>--}}<!-- input-group -->
    </div><!-- br-header-left -->
    <div class="br-header-right">
        <nav class="nav">
            <div class="dropdown">
                <a href="#" class="nav-link nav-link-profile" data-toggle="dropdown">
                    <span class="logged-name hidden-md-down">{!! Auth::user()->full_name !!}</span>
                    <img src="{!! asset('assets/img/avatar.jpg') !!}" class="wd-32 rounded-circle" alt="">
                    {{--<span class="square-10 bg-success"></span>--}}
                </a>
                <div class="dropdown-menu dropdown-menu-header wd-200">
                    <ul class="list-unstyled user-profile-nav">
                        <li><a href="{!! route('profile') !!}"><i class="icon ion-ios-person"></i> Edit Profile</a></li>
                        <li><a href="{!! route('settings') !!}"><i class="icon ion-ios-gear"></i> College Settings</a></li>
                        <li><a href="{!! route('campus') !!}"><i class="icon ion-ios-gear"></i> College Campus</a></li>
                        <li><a href="{!! route('staffs') !!}"><i class="icon ion-person-stalker"></i> College Staff</a></li>
                        <li>
                            <a href="javascript:;"
                               onclick="event.preventDefault();document.getElementById('logout-form')s.submit();"><i class="icon ion-power"></i> Sign Out</a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                  style="display: none;">
                                {{ csrf_field() }}
                            </form>
                        </li>
                    </ul>
                </div><!-- dropdown-menu -->
            </div><!-- dropdown -->
        </nav>
    {{--<div class="navicon-right">
        <a id="btnRightMenu" href="#" class="pos-relative">
            <i class="icon ion-ios-chatboxes-outline"></i>
            <!-- start: if statement -->
            <span class="square-8 bg-danger pos-absolute t-10 r--5 rounded-circle"></span>
            <!-- end: if statement -->
        </a>
    </div>--}}<!-- navicon-right -->
    </div><!-- br-header-right -->
</div><!-- br-header -->
