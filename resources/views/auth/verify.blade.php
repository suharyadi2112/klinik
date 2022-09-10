@php
$pageConfigs = ['bodyCustomClass' => 'bg-full-screen-image'];
@endphp

@extends('layouts.fullLayoutMaster')

@section('title','Verify')

@section('page-styles')
<link rel="stylesheet" type="text/css" href="{{asset('css/pages/authentication.css')}}">
@endsection

@section('content')
<div class="container">
  <div class="row justify-content-center flexbox-container">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header">
          <h4 class="card-title">{{ __('Verify Your Email Address') }}</h4>
        </div>

        <div class="card-body">
          @if (session('resent'))
            <div class="alert alert-success" role="alert">
              {{ __('A fresh verification link has been sent to your email address.') }}
            </div>
          @endif

          {{ __('Before proceeding, please check your email for a verification link.') }}
          {{ __('If you did not receive the email') }},
          <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
            @csrf
            <button type="submit" class="btn btn-link p-0 m-0 align-baseline">{{ __('click here to request another') }}</button>.
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
