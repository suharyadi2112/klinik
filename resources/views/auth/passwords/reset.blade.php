@extends('layouts.fullLayoutMaster')

@section('title','Reset Password')

@section('content')
<section class="row flexbox-container">
  <div class="col-xl-7 col-10">
    <div class="card bg-authentication mb-0">
      <div class="row m-0">
        <!-- left section-login -->
        <div class="col-md-6 col-12 px-0">
          <div class="card disable-rounded-right d-flex justify-content-center mb-0 p-2 h-100">
            <div class="card-header pb-1">
              <div class="card-title">
                <h4 class="text-center mb-2">Reset your Password</h4>
              </div>
            </div>
            <div class="card-body">
              <form class="mb-2" method="POST" action="{{ route('password.update') }}">
                @csrf
                <input type="hidden" name="token" value="{{ $token }}">

                <div class="form-group">
                  <label class="text-bold-600" for="email">Email</label>
                  <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}"  autocomplete="email" autofocus>
                  @error('email')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                </div>

                <div class="form-group">
                  <label class="text-bold-600" for="password">New Password</label>
                  <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password"  autocomplete="new-password">

                  @error('password')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                </div>

                <div class="form-group mb-2">
                  <label class="text-bold-600" for="password-confirm">Confirm New Password</label>
                  <input id="password-confirm" type="password" class="form-control" name="password_confirmation"  autocomplete="new-password">
                </div>

                <button type="submit" class="btn btn-primary glow position-relative w-100">
                    Reset my password
                  <i id="icon-arrow" class="bx bx-right-arrow-alt"></i>
                </button>
              </form>
            </div>
          </div>
        </div>
        <!-- right section image -->
        <div class="col-md-6 d-md-block d-none text-center align-self-center p-3">
          <img class="img-fluid" src="{{asset('images/pages/reset-password.png')}}" alt="branding logo">
        </div>
      </div>
    </div>
  </div>
</section>
@endsection
