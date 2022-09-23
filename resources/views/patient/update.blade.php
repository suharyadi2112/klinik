@extends('layouts.contentLayoutMaster')
{{-- title --}}
@section('title','Patient')

{{-- vendor styles --}}
@section('vendor-styles')
<link rel="stylesheet" type="text/css" href="{{asset('vendors/css/ui/prism.min.css')}}">  
<link rel="stylesheet" type="text/css" href="{{asset('vendors/css/tables/datatable/dataTables.bootstrap4.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('vendors/css/tables/datatable/responsive.bootstrap4.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('vendors/css/forms/select/select2.min.css')}}">

{{-- sweetalert2 --}}
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<style type="text/css">
  .pdg {
    padding-bottom: 15px;
  }
</style>

@endsection

@section('content')

@if(auth()->user()->can('view action_main')/* && $some_other_condition*/)
<section id="description" class="card">
    <div class="card-header">
        <h4 class="card-title">Dashboard Update Patient</h4>
    </div>
    <div class="card-body">
        <form id="UpdatePatient" data-route="{{ route('UpdatePatient') }}" role="form" method="POST" accept-charset="utf-8">
          <div class="form-body">
              <div class="row">
                  <input type="hidden" name="id" value="{{ $ct->pasid }}">  
                  <div class="col-md-6 col-12 pdg">
                    <label>Identity</label>
                      <div class="position-relative">
                          <select class="form-control" id="identitas" name="identitas">
                            <option value="">Identity Type</option>
                              @forelse($identity as $key => $valkid)
                                <option value="{{ $valkid->jenis }}" {{($valkid->jenis == $ct->pasidentitas) ? 'selected' : '' }}>{{ $valkid->jenis   }}</option>
                              @empty
                                <option value="">Data not found</option>
                              @endforelse
                          </select>
                      </div>
                  </div>

                  <div class="col-md-6 col-12 pdg">
                    <label>Identity ID</label>
                      <div class="position-relative">
                          <input type="text" name="identitas_id" class="form-control" placeholder="Patient Identity ID" value="{{ $ct->pasnik }}">
                      </div>
                  </div>

                  <div class="col-md-6 col-12 pdg">
                    <label>Name</label>
                      <div class="position-relative">
                          <input type="text" name="nama" class="form-control" placeholder="Patient Name" value="{{ $ct->pasnama }}">
                      </div>
                  </div>

                  <div class="col-md-6 col-12 pdg">
                    <label>Place Of Birth</label>
                      <div class="position-relative">
                          <input type="text" name="tempat_lahir" class="form-control" placeholder="Patient Place Of Birth" value="{{ $ct->pastempatlahir }}">
                      </div>
                  </div>

                  <div class="col-md-6 col-12 pdg">
                    <label>Date Of Birth</label>
                      <div class="position-relative">
                          <input type="date" name="tgl_lahir" class="form-control" placeholder="Patient Date Of Birth" value="{{ $ct->pastgllahir }}">
                      </div>
                  </div>

                  <div class="col-md-6 col-12 pdg">
                    <label>Age</label>
                      <div class="position-relative">
                          <input type="text" name="umur" id="umur" class="form-control" placeholder="Patient Age" readonly value="{{ $ct->pasumur }}">
                      </div>
                  </div>

                  <div class="col-md-6 col-12 pdg">
                    <label>Gender</label>
                      <div class="position-relative">
                          <select class="form-control" id="gender" name="gender">
                            <option value="">Gender</option>
                              @forelse($gender as $key => $valgen)
                                <option value="{{ $valgen->gender }}" {{($valgen->gender == $ct->pasjk) ? 'selected' : '' }}>{{ $valgen->gender }}</option>
                              @empty
                                <option value="">Data not found</option>
                              @endforelse
                          </select>
                      </div>
                  </div>

                  <div class="col-md-6 col-12 pdg">
                    <label>Blood Group</label>
                      <div class="position-relative">
                          <select class="form-control" id="gol_dar" name="gol_dar">
                            <option value="">Blood Group</option>
                              @forelse($blood as $key => $valblood)
                                <option value="{{ $valblood->goldar }}" {{($valblood->goldar == $ct->pasgol) ? 'selected' : '' }}>{{ $valblood->goldar }}</option>
                              @empty
                                <option value="">Data not found</option>
                              @endforelse
                          </select>
                      </div>
                  </div>

                  <div class="col-md-6 col-12 pdg">
                    <label>Address</label>
                      <div class="position-relative">
                          <input type="text" name="alamat" class="form-control" placeholder="Patient Address" value="{{ $ct->pasalamat }}">
                      </div>
                  </div>

                  <div class="col-md-6 col-12 pdg">
                    <label>RT</label>
                      <div class="position-relative">
                          <input type="text" name="rt" class="form-control" placeholder="Patient RT" value="{{ $ct->pasrt }}">
                      </div>
                  </div>

                  <div class="col-md-6 col-12 pdg">
                    <label>RW</label>
                      <div class="position-relative">
                          <input type="text" name="rw" class="form-control" placeholder="Patient RW" value="{{ $ct->pasrw }}">
                      </div>
                  </div>

                  <div class="col-md-6 col-12 pdg">
                    <label>Village (Kelurahan)</label>
                      <div class="position-relative">
                          <input type="text" name="kel" class="form-control" placeholder="Patient Village" value="{{ $ct->paskel }}">
                      </div>
                  </div>

                  <div class="col-md-6 col-12 pdg">
                    <label>District (Kecamatan)</label>
                      <div class="position-relative">
                          <input type="text" name="kec" class="form-control" placeholder="Patient District" value="{{ $ct->paskec }}">
                      </div>
                  </div>

                  <div class="col-md-6 col-12 pdg">
                    <label>Religion</label>
                      <div class="position-relative">
                          <select class="form-control" id="agama" name="agama">
                            <option value="">Religion</option>
                              @forelse($religion as $key => $valrel)
                                <option value="{{ $valrel->agama }}" {{($valrel->agama == $ct->pasagama) ? 'selected' : '' }}>{{ $valrel->agama }}</option>
                              @empty
                                <option value="">Data not found</option>
                              @endforelse
                          </select>
                      </div>
                  </div>

                  <div class="col-md-6 col-12 pdg">
                    <label>Marital Status</label>
                      <div class="position-relative">
                          <select class="form-control" id="status" name="status">
                            <option value="">Marital Status</option>
                              @forelse($status as $key => $valst)
                                <option value="{{ $valst->status }}" {{($valst->status == $ct->passtatus) ? 'selected' : '' }}>{{ $valst->status }}</option>
                              @empty
                                <option value="">Data not found</option>
                              @endforelse
                          </select>
                      </div>
                  </div>

                  <div class="col-md-6 col-12 pdg">
                    <label>Occupation</label>
                      <div class="position-relative">
                          <select class="form-control" id="pekerjaan" name="pekerjaan">
                            <option value="">Occupation</option>
                              @forelse($job as $key => $valjob)
                                <option value="{{ $valjob->pekerjaan }}" {{($valjob->pekerjaan == $ct->paspekerjaan) ? 'selected' : '' }}>{{ $valjob->pekerjaan }}</option>
                              @empty
                                <option value="">Data not found</option>
                              @endforelse
                          </select>
                      </div>
                  </div>

                  <div class="col-md-6 col-12 pdg">
                    <label>Nationality</label>
                      <div class="position-relative">
                          <select class="form-control" id="kwn" name="kwn">
                            <option value="">Nationality</option>
                              @forelse($kwn as $key => $valkwn)
                                <option value="{{ $valkwn->kwn }}" {{($valkwn->kwn == $ct->pasnegara) ? 'selected' : '' }}>{{ $valkwn->kwn }}</option>
                              @empty
                                <option value="">Data not found</option>
                              @endforelse
                          </select>
                      </div>
                  </div>

                  <div class="col-md-6 col-12 pdg">
                    <label>Phone</label>
                      <div class="position-relative">
                          <input type="text" name="no_hp" class="form-control" placeholder="Patient Phone" value="{{ $ct->pastlp }}">
                      </div>
                  </div>

                  <div class="col-md-6 col-12 pdg">
                    <label>Email</label>
                      <div class="position-relative">
                          <input type="email" name="email" class="form-control" placeholder="Patient Email" value="{{ $ct->pasemail }}">
                      </div>
                  </div>
              
                  <div class="col-12 d-flex justify-content-end">
                      <a href="{{ route('ShowPartner') }}"><button type="button" class="btn btn-warning mr-1"><i class='bx bx-arrow-back' ></i> Back</button></a>
                      <button type="submit" class="btn btn-outline-primary mr-1 btn_insert_partner"><i class='bx bx-plus-circle' ></i> Update</button>
                  </div>
              </div>
          </div>
        </form>
    </div>
</section>
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
<!--/ Description -->

<!--/ HTML Markup -->
@endsection

{{-- vendor scripts --}}
@section('vendor-scripts')
<script src="{{asset('vendors/js/forms/select/select2.full.min.js') }}"></script>
<script type="text/javascript">

  function setAge(e){
      var bday = new Date(Date.parse(e.target.value));
      var today = new Date()
      
      document.getElementsByName('umur')[0].value = today.getFullYear() - bday.getFullYear();
  }  
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

  /*---------------------post insert patient------------------------*/
  $(document).on('submit', '#UpdatePatient', function(e) {
      e.preventDefault();
      var route = $('#UpdatePatient').data('route');
      var form_data = $(this);
      $.ajaxSetup({headers:{'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')}});
      Pace.track(function(){
        $.ajax({
            type: 'POST',
            url: route,
            data: form_data.serialize(),
            beforeSend: function() {
              // $('.btn_insert_partner').prop('disabled', true);
            },
            success: function(data) {
              switch (data.code) {
                case "1":
                  ToastToB.fire({icon: 'error',title: data.fail})
                break;
                case "2":
                  ToastToB.fire({icon: 'success',title: 'Update Patient Success, page will redirect to Patient Dashboard'})
                  setInterval(function () {window.location.href = "{{ route('ShowPatient')}}";}, 3000);
                break;
                case "3":
                  ToastToB.fire({icon: 'error',title: 'Update Patient Failed'})
                break;
                default:
                break;
              }
             },
            error: function(data,xhr) {
              alert("Failed response")
            },
        });
    });
  });
</script>

@endsection