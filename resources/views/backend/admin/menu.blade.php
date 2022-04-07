<li class=" nav-item"><a class="d-flex align-items-center" href="{{ url('dashboard') }}"><i data-feather="home"></i><span class="menu-title text-truncate" data-i18n="Dashboards">Dashboards</span></a>
    <ul class="menu-content">
        <li><a class="d-flex align-items-center" href="{{ url('dashboard') }}"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Analytics">Dashboard</span></a>
        </li>
        <li><a class="d-flex align-items-center" href="{{ url('paymentandutilities') }}"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Analytics">Payment & Utilities</span></a>
      </li>
      <li><a class="d-flex align-items-center" href="#"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="eCommerce">Hyperlocal</span></a>
      </li>
    </ul>
  </li>
  <li class=" nav-item"><a class="d-flex align-items-center" href="#"><i data-feather='users'></i><span class="menu-title text-truncate" data-i18n="Dashboards">Users</span></a>
    <ul class="menu-content">
      <li @if(Request::url() == url('userlist')) class="active" @endif>
        <a class="d-flex align-items-center" href="{{ url('userlist') }}">
          <i data-feather='users'></i><span class="menu-item text-truncate" data-i18n="Analytics">Userlist</span>
        </a>
      </li>
      <li @if(Request::url() == url('storelist')) class="active" @endif>
        <a class="d-flex align-items-center" href="{{ url('storelist') }}">
          <i class="fas fa-store"></i><span class="menu-item text-truncate" data-i18n="Analytics">Store</span>
        </a>
      </li>
      <li @if(Request::url() == url('distributorlist')) class="active" @endif>
        <a class="d-flex align-items-center" href="{{ url('distributorlist') }}">
          <i data-feather='users'></i><span class="menu-item text-truncate" data-i18n="Analytics">Distributors</span>
        </a>
      </li>
      <li @if(Request::url() == url('masterdistributorlist')) class="active" @endif>
        <a class="d-flex align-items-center" href="{{ url('masterdistributorlist') }}">
          <i data-feather='user'></i><span class="menu-item text-truncate" data-i18n="Analytics">Master Distributors</span>
        </a>
        </li>
      <li @if(Request::url() == url('admincreateuser')) class="active" @endif>
        <a class="d-flex align-items-center" href="{{ url('admincreateuser') }}">
          <i class="fas fa-user-plus"></i><span class="menu-item text-truncate" data-i18n="Analytics">Create User</span>
        </a>
      </li>
      <li @if(Request::url() == url('merchant_business')) class="active" @endif>
        <a class="d-flex align-items-center" href="{{ url('merchant_business') }}">
          <i data-feather='repeat'></i><span class="menu-item text-truncate" data-i18n="Analytics">Merchant Business</span>
        </a>
      </li>
      <li @if(Request::url() == url('distibutor_business')) class="active" @endif>
        <a class="d-flex align-items-center" href="{{ url('distibutor_business') }}">
          <i data-feather='repeat'></i><span class="menu-item text-truncate" data-i18n="Analytics">Distibutor Business</span>
        </a>
      </li>
      <li @if(Request::url() == url('master_distibutor_business')) class="active" @endif>
        <a class="d-flex align-items-center" href="{{ url('master_distibutor_business') }}">
          <i data-feather='repeat'></i><span class="menu-item text-truncate" data-i18n="Analytics">Master Distibutor Business</span>
        </a>
      </li>
      <li @if(Request::url() == url('admin_mapping_request')) class="active" @endif>
        <a class="d-flex align-items-center" href="{{ url('admin_mapping_request') }}">
          <i data-feather='repeat'></i><span class="menu-item text-truncate" data-i18n="Analytics">Mapping Request</span>
        </a>
      </li>
    </ul>
  </li>
  <li class=" nav-item"><a class="d-flex align-items-center" href="#"><i data-feather='settings'></i><span class="menu-title text-truncate" data-i18n="Dashboards">Settings</span></a>
    <ul class="menu-content">
      <li @if(Request::url() == url('leintransfer')) class="active" @endif>
        <a class="d-flex align-items-center" href="{{ url('leintransfer') }}">
          <i class="fas fa-wallet"></i><span class="menu-item text-truncate" data-i18n="Analytics">Lein wallet transfer</span>
        </a>
      </li>
      <li @if(Request::url() == url('adminleintomain')) class="active" @endif>
        <a class="d-flex align-items-center" href="{{ url('adminleintomain') }}">
          <i class="fas fa-wallet"></i><span class="menu-item text-truncate" data-i18n="Analytics">Admin lein to main</span>
        </a>
      </li>
      <li @if(Request::url() == url('createplan')) class="active" @endif>
        <a class="d-flex align-items-center" href="{{ url('createplan') }}">
          <i data-feather='zap'></i><span class="menu-item text-truncate" data-i18n="Analytics">Create plans</span>
        </a>
      </li>
      <li @if(Request::url() == url('set_plan_base_price')) class="active" @endif>
        <a class="d-flex align-items-center" href="{{ url('set_plan_base_price') }}">
          <i data-feather='zap'></i><span class="menu-item text-truncate" data-i18n="Analytics">Base Price</span>
        </a>
      </li>
      <li @if(Request::url() == url('cashbackdiscount')) class="active" @endif>
        <a class="d-flex align-items-center" href="{{ url('cashbackdiscount') }}">
          <i class="fas fa-receipt"></i><span class="menu-item text-truncate" data-i18n="Analytics">Cashback & discounts</span>
        </a>
      </li>
      <li @if(Request::url() == url('bank_transfer_fees')) class="active" @endif>
        <a class="d-flex align-items-center" href="{{ url('bank_transfer_fees') }}">
          <i class="fas fa-receipt"></i><span class="menu-item text-truncate" data-i18n="Analytics">Bank transfer Fee</span>
        </a>
      </li>
      <li @if(Request::url() == url('select_payment_getway')) class="active" @endif>
        <a class="d-flex align-items-center" href="{{ url('select_payment_getway') }}">
          <i class="fas fa-wrench"></i><span class="menu-item text-truncate" data-i18n="Analytics">Payment gateway settings</span>
        </a>
      </li>
      <li @if(Request::url() == url('payment_gateway_key')) class="active" @endif>
        <a class="d-flex align-items-center" href="{{ url('payment_gateway_key') }}">
          <i class="fas fa-wrench"></i><span class="menu-item text-truncate" data-i18n="Analytics">Api Key</span>
        </a>
      </li>
      <li @if(Request::url() == url('paymentgetwaysettings')) class="active" @endif>
        <a class="d-flex align-items-center" href="{{ url('paymentgetwaysettings') }}">
          <i class="fas fa-wrench"></i><span class="menu-item text-truncate" data-i18n="Analytics">Plan payment gateway</span>
        </a>
      </li>
      <li @if(Request::url() == url('add_account_charges')) class="active" @endif>
        <a class="d-flex align-items-center" href="{{ url('add_account_charges') }}">
          <i data-feather='flag'></i><span class="menu-item text-truncate" data-i18n="Analytics">Add account charges</span>
        </a>
      </li>
      <li @if(Request::url() == url('peyment_link_setting')) class="active" @endif>
        <a class="d-flex align-items-center" href="{{ url('peyment_link_setting') }}">
          <i data-feather='radio'></i><span class="menu-item text-truncate" data-i18n="Analytics">Epos</span>
        </a>
      </li>
      <li @if(Request::url() == url('bankdetailsupdate')) class="active" @endif>
        <a class="d-flex align-items-center" href="{{ url('bankdetailsupdate') }}">
          <i class="far fa-list-alt"></i><span class="menu-item text-truncate" data-i18n="Analytics">Bank details update</span>
        </a>
      </li>
    </ul>
  </li>
  <li class=" nav-item"><a class="d-flex align-items-center" href="#"><i data-feather='framer'></i><span class="menu-title text-truncate" data-i18n="Dashboards">Marketing</span></a>
    <ul class="menu-content">
        <li @if(Request::url() == url('offerpopup')) class="active" @endif><a class="d-flex align-items-center" href="{{ url('offerpopup') }}"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Analytics">Popup</span></a>
        </li>
        <li @if(Request::url() == url('marquetext')) class="active" @endif><a class="d-flex align-items-center" href="{{ url('marquetext') }}"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Analytics">Marque Texts</span></a>
      </li>
    </ul>
  </li>
<li @if(Request::url() == url('admin_add_wallet_history')) class="active" @endif class="nav-item">
    <a class="d-flex align-items-center" href="{{ url('admin_add_wallet_history') }}"><i data-feather='info'></i><span class="menu-title text-truncate" data-i18n="Calendar"></span>ledger</a>
</li>
<li @if(Request::url() == url('admin_all_transaction')) class="active" @endif class="nav-item">
  <a class="d-flex align-items-center" href="{{ url('admin_all_transaction') }}"><i data-feather='info'></i><span class="menu-title text-truncate" data-i18n="Calendar"></span>All Transaction</a>
</li>
<li @if(Request::url() == url('admin_tally')) class="active" @endif class="nav-item">
  <a class="d-flex align-items-center" href="{{ url('admin_tally') }}"><i data-feather='info'></i><span class="menu-title text-truncate" data-i18n="Calendar"></span>Tally</a>
</li>
<li @if(Request::url() == url('errorlog')) class="active" @endif class="nav-item">
  <a class="d-flex align-items-center" href="{{ url('errorlog') }}"><i class="far fa-list-alt"></i><span class="menu-title text-truncate" data-i18n="Calendar"></span>Error<span class="badge badge-light-light bg-dark rounded-pill ms-auto me-1" id="errorcountdiv">{{count_error()}}</span></a>
</li>