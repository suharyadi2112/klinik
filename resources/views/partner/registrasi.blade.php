@extends('layouts.contentLayoutMaster')
{{-- title --}}
@section('title','Partner')

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

@if(auth()->user()->can('create partner')/* && $some_other_condition*/)
<section id="description" class="card">
    <div class="card-header">
        <h4 class="card-title">Dashboard Add Partner</h4>
    </div>
    <div class="card-body">
        <form id="InsertPartner" data-route="{{ route('InsertPartner') }}" role="form" method="POST" accept-charset="utf-8">
          <div class="form-body">
              <div class="row">
                  
                  <div class="col-md-6 col-12 pdg">
                    <label>Partner Name</label>
                      <div class="position-relative">
                          <input type="text" name="nama" class="form-control" placeholder="Partner Name">
                      </div>
                  </div>

                  <div class="col-md-6 col-12 pdg">
                    <label>Partner Address</label>
                      <div class="position-relative">
                          <input type="text" name="alamat" class="form-control" placeholder="Partner Address">
                      </div>
                  </div>

                  <div class="col-md-6 col-12 pdg">
                    <label>Partner Phone</label>
                      <div class="position-relative">
                          <input type="number" name="nohp" class="form-control" placeholder="Partner Phone">
                      </div>
                  </div>

                  <div class="col-md-6 col-12 pdg">
                    <label>Contact Person</label>
                      <div class="position-relative">
                          <input type="text" name="cp" class="form-control" placeholder="Contact Person">
                      </div>
                  </div>

                  <div class="col-md-6 col-12 pdg">
                    <label>Contact Person Number</label>
                      <div class="position-relative">
                          <input type="number" name="cpm" class="form-control" placeholder="Contact Person Number">
                      </div>
                  </div>

                  <div class="col-md-6 col-12 pdg">
                    <label>First Email</label>
                      <div class="position-relative">
                          <input type="email" name="fe" class="form-control" placeholder="First Email">
                      </div>
                  </div>

                  <div class="col-md-6 col-12 pdg">
                    <label>Second Email</label>
                      <div class="position-relative">
                          <input type="email" name="se" class="form-control" placeholder="Second Email">
                      </div>
                  </div>

                  <div class="col-md-6 col-12 pdg">
                    <label>Partner Category</label>
                      <div class="position-relative">
                          <select class="form-control" id="kategori" name="kategori">
                            <option value="">Partner Category</option>
                              @forelse($kategoripa as $key => $valkat)
                                <option value="{{ $valkat->katpengirimid }}">{{ $valkat->katpengirimnama   }}</option>
                              @empty
                                <option value="">Data not found</option>
                              @endforelse
                          </select>
                      </div>
                  </div>

                  <div class="col-md-6 col-12 pdg">
                    <label>MOU Date</label>
                      <div class="position-relative">
                          <input type="date" name="moud" class="form-control" placeholder="MOU Date">
                      </div>
                  </div>

                  <div class="col-md-6 col-12 pdg">
                    <label>MOU Expired Date</label>
                      <div class="position-relative">
                          <input type="date" name="moudx" class="form-control" placeholder="MOU Expired Date">
                      </div>
                  </div>
              
                  <div class="col-12 d-flex justify-content-end">
                      <a href="{{ route('ShowPartner') }}"><button type="button" class="btn btn-warning mr-1"><i class='bx bx-arrow-back' ></i> Back</button></a>
                      <button type="submit" class="btn btn-outline-primary mr-1 btn_insert_partner"><i class='bx bx-plus-circle' ></i> Submit</button>
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

  /*---------------------post insert partner------------------------*/
  $(document).on('submit', '#InsertPartner', function(e) {
      e.preventDefault();
      var route = $('#InsertPartner').data('route');
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
                  ToastToB.fire({icon: 'success',title: 'Insert Partner Success, page will redirect to Partner Dashboard'})
                  setInterval(function () {window.location.href = "{{ route('ShowPartner')}}";}, 3000);
                break;
                case "3":
                  ToastToB.fire({icon: 'error',title: 'Insert Partner Failed'})
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