
@extends('dashboard.layout.master2')

@section('content')
<div class="page-content d-flex align-items-center justify-content-center">

  <div class="row w-100 mx-0 auth-page">
    <div class="col-md-8 col-xl-6 mx-auto">
      <div class="card">
        <div class="row">
          <div class="col-md-4 pe-md-0">
            <div class="auth-side-wrapper" style="background-image: url({{ asset('images/IMG_20220215_195727.jpg')}})">

            </div>
          </div>
          <div class="col-md-8 ps-md-0">
            <div class="auth-form-wrapper px-4 py-5">
              <a href="#" class="noble-ui-logo d-block mb-2"><span>p</span>aint</a>
              <h6 class="text-muted fw-normal mb-4">{{ __('Admin Login') }}</h6>
              <form class="forms-sample" method="POST" action="{{ route('admin.login') }}" >
              @csrf
                <div class="mb-3">
                  <label for="userEmail" class="form-label">{{ __('E-Mail Address') }}</label>
                  <input type="email" name="email" class="form-control" id="userEmail" placeholder="Email" value="{{ old('email') }}" required>
                </div>
                <div class="mb-3">
                  <label for="userPassword" class="form-label">{{ __('Password') }}</label>
                  <input type="password" class="form-control" name="password"  id="userPassword" autocomplete="current-password" placeholder="Password" required>
                </div>


                <button type="submit" class="btn btn-outline-primary btn-icon-text mb-2 mb-md-0">
                  {{ __('Login') }}   <i data-feather="log-in"></i> 
                  </button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

</div>
@endsection