<li class=" nav-item"><a class="d-flex align-items-center" href="#"><i data-feather="home"></i><span class="menu-title text-truncate" data-i18n="Dashboards">Dashboard</span></a>
    <ul class="menu-content">
      <li @if(Request::url() == url('home')) class="active" @endif><a class="d-flex align-items-center" href="{{ url('home') }}"><i class="fas fa-rupee-sign"></i><span class="menu-item text-truncate" data-i18n="Shop">Utilities & payments</span></a>
      </li>
          <li ><a class="d-flex align-items-center" href="{{ url('comingsoon') }}"><i class="fas fa-chart-line"></i><span class="menu-item text-truncate" data-i18n="View">Analytics</span></a>
          </li>
          <li><a class="d-flex align-items-center" href="{{ url('comingsoon') }}"><i data-feather='database'></i><span class="menu-item text-truncate" data-i18n="View">Hyperlocal</span></a>
          </li>
    </ul>
  </li>
  <li class=" nav-item"><a class="d-flex align-items-center" href="#"><i class="fas fa-cog"></i><span class="menu-title text-truncate" data-i18n="Dashboards">General</span></a>
    <ul class="menu-content">
        
        <li @if(Request::url() == url('utilitiesandpayments')) class="active" @endif ><a class="d-flex align-items-center" href="{{ url('utilitiesandpayments') }}"><i data-feather="home"></i><span class="menu-item text-truncate" data-i18n="View"></span>Home</a>
        </li>
        <li><a class="d-flex align-items-center" href="{{ url('comingsoon') }}"><i data-feather='box'></i><span class="menu-item text-truncate" data-i18n="Shop">Orders</span></a>
        </li>
        <li @if(Request::url() == url('addmoney')) class="active" @endif><a class="d-flex align-items-center" href="{{url('addmoney')}}"><i data-feather='plus-circle'></i><span class="menu-item text-truncate" data-i18n="Shop">Add Money</span></a>
        </li>
        <li @if(Request::url() == url('add_account')) class="active" @endif><a class="d-flex align-items-center" href="{{url('add_account')}}"><i data-feather='plus-square'></i><span class="menu-item text-truncate" data-i18n="Shop">Settlement</span></a>
        </li>
        <li @if(Request::url() == url('internal_transfer')) class="active" @endif><a class="d-flex align-items-center" href="{{url('internal_transfer')}}"><i data-feather='repeat'></i><span class="menu-item text-truncate" data-i18n="Shop">Internal/Network Transfer</span></a>
        </li>
        @if(session()->get('type') != 4)
        <li @if(Request::url() == url('mapping')) class="active" @endif><a class="d-flex align-items-center" href="{{url('mapping')}}"><i data-feather='repeat'></i><span class="menu-item text-truncate" data-i18n="Shop">Mapping</span></a>
        </li>
        @endif
        @if(session()->get('type') != 1)
          <li @if(Request::url() == url('mapping_request')) class="active" @endif><a class="d-flex align-items-center" href="{{url('mapping_request')}}"><i data-feather='repeat'></i><span class="menu-item text-truncate" data-i18n="Shop">Mapping List</span></a>
          </li>
        @endif
        <li @if(Request::url() == url('leinwallet')) class="active" @endif><a class="d-flex align-items-center" href="{{url('leinwallet')}}"><i class="fas fa-wallet"></i><span class="menu-item text-truncate" data-i18n="Shop">Lein Wallet</span></a>
        </li>
        <li><a class="d-flex align-items-center" href="{{ url('comingsoon') }}"><i class="fab fa-audible"></i><span class="menu-item text-truncate" data-i18n="Shop">Catalogue</span></a>
        </li>
        <li><a class="d-flex align-items-center" href="{{ url('comingsoon') }}"><i data-feather='flag'></i><span class="menu-item text-truncate" data-i18n="Shop">Commission</span></a>
        </li>
        <!--@if (check_is_reffer_user(session()->get('userid')) == 0)-->
        <!--<li @if(Request::url() == url('plan_purchase')) class="active" @endif><a class="d-flex align-items-center" href="{{ url('plan_purchase') }}"><i data-feather='zap'></i><span class="menu-item text-truncate" data-i18n="Shop">Upgrade Plan</span></a>-->
        <!--</li>    -->
        <!--@endif-->
        
    </ul>
  </li>
  <li class=" nav-item"><a class="d-flex align-items-center" href="#"><i class="fas fa-chart-line"></i><span class="menu-title text-truncate" data-i18n="Dashboards">Promotions</span></a>
    <ul class="menu-content">
        <li><a class="d-flex align-items-center" href="{{ url('comingsoon') }}"><i class="fas fa-percentage"></i><span class="menu-item text-truncate" data-i18n="Shop">Discount</span></a>
        </li>
        <li><a class="d-flex align-items-center" href="{{ url('comingsoon') }}"><i class="far fa-image"></i><span class="menu-item text-truncate" data-i18n="Shop">Add Banners</span></a>
        </li>
    </ul>
  </li>
  <li class=" nav-item"><a class="d-flex align-items-center" href="#"><i class="far fa-list-alt"></i><span class="menu-title text-truncate" data-i18n="Dashboards">Configure</span></a>
    <ul class="menu-content">
        <li><a class="d-flex align-items-center" href="{{ url('comingsoon') }}"><i class="fas fa-cog"></i><span class="menu-item text-truncate" data-i18n="Shop">Taxes, Fees & Charges</span></a>
        </li>
        <li @if(Request::url() == url('transactionpin')) class="active" @endif>
          <a class="d-flex align-items-center" href="{{url('transactionpin')}}"><span class="menu-item text-truncate" data-i18n="Account"><i data-feather='key'></i>Transaction Pin</span></a>
        </li>
    </ul>
  </li>
  @if(session()->get('type') != 1)
  <li class=" nav-item"><a class="d-flex align-items-center" href="#"><i class="fas fa-user-friends"></i><span class="menu-title text-truncate" data-i18n="Dashboards">Network</span></a>
    <ul class="menu-content">
      @if(session()->get('type') == 4)
        <li @if(Request::url() == url('merchant_network_list')) class="active" @endif><a class="d-flex align-items-center" href="{{ url('merchant_network_list') }}"><i class="fas fa-user-friends"></i><span class="menu-item text-truncate" data-i18n="Shop">Merchant network list</span></a>
        </li>
        <li @if(Request::url() == url('my_network')) class="active" @endif><a class="d-flex align-items-center" href="{{ url('my_network') }}"><i class="fas fa-user-friends"></i><span class="menu-item text-truncate" data-i18n="Shop">Distibutor Network List</span></a>
        </li>
      @endif
      @if(session()->get('type') == 3)
        <li @if(Request::url() == url('my_network')) class="active" @endif><a class="d-flex align-items-center" href="{{ url('my_network') }}"><i class="fas fa-user-friends"></i><span class="menu-item text-truncate" data-i18n="Shop">My network</span></a>
        </li>
      @endif
      @if(session()->get('type') == 3 || session()->get('type') == 4)
        <li @if(Request::url() == url('addnewnetwork')) class="active" @endif><a class="d-flex align-items-center" href="{{ url('addnewnetwork') }}"><i class="fas fa-user-plus"></i><span class="menu-item text-truncate" data-i18n="Shop">Add new network</span></a>
        </li>
        <li @if(Request::url() == url('credittonetwork')) class="active" @endif><a class="d-flex align-items-center" href="{{ url('credittonetwork ') }}"><i data-feather='plus'></i><span class="menu-item text-truncate" data-i18n="Shop">Credit To network</span></a>
        </li>
      @endif
      <li @if(Request::url() == url('total_business')) class="active" @endif><a class="d-flex align-items-center" href="{{ url('total_business') }}"><i data-feather='repeat'></i><span class="menu-item text-truncate" data-i18n="Shop">Total Business</span></a>
      </li>
    </ul>
  </li>
  @endif
<li @if(Request::url() == url('alltransaction')) class="active" @endif class="nav-item">
  <a class="d-flex align-items-center" href="{{ url('alltransaction') }}"><i data-feather='info'></i><span class="menu-title text-truncate" data-i18n="Calendar"></span>ledger</a>
</li>
<li  class="@if(Request::url() == url('linkgen')) active @endif nav-item">
  <a class="d-flex align-items-center" href="{{ url('linkgen') }}"><i data-feather='radio'></i><span class="menu-title text-truncate" data-i18n="Calendar"></span>EPOS </a>
</li>