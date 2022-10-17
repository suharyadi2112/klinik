@extends('layouts.contentLayoutMaster')
{{-- page title --}}
@section('title','Screening')
{{-- vendor styles --}}
@section('vendor-styles')
<link rel="stylesheet" type="text/css" href="{{asset('vendors/css/tables/datatable/dataTables.bootstrap4.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('vendors/css/tables/datatable/responsive.bootstrap4.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('vendors/css/tables/datatable/buttons.bootstrap4.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('vendors/css/forms/select/select2.min.css')}}">

{{-- sweetalert2 --}}
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

{{-- pace --}}
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/pace-js@latest/pace-theme-default.min.css">

@endsection
@section('page-styles')
<link rel="stylesheet" type="text/css" href="{{asset('css/pages/app-users.css')}}">
@endsection
@section('content')

@if(auth()->user()->can('view screening')/* && $some_other_condition*/)
<!-- add result laboratorium -->
<section class="add_registration-list-wrapper">
  <div class="add_registration-list-table">
    <div class="card ">
      <div class="card-body">
        @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @endif
      	{{-- <form id="InsertRegistration" data-route="{{ route('InsertRegistration') }}" role="form" method="POST" accept-charset="utf-8"> --}}
        {{-- start form --}}
      	<div class="row match-height">
          <div class="col-12">
               <div class="row">
  		            <div class="col-sm-4 col-12">
  		                <h6><small class="text-muted">Registration Date</small></h6>
  		                <p><b>{{ $databasic->pentgl }}</b></p>
  		            </div>
  		            <div class="col-sm-4 col-12">
  		                <h6><small class="text-muted">Reference Date</small></h6>
  		                <p><b>{{ $databasic->pentglrujukan }}</b></p>
  		            </div>
  		            <div class="col-sm-4 col-12">
  		                <h6><small class="text-muted">Patient Name</small></h6>
  		                <p><b>{{ $databasic->pasnama }}</b></p>
  		            </div>
  		            <div class="col-sm-4 col-12">
  		                <h6><small class="text-muted">Partner</small></h6>
  		                <p><b>{{ $databasic->pennama }}</b></p>
  		            </div>
  		            <div class="col-sm-4 col-12">
  		                <h6><small class="text-muted">Type Of Billing</small></h6>
  		                <p><b>{{ $databasic->pemnama }}</b></p>
  		            </div>
  		        </div>
		        <hr>


              <ul class="nav nav-tabs" role="tablist">
                <li class="nav-item">
                    <a class="nav-link ChangeTab" tujuan="home-tab" id="home-tab" data-toggle="tab" href="#home" aria-controls="home" role="tab" aria-selected="true">
                        <i class='bx bx-band-aid align-middle'></i>
                        <span class="align-middle">Reassessment Health</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link ChangeTab" tujuan="profile-tab" id="profile-tab" data-toggle="tab" href="#profile" aria-controls="profile" role="tab" aria-selected="false">
                        <i class='bx bxs-first-aid align-middle'></i>
                        <span class="align-middle">Health Screening</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link ChangeTab" tujuan="about-tab" id="about-tab" data-toggle="tab" href="#about" aria-controls="about" role="tab" aria-selected="false">
                        <i class='bx bx-first-aid align-middle'></i>
                        <span class="align-middle">Health Screening 2</span>
                    </a>
                </li>
              </ul>
              <div class="tab-content p-0">
                  
                  {{-- PAGE 1 --}}

                  <div class="tab-pane home-tab" id="home" aria-labelledby="home-tab" role="tabpanel">
                    <form id="UpdateScreeningSatu" data-route="{{ route('UpdateScreening',['id_regis' => $id_res_encrypt, 'type' => 'screening_satu']) }}" role="form" method="POST" accept-charset="utf-8">
                    <div class="form-body">
                    <h6 class="card-title">Medical check up data</h6>
                      <div class="row">

                        {{-- Medical Check Up Data --}}

                          <div class="col-md-4 col-12">
                            <label for="registration-date">Date of exam <code>Registration Date</code></label>
                              <div class="position-relative has-icon-left">
                                  <input type="date" value="{{ $databasic->pentgl }}" name="date_registration" class="form-control" placeholder="Registration Data" readonly>
                                  <div class="form-control-position">
                                      <i class="bx bx-calendar"></i>
                                  </div>
                              </div>
                          </div>
                          <div class="col-md-4 mb-1">
                            <label for="certification">Certification</label>
                              <div class="position-relative has-icon-left">
                                  <textarea class="form-control" id="certification" name="certification" placeholder="leave certification" aria-label="certification">@if($GetScrReassessment){{ $GetScrReassessment->certification }}@endif</textarea>
                                  <div class="form-control-position">
                                    <i class='bx bx-note'></i>
                                  </div>
                              </div>
                          </div>
                          <div class="col-md-4 mb-1">
                            <label for="remark/medical history">Remark exam/medical history</label>
                              <div class="position-relative has-icon-left">
                                  <textarea class="form-control" id="remarkexam" name="remarkexam" placeholder="leave remark exam" aria-label="remark exam">@if($GetScrReassessment){{ $GetScrReassessment->remark_exam }}@endif</textarea>
                                  <div class="form-control-position">
                                    <i class='bx bx-note'></i>
                                  </div>
                              </div>
                          </div>

                        </div>

                        <hr>
                        {{-- Then futher examination was conduted --}}
                      
                      <h6 class="card-title">Then futher examination was conduted</h6>
                      <div class="row">
                          <div class="col-md-4 col-12">
                            <label for="doctor name">Doctor's Name</label>
                              <div class="position-relative has-icon-left">
                                  <input type="text" value="{{ $users->name }}" name="doctor_name" class="form-control" placeholder="Doctor name" readonly>
                                  <div class="form-control-position">
                                      <i class="bx bx-user"></i>
                                  </div>
                              </div>
                          </div>
                          <div class="col-md-4 col-12">
                            <label for="date of exam">Date of exam <code>Reference Date</code></label>
                              <div class="position-relative has-icon-left">
                                  <input type="date" value="{{ $databasic->pentglrujukan }}" name="date_of_exam" class="form-control" placeholder="Date of exam" readonly>
                                  <div class="form-control-position">
                                      <i class="bx bx-calendar"></i>
                                  </div>
                              </div>
                          </div>
                          <div class="col-md-4 col-12 mb-1">
                            <label for="place of exam">Place of exam</label>
                              <div class="position-relative has-icon-left">
                                  <input type="text" value="Laboratorium Klinik Osmaro" name="place_of_exam" class="form-control" placeholder="Place of exam" readonly>
                                  <div class="form-control-position">
                                      <i class="bx bx-home"></i>
                                  </div>
                              </div>
                          </div>

                          <div class="col-md-4 mb-1">
                            <label for="conclusion/remark">Conclusion/Remark</label>
                              <div class="position-relative has-icon-left">
                                  <textarea class="form-control" id="conclusion_remark" name="conclusion_remark" placeholder="leave remark exam" aria-label="remark exam">@if($GetScrReassessment){{ $GetScrReassessment->conclusion_remark }}@endif</textarea>
                                  <div class="form-control-position">
                                    <i class='bx bxs-info-circle'></i>
                                  </div>
                              </div>
                          </div>
                      </div>
                      <hr>

                      {{-- Recertification --}}
                      
                      <h6 class="card-title">Recertification & Advice</h6>
                      <div class="row">
                    
                          <div class="col-md-6 mb-1">
                            <label for="recertification">Recertification</label>
                              <div class="position-relative has-icon-left">
                                  <textarea class="form-control" id="recertification" name="recertification" placeholder="leave recertification" aria-label="recertification">@if($GetScrReassessment){{ $GetScrReassessment->recertification }}@endif</textarea>
                                  <div class="form-control-position">
                                    <i class='bx bxs-certification'></i>
                                  </div>
                              </div>
                          </div>

                          <div class="col-md-6 mb-1">
                            <label for="advice">advice</label>
                              <div class="position-relative has-icon-left">
                                  <textarea class="form-control" id="advice" name="advice" placeholder="leave advice" aria-label="advice">@if($GetScrReassessment){{ $GetScrReassessment->advice }}@endif</textarea>
                                  <div class="form-control-position">
                                    <i class='bx bxs-smile'></i>
                                  </div>
                              </div>
                          </div>
                      
                      </div>
                    </div>
                    <button type="submit" class="btn btn-info PrintSatu glow shadow"><i class='bx bx-cloud-upload HaveChangeSatu'></i> Update</button>
                    <a target="_blank" class="btn btn-primary glow shadow" href="{{ route('PrintReassessmentHealth',['id_regis' => $id_res_encrypt, 'type' => 'screening_satu'])}}"><i class='bx bx-printer'></i> Print</a>
                  </form>
                  </div>



                  {{--__________________ PAGE 2 ________________--}}



                  <div class="tab-pane profile-tab" id="profile" aria-labelledby="profile-tab" role="tabpanel">
                    <form id="UpdateScreeningDua" data-route="{{ route('UpdateScreening',['id_regis' => $id_res_encrypt, 'type' => 'screening_dua']) }}" role="form" method="POST" accept-charset="utf-8">
                    <div class="form-body">

                      {{-- Medical History --}}
                      <h6 class="card-title">Medical History</h6>
                      <div class="row">

                          <div class="col-md-5 mb-1 mr-0">
                            <label for="medical-history">Medical History<code>pick if have</code></label>
                            <select class="select2MedicalHistory form-control" multiple="multiple" name="medical_history[]">
                              @forelse($MedHis as $keyf => $valMedHis)
                                <option value="{{ $valMedHis->id_medical_history }}">{{ $valMedHis->name_medical_history }}</option>
                              @empty
                                <option value="">Data Not Found !</option>
                              @endforelse
                            </select>
                          </div>

                          <div class="col-md-1 mb-1">
                            <li class="d-inline-block pt-2">
                              <fieldset>
                                  <div class="checkbox checkbox-primary checkbox-glow">
                                      <input type="checkbox" id="checkboxGlow1" name="medical_history[]"
                                      @if($DataPageTwo['medical_history'] ?? null) 
                                        @if(in_array('on', $DataPageTwo['medical_history']))
                                          checked 
                                        @endif
                                      @endif
                                      >
                                      <label for="checkboxGlow1">Others</label>
                                  </div>
                              </fieldset>
                            </li>
                          </div>
                          

                      </div>
                      <hr>

                      {{-- CLINIC EXAMINATION --}}
                 
                      <h6 class="card-title">Clinic Examination, Laboratory Test, Other Test</h6>
                      <div class="row">

                          {{-- TABELING INPUT CLINIC EXAMINATION --}}
                          
                          <div class="col-md-12 mb-1">
                            <table border="0">
                              <tbody>
                                <tr>
                                  <td>
                                    <div class="row">
                                      <div class="col-md-6 mb-1">
                                        <label for="weight">Weight</label>
                                          <div class="position-relative has-icon-left">
                                              <input type="text" name="weight" class="form-control" placeholder="Weight" 
                                              @if($DataPageTwo != '')
                                                @if($DataPageTwo['weight'] ?? null)
                                                value="{{ $DataPageTwo['weight'] ? $DataPageTwo['weight'] : '' }}" 
                                                @endif
                                              @endif
                                              >
                                              <div class="form-control-position">
                                                  <i class='bx bx-dumbbell'></i>
                                              </div>
                                          </div>
                                      </div>
                                      <div class="col-md-6 mb-1">
                                        <label for="height">Height</label>
                                          <div class="position-relative has-icon-left">
                                              <input type="text" name="height" class="form-control" placeholder="Height"
                                              @if($DataPageTwo != '')
                                                @if($DataPageTwo['height'] ?? null)
                                                value="{{ $DataPageTwo['height'] ? $DataPageTwo['height'] : '' }}"
                                                @endif
                                              @endif
                                              >
                                              <div class="form-control-position">
                                                  <i class='bx bx-ruler'></i>
                                              </div>
                                          </div>
                                      </div>
                                    </div>
                                    <div class="row">
                                      <div class="col-md-6 mb-1">
                                        <label for="bmi">BMI <code>body mass indeks</code></label>
                                          <div class="position-relative has-icon-left">
                                              <input type="text" name="bmi" class="form-control" placeholder="BMI" 
                                              @if($DataPageTwo != '')
                                                @if($DataPageTwo['bmi'] ?? null)
                                                value="{{ $DataPageTwo['bmi'] ? $DataPageTwo['bmi'] : '' }}"
                                                @endif
                                              @endif
                                              >
                                              <div class="form-control-position">
                                                  <i class='bx bx-dumbbell'></i>
                                              </div>
                                          </div>
                                      </div>
                                      <div class="col-md-6 mb-1">
                                        <label for="visus">Visus</label>
                                          <div class="position-relative has-icon-left">
                                              <input type="text" name="visus" class="form-control" placeholder="Visus" 
                                              @if($DataPageTwo != '')
                                                @if($DataPageTwo['visus'] ?? null)
                                                value="{{ $DataPageTwo['visus'] ? $DataPageTwo['visus'] : '' }}"
                                                @endif
                                              @endif
                                              >
                                              <div class="form-control-position">
                                                  <i class='bx bx-show-alt'></i>
                                              </div>
                                          </div>
                                      </div>
                                    </div>
                                  </td>
                                  {{-- td jarak --}}
                                  <td class="p-1"></td>

                                  <td style="width:50%; vertical-align: top;" rowspan="2">
                                     <table class="table table-bordered table-sm">
                                        {{-- laboratory test --}}
                                        <thead class="thead-dark">
                                          <tr>
                                            <th colspan="2" style="text-align: center; font-size: 13px;">laboratory Test</th>
                                          </tr>
                                        </thead>
                                        <thead>
                                          <tr>
                                            <th style="text-align:center;">Type</th>
                                            <th style="text-align:center;" nowrap>No/Normal - Yes/Abnormal</th>
                                          </tr>
                                        </thead>
                                        <tbody>
                                          @php 
                                          $nokk = 1;
                                          @endphp
                                          @foreach($LabTest as $keyLabTest => $ValLabTest)
                                          @if($ValLabTest->type_laboratory_test == 'main')
                                          <tr>
                                            <td style="padding-left:10px;">{{ $nokk }}. {{ $ValLabTest->name_laboratory_test }}</td>

                                            <td style=" text-align: center;">
                                              <div class="custom-control custom-switch custom-switch-success">
                                                  <input type="checkbox" class="custom-control-input" name="laboratory_test[]" id="{{ $ValLabTest->id_laboratory_test }}" value="{{ $ValLabTest->id_laboratory_test }}"
                                                  @if($DataPageTwo['laboratory_test'] ?? null) 
                                                    @if(in_array($ValLabTest->id_laboratory_test, $DataPageTwo['laboratory_test']))
                                                      checked
                                                    @endif
                                                  @endif
                                                  >
                                                  <label class="custom-control-label" for="{{ $ValLabTest->id_laboratory_test }}">
                                                      <span class="switch-icon-left"><i class="bx bx-check"></i></span>
                                                      <span class="switch-icon-right"><i class="bx bx-check"></i></span>
                                                  </label>
                                              </div>
                                            </td>

                                          </tr>
                                          @php $nokk++ @endphp
                                          @endif
                                          @endforeach
                                        </tbody>
                                      </table>

                                      <table class="table table-bordered table-sm">
                                        {{-- Other test --}}
                                        <thead class="thead-dark">
                                          <tr>
                                            <th colspan="2" style="text-align: center; font-size: 13px;">Other Test</th>
                                          </tr>
                                        </thead>
                                        <thead>
                                          <tr>
                                            <th style="text-align:center;">Type</th>
                                            <th style="text-align:center;" nowrap>No/Normal - Yes/Abnormal</th>
                                          </tr>
                                        </thead>
                                        <tbody>
                                          @php $nokk = 1; 
                                          @endphp
                                          @foreach($LabTest as $keyLabTest => $ValLabTestOther)
                                          @if($ValLabTestOther->type_laboratory_test == 'other')
                                          <tr>
                                            <td style="padding-left:10px;">{{ $nokk }}. {{ $ValLabTestOther->name_laboratory_test }}</td>
                                            <td style=" text-align: center;">
                                              <div class="custom-control custom-switch custom-switch-success">
                                                  <input type="checkbox" class="custom-control-input" name="other_test[]" id="{{ $ValLabTestOther->id_laboratory_test }}" value="{{ $ValLabTestOther->id_laboratory_test }}"
                                                  @if($DataPageTwo['other_test'] ?? null) 
                                                    @if(in_array($ValLabTestOther->id_laboratory_test, $DataPageTwo['other_test']))
                                                      checked
                                                    @endif
                                                  @endif
                                                  >
                                                  <label class="custom-control-label" for="{{ $ValLabTestOther->id_laboratory_test }}">
                                                      <span class="switch-icon-left"><i class="bx bx-check"></i></span>
                                                      <span class="switch-icon-right"><i class="bx bx-check"></i></span>
                                                  </label>
                                              </div>
                                            </td>
                                          </tr>
                                          @php $nokk++ @endphp
                                          @endif
                                          @endforeach
                                        </tbody>
                                      </table>

                                      <table class="table table-bordered table-sm">
                                        {{-- Remark --}}
                                        <thead class="thead-dark">
                                          <tr>
                                            <th colspan="2" style="text-align: center; font-size: 13px;">Remark</th>
                                          </tr>
                                        </thead>
                                       
                                        <tbody>
                                         <tr>
                                           <td>
                                             <label for="remark_health_screening_page_dua">Remark <code>Page 2</code></label>
                                              <div class="position-relative has-icon-left">
                                                  <textarea class="form-control" id="remark_health_screening_page_dua" name="remark_health_screening_page_dua" placeholder="leave remark health screening" aria-label="remark">@if($DataPageTwo['remark_health_screening_page_dua'] ?? null) {{ $DataPageTwo['remark_health_screening_page_dua'] }} @endif</textarea>
                                                  <div class="form-control-position">
                                                    <i class='bx bxs-info-circle'></i>
                                                  </div>
                                              </div>
                                           </td>
                                         </tr>
                                        </tbody>
                                      </table>

                                      <table class="table table-bordered table-sm">
                                        {{-- Panel Doctor Decleration --}}
                                        <thead class="thead-dark">
                                          <tr>
                                            <th colspan="2" style="text-align: center; font-size: 13px;">Panel Doctor Declaration</th>
                                          </tr>
                                        </thead>
                                       
                                        <tbody>
                                         <tr>
                                           <td>
                                             <label for="panel_doctor_declaration">Panel Doctor Decleration</label>
                                              <div class="position-relative has-icon-left">
                                                  <textarea class="form-control" id="panel_doctor_declaration" name="panel_doctor_declaration" placeholder="leave panel doctor declaration" aria-label="panel_doctor_declaration">@if($DataPageTwo['panel_doctor_declaration'] ?? null) {{ $DataPageTwo['panel_doctor_declaration'] }} @endif</textarea>
                                                  <div class="form-control-position">
                                                    <i class='bx bxs-info-circle'></i>
                                                  </div>
                                              </div>
                                           </td>
                                         </tr>
                                        </tbody>
                                      </table>

                                      <table class="table table-bordered table-sm">
                                        {{-- Advice Health Screening Page 2 --}}
                                        <thead class="thead-dark">
                                          <tr>
                                            <th colspan="2" style="text-align: center; font-size: 13px;">Advice</th>
                                          </tr>
                                        </thead>
                                       
                                        <tbody>
                                         <tr>
                                           <td>
                                             <label for="advice_health_screening">Advice <code>Page 2</code></label>
                                              <div class="position-relative has-icon-left">
                                                  <textarea class="form-control" id="advice_health_screening" name="advice_health_screening" placeholder="leave advice health screening" aria-label="advice_health_screening">@if($DataPageTwo['advice_health_screening'] ?? null) {{ $DataPageTwo['advice_health_screening'] }} @endif</textarea>
                                                  <div class="form-control-position">
                                                    <i class='bx bxs-info-circle'></i>
                                                  </div>
                                              </div>
                                           </td>
                                         </tr>
                                        </tbody>
                                      </table>

                                  </td>
                                </tr>
                                <tr>
                                  <td style="width:50%; vertical-align: top;">
                                    <table class="table table-bordered table-sm">
                                        {{-- vision --}}
                                        <thead class="thead-dark">
                                          <tr>
                                            <th colspan="2" style="text-align: center; font-size: 13px;">Clinic Examination</th>
                                          </tr>
                                        </thead>
                                        <thead >
                                          <tr>
                                            <th style="text-align:center;">Type</th>
                                            <th style="text-align:center;" nowrap>No/Normal - Yes/Abnormal</th>
                                          </tr>
                                        </thead>
                                        <thead>
                                          <tr>
                                            <th colspan="2">1. Vision</th>
                                          </tr>
                                        </thead>
                                        <tbody>
                                          <tr>
                                            <td style="padding-left:10px;">a. Distant Vision</td>
                                            <td style=" text-align: center;">
                                              <div class="custom-control custom-switch custom-switch-success">
                                                  <input type="checkbox" class="custom-control-input" id="distant_vision" name="distant_vision" 
                                                  @if($DataPageTwo['distant_vision'] ?? null)
                                                    checked
                                                  @endif
                                                  >
                                                  <label class="custom-control-label" for="distant_vision">
                                                      <span class="switch-icon-left"><i class="bx bx-check"></i></span>
                                                      <span class="switch-icon-right"><i class="bx bx-check"></i></span>
                                                  </label>
                                              </div>
                                            </td>
                                          </tr>
                                          <tr>
                                            <td style="padding-left:10px;">b. Near Vision</td>
                                            <td style=" text-align: center;">
                                              <div class="custom-control custom-switch custom-switch-success">
                                                <input type="checkbox" class="custom-control-input" id="near_vision" name="near_vision"
                                                @if($DataPageTwo['near_vision'] ?? null)
                                                  checked
                                                @endif
                                                >
                                                <label class="custom-control-label" for="near_vision">
                                                    <span class="switch-icon-left"><i class="bx bx-check"></i></span>
                                                    <span class="switch-icon-right"><i class="bx bx-check"></i></span>
                                                </label>
                                              </div>
                                            </td>
                                          </tr>
                                          <tr>
                                            <td style="padding-left:10px;">c. Colour Vision</td>
                                            <td style=" text-align: center;">
                                              <div class="custom-control custom-switch custom-switch-success">
                                                <input type="checkbox" class="custom-control-input" id="colour_vision" name="colour_vision"
                                                @if($DataPageTwo['colour_vision'] ?? null)
                                                  checked
                                                @endif
                                                >
                                                <label class="custom-control-label" for="colour_vision">
                                                    <span class="switch-icon-left"><i class="bx bx-check"></i></span>
                                                    <span class="switch-icon-right"><i class="bx bx-check"></i></span>
                                                </label>
                                              </div>
                                            </td>
                                          </tr>
                                          <tr>
                                            <td style="padding-left:10px;">d. Any Organic Eye Disease</td>
                                            <td style=" text-align: center;">
                                              <div class="custom-control custom-switch custom-switch-success">
                                                <input type="checkbox" class="custom-control-input" id="any_organic_eye_disease" name="any_organic_eye_disease"
                                                @if($DataPageTwo['any_organic_eye_disease'] ?? null)
                                                  checked
                                                @endif
                                                >
                                                <label class="custom-control-label" for="any_organic_eye_disease">
                                                    <span class="switch-icon-left"><i class="bx bx-check"></i></span>
                                                    <span class="switch-icon-right"><i class="bx bx-check"></i></span>
                                                </label>
                                              </div>
                                            </td>
                                          </tr>
                                        </tbody>
                                        {{-- hearing --}}
                                        <thead>
                                          <tr>
                                            <th colspan="2">2. Hearing</th>
                                          </tr>
                                        </thead>
                                        <tbody>
                                          <tr>
                                            <td style="padding-left:10px; font-size:12px; text-align: left;">Unable to hear ordinary conversation at 2 m</td>
                                            <td style=" text-align: center;">
                                              <div class="custom-control custom-switch custom-switch-success">
                                                <input type="checkbox" class="custom-control-input" id="hearing" name="hearing"
                                                @if($DataPageTwo['hearing'] ?? null)
                                                  checked
                                                @endif
                                                >
                                                <label class="custom-control-label" for="hearing">
                                                    <span class="switch-icon-left"><i class="bx bx-check"></i></span>
                                                    <span class="switch-icon-right"><i class="bx bx-check"></i></span>
                                                </label>
                                              </div>
                                            </td>
                                          </tr>
                                        </tbody>

                                        {{-- cardiovascular system --}}
                                        <thead>
                                          <tr>
                                            <th colspan="2">3. Cardiovascular System</th>
                                          </tr>
                                        </thead>
                                        <tbody>
                                          <tr>
                                            <td style="padding-left:10px;">a. Blood Pressure</td>
                                            <td style=" text-align: center;">
                                              <div class="custom-control custom-switch custom-switch-success">
                                                <input type="checkbox" class="custom-control-input" id="blood_pressure" name="blood_pressure"
                                                @if($DataPageTwo['blood_pressure'] ?? null)
                                                  checked
                                                @endif
                                                >
                                                <label class="custom-control-label" for="blood_pressure">
                                                    <span class="switch-icon-left"><i class="bx bx-check"></i></span>
                                                    <span class="switch-icon-right"><i class="bx bx-check"></i></span>
                                                </label>
                                              </div>
                                            </td>
                                          </tr>
                                          <tr>
                                            <td style="padding-left:30px; font-size: 13px;">Systolic/Diastolic</td>
                                            <td style=" text-align: center;">
                                              <div class="input-group">
                                                <input class="form-control form-control-sm" name="systolic_diastolic" id="systolic_diastolic" type="text" placeholder="Input Systolic/Diastolic" 
                                                @if($DataPageTwo['systolic_diastolic'] ?? null)
                                                  value="{{ $DataPageTwo['systolic_diastolic'] }}" 
                                                @endif
                                                />
                                                <div class="input-group-append">
                                                    <span class="input-group-text form-control-sm">mmHg</span>
                                                </div>
                                              </div>
                                            </td>
                                          </tr>
                                          <tr>
                                            <td style="padding-left:30px; font-size: 13px;">Pulse</td>
                                            <td style=" text-align: center;">
                                              <div class="input-group">
                                                <input class="form-control form-control-sm" name="pulse" id="pulse" type="text" placeholder="Input Pulse" 
                                                @if($DataPageTwo['pulse'] ?? null)
                                                  value="{{ $DataPageTwo['pulse'] }}" 
                                                @endif
                                                />
                                                <div class="input-group-append">
                                                    <span class="input-group-text form-control-sm">x/minute</span>
                                                </div>
                                              </div>
                                            </td>
                                          </tr>
                                          <tr>
                                            <td style="padding-left:10px;">b. Heart Disease</td>
                                            <td style=" text-align: center;">
                                              <div class="custom-control custom-switch custom-switch-success">
                                                <input type="checkbox" class="custom-control-input" id="heart_disease" name="heart_disease"
                                                @if($DataPageTwo['heart_disease'] ?? null)
                                                  checked
                                                @endif
                                                >
                                                <label class="custom-control-label" for="heart_disease">
                                                    <span class="switch-icon-left"><i class="bx bx-check"></i></span>
                                                    <span class="switch-icon-right"><i class="bx bx-check"></i></span>
                                                </label>
                                              </div>
                                            </td>
                                          </tr>
                                          <tr>
                                            <td style="padding-left:10px;">c. Varicose Veins</td>
                                            <td style=" text-align: center;">
                                              <div class="custom-control custom-switch custom-switch-success">
                                                <input type="checkbox" class="custom-control-input" id="varicose_veins" name="varicose_veins"
                                                @if($DataPageTwo['varicose_veins'] ?? null)
                                                  checked
                                                @endif
                                                >
                                                <label class="custom-control-label" for="varicose_veins">
                                                    <span class="switch-icon-left"><i class="bx bx-check"></i></span>
                                                    <span class="switch-icon-right"><i class="bx bx-check"></i></span>
                                                </label>
                                              </div>
                                            </td>
                                          </tr>
                                        </tbody>

                                      </table>

                                      <table class="table table-bordered table-sm">
                                        <thead class="thead-dark">
                                          <tr>
                                            <th style="text-align:center;">Type</th>
                                            <th style="text-align:center;" nowrap>No/Normal - Yes/Abnormal</th>
                                          </tr>
                                        </thead>
                                        <thead>
                                          <tr>
                                            <th colspan="2">Respiratory System</th>
                                          </tr>
                                        </thead>
                                        <tbody>
                                          <tr>
                                            <td style="padding-left:10px;">Respiratory System</td>
                                            <td style=" text-align: center;">
                                              <div class="custom-control custom-switch custom-switch-success">
                                                  <input type="checkbox" class="custom-control-input" id="respiratory_system" name="respiratory_system"
                                                  @if($DataPageTwo['respiratory_system'] ?? null)
                                                    checked
                                                  @endif
                                                  >
                                                  <label class="custom-control-label" for="respiratory_system">
                                                      <span class="switch-icon-left"><i class="bx bx-check"></i></span>
                                                      <span class="switch-icon-right"><i class="bx bx-check"></i></span>
                                                  </label>
                                              </div>
                                            </td>
                                          </tr>
                                        </tbody>
                                        <thead>
                                          <tr>
                                            <th colspan="2">Skin-Chronic</th>
                                          </tr>
                                        </thead>
                                        <tbody>
                                          <tr>
                                            <td style="padding-left:10px;">Skin-Chronic</td>
                                            <td style=" text-align: center;">
                                              <div class="custom-control custom-switch custom-switch-success">
                                                  <input type="checkbox" class="custom-control-input" id="skin_chronic" name="skin_chronic"
                                                  @if($DataPageTwo['skin_chronic'] ?? null)
                                                    checked
                                                  @endif
                                                  >
                                                  <label class="custom-control-label" for="skin_chronic">
                                                      <span class="switch-icon-left"><i class="bx bx-check"></i></span>
                                                      <span class="switch-icon-right"><i class="bx bx-check"></i></span>
                                                  </label>
                                              </div>
                                            </td>
                                          </tr>
                                        </tbody>
                                        <thead>
                                          <tr>
                                            <th colspan="2">Abdomen</th>
                                          </tr>
                                        </thead>
                                        <tbody>
                                          <tr>
                                            <td style="padding-left:10px;">Abdomen</td>
                                            <td style=" text-align: center;">
                                              <div class="custom-control custom-switch custom-switch-success">
                                                  <input type="checkbox" class="custom-control-input" id="abdomen" name="abdomen"
                                                  @if($DataPageTwo['abdomen'] ?? null)
                                                    checked
                                                  @endif
                                                  >
                                                  <label class="custom-control-label" for="abdomen">
                                                      <span class="switch-icon-left"><i class="bx bx-check"></i></span>
                                                      <span class="switch-icon-right"><i class="bx bx-check"></i></span>
                                                  </label>
                                              </div>
                                            </td>
                                          </tr>
                                        </tbody>
                                        <thead>
                                          <tr>
                                            <th colspan="2">Locomotor/Neurogical</th>
                                          </tr>
                                        </thead>
                                        <tbody>
                                          <tr>
                                            <td style="padding-left:10px;">Locomotor/Neurogical</td>
                                            <td style=" text-align: center;">
                                              <div class="custom-control custom-switch custom-switch-success">
                                                  <input type="checkbox" class="custom-control-input" id="locomotor/neurogical" name="locomotor_neurogical"
                                                  @if($DataPageTwo['locomotor_neurogical'] ?? null)
                                                    checked
                                                  @endif
                                                  > 
                                                  <label class="custom-control-label" for="locomotor/neurogical">
                                                      <span class="switch-icon-left"><i class="bx bx-check"></i></span>
                                                      <span class="switch-icon-right"><i class="bx bx-check"></i></span>
                                                  </label>
                                              </div>
                                            </td>
                                          </tr>
                                        </tbody>
                                        <thead>
                                          <tr>
                                            <th colspan="2">Endocrine disorders</th>
                                          </tr>
                                        </thead>
                                        <tbody>
                                          <tr>
                                            <td style="padding-left:10px;">Endocrine disorders</td>
                                            <td style=" text-align: center;">
                                              <div class="custom-control custom-switch custom-switch-success">
                                                  <input type="checkbox" class="custom-control-input" id="endocrine_disorders" name="endocrine_disorders"
                                                  @if($DataPageTwo['endocrine_disorders'] ?? null)
                                                    checked
                                                  @endif
                                                  >
                                                  <label class="custom-control-label" for="endocrine_disorders">
                                                      <span class="switch-icon-left"><i class="bx bx-check"></i></span>
                                                      <span class="switch-icon-right"><i class="bx bx-check"></i></span>
                                                  </label>
                                              </div>
                                            </td>
                                          </tr>
                                        </tbody>
                                        <thead>
                                          <tr>
                                            <th colspan="2">Mental State</th>
                                          </tr>
                                        </thead>
                                        <tbody>
                                          <tr>
                                            <td style="padding-left:10px;">Mental State</td>
                                            <td style=" text-align: center;">
                                              <div class="custom-control custom-switch custom-switch-success">
                                                  <input type="checkbox" class="custom-control-input" id="mental_state" name="mental_state"
                                                  @if($DataPageTwo['mental_state'] ?? null)
                                                    checked
                                                  @endif
                                                  >
                                                  <label class="custom-control-label" for="mental_state">
                                                      <span class="switch-icon-left"><i class="bx bx-check"></i></span>
                                                      <span class="switch-icon-right"><i class="bx bx-check"></i></span>
                                                  </label>
                                              </div>
                                            </td>
                                          </tr>
                                        </tbody>
                                      </table>

                                  </td>
                                 
                                </tr>
                              </tbody>
                            </table>
                          </div>
                          
                      </div>

                    </div>

                    <button type="submit" class="btn btn-info PrintSatu glow shadow"><i class='bx bx-cloud-upload HaveChangeDua'></i> Update</button>
                    <a target="_blank" class="btn btn-primary glow shadow" href="{{ route('PrintReassessmentHealth',['id_regis' => $id_res_encrypt,'type' => 'screening_dua'])}}"><i class='bx bx-printer'></i> Print</a>
                  </form>
                  </div>

                  {{-- HEALTH SCREENING REPORT PAGE 3 --}}
                  <div class="tab-pane about-tab" id="about" aria-labelledby="about-tab" role="tabpanel">

                    <form id="UpdateScreeningTiga" data-route="{{ route('UpdateScreening',['id_regis' => $id_res_encrypt, 'type' => 'screening_tiga']) }}" role="form" method="POST" accept-charset="utf-8">
                      <div class="form-body">

                        <label for="remark_page_tiga">Remark Health Screening Report<code>Page 3</code></label>
                        <div class="position-relative has-icon-left mb-1">
                            <textarea class="form-control" id="remark_health_screening_page_tiga" name="remark_health_screening_page_tiga" placeholder="Describe Abnormalities" aria-label="remark_health_screening_page_tiga">@if($DataPageThree['remark_health_screening_page_tiga'] ?? null) {{ $DataPageThree['remark_health_screening_page_tiga'] }} @endif</textarea>
                            <div class="form-control-position">
                              <i class='bx bxs-info-circle'></i>
                            </div>
                        </div>

                        <table class="table table-bordered table-sm">
                          {{-- physical examination --}}
                          <thead class="thead-dark">
                            <tr>
                              <th colspan="4" style="text-align: center; font-size: 13px;">Physical Examination</th>
                            </tr>
                          </thead>
                          <thead>
                            <tr>
                              <th style="text-align:center;">No</th>
                              <th style="text-align:center;">Type</th>
                              <th style="text-align:center;" nowrap>No/Normal - Yes/Abnormal</th>
                              <th style="text-align:center;">Describe Abnormalities in detail</th>
                            </tr>
                          </thead>
                          <tbody>
                            @php 
                            $phyc = 1;
                            @endphp
                            @foreach($PhysExam as $keyPhysExam => $ValPhysExam)
                            <tr>
                              <td style="text-align:center; width: 5px;">{{ $phyc }}</td>
                              <td style="padding-left:10px;">{{ $ValPhysExam->name_physical }}</td>
                              <td style=" text-align: center;">
                                 @php $Valdescribe_abnormalities = null; @endphp
                                 @if($DataPageThree['describe_abnormalities'] ?? null) 
                                    @if($DataPageThree['physical_examination'] ?? null) 
                                        @if(in_array($ValPhysExam->id_physical, $DataPageThree['physical_examination']))
                                          @php $Valdescribe_abnormalities = $DataPageThree['describe_abnormalities'][$ValPhysExam->id_physical] @endphp
                                        @else
                                          @php $Valdescribe_abnormalities = null; @endphp
                                        @endif
                                    @endif
                                  @endif
                                <div class="custom-control custom-switch custom-switch-success">
                                    <input type="checkbox" class="custom-control-input CheckPhysicExam" data_idphysc="{{ $ValPhysExam->id_physical }}" name="physical_examination[]" id="phyc{{ $ValPhysExam->id_physical }}" value="{{ $ValPhysExam->id_physical }}"
                                    @if($DataPageThree['physical_examination'] ?? null) 
                                      @if(in_array($ValPhysExam->id_physical, $DataPageThree['physical_examination']))
                                        checked
                                      @endif
                                    @endif
                                    >
                                    <label class="custom-control-label" for="phyc{{ $ValPhysExam->id_physical }}">
                                        <span class="switch-icon-left"><i class="bx bx-check"></i></span>
                                        <span class="switch-icon-right"><i class="bx bx-check"></i></span>
                                    </label>
                                </div>
                              </td>
                              <td style=" text-align: center;">
                                <div class="position-relative has-icon-left">
                                    <textarea class="form-control" id="fdescribe_abnormalities{{ $ValPhysExam->id_physical }}" name="describe_abnormalities[{{ $ValPhysExam->id_physical }}]" placeholder="Describe {{ $ValPhysExam->name_physical }}" aria-label="describe_abnormalities" @if(!$Valdescribe_abnormalities) disabled @endif>{{ $Valdescribe_abnormalities }}</textarea>
                                    <div class="form-control-position">
                                      <i class='bx bxs-info-circle'></i>
                                    </div>
                                </div>
                              </td>

                            </tr>
                            @php $phyc++ @endphp
                            @endforeach
                          </tbody>
                        </table>
                      </div>
                      <button type="submit" class="btn btn-info PrintSatu glow shadow"><i class='bx bx-cloud-upload HaveChangeTiga'></i> Update</button>
                      <a target="_blank" class="btn btn-primary glow shadow" href="{{ route('PrintReassessmentHealth',['id_regis' => $id_res_encrypt,'type' => 'screening_tiga'])}}"><i class='bx bx-printer'></i> Print</a>
                    </form>

                  </div>
              </div>
				    </div>
		   	</div>
		  {{-- endform --}}
		  <hr>
      <div class="col-12 d-flex justify-content-end p-0 m-0">
        <div class="shadow-lg p-1 bg-white rounded">
            <a href="{{ route('ViewLaboratorium') }}"><button type="button" class="btn btn-warning mr-1"><i class='bx bx-arrow-back' ></i> Back</button></a>
            <a target="_blank" class="btn btn-outline-primary mr-0" href="{{ route('PrintReassessmentHealth',['id_regis' => $id_res_encrypt,'type' => 'screening_all'])}}"><i class='bx bx-printer'></i> Print All Report Screening</a>
        </div>
      </div>
      {{-- </form> --}}
      </div>
    </div>
  </div>
</section>
<!-- add result laboratorium -->
@else
<div class="col-xl-7 col-md-8 col-12">
    <div class="card bg-transparent shadow-none">
      <div class="card-body text-center">
        <img src="{{asset('images/pages/not-authorized.png')}}" class="img-fluid" alt="not authorized" width="400">
        <h1 class="my-2 error-title">You are not authorized!</h1>
        <p>
            You do not have permission to view this directory or page using
            the credentials that you supplied.
        </p>
        <a href="{{asset('/')}}" class="btn btn-primary round glow mt-2">BACK TO MAIN DASHBOARD</a>
      </div>
    </div>
</div>
@endif

@php
if($DataPageTwo['medical_history'] ?? null){
  $varMedHis = json_encode(array_values($DataPageTwo['medical_history']));//hanya ambil value, tidak beserta key
}else{
  $varMedHis = '[]';//set empty array if nil
}
@endphp

@endsection


{{-- vendor scripts --}}
@section('vendor-scripts')
<script src="{{asset('vendors/js/tables/datatable/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('vendors/js/tables/datatable/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('vendors/js/tables/datatable/dataTables.buttons.min.js')}}"></script>
<script src="{{asset('vendors/js/tables/datatable/buttons.bootstrap4.min.js')}}"></script>
<script src="{{asset('vendors/js/forms/select/select2.full.min.js') }}"></script>
@endsection

{{-- page scripts --}}
@section('page-scripts')

<script type="text/javascript">

//top end notif
const ToastToB = Swal.mixin({
	toast: true,
	position: 'top-end',
	showConfirmButton: false,
	timer: 3000,
	timerProgressBar: true,
didOpen: (toast) => {
		toast.addEventListener('mouseenter', Swal.stopTimer)
		toast.addEventListener('mouseleave', Swal.resumeTimer)
	}
})

var varMedHiss = "{{ $varMedHis }}";

// Basic Select2 select
$(".select2MedicalHistory").select2({
  dropdownAutoWidth: true,
  placeholder: "Select Medical History",
  allowClear: true,
  width: '100%'
});
$('.select2MedicalHistory').val(JSON.parse(varMedHiss.replace(/&quot;/g,'"'))).change();

jQuery(document).ready(function($){
  $('.CheckPhysicExam').on('click',function(){
    var valId = $(this).attr("data_idphysc");
    if(this.checked) {
      $('#fdescribe_abnormalities'+valId+'').prop("disabled", false);
    }else {
      $('#fdescribe_abnormalities'+valId+'').prop("disabled", true);
    }
  });
});

/*---------------------update screening report------------------------*/
$(document).on('submit', '#UpdateScreeningSatu', function(e) {
  varTargetID = event.target.id;
  e.preventDefault();
  var form_data = $(this);
  ActionPostScreening(e, varTargetID, form_data);
});
$(document).on('submit', '#UpdateScreeningDua', function(e) {
  varTargetID = event.target.id;
  e.preventDefault();
  var form_data = $(this);
  ActionPostScreening(e, varTargetID, form_data);
});
$(document).on('submit', '#UpdateScreeningTiga', function(e) {
  varTargetID = event.target.id;
  e.preventDefault();
  var form_data = $(this);
  ActionPostScreening(e, varTargetID, form_data);
});

function ActionPostScreening(e, TargetID, form_data){
  e.preventDefault();
    var route = $('#'+TargetID).data('route');
    $.ajaxSetup({headers:{'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')}});
    Pace.track(function(){
      Pace.restart();
      $.ajax({
          type: 'POST',
          url: route,
          data: form_data.serialize(),
          beforeSend: function() {
            $('.PrintSatu').prop('disabled', true);
          },
          success: function(data) {
            switch (data.code) {
              case "1":
                ToastToB.fire({icon: 'error',title: data.fail});
              break;
              case "2":
                ToastToB.fire({icon: 'success',title: 'Succes update Reassessment Health Report'});
              break;
              case "3":
                ToastToB.fire({icon: 'error',title: 'Update Screening Failed'});
              break;
              default:
              break;
            }
           },
          complete: function() {
            $('.PrintSatu').prop('disabled', false);
          },
          error: function(data,xhr) {
            alert("Failed response")
          },
      });
  });
}

//--------------- setingan active tab--------------------//
$(document).ready(function() {
  // Get saved data from sessionStorage
  let selectedCollapse = sessionStorage.getItem('selectedCollapse');
  if(selectedCollapse != null) {
    $('.accordion .collapse .nav-link .tab-pane').removeClass('active');
    $("#"+selectedCollapse).addClass('active');
    $("."+selectedCollapse).addClass('active');
  }
  //To set, which one will be opened
  $(document).on("click", ".ChangeTab", function () {
    let target = $(this).attr('tujuan');
    //Save data to sessionStorage
    sessionStorage.setItem('selectedCollapse', target);
  });
});

</script>
<style type="text/css">
.select2-search--inline {
    display: contents; /*this will make the container disappear, making the child the one who sets the width of the element*/
}

.select2-search__field:placeholder-shown {
    width: 100% !important; /*makes the placeholder to be 100% of the width while there are no options selected*/
}
</style>
@endsection
