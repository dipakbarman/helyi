@if(session()->get('type') != 0)
<!-- BEGIN: Header-->
<nav class="header-navbar navbar navbar-expand-lg align-items-center floating-nav navbar-light navbar-shadow container-xxl">
  <div class="navbar-container d-flex content">
    <ul class="nav navbar-nav align-items-center ms-auto">
      {{-- <li class="nav-item px-2">
        <button type="button" class="btn btn-relief-success"><i data-feather='smartphone'></i> View website</button>
      </li>
      <li class="nav-item px-2">
        <button type="button" class="btn btn-relief-success"><i data-feather='smartphone'></i> Customer app</button>
      </li>
      <li class="nav-item px-2">
        <button type="button" class="btn btn-relief-success"><i class="fas fa-store"></i> Business app</button>
      </li> --}}
      <li class="nav-item px-1">
        <button type="button" class="btn btn-outline-success waves-effect"><i data-feather='smartphone'></i> Customer app</button>
      </li>
      <li class="nav-item px-1">
          <button type="button" class="btn btn-outline-success waves-effect"><i class="fas fa-store"></i> Business app</button>
      </li>
      <li class="nav-item" style="margin-right: 15px;">
        <a href="{{ url('transaction_history') }}">
        <i class="fas fa-wallet"></i> Lein Wallet : <i class="fas fa-rupee-sign"></i> {{ number_format(get_lein_wallet_bal(),0)}}
      </a>
      </li>
      <li class="nav-item" id="bal_sec">
        <a href="{{ url('addmoney') }}">
        <i class="fas fa-wallet"></i> Main : <i class="fas fa-rupee-sign"></i>  {{number_format(get_wallet_bal(),0)}}
      </a>
      </li>
      @php
            $notification = DB::table('notification')->where('uid',session()->get('userid'))->orderBy('id','DESC')->limit(10)->get();
      @endphp
      <li class="nav-item dropdown dropdown-notification me-25"><a id="notification_sec" onclick="count_zero()" class="nav-link" href="#" data-bs-toggle="dropdown"><i class="ficon" data-feather="bell"></i><span class="badge rounded-pill bg-danger badge-up" id="check_notification_count"></span></a>
        <ul class="dropdown-menu dropdown-menu-media dropdown-menu-end">
          <li class="dropdown-menu-header">
            <div class="dropdown-header d-flex">
              <h4 class="notification-title mb-0 me-auto">Notifications</h4>
              
            </div>
          </li>
          <li class="scrollable-container media-list">
          
            <div class="funds_received_sec">
              @foreach ($notification as $list)
              <a class="d-flex" href="#">
                <div class="list-item d-flex align-items-start">
                  <div class="me-1">
                    @if ($list->type == 1)
                    <div class="avatar bg-light-success">
                      <div class="avatar-content"><i data-feather='plus'></i></div>
                    </div>
                    @endif
                    @if ($list->type == 2)
                    <div class="avatar bg-light-danger">
                      <div class="avatar-content"><i data-feather='minus'></i></div>
                    </div>
                    @endif
                    
                  </div>
                  @if ($list->type == 1)
                  <div class="list-item-body flex-grow-1">
                    <p class="media-heading"><span class="fw-bolder" style="text-transform: capitalize;"> ₹ {{$list->remark}} </span>&nbsp;</p>
                  </div>    
                  @endif
                  @if ($list->type == 2)
                  <div class="list-item-body flex-grow-1">
                    <p class="media-heading"><span class="fw-bolder" style="text-transform: capitalize;">
                      ₹ {{$list->remark}}
                    </span>&nbsp;</p>
                  </div>    
                  @endif
                  
                </div></a>
              @endforeach
            </div>
          </li>
          <li class="dropdown-menu-footer"><a class="btn btn-success w-100" href="{{ url('alltransaction') }}">Read all notifications</a></li>
        </ul>
      </li>
      <li class="nav-item d-none d-lg-block"><a class="nav-link nav-link-style"><i class="ficon" data-feather="moon"></i></a></li>
      {{-- <li class="nav-item nav-search"><a class="nav-link nav-link-search"><i class="ficon" data-feather="search"></i></a>
        <div class="search-input">
          <div class="search-input-icon"><i data-feather="search"></i></div>
          <input class="form-control input" type="text" placeholder="Explore Vuexy..." tabindex="-1" data-search="search">
          <div class="search-input-close"><i data-feather="x"></i></div>
          <ul class="search-list search-list-main"></ul>
        </div>
      </li> --}}

      <li class="nav-item dropdown dropdown-user"><a class="nav-link dropdown-toggle dropdown-user-link" id="dropdown-user" href="#" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <div class="user-nav d-sm-flex d-none"><span style="  text-transform: capitalize;" class="user-name fw-bolder">{{ get_user_firstname(session()->get('userid')) }}</span><span class="user-status"> @if(session()->get('type') == 1)  Merchant @endif @if(session()->get('type') == 3) Distributor @endif @if(session()->get('type') == 4) Master Distributor @endif </span>
          <span class="user-status" >Current plan - {{ current_plan_name() }}</span>
          </div><span class="avatar"><img class="round" src="{{ url('storage/app/'.get_user_shop_logo(session()->get('userid'))) }}" alt="avatar" height="40" width="40"><span class="avatar-status-online"></span></span></a>
        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdown-user">
          <a class="dropdown-item" href="{{ url('profile') }}"><i data-feather='user'></i> Profile</a>
          <a class="dropdown-item" href="{{ url('logout') }}"><i class="me-50" data-feather="power"></i> Logout</a>
        </div>
      </li>
    </ul>
  </div>
</nav>
@endif