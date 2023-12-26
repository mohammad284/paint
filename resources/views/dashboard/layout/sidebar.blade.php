@push('plugin-styles')
  <link href="{{ asset('assets/plugins/@mdi/css/materialdesignicons.min.css') }}" rel="stylesheet" />
@endpush
<nav class="sidebar">
  <div class="sidebar-header">
    <a href="{{ url('/admin') }}" class="sidebar-brand">
    <span>M</span>alar
    </a>
    <div class="sidebar-toggler not-active">
      <span></span>
      <span></span>
      <span></span>
    </div>
  </div>
  <div class="sidebar-body">
    <ul class="nav">
      @if(Auth::guard('admin')->check())
      @if (Auth::guard('admin')->user()->type == 'admin')

        <li class="nav-item nav-category">{{__('advertising')}}</li>
        <li class="nav-item ">
          <a class="nav-link" data-bs-toggle="collapse" href="#slider" role="button" aria-expanded="" aria-controls="email">
          <i class="mdi mdi-radio"></i>
            <span class="link-title">{{__('advertising')}}</span>
            <i class="link-arrow" data-feather="chevron-down"></i>
          </a>
          <div class="collapse " id="slider">
            <ul class="nav sub-menu">
              <li class="nav-item">
                <a href="/admin/sliders" class="nav-link {{ (request()->is('admin/sliders')) ? 'active' : '' }}"> {{__('web advertising')}}</a>
              </li>
            </ul>
          </div>
        </li>
        <li class="nav-item nav-category">{{__('users')}}</li>
        <li class="nav-item ">
          <a href="/admin/allUser" class="nav-link">
          <i class="mdi mdi-account-star"></i>
            <span class="link-title">{{__('all users')}}</span>
          </a>
        </li>
        <li class="nav-item nav-category">{{__('business')}}</li>
        <li class="nav-item ">
          <a href="/admin/viewBusiness" class="nav-link">
          <i class="mdi mdi-account-star"></i>
            <span class="link-title">{{__('all businesses')}}</span>
          </a>
        </li>
        <li class="nav-item nav-category">{{__('providers')}}</li>
        <li class="nav-item ">
          <a class="nav-link" data-bs-toggle="collapse" href="#provider" role="button" aria-expanded="" aria-controls="email">
          <i class="mdi mdi-account-star"></i>
            <span class="link-title">{{__('providers')}}</span>
            <i class="link-arrow" data-feather="chevron-down"></i>
          </a>
          <div class="collapse " id="provider">
            <ul class="nav sub-menu">
              <li class="nav-item">
                <a href="/admin/allprovider" class="nav-link {{ (request()->is('admin/allprovider')) ? 'active' : '' }}"> {{__('Service Provider')}}</a>
              </li>
              <li class="nav-item">
                <a href="/admin/requestProvider" class="nav-link {{ (request()->is('admin/requestProvider')) ? 'active' : '' }}"> {{__('Service Provider Requests')}}</a>
              </li>
              <li class="nav-item">
                <a href="/admin/blockedProviders" class="nav-link {{ (request()->is('admin/blockedProviders')) ? 'active' : '' }}"> {{__('block accounts')}}</a>
              </li>
              <li class="nav-item">
                <a href="/admin/updateBuisnessProvider" class="nav-link {{ (request()->is('admin/updateBuisnessProvider')) ? 'active' : '' }}"> {{__('update provider buisness')}}</a>
              </li>
            </ul>
          </div>
        </li>

        <li class="nav-item nav-category">{{__('tenders')}}</li>
        <li class="nav-item ">
          <a class="nav-link" data-bs-toggle="collapse" href="#Tenders" role="button" aria-expanded="" aria-controls="email">
          <i class="mdi mdi-account-star"></i>
            <span class="link-title">{{__('tenders')}}</span>
            <i class="link-arrow" data-feather="chevron-down"></i>
          </a>
          <div class="collapse " id="Tenders">
            <ul class="nav sub-menu">
              <li class="nav-item">
                <a href="/admin/insideTender" class="nav-link {{ (request()->is('admin/insideTender')) ? 'active' : '' }}"> {{__('inside tenders')}}</a>
              </li>
              <li class="nav-item">
                <a href="/admin/outsideTender" class="nav-link {{ (request()->is('admin/outsideTender')) ? 'active' : '' }}"> {{__('outside tenders')}}</a>
              </li>
              <li class="nav-item">
                <a href="/admin/buildingTender" class="nav-link {{ (request()->is('admin/buildingTender')) ? 'active' : '' }}"> {{__('building tender')}}</a>
              </li>
              <li class="nav-item">
                <a href="/admin/glossyTender" class="nav-link {{ (request()->is('admin/glossyTender')) ? 'active' : '' }}"> {{__('glossy tenders')}}</a>
              </li>
              <li class="nav-item">
                <a href="/admin/flourTender" class="nav-link {{ (request()->is('admin/flourTender')) ? 'active' : '' }}"> {{__('flour tenders')}}</a>
              </li>
              <li class="nav-item">
                <a href="/admin/plasterTender" class="nav-link {{ (request()->is('admin/plasterTender')) ? 'active' : '' }}"> {{__('plaster tenders')}}</a>
              </li>
              <li class="nav-item">
                <a href="/admin/otherTender" class="nav-link {{ (request()->is('admin/otherTender')) ? 'active' : '' }}"> {{__('other tenders')}}</a>
              </li>
              <li class="nav-item">
                <a href="/admin/tenderInteristing" class="nav-link {{ (request()->is('admin/tenderInteristing')) ? 'active' : '' }}"> {{__('interisting')}}</a>
              </li>
              <li class="nav-item">
                <a href="/admin/tenderConnected" class="nav-link {{ (request()->is('admin/tenderConnected')) ? 'active' : '' }}"> {{__('connecting')}}</a>
              </li>
              <li class="nav-item">
                <a href="/admin/dealTenders" class="nav-link {{ (request()->is('admin/dealTenders')) ? 'active' : '' }}"> {{__('deals')}}</a>
              </li>
            </ul>
          </div>
        </li>
        <li class="nav-item nav-category">{{__('specialist')}}</li>
        <li class="nav-item ">
          <a class="nav-link" data-bs-toggle="collapse" href="#specialist" role="button" aria-expanded="" aria-controls="email">
          <i class="mdi mdi-package-variant-closed"></i>
            <span class="link-title">{{__('specialist')}}</span>
            <i class="link-arrow" data-feather="chevron-down"></i>
          </a>
          <div class="collapse " id="specialist">
            <ul class="nav sub-menu">
              <li class="nav-item">
                <a href="/admin/papers" class="nav-link {{ (request()->is('admin/papers')) ? 'active' : '' }}"> {{__('wallPaper')}}</a>
              </li>
              <li class="nav-item">
                <a href="/admin/plasterType" class="nav-link {{ (request()->is('admin/plasterType')) ? 'active' : '' }}"> {{__('Plaster Type')}}</a>
              </li>
            </ul>
          </div>
        </li>
      
        <li class="nav-item nav-category">{{__('reviews')}}</li>
        <li class="nav-item ">
          <a href="/admin/reviews" class="nav-link">
          <i class="mdi mdi-heart-box"></i>
            <span class="link-title">{{__('reviews')}}</span>
          </a>
        </li>
        <li class="nav-item nav-category">{{__('Feed Back')}}</li>
        <li class="nav-item ">
          <a href="/admin/feeds" class="nav-link">
          <i class="mdi mdi-heart-box"></i>
            <span class="link-title">{{__('Feed Back')}}</span>
          </a>
        </li>
        <li class="nav-item nav-category">{{__('notifications')}}</li>
        <li class="nav-item ">
          <a class="nav-link" data-bs-toggle="collapse" href="#notification" role="button" aria-expanded="" aria-controls="email">
          <i class="mdi mdi-bell-ring-outline"></i>
            <span class="link-title">{{__('notifications')}}</span>
            <i class="link-arrow" data-feather="chevron-down"></i>
          </a>
          <div class="collapse " id="notification">
            <ul class="nav sub-menu">
              <li class="nav-item">
                <a href="/admin/notifications" class="nav-link {{ (request()->is('admin/notifications')) ? 'active' : '' }}"> {{__('notifications')}}</a>
              </li>
              <li class="nav-item">
                <a href="/admin/notificationText" class="nav-link {{ (request()->is('admin/notificationText')) ? 'active' : '' }}"> {{__('notification text')}}</a>
              </li>
            </ul>
          </div>
        </li>
        <li class="nav-item nav-category">{{__('sitting')}}</li>
        <li class="nav-item ">
          <a class="nav-link" data-bs-toggle="collapse" href="#sitting" role="button" aria-expanded="" aria-controls="email">
          <i data-feather="settings"></i>
            <span class="link-title">{{__('sitting')}}</span>
            <i class="link-arrow" data-feather="chevron-down"></i>
          </a>
          <div class="collapse " id="sitting">
            <ul class="nav sub-menu">
              <li class="nav-item">
                <a href="/admin/terms" class="nav-link {{ (request()->is('admin/terms')) ? 'active' : '' }}"> {{__('terms')}}</a>
              </li>
              <li class="nav-item">
                <a href="/admin/privacy" class="nav-link {{ (request()->is('admin/privacy')) ? 'active' : '' }}"> {{__('privacy')}}</a>
              </li>
              <li class="nav-item">
                <a href="/admin/address" class="nav-link {{ (request()->is('admin/address')) ? 'active' : '' }}"> {{__('address')}}</a>
              </li>
              <li class="nav-item">
                <a href="/admin/colors" class="nav-link {{ (request()->is('admin/colors')) ? 'active' : '' }}"> {{__('colors')}}</a>
              </li>
              <li class="nav-item">
                <a href="/admin/aboutUs" class="nav-link {{ (request()->is('admin/aboutUs')) ? 'active' : '' }}"> {{__('about us')}}</a>
              </li>
            </ul>
          </div>
        </li>
        <li class="nav-item nav-category">{{__('Admins')}}</li>
        <li class="nav-item ">
          <a href="/admin/myAdmins" class="nav-link">
          <i  data-feather="box"></i>
            <span class="link-title">{{__('Admins')}}</span>
          </a>
        </li>
        <li class="nav-item nav-category">{{__('support')}}</li>
        <li class="nav-item ">
          <a href="/admin/support" class="nav-link">
          <i class="mdi mdi-help-circle"></i>
            <span class="link-title">{{__('support')}}</span>
          </a>
        </li>
        <li class="nav-item nav-category">{{__('logout')}}</li>
        <li class="nav-item ">
        <a class="nav-link" href="{{ route('admin.logout') }}"
          onclick="event.preventDefault();
                  document.getElementById('logout-form').submit();">
          <i data-feather="log-out"></i>
          <span class="link">
            {{__('logout')}}
          </span>
        </a>
        <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
          @csrf
        </form>
        </li>
        @endif
        @if (Auth::guard('admin')->user()->type == 'store' | Auth::guard('admin')->user()->type == 'admin')
        @endif 
        @endif
    </ul>
  </div>
</nav>
