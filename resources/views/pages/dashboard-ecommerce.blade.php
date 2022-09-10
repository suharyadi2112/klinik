@extends('layouts.contentLayoutMaster')
{{-- page Title --}}
@section('title','Dashboard E-commerce')
{{-- vendor css --}}
@section('vendor-styles')
<link rel="stylesheet" type="text/css" href="{{asset('vendors/css/charts/apexcharts.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('vendors/css/extensions/swiper.min.css')}}">
@endsection
@section('page-styles')
<link rel="stylesheet" type="text/css" href="{{asset('css/pages/dashboard-ecommerce.css')}}">
@endsection

@section('content')
<!-- Dashboard Ecommerce Starts -->
<section id="dashboard-ecommerce">
  <div class="row">
    <!-- Greetings Content Starts -->
    <div class="col-xl-4 col-md-6 col-12 dashboard-greetings">
      <div class="card">
        <div class="card-header">
          <h3 class="greeting-text">Congratulations John!</h3>
          <p class="mb-0">Best seller of the month</p>
        </div>
        <div class="card-body pt-0">
          <div class="d-flex justify-content-between align-items-end">
            <div class="dashboard-content-left">
              <h1 class="text-primary font-large-2 text-bold-500">$89k</h1>
              <p>You have done 57.6% more sales today.</p>
              <button type="button" class="btn btn-primary glow">View Sales</button>
            </div>
            <div class="dashboard-content-right">
              <img src="{{asset('images/icon/cup.png')}}" height="220" width="220" class="img-fluid"
                alt="Dashboard Ecommerce" />
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Multi Radial Chart Starts -->
    <div class="col-xl-4 col-md-6 col-12 dashboard-visit">
      <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
          <h4 class="card-title">Visits of 2020</h4>
          <i class="bx bx-dots-vertical-rounded font-medium-3 cursor-pointer"></i>
        </div>
        <div class="card-body">
          <div id="multi-radial-chart"></div>
          <ul class="list-inline text-center mt-1 mb-0">
            <li class="mr-2"><span class="bullet bullet-xs bullet-primary mr-50"></span>Target</li>
            <li class="mr-2"><span class="bullet bullet-xs bullet-danger mr-50"></span>Mart</li>
            <li><span class="bullet bullet-xs bullet-warning mr-50"></span>Ebay</li>
          </ul>
        </div>
      </div>
    </div>
    <div class="col-xl-4 col-12 dashboard-users">
      <div class="row  ">
        <!-- Statistics Cards Starts -->
        <div class="col-12">
          <div class="row">
            <div class="col-sm-6 col-12 dashboard-users-success">
              <div class="card text-center">
                <div class="card-body py-1">
                  <div class="badge-circle badge-circle-lg badge-circle-light-success mx-auto mb-50">
                    <i class="bx bx-briefcase-alt font-medium-5"></i>
                  </div>
                  <div class="text-muted line-ellipsis">New Products</div>
                  <h3 class="mb-0">1.2k</h3>
                </div>
              </div>
            </div>
            <div class="col-sm-6 col-12 dashboard-users-danger">
              <div class="card text-center">
                <div class="card-body py-1">
                  <div class="badge-circle badge-circle-lg badge-circle-light-danger mx-auto mb-50">
                    <i class="bx bx-user font-medium-5"></i>
                  </div>
                  <div class="text-muted line-ellipsis">New Users</div>
                  <h3 class="mb-0">45.6k</h3>
                </div>
              </div>
            </div>
            <div class="col-xl-12 col-lg-6 col-12 dashboard-revenue-growth">
              <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center pb-0">
                  <h4 class="card-title">Revenue Growth</h4>
                  <div class="d-flex align-items-end justify-content-end">
                    <span class="mr-25">$25,980</span>
                    <i class="bx bx-dots-vertical-rounded font-medium-3 cursor-pointer"></i>
                  </div>
                </div>
                <div class="card-body pb-0">
                  <div id="revenue-growth-chart"></div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- Revenue Growth Chart Starts -->
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-xl-8 col-12 dashboard-order-summary">
      <div class="card">
        <div class="row">
          <!-- Order Summary Starts -->
          <div class="col-md-8 col-12 order-summary border-right pr-md-0">
            <div class="card mb-0">
              <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="card-title">Order Summary</h4>
                <div class="d-flex">
                  <button type="button" class="btn btn-sm btn-light-primary mr-1">Week</button>
                  <button type="button" class="btn btn-sm btn-primary glow">Month</button>
                </div>
              </div>
              <div class="card-body p-0">
                <div id="order-summary-chart"></div>
              </div>
            </div>
          </div>
          <!-- Sales History Starts -->
          <div class="col-md-4 col-12 pl-md-0">
            <div class="card mb-0">
              <div class="card-header pb-50">
                <h4 class="card-title">Best Sellers</h4>
              </div>
              <div class="card-body py-1">
                <div class="d-flex justify-content-between align-items-center mb-2">
                  <div class="sales-item-name">
                    <p class="mb-0">iPhone</p>
                    <small class="text-muted">Smartphone</small>
                  </div>
                  <h6 class='mb-0'>794</h6>
                </div>
                <div class="d-flex justify-content-between align-items-center mb-2">
                  <div class="sales-item-name">
                    <p class="mb-0">Airpods</p>
                    <small class="text-muted">Earphone</small>
                  </div>
                  <h6 class='mb-0'>550</h6>
                </div>
                <div class="d-flex justify-content-between align-items-center">
                  <div class="sales-item-name">
                    <p class="mb-0">MacBook</p>
                    <small class="text-muted">Laptop</small>
                  </div>
                  <h6 class='mb-0'>271</h6>
                </div>
              </div>
              <div class="card-footer border-top pb-md-0">
                <h5>Total Sales</h5>
                <span class="text-primary text-bold-500">$82,950.96</span>
                <div class="progress progress-bar-primary progress-sm mt-50 mb-md-50">
                  <div class="progress-bar" role="progressbar" aria-valuenow="78" style="width:78%"></div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Latest Update Starts -->
    <div class="col-xl-4 col-md-6 col-12 dashboard-latest-update">
      <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center pb-50">
          <h4 class="card-title">Latest Update</h4>
          <div class="dropdown">
            <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button" id="dropdownMenuButtonSec"
              data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              2020
            </button>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButtonSec">
              <a class="dropdown-item" href="javascript:;">2020</a>
              <a class="dropdown-item" href="javascript:;">2019</a>
              <a class="dropdown-item" href="javascript:;">2018</a>
            </div>
          </div>
        </div>
        <div class="card-body p-0 pb-1">
          <ul class="list-group list-group-flush">
            <li
              class="list-group-item list-group-item-action border-0 d-flex align-items-center justify-content-between">
              <div class="list-left d-flex">
                <div class="list-icon mr-1">
                  <div class="avatar bg-rgba-primary m-0">
                    <div class="avatar-content">
                      <i class="bx bxs-zap text-primary font-size-base"></i>
                    </div>
                  </div>
                </div>
                <div class="list-content">
                  <span class="list-title">Total Products</span>
                  <small class="text-muted d-block">2k New Products</small>
                </div>
              </div>
              <span>10k</span>
            </li>
            <li
              class="list-group-item list-group-item-action border-0 d-flex align-items-center justify-content-between">
              <div class="list-left d-flex">
                <div class="list-icon mr-1">
                  <div class="avatar bg-rgba-info m-0">
                    <div class="avatar-content">
                      <i class="bx bx-stats text-info font-size-base"></i>
                    </div>
                  </div>
                </div>
                <div class="list-content">
                  <span class="list-title">Total Sales</span>
                  <small class="text-muted d-block">39k New Sales</small>
                </div>
              </div>
              <span>26M</span>
            </li>
            <li
              class="list-group-item list-group-item-action border-0 d-flex align-items-center justify-content-between">
              <div class="list-left d-flex">
                <div class="list-icon mr-1">
                  <div class="avatar bg-rgba-danger m-0">
                    <div class="avatar-content">
                      <i class="bx bx-credit-card text-danger font-size-base"></i>
                    </div>
                  </div>
                </div>
                <div class="list-content">
                  <span class="list-title">Total Revenue</span>
                  <small class="text-muted d-block">43k New Revenue</small>
                </div>
              </div>
              <span>15M</span>
            </li>
            <li
              class="list-group-item list-group-item-action border-0 d-flex align-items-center justify-content-between">
              <div class="list-left d-flex">
                <div class="list-icon mr-1">
                  <div class="avatar bg-rgba-success m-0">
                    <div class="avatar-content">
                      <i class="bx bx-dollar text-success font-size-base"></i>
                    </div>
                  </div>
                </div>
                <div class="list-content">
                  <span class="list-title">Total Cost</span>
                  <small class="text-muted d-block">Total Expenses</small>
                </div>
              </div>
              <span>2B</span>
            </li>
            <li
              class="list-group-item list-group-item-action border-0 d-flex align-items-center justify-content-between">
              <div class="list-left d-flex">
                <div class="list-icon mr-1">
                  <div class="avatar bg-rgba-primary m-0">
                    <div class="avatar-content">
                      <i class="bx bx-user text-primary font-size-base"></i>
                    </div>
                  </div>
                </div>
                <div class="list-content">
                  <span class="list-title">Total Users</span>
                  <small class="text-muted d-block">New Users</small>
                </div>
              </div>
              <span>2k</span>
            </li>
            <li
              class="list-group-item list-group-item-action border-0 d-flex align-items-center justify-content-between">
              <div class="list-left d-flex">
                <div class="list-icon mr-1">
                  <div class="avatar bg-rgba-danger m-0">
                    <div class="avatar-content">
                      <i class="bx bx-edit-alt text-danger font-size-base"></i>
                    </div>
                  </div>
                </div>
                <div class="list-content">
                  <span class="list-title">Total Visits</span>
                  <small class="text-muted d-block">New Visits</small>
                </div>
              </div>
              <span>46k</span>
            </li>
          </ul>
        </div>
      </div>
    </div>
    <!-- Earning Swiper Starts -->
    <div class="col-xl-4 col-md-6 col-12 dashboard-earning-swiper" id="widget-earnings">
      <div class="card">
        <div class="card-header border-bottom d-flex justify-content-between align-items-center">
          <h5 class="card-title"><i class="bx bx-dollar font-medium-5 align-middle"></i> <span
              class="align-middle">Earnings</span></h5>
          <i class="bx bx-dots-vertical-rounded font-medium-3 cursor-pointer"></i>
        </div>
        <div class="card-body py-1 px-0">
          <!-- earnings swiper starts -->
          <div class="widget-earnings-swiper swiper-container p-1">
            <div class="swiper-wrapper">
              <div class="swiper-slide rounded swiper-shadow py-50 px-2 d-flex align-items-center" id="repo-design">
                <i class="bx bx-pyramid mr-1 font-weight-normal font-medium-4"></i>
                <div class="swiper-text">
                  <div class="swiper-heading">Repo Design</div>
                  <small class="d-block">Gitlab</small>
                </div>
              </div>
              <div class="swiper-slide rounded swiper-shadow py-50 px-2 d-flex align-items-center" id="laravel-temp">
                <i class="bx bx-sitemap mr-50 font-large-1"></i>
                <div class="swiper-text">
                  <div class="swiper-heading">Designer</div>
                  <small class="d-block">Women Clothes</small>
                </div>
              </div>
              <div class="swiper-slide rounded swiper-shadow py-50 px-2 d-flex align-items-center" id="admin-theme">
                <i class="bx bx-check-shield mr-50 font-large-1"></i>
                <div class="swiper-text">
                  <div class="swiper-heading">Best Sellers</div>
                  <small class="d-block">Clothing</small>
                </div>
              </div>
              <div class="swiper-slide rounded swiper-shadow py-50 px-2 d-flex align-items-center" id="ux-developer">
                <i class="bx bx-devices mr-50 font-large-1"></i>
                <div class="swiper-text">
                  <div class="swiper-heading">Admin Template</div>
                  <small class="d-block">Global Network</small>
                </div>
              </div>
              <div class="swiper-slide rounded swiper-shadow py-50 px-2 d-flex align-items-center" id="marketing-guide">
                <i class="bx bx-book-bookmark mr-50 font-large-1"></i>
                <div class="swiper-text">
                  <div class="swiper-heading">Marketing Guide</div>
                  <small class="d-block">Books</small>
                </div>
              </div>
            </div>
          </div>
          <!-- earnings swiper ends -->
        </div>
        <div class="main-wrapper-content">
          <div class="wrapper-content" data-earnings="repo-design">
            <div class="widget-earnings-scroll table-responsive">
              <table class="table table-borderless widget-earnings-width mb-0">
                <tbody>
                  <tr>
                    <td class="pr-75">
                      <div class="media align-items-center">
                        <a class="media-left mr-50" href="javascript:;">
                          <img src="{{asset('images/portrait/small/avatar-s-10.jpg')}}" alt="avatar"
                            class="rounded-circle" height="30" width="30">
                        </a>
                        <div class="media-body">
                          <h6 class="media-heading mb-0">Jerry Lter</h6>
                          <span class="font-small-2">Designer</span>
                        </div>
                      </div>
                    </td>
                    <td class="px-0 w-25">
                      <div class="progress progress-bar-info progress-sm mb-0">
                        <div class="progress-bar" role="progressbar" aria-valuenow="33" aria-valuemin="80"
                          aria-valuemax="100" style="width:33%;"></div>
                      </div>
                    </td>
                    <td class="text-center"><span class="badge badge-light-warning">- $280</span>
                    </td>
                  </tr>
                  <tr>
                    <td class="pr-75">
                      <div class="media align-items-center">
                        <a class="media-left mr-50" href="javascript:;">
                          <img src="{{asset('images/portrait/small/avatar-s-11.jpg')}}" alt="avatar"
                            class="rounded-circle" height="30" width="30">
                        </a>
                        <div class="media-body">
                          <h6 class="media-heading mb-0">Pauly uez</h6>
                          <span class="font-small-2">Devloper</span>
                        </div>
                      </div>
                    </td>
                    <td class="px-0 w-25">
                      <div class="progress progress-bar-success progress-sm mb-0">
                        <div class="progress-bar" role="progressbar" aria-valuenow="10" aria-valuemin="80"
                          aria-valuemax="100" style="width:10%;"></div>
                      </div>
                    </td>
                    <td class="text-center"><span class="badge badge-light-success">+ $853</span>
                    </td>
                  </tr>
                  <tr>
                    <td class="pr-75">
                      <div class="media align-items-center">
                        <a class="media-left mr-50" href="javascript:;">
                          <img src="{{asset('images/portrait/small/avatar-s-11.jpg')}}" alt="avatar"
                            class="rounded-circle" height="30" width="30">
                        </a>
                        <div class="media-body">
                          <h6 class="media-heading mb-0">Lary Masey</h6>
                          <span class="font-small-2">Marketing</span>
                        </div>
                      </div>
                    </td>
                    <td class="px-0 w-25">
                      <div class="progress progress-bar-primary progress-sm mb-0">
                        <div class="progress-bar" role="progressbar" aria-valuenow="15" aria-valuemin="80"
                          aria-valuemax="100" style="width:15%;"></div>
                      </div>
                    </td>
                    <td class="text-center"><span class="badge badge-light-primary">+ $125</span>
                    </td>
                  </tr>
                  <tr>
                    <td class="pr-75">
                      <div class="media align-items-center">
                        <a class="media-left mr-50" href="javascript:;">
                          <img src="{{asset('images/portrait/small/avatar-s-12.jpg')}}" alt="avatar"
                            class="rounded-circle" height="30" width="30">
                        </a>
                        <div class="media-body">
                          <h6 class="media-heading mb-0">Lula Taylor</h6>
                          <span class="font-small-2">Degigner</span>
                        </div>
                      </div>
                    </td>
                    <td class="px-0 w-25">
                      <div class="progress progress-bar-danger progress-sm mb-0">
                        <div class="progress-bar" role="progressbar" aria-valuenow="35" aria-valuemin="80"
                          aria-valuemax="100" style="width:35%;"></div>
                      </div>
                    </td>
                    <td class="text-center"><span class="badge badge-light-danger">- $310</span>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
          <div class="wrapper-content" data-earnings="laravel-temp">
            <div class="widget-earnings-scroll table-responsive">
              <table class="table table-borderless widget-earnings-width mb-0">
                <tbody>
                  <tr>
                    <td class="pr-75">
                      <div class="media align-items-center">
                        <a class="media-left mr-50" href="javascript:;">
                          <img src="{{asset('images/portrait/small/avatar-s-9.jpg')}}" alt="avatar"
                            class="rounded-circle" height="30" width="30">
                        </a>
                        <div class="media-body">
                          <h6 class="media-heading mb-0">Jesus Lter</h6>
                          <span class="font-small-2">Designer</span>
                        </div>
                      </div>
                    </td>
                    <td class="px-0 w-25">
                      <div class="progress progress-bar-info progress-sm mb-0">
                        <div class="progress-bar" role="progressbar" aria-valuenow="28" aria-valuemin="80"
                          aria-valuemax="100" style="width:28%;"></div>
                      </div>
                    </td>
                    <td class="text-center"><span class="badge badge-light-info">- $280</span></td>
                  </tr>
                  <tr>
                    <td class="pr-75">
                      <div class="media align-items-center">
                        <a class="media-left mr-50" href="javascript:;">
                          <img src="{{asset('images/portrait/small/avatar-s-10.jpg')}}" alt="avatar"
                            class="rounded-circle" height="30" width="30">
                        </a>
                        <div class="media-body">
                          <h6 class="media-heading mb-0">Pauly Dez</h6>
                          <span class="font-small-2">Devloper</span>
                        </div>
                      </div>
                    </td>
                    <td class="px-0 w-25">
                      <div class="progress progress-bar-success progress-sm mb-0">
                        <div class="progress-bar" role="progressbar" aria-valuenow="90" aria-valuemin="80"
                          aria-valuemax="100" style="width:90%;"></div>
                      </div>
                    </td>
                    <td class="text-center"><span class="badge badge-light-success">+ $83</span>
                    </td>
                  </tr>
                  <tr>
                    <td class="pr-75">
                      <div class="media align-items-center">
                        <a class="media-left mr-50" href="javascript:;">
                          <img src="{{asset('images/portrait/small/avatar-s-11.jpg')}}" alt="avatar"
                            class="rounded-circle" height="30" width="30">
                        </a>
                        <div class="media-body">
                          <h6 class="media-heading mb-0">Lary Masey</h6>
                          <span class="font-small-2">Marketing</span>
                        </div>
                      </div>
                    </td>
                    <td class="px-0 w-25">
                      <div class="progress progress-bar-primary progress-sm mb-0">
                        <div class="progress-bar" role="progressbar" aria-valuenow="15" aria-valuemin="80"
                          aria-valuemax="100" style="width:15%;"></div>
                      </div>
                    </td>
                    <td class="text-center"><span class="badge badge-light-primary">+ $125</span>
                    </td>
                  </tr>
                  <tr>
                    <td class="pr-75">
                      <div class="media align-items-center">
                        <a class="media-left mr-50" href="javascript:;">
                          <img src="{{asset('images/portrait/small/avatar-s-12.jpg')}}" alt="avatar"
                            class="rounded-circle" height="30" width="30">
                        </a>
                        <div class="media-body">
                          <h6 class="media-heading mb-0">Lula Taylor</h6>
                          <span class="font-small-2">Devloper</span>
                        </div>
                      </div>
                    </td>
                    <td class="px-0 w-25">
                      <div class="progress progress-bar-danger progress-sm mb-0">
                        <div class="progress-bar" role="progressbar" aria-valuenow="35" aria-valuemin="80"
                          aria-valuemax="100" style="width:35%;"></div>
                      </div>
                    </td>
                    <td class="text-center"><span class="badge badge-light-danger">- $310</span>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
          <div class="wrapper-content" data-earnings="admin-theme">
            <div class="widget-earnings-scroll table-responsive">
              <table class="table table-borderless widget-earnings-width mb-0">
                <tbody>
                  <tr>
                    <td class="pr-75">
                      <div class="media align-items-center">
                        <a class="media-left mr-50" href="javascript:;">
                          <img src="{{asset('images/portrait/small/avatar-s-25.jpg')}}" alt="avatar"
                            class="rounded-circle" height="30" width="30">
                        </a>
                        <div class="media-body">
                          <h6 class="media-heading mb-0">Mera Lter</h6>
                          <span class="font-small-2">Designer</span>
                        </div>
                      </div>
                    </td>
                    <td class="px-0 w-25">
                      <div class="progress progress-bar-info progress-sm mb-0">
                        <div class="progress-bar" role="progressbar" aria-valuenow="52" aria-valuemin="80"
                          aria-valuemax="100" style="width:52%;"></div>
                      </div>
                    </td>
                    <td class="text-center"><span class="badge badge-light-info">- $180</span></td>
                  </tr>
                  <tr>
                    <td class="pr-75">
                      <div class="media align-items-center">
                        <a class="media-left mr-50" href="javascript:;">
                          <img src="{{asset('images/portrait/small/avatar-s-15.jpg')}}" alt="avatar"
                            class="rounded-circle" height="30" width="30">
                        </a>
                        <div class="media-body">
                          <h6 class="media-heading mb-0">Pauly Dez</h6>
                          <span class="font-small-2">Devloper</span>
                        </div>
                      </div>
                    </td>
                    <td class="px-0 w-25">
                      <div class="progress progress-bar-success progress-sm mb-0">
                        <div class="progress-bar" role="progressbar" aria-valuenow="90" aria-valuemin="80"
                          aria-valuemax="100" style="width:90%;"></div>
                      </div>
                    </td>
                    <td class="text-center"><span class="badge badge-light-success">+ $553</span>
                    </td>
                  </tr>
                  <tr>
                    <td class="pr-75">
                      <div class="media align-items-center">
                        <a class="media-left mr-50" href="javascript:;">
                          <img src="{{asset('images/portrait/small/avatar-s-11.jpg')}}" alt="avatar"
                            class="rounded-circle" height="30" width="30">
                        </a>
                        <div class="media-body">
                          <h6 class="media-heading mb-0">jini mara</h6>
                          <span class="font-small-2">Marketing</span>
                        </div>
                      </div>
                    </td>
                    <td class="px-0 w-25">
                      <div class="progress progress-bar-primary progress-sm mb-0">
                        <div class="progress-bar" role="progressbar" aria-valuenow="15" aria-valuemin="80"
                          aria-valuemax="100" style="width:15%;"></div>
                      </div>
                    </td>
                    <td class="text-center"><span class="badge badge-light-primary">+ $125</span>
                    </td>
                  </tr>
                  <tr>
                    <td class="pr-75">
                      <div class="media align-items-center">
                        <a class="media-left mr-50" href="javascript:;">
                          <img src="{{asset('images/portrait/small/avatar-s-12.jpg')}}" alt="avatar"
                            class="rounded-circle" height="30" width="30">
                        </a>
                        <div class="media-body">
                          <h6 class="media-heading mb-0">Lula Taylor</h6>
                          <span class="font-small-2">UX</span>
                        </div>
                      </div>
                    </td>
                    <td class="px-0 w-25">
                      <div class="progress progress-bar-danger progress-sm mb-0">
                        <div class="progress-bar" role="progressbar" aria-valuenow="35" aria-valuemin="80"
                          aria-valuemax="100" style="width:35%;"></div>
                      </div>
                    </td>
                    <td class="text-center"><span class="badge badge-light-danger">- $150</span>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
          <div class="wrapper-content" data-earnings="ux-developer">
            <div class="widget-earnings-scroll table-responsive">
              <table class="table table-borderless widget-earnings-width mb-0">
                <tbody>
                  <tr>
                    <td class="pr-75">
                      <div class="media align-items-center">
                        <a class="media-left mr-50" href="javascript:;">
                          <img src="{{asset('images/portrait/small/avatar-s-16.jpg')}}" alt="avatar"
                            class="rounded-circle" height="30" width="30">
                        </a>
                        <div class="media-body">
                          <h6 class="media-heading mb-0">Drako Lter</h6>
                          <span class="font-small-2">Designer</span>
                        </div>
                      </div>
                    </td>
                    <td class="px-0 w-25">
                      <div class="progress progress-bar-info progress-sm mb-0">
                        <div class="progress-bar" role="progressbar" aria-valuenow="38" aria-valuemin="80"
                          aria-valuemax="100" style="width:38%;"></div>
                      </div>
                    </td>
                    <td class="text-center"><span class="badge badge-light-danger">- $280</span>
                    </td>
                  </tr>
                  <tr>
                    <td class="pr-75">
                      <div class="media align-items-center">
                        <a class="media-left mr-50" href="javascript:;">
                          <img src="{{asset('images/portrait/small/avatar-s-1.jpg')}}" alt="avatar"
                            class="rounded-circle" height="30" width="30">
                        </a>
                        <div class="media-body">
                          <h6 class="media-heading mb-0">Pauly Dez</h6>
                          <span class="font-small-2">Devloper</span>
                        </div>
                      </div>
                    </td>
                    <td class="px-0 w-25">
                      <div class="progress progress-bar-success progress-sm mb-0">
                        <div class="progress-bar" role="progressbar" aria-valuenow="90" aria-valuemin="80"
                          aria-valuemax="100" style="width:90%;"></div>
                      </div>
                    </td>
                    <td class="text-center"><span class="badge badge-light-success">+ $853</span>
                    </td>
                  </tr>
                  <tr>
                    <td class="pr-75">
                      <div class="media align-items-center">
                        <a class="media-left mr-50" href="javascript:;">
                          <img src="{{asset('images/portrait/small/avatar-s-11.jpg')}}" alt="avatar"
                            class="rounded-circle" height="30" width="30">
                        </a>
                        <div class="media-body">
                          <h6 class="media-heading mb-0">Lary Masey</h6>
                          <span class="font-small-2">Marketing</span>
                        </div>
                      </div>
                    </td>
                    <td class="px-0 w-25">
                      <div class="progress progress-bar-primary progress-sm mb-0">
                        <div class="progress-bar" role="progressbar" aria-valuenow="15" aria-valuemin="80"
                          aria-valuemax="100" style="width:15%;"></div>
                      </div>
                    </td>
                    <td class="text-center"><span class="badge badge-light-primary">+ $125</span>
                    </td>
                  </tr>
                  <tr>
                    <td class="pr-75">
                      <div class="media align-items-center">
                        <a class="media-left mr-50" href="javascript:;">
                          <img src="{{asset('images/portrait/small/avatar-s-2.jpg')}}" alt="avatar"
                            class="rounded-circle" height="30" width="30">
                        </a>
                        <div class="media-body">
                          <h6 class="media-heading mb-0">Lvia Taylor</h6>
                          <span class="font-small-2">Devloper</span>
                        </div>
                      </div>
                    </td>
                    <td class="px-0 w-25">
                      <div class="progress progress-bar-danger progress-sm mb-0">
                        <div class="progress-bar" role="progressbar" aria-valuenow="75" aria-valuemin="80"
                          aria-valuemax="100" style="width:75%;"></div>
                      </div>
                    </td>
                    <td class="text-center"><span class="badge badge-light-danger">- $360</span>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
          <div class="wrapper-content" data-earnings="marketing-guide">
            <div class="widget-earnings-scroll table-responsive">
              <table class="table table-borderless widget-earnings-width mb-0">
                <tbody>
                  <tr>
                    <td class="pr-75">
                      <div class="media align-items-center">
                        <a class="media-left mr-50" href="javascript:;">
                          <img src="{{asset('images/portrait/small/avatar-s-19.jpg')}}" alt="avatar"
                            class="rounded-circle" height="30" width="30">
                        </a>
                        <div class="media-body">
                          <h6 class="media-heading mb-0">yono Lter</h6>
                          <span class="font-small-2">Designer</span>
                        </div>
                      </div>
                    </td>
                    <td class="px-0 w-25">
                      <div class="progress progress-bar-info progress-sm mb-0">
                        <div class="progress-bar" role="progressbar" aria-valuenow="28" aria-valuemin="80"
                          aria-valuemax="100" style="width:28%;"></div>
                      </div>
                    </td>
                    <td class="text-center"><span class="badge badge-light-primary">- $270</span>
                    </td>
                  </tr>
                  <tr>
                    <td class="pr-75">
                      <div class="media align-items-center">
                        <a class="media-left mr-50" href="javascript:;">
                          <img src="{{asset('images/portrait/small/avatar-s-11.jpg')}}" alt="avatar"
                            class="rounded-circle" height="30" width="30">
                        </a>
                        <div class="media-body">
                          <h6 class="media-heading mb-0">Pauly Dez</h6>
                          <span class="font-small-2">Devloper</span>
                        </div>
                      </div>
                    </td>
                    <td class="px-0 w-25">
                      <div class="progress progress-bar-success progress-sm mb-0">
                        <div class="progress-bar" role="progressbar" aria-valuenow="90" aria-valuemin="80"
                          aria-valuemax="100" style="width:90%;"></div>
                      </div>
                    </td>
                    <td class="text-center"><span class="badge badge-light-success">+ $853</span>
                    </td>
                  </tr>
                  <tr>
                    <td class="pr-75">
                      <div class="media align-items-center">
                        <a class="media-left mr-50" href="javascript:;">
                          <img src="{{asset('images/portrait/small/avatar-s-12.jpg')}}" alt="avatar"
                            class="rounded-circle" height="30" width="30">
                        </a>
                        <div class="media-body">
                          <h6 class="media-heading mb-0">Lary Masey</h6>
                          <span class="font-small-2">Marketing</span>
                        </div>
                      </div>
                    </td>
                    <td class="px-0 w-25">
                      <div class="progress progress-bar-primary progress-sm mb-0">
                        <div class="progress-bar" role="progressbar" aria-valuenow="15" aria-valuemin="80"
                          aria-valuemax="100" style="width:15%;"></div>
                      </div>
                    </td>
                    <td class="text-center"><span class="badge badge-light-primary">+ $225</span>
                    </td>
                  </tr>
                  <tr>
                    <td class="pr-75">
                      <div class="media align-items-center">
                        <a class="media-left mr-50" href="javascript:;">
                          <img src="{{asset('images/portrait/small/avatar-s-25.jpg')}}" alt="avatar"
                            class="rounded-circle" height="30" width="30">
                        </a>
                        <div class="media-body">
                          <h6 class="media-heading mb-0">Lula Taylor</h6>
                          <span class="font-small-2">Devloper</span>
                        </div>
                      </div>
                    </td>
                    <td class="px-0 w-25">
                      <div class="progress progress-bar-danger progress-sm mb-0">
                        <div class="progress-bar" role="progressbar" aria-valuenow="35" aria-valuemin="80"
                          aria-valuemax="100" style="width:35%;"></div>
                      </div>
                    </td>
                    <td class="text-center"><span class="badge badge-light-danger">- $350</span>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Marketing Campaigns Starts -->
    <div class="col-xl-8 col-12 dashboard-marketing-campaign">
      <div class="card marketing-campaigns">
        <div class="card-header d-flex justify-content-between align-items-center pb-1">
          <h4 class="card-title">Marketing campaigns</h4>
          <i class="bx bx-dots-vertical-rounded font-medium-3 cursor-pointer"></i>
        </div>
        <div class="card-body pb-0">
          <div class="row mb-1">
            <div class="col-md-9 col-12">
              <div class="d-inline-block">
                <!-- chart-1   -->
                <div class="d-flex market-statistics-1">
                  <!-- chart-statistics-1 -->
                  <div id="donut-success-chart" class="mx-1"></div>
                  <!-- data -->
                  <div class="statistics-data my-auto">
                    <div class="statistics">
                      <span class="font-medium-2 mr-50 text-bold-600">25,756</span><span
                        class="text-success">(+16.2%)</span>
                    </div>
                    <div class="statistics-date">
                      <i class="bx bx-radio-circle font-small-1 text-success mr-25"></i>
                      <small class="text-muted">May 12, 2020</small>
                    </div>
                  </div>
                </div>
              </div>
              <div class="d-inline-block">
                <!-- chart-2 -->
                <div class="d-flex mb-75 market-statistics-2">
                  <!-- chart statistics-2 -->
                  <div id="donut-danger-chart" class="mx-1"></div>
                  <!-- data-2 -->
                  <div class="statistics-data my-auto">
                    <div class="statistics">
                      <span class="font-medium-2 mr-50 text-bold-600">5,352</span><span
                        class="text-danger">(-4.9%)</span>
                    </div>
                    <div class="statistics-date">
                      <i class="bx bx-radio-circle font-small-1 text-success mr-25"></i>
                      <small class="text-muted">Jul 26, 2020</small>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-3 col-12 text-md-right">
              <button class="btn btn-sm btn-primary glow mt-md-2 mb-1">View Report</button>
            </div>
          </div>
        </div>
        <div class="table-responsive">
          <!-- table start -->
          <table id="table-marketing-campaigns" class="table table-borderless table-marketing-campaigns mb-0">
            <thead>
              <tr>
                <th>Campaign</th>
                <th>Growth</th>
                <th>Charges</th>
                <th>Status</th>
                <th class="text-center">Action</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td class="py-1 line-ellipsis">
                  <img class="rounded-circle mr-1" src="{{asset('images/icon/fs.png')}}" alt="card" height="24"
                    width="24">Fastrack Watches
                </td>
                <td class="py-1">
                  <i class="bx bx-trending-up text-success align-middle mr-50"></i><span>30%</span>
                </td>
                <td class="py-1">$5,536</td>
                <td class="text-success py-1">Active</td>
                <td class="text-center py-1">
                  <div class="dropdown">
                    <span
                      class="bx bx-dots-vertical-rounded font-medium-3 dropdown-toggle nav-hide-arrow cursor-pointer"
                      data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" role="menu"></span>
                    <div class="dropdown-menu dropdown-menu-right">
                      <a class="dropdown-item" href="javascript:;"><i class="bx bx-edit-alt mr-1"></i> edit</a>
                      <a class="dropdown-item" href="javascript:;"><i class="bx bx-trash mr-1"></i> delete</a>
                    </div>
                  </div>
                </td>
              </tr>
              <tr>
                <td class="py-1 line-ellipsis">
                  <img class="rounded-circle mr-1" src="{{asset('images/icon/puma.png')}}" alt="card" height="24"
                    width="24">Puma Shoes
                </td>
                <td class="py-1">
                  <i class="bx bx-trending-down text-danger align-middle mr-50"></i><span>15.5%</span>
                </td>
                <td class="py-1">$1,569</td>
                <td class="text-success py-1">Active</td>
                <td class="text-center py-1">
                  <div class="dropdown">
                    <span
                      class="bx bx-dots-vertical-rounded font-medium-3 dropdown-toggle nav-hide-arrow cursor-pointer"
                      data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" role="menu">
                    </span>
                    <div class="dropdown-menu dropdown-menu-right">
                      <a class="dropdown-item" href="javascript:;"><i class="bx bx-edit-alt mr-1"></i> edit</a>
                      <a class="dropdown-item" href="javascript:;"><i class="bx bx-trash mr-1"></i> delete</a>
                    </div>
                  </div>
                </td>
              </tr>
              <tr>
                <td class="py-1 line-ellipsis">
                  <img class="rounded-circle mr-1" src="{{asset('images/icon/nike.png')}}" alt="card" height="24"
                    width="24">Nike Air Jordan
                </td>
                <td class="py-1">
                  <i class="bx bx-trending-up text-success align-middle mr-50"></i><span>70.3%</span>
                </td>
                <td class="py-1">$23,859</td>
                <td class="text-danger py-1">Closed</td>
                <td class="text-center py-1">
                  <div class="dropdown">
                    <span
                      class="bx bx-dots-vertical-rounded font-medium-3 dropdown-toggle nav-hide-arrow cursor-pointer"
                      data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" role="menu">
                    </span>
                    <div class="dropdown-menu dropdown-menu-right">
                      <a class="dropdown-item" href="javascript:;"><i class="bx bx-edit-alt mr-1"></i> edit</a>
                      <a class="dropdown-item" href="javascript:;"><i class="bx bx-trash mr-1"></i> delete</a>
                    </div>
                  </div>
                </td>
              </tr>
              <tr>
                <td class="py-1 line-ellipsis">
                  <img class="rounded-circle mr-1" src="{{asset('images/icon/one-plus.png')}}" alt="card" height="24"
                    width="24">Oneplus 7 pro
                </td>
                <td class="py-1">
                  <i class="bx bx-trending-up text-success align-middle mr-50"></i><span>10.4%</span>
                </td>
                <td class="py-1">$9,523</td>
                <td class="text-success py-1">Active</td>
                <td class="text-center py-1">
                  <div class="dropdown">
                    <span
                      class="bx bx-dots-vertical-rounded font-medium-3 dropdown-toggle nav-hide-arrow cursor-pointer"
                      data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" role="menu">
                    </span>
                    <div class="dropdown-menu dropdown-menu-right">
                      <a class="dropdown-item" href="javascript:;"><i class="bx bx-edit-alt mr-1"></i> edit</a>
                      <a class="dropdown-item" href="javascript:;"><i class="bx bx-trash mr-1"></i> delete</a>
                    </div>
                  </div>
                </td>
              </tr>
              <tr>
                <td class="py-1 line-ellipsis">
                  <img class="rounded-circle mr-1" src="{{asset('images/icon/google.png')}}" alt="card" height="24"
                    width="24">Google Pixel 4 xl
                </td>
                <td class="py-1"><i class="bx bx-trending-down text-danger align-middle mr-50"></i><span>-62.38%</span>
                </td>
                <td class="py-1">$12,897</td>
                <td class="text-danger py-1">Closed</td>
                <td class="text-center py-1">
                  <div class="dropup">
                    <span
                      class="bx bx-dots-vertical-rounded font-medium-3 dropdown-toggle nav-hide-arrow cursor-pointer"
                      data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" role="menu">
                    </span>
                    <div class="dropdown-menu dropdown-menu-right">
                      <a class="dropdown-item" href="javascript:;"><i class="bx bx-edit-alt mr-1"></i> edit</a>
                      <a class="dropdown-item" href="javascript:;"><i class="bx bx-trash mr-1"></i> delete</a>
                    </div>
                  </div>
                </td>
              </tr>
            </tbody>
          </table>
          <!-- table ends -->
        </div>
      </div>
    </div>
  </div>
</section>
<!-- Dashboard Ecommerce ends -->
@endsection

@section('vendor-scripts')
<script src="{{asset('vendors/js/charts/apexcharts.min.js')}}"></script>
<script src="{{asset('vendors/js/extensions/swiper.min.js')}}"></script>
@endsection

@section('page-scripts')
<script src="{{asset('js/scripts/pages/dashboard-ecommerce.js')}}"></script>
@endsection
