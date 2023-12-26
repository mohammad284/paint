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
        <!-- <li class="nav-item nav-category">{{__('Main')}}</li> -->
        <!-- <li class="nav-item">
          <a href="{{ url('/admin') }}" class="nav-link">
          <i  data-feather="box"></i>
            <span class="link-title">{{__('Main')}}</span>
          </a>
        </li> -->
        <li class="nav-item nav-category">{{__('الاعلانات')}}</li>
        <li class="nav-item ">
          <a class="nav-link" data-bs-toggle="collapse" href="#slider" role="button" aria-expanded="" aria-controls="email">
          <i class="mdi mdi-account-star"></i>
            <span class="link-title">{{__('الاعلانات')}}</span>
            <i class="link-arrow" data-feather="chevron-down"></i>
          </a>
          <div class="collapse " id="slider">
            <ul class="nav sub-menu">
              <li class="nav-item">
                <a href="/admin/sliders" class="nav-link {{ (request()->is('admin/sliders')) ? 'active' : '' }}"> {{__('اعلانات الويب')}}</a>
              </li>
              <li class="nav-item">
                <a href="/admin/advertising" class="nav-link {{ (request()->is('admin/advertising')) ? 'active' : '' }}"> {{__('اعلانات المتجر')}}</a>
              </li>
            </ul>
          </div>
        </li>
        <li class="nav-item nav-category">{{__('المستخدمين')}}</li>
        <li class="nav-item ">
          <a href="/admin/allUser" class="nav-link">
          <i class="mdi mdi-account-star"></i>
            <span class="link-title">{{__('كل المستخدمين')}}</span>
          </a>
        </li>

        <li class="nav-item nav-category">{{__('مزودي الخدمة')}}</li>
        <li class="nav-item ">
          <a class="nav-link" data-bs-toggle="collapse" href="#provider" role="button" aria-expanded="" aria-controls="email">
          <i class="mdi mdi-account-star"></i>
            <span class="link-title">{{__('كل مزودي الخدمة')}}</span>
            <i class="link-arrow" data-feather="chevron-down"></i>
          </a>
          <div class="collapse " id="provider">
            <ul class="nav sub-menu">
              <li class="nav-item">
                <a href="/admin/allprovider" class="nav-link {{ (request()->is('admin/allprovider')) ? 'active' : '' }}"> {{__('مزودي الخدمة المقبولين')}}</a>
              </li>
              <li class="nav-item">
                <a href="/admin/requestProvider" class="nav-link {{ (request()->is('admin/requestProvider')) ? 'active' : '' }}"> {{__('طلبات مزودي الخدمة')}}</a>
              </li>
              <li class="nav-item">
                <a href="/admin/blockedProviders" class="nav-link {{ (request()->is('admin/blockedProviders')) ? 'active' : '' }}"> {{__('مزودي الخدمة المجمدين')}}</a>
              </li>
              <li class="nav-item">
                <a href="/admin/Services" class="nav-link {{ (request()->is('admin/Services')) ? 'active' : '' }}"> {{__('خدمات مزودي الخدمة')}}</a>
              </li>
            </ul>
          </div>
        </li>
        <li class="nav-item nav-category">{{__('الباقات')}}</li>
        <li class="nav-item ">
          <a href="/admin/allPackage" class="nav-link">
          <i  data-feather="box"></i>
            <span class="link-title">{{__('كل الباقات')}}</span>
          </a>
        </li>
        <li class="nav-item nav-category">{{__('مواد الدهان المتوفرة')}}</li>
        <li class="nav-item ">
          <a href="/admin/material" class="nav-link">
          <i  data-feather="box"></i>
            <span class="link-title">{{__('كل المواد')}}</span>
          </a>
        </li>
        <li class="nav-item nav-category">{{__('المناقصات')}}</li>
        <li class="nav-item ">
          <a class="nav-link" data-bs-toggle="collapse" href="#Tenders" role="button" aria-expanded="" aria-controls="email">
          <i class="mdi mdi-account-star"></i>
            <span class="link-title">{{__('كل المناقصات')}}</span>
            <i class="link-arrow" data-feather="chevron-down"></i>
          </a>
          <div class="collapse " id="Tenders">
            <ul class="nav sub-menu">
              <li class="nav-item">
                <a href="/admin/insideTender" class="nav-link {{ (request()->is('admin/insideTender')) ? 'active' : '' }}"> {{__('مناقصات المنازل الداخلية')}}</a>
              </li>
              <li class="nav-item">
                <a href="/admin/outsideTender" class="nav-link {{ (request()->is('admin/outsideTender')) ? 'active' : '' }}"> {{__('مناقصات المنازل الخارجية')}}</a>
              </li>
              <li class="nav-item">
                <a href="/admin/buildingTender" class="nav-link {{ (request()->is('admin/buildingTender')) ? 'active' : '' }}"> {{__('مناقصات الابنية')}}</a>
              </li>

              <li class="nav-item">
                <a href="/admin/glossyTender" class="nav-link {{ (request()->is('admin/glossyTender')) ? 'active' : '' }}"> {{__('مناقصات اللكر')}}</a>
              </li>
              <li class="nav-item">
                <a href="/admin/flourTender" class="nav-link {{ (request()->is('admin/flourTender')) ? 'active' : '' }}"> {{__('مناقصات الارضيات')}}</a>
              </li>
              <li class="nav-item">
                <a href="/admin/tenderInteristing" class="nav-link {{ (request()->is('admin/tenderInteristing')) ? 'active' : '' }}"> {{__('اهتمامات المناقصات')}}</a>
              </li>
              <li class="nav-item">
                <a href="/admin/tenderConnected" class="nav-link {{ (request()->is('admin/tenderConnected')) ? 'active' : '' }}"> {{__('اتصالات المناقصات')}}</a>
              </li>
              <li class="nav-item">
                <a href="/admin/dealTenders" class="nav-link {{ (request()->is('admin/dealTenders')) ? 'active' : '' }}"> {{__('المناقصات المتفق عليها')}}</a>
              </li>
            </ul>
          </div>
        </li>
        <li class="nav-item nav-category">{{__('ورق الجدران')}}</li>
        <li class="nav-item ">
          <a href="/admin/papers" class="nav-link">
          <i  data-feather="box"></i>
            <span class="link-title">{{__('انواع ورق الجدران')}}</span>
          </a>
        </li>
        <!-- <li class="nav-item nav-category">{{__('أنواع العمل')}}</li>
        <li class="nav-item ">
          <a class="nav-link" data-bs-toggle="collapse" href="#TypeWork" role="button" aria-expanded="" aria-controls="email">
          <i class="mdi mdi-account-star"></i>
            <span class="link-title">{{__('أنواع العمل')}}</span>
            <i class="link-arrow" data-feather="chevron-down"></i>
          </a>
          <div class="collapse " id="TypeWork">
            <ul class="nav sub-menu">
              <li class="nav-item">
                <a href="/admin/allTypeWork" class="nav-link {{ (request()->is('admin/allTypeWork')) ? 'active' : '' }}"> {{__('work type')}}</a>
              </li>
              <li class="nav-item">
                <a href="/admin/branshes" class="nav-link {{ (request()->is('admin/branshes')) ? 'active' : '' }}"> {{__('bransh work')}}</a>
              </li>
              <li class="nav-item">
                <a href="/admin/categories" class="nav-link {{ (request()->is('admin/categories')) ? 'active' : '' }}"> {{__('تصنيفات العمل الخارجي')}}</a>
              </li>
              <li class="nav-item">
                <a href="/admin/services" class="nav-link {{ (request()->is('admin/services')) ? 'active' : '' }}"> {{__('service')}}</a>
              </li>
            </ul>
          </div>
        </li> -->
        <!-- <li class="nav-item nav-category">{{__('buildings')}}</li>
        <li class="nav-item ">
          <a class="nav-link" data-bs-toggle="collapse" href="" role="button" aria-expanded="" aria-controls="email">
          <i class="mdi mdi-account-star"></i>
            <span class="link-title">{{__('أنواع العمل')}}</span>
            <i class="link-arrow" data-feather="chevron-down"></i>
          </a>
          <div class="collapse " id="buildings">
            <ul class="nav sub-menu">
              <li class="nav-item">
                <a href="/admin/buildings" class="nav-link {{ (request()->is('admin/buildings')) ? 'active' : '' }}"> {{__('building type')}}</a>
              </li>
              <li class="nav-item">
                <a href="/admin/floars" class="nav-link {{ (request()->is('admin/floars')) ? 'active' : '' }}"> {{__('floar type')}}</a>
              </li>
            </ul>
          </div>
        </li> -->
        <li class="nav-item nav-category">{{__('المراجعات والتقييمات')}}</li>
        <li class="nav-item ">
          <a href="/admin/reviews" class="nav-link">
          <i  data-feather="box"></i>
            <span class="link-title">{{__('المراجعات والتقييمات')}}</span>
          </a>
        </li>
        <li class="nav-item nav-category">{{__('المدفوعات')}}</li>
        <li class="nav-item ">
          <a href="/admin/payments" class="nav-link">
          <i  data-feather="box"></i>
            <span class="link-title">{{__('كل المدفوعات')}}</span>
          </a>
        </li>
        <li class="nav-item nav-category">{{__('الاشعارات')}}</li>
        <li class="nav-item ">
          <a class="nav-link" data-bs-toggle="collapse" href="#notification" role="button" aria-expanded="" aria-controls="email">
          <i class="mdi mdi-bell-ring-outline"></i>
            <span class="link-title">{{__('الاشعارات')}}</span>
            <i class="link-arrow" data-feather="chevron-down"></i>
          </a>
          <div class="collapse " id="notification">
            <ul class="nav sub-menu">
              <li class="nav-item">
                <a href="/admin/notifications" class="nav-link {{ (request()->is('admin/notifications')) ? 'active' : '' }}"> {{__('كل الاشعارات')}}</a>
              </li>
              <li class="nav-item">
                <a href="/admin/notificationText" class="nav-link {{ (request()->is('admin/notificationText')) ? 'active' : '' }}"> {{__('نص الاشعارات')}}</a>
              </li>
            </ul>
          </div>
        </li>
        <li class="nav-item nav-category">{{__('الاعدادات')}}</li>
        <li class="nav-item ">
          <a class="nav-link" data-bs-toggle="collapse" href="#sitting" role="button" aria-expanded="" aria-controls="email">
          <i class="mdi mdi-bell-ring-outline"></i>
            <span class="link-title">{{__('الاعدادات')}}</span>
            <i class="link-arrow" data-feather="chevron-down"></i>
          </a>
          <div class="collapse " id="sitting">
            <ul class="nav sub-menu">
              <li class="nav-item">
                <a href="/admin/terms" class="nav-link {{ (request()->is('admin/terms')) ? 'active' : '' }}"> {{__('الشروط والاحكام')}}</a>
              </li>
              <li class="nav-item">
                <a href="/admin/privacy" class="nav-link {{ (request()->is('admin/privacy')) ? 'active' : '' }}"> {{__('سياسة الخصوصية')}}</a>
              </li>
              <li class="nav-item">
                <a href="/admin/blackList" class="nav-link {{ (request()->is('admin/blackList')) ? 'active' : '' }}"> {{__('القائمة السوداء')}}</a>
              </li>
              <li class="nav-item">
                <a href="/admin/address" class="nav-link {{ (request()->is('admin/blackList')) ? 'address' : '' }}"> {{__('العناوين')}}</a>
              </li>
              <li class="nav-item">
                <a href="/admin/colors" class="nav-link {{ (request()->is('admin/colors')) ? 'address' : '' }}"> {{__('الالوان')}}</a>
              </li>
              <li class="nav-item">
                <a href="/admin/aboutUs" class="nav-link {{ (request()->is('admin/aboutUs')) ? 'address' : '' }}"> {{__('نبذة عنا')}}</a>
              </li>
              <li class="nav-item">
                <a href="/admin/floars" class="nav-link {{ (request()->is('admin/floars')) ? 'active' : '' }}"> {{__('انواع الارضيات')}}</a>
              </li>
            </ul>
          </div>
        </li>
        <li class="nav-item nav-category">{{__('الادمن')}}</li>
        <li class="nav-item ">
          <a href="/admin/myAdmins" class="nav-link">
          <i  data-feather="box"></i>
            <span class="link-title">{{__('اعدادات الادمن')}}</span>
          </a>
        </li>
        <li class="nav-item nav-category">{{__('الدعم')}}</li>
        <li class="nav-item ">
          <a href="/admin/support" class="nav-link">
          <i  data-feather="box"></i>
            <span class="link-title">{{__('الدعم')}}</span>
          </a>
        </li>
        <li class="nav-item nav-category">{{__('تسجيل الخروج')}}</li>
        <li class="nav-item ">
        <a class="nav-link" href="{{ route('admin.logout') }}"
          onclick="event.preventDefault();
                  document.getElementById('logout-form').submit();">
          <i class="fas fa-power-off"></i>
          <span class="link">
            {{__('تسجيل الخروج')}}
          </span>
        </a>
        <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
          @csrf
        </form>
        </li>
        @endif
        @if (Auth::guard('admin')->user()->type == 'store' | Auth::guard('admin')->user()->type == 'admin')
        <!-- <li class="nav-item nav-category">{{__('advertising')}}</li>
        <li class="nav-item ">
          <a href="/admin/advertising" class="nav-link">
          <i  data-feather="box"></i>
            <span class="link-title">{{__('advertising')}}</span>
          </a>
        </li> -->
        <li class="nav-item nav-category">{{__('product category')}}</li>
        <li class="nav-item ">
          <a href="/admin/categories" class="nav-link">
          <i  data-feather="box"></i>
            <span class="link-title">{{__('categories')}}</span>
          </a>
        </li>
        <li class="nav-item nav-category">{{__('price list')}}</li>
        <li class="nav-item ">
          <a href="/admin/priceList" class="nav-link">
          <i  data-feather="box"></i>
            <span class="link-title">{{__('price adjustment')}}</span>
          </a>
        </li>
        <li class="nav-item nav-category">{{__('product size')}}</li>
        <li class="nav-item ">
          <a href="/admin/sizes" class="nav-link">
          <i  data-feather="box"></i>
            <span class="link-title">{{__('sizes')}}</span>
          </a>
        </li>
        <li class="nav-item nav-category">{{__('payment')}}</li>
        <li class="nav-item ">
          <a class="nav-link" data-bs-toggle="collapse" href="#payment" role="button" aria-expanded="" aria-controls="email">
          <i class="mdi mdi-bell-ring-outline"></i>
            <span class="link-title">{{__('payment')}}</span>
            <i class="link-arrow" data-feather="chevron-down"></i>
          </a>
          <div class="collapse " id="payment">
            <ul class="nav sub-menu">
              <li class="nav-item">
                <a href="/admin/paymentMethods" class="nav-link {{ (request()->is('admin/paymentMethods')) ? 'active' : '' }}"> {{__('payment methods')}}</a>
              </li>
              <li class="nav-item">
                <a href="/admin/storePayments" class="nav-link {{ (request()->is('admin/storePayments')) ? 'active' : '' }}"> {{__('store payment')}}</a>
              </li>
            </ul>
          </div>
        </li>
        <li class="nav-item nav-category">{{__('products')}}</li>
        <li class="nav-item ">
          <a class="nav-link" data-bs-toggle="collapse" href="#products" role="button" aria-expanded="" aria-controls="email">
          <i class="mdi mdi-bell-ring-outline"></i>
            <span class="link-title">{{__('products')}}</span>
            <i class="link-arrow" data-feather="chevron-down"></i>
          </a>
          <div class="collapse " id="products">
            <ul class="nav sub-menu">
              <li class="nav-item">
                <a href="/admin/products" class="nav-link {{ (request()->is('admin/products')) ? 'active' : '' }}"> {{__('paint products')}}</a>
              </li>
              <li class="nav-item">
                <a href="/admin/bestSeller" class="nav-link {{ (request()->is('admin/bestSeller')) ? 'active' : '' }}"> {{__('best seller')}}</a>
              </li>
              <li class="nav-item">
                <a href="/admin/productReview" class="nav-link {{ (request()->is('admin/productReview')) ? 'active' : '' }}"> {{__('product reviews')}}</a>
              </li>
            </ul>
          </div>
        </li>
        <li class="nav-item nav-category">{{__('order tracking')}}</li>
        <li class="nav-item ">
          <a class="nav-link" data-bs-toggle="collapse" href="#order_tracking" role="button" aria-expanded="" aria-controls="email">
          <i class="mdi mdi-bell-ring-outline"></i>
            <span class="link-title">{{__('order tracking')}}</span>
            <i class="link-arrow" data-feather="chevron-down"></i>
          </a>
          <div class="collapse " id="order_tracking">
            <ul class="nav sub-menu">
              <li class="nav-item">
                <a href="/admin/orderReceived" class="nav-link {{ (request()->is('admin/orderReceived')) ? 'active' : '' }}"> {{__('received')}}</a>
              </li>
              <li class="nav-item">
                <a href="/admin/orderPrepared" class="nav-link {{ (request()->is('admin/orderPrepared')) ? 'active' : '' }}"> {{__('prepared')}}</a>
              </li>
              <li class="nav-item">
                <a href="/admin/orderSend" class="nav-link {{ (request()->is('admin/orderSend')) ? 'active' : '' }}"> {{__('send to shipping company')}}</a>
              </li>
              <li class="nav-item">
                <a href="/admin/orderDone" class="nav-link {{ (request()->is('admin/orderDone')) ? 'active' : '' }}"> {{__('order done')}}</a>
              </li>
              <!-- <li class="nav-item">
                <a href="/admin/orderRejected" class="nav-link {{ (request()->is('admin/orderRejected')) ? 'active' : '' }}"> {{__('rejected')}}</a>
              </li> -->
            </ul>
          </div>
        </li>
        <li class="nav-item nav-category">{{__('coupon')}}</li>
        <li class="nav-item ">
          <a href="/admin/coupons" class="nav-link">
          <i  data-feather="box"></i>
            <span class="link-title">{{__('coupon')}}</span>
          </a>
        </li>
        @endif 
        @endif
    </ul>
  </div>
</nav>
