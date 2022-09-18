@extends('layouts.contentLayoutMaster')
{{-- title --}}
@section('title','Action')

{{-- vendor styles --}}
@section('vendor-styles')
<link rel="stylesheet" type="text/css" href="{{asset('vendors/css/ui/prism.min.css')}}">  
<link rel="stylesheet" type="text/css" href="{{asset('vendors/css/tables/datatable/dataTables.bootstrap4.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('vendors/css/tables/datatable/responsive.bootstrap4.min.css')}}">

{{-- sweetalert2 --}}
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
 

@endsection

@section('content')

<section id="description" class="card">
    <div class="card-header">
        <h4 class="card-title">Dashboard Action</h4>
    </div>
    <div class="card-body">
        <div class="card-text">
        {{-- batas table --}}
        <div class="table-responsive">
            <button type="button" class="btn btn-primary round addc"><i class="bx bx-plus-circle"></i> 
              Create Action
            </button>
            <table class="table yajra-datatable table-inverse table-hover" width="100%">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Category Action ID</th>
                  <th>Name</th>
                  <th>Unit</th>
                  <th>Value</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
              </tbody>
            </table>
        </div>
        {{-- batas table --}}
        </div>
    </div>
</section>
<!--/ Description -->

<!--/ HTML Markup -->
@endsection

{{-- vendor scripts --}}
@section('vendor-scripts')
<script src="{{asset('vendors/js/ui/prism.min.js')}}"></script> 
<script src="{{asset('vendors/js/tables/datatable/jquery.dataTables.min.js') }}"></script>
<script src="{{asset('vendors/js/tables/datatable/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{asset('vendors/js/tables/datatable/dataTables.responsive.min.js') }}"></script>

<div class="modal fade" id="ModalInsertC" data-keyboard="false" data-backdrop="static">  
  <div class="modal-dialog ">
    <div class="modal-content" id="modal-content">
      <div class="row">
        <div class="col-lg-12">
          <div class="modal-header bg-info p-2">
            <h5 class="modal-title white" id="staticBackdropLabel">Insert Action</h5> 
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"> 
              <span aria-hidden="true">&times;</span> 
            </button>
          </div>
          <form id="FormInsertC" data-route="{{ route('PostC') }}" role="form" method="POST" accept-charset="utf-8">
          <div class="modal-body" >

              <div class="form-group">
                  <label for="select-country">Category Action</label>
                  <select class="form-control" id="action" name="action">
                    <option value="">Select Category</option>
                      @forelse($tindakan as $key => $valtindakan)
                        <option value="{{ $valtindakan->tndid }}">{{ $valtindakan->tndnama }}</option>
                      @empty
                        <option value="">Data not found</option>
                      @endforelse
                  </select>
              </div>

              <div class="form-group">
                  <label class="form-label" for="basic-default-name">Name</label>
                  <input type="text" class="form-control" id="basic-default-name" name="nama" placeholder="Name" />
              </div>
  
              <div class="form-group">
                  <label class="form-label" for="basic-default-unit">Unit</label>
                  <input type="text" class="form-control" id="basic-default-unit" name="unit" placeholder="Unit" />
              </div>    
              <div class="form-group">
                  <label class="form-label" for="basic-default-value">Value</label>
                  <input type="text" class="form-control" id="basic-default-value" name="value" placeholder="value" />
              </div>   
                        
          </div>
          <div class="modal-footer">
              <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Cancel</button>
              <button type="submit" class="insertca btn btn-primary"><i class='bx bx-upload' ></i> Insert</button>
          </div>

          </form>
          {{-- tutup form --}}
        </div>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="ModalUpdateC" data-keyboard="false" data-backdrop="static">  
  <div class="modal-dialog">
    <div class="modal-content" id="modal-content">
      <div class="row">
        <div class="col-lg-12">
          <div class="modal-header bg-primary p-2">
            <h5 class="modal-title white" id="staticBackdropLabel">Update Action</h5> 
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"> 
              <span aria-hidden="true">&times;</span> 
            </button>
          </div>
          <form id="FormUpdateC" data-route="{{ route('UpdateC') }}" role="form" method="POST" accept-charset="utf-8">    
            {{-- render modal --}}
            <div id="RenderFormUpdateC"></div>

            <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="updateus btn btn-primary"><i class='bx bx-pencil' ></i> Update</button>
                </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">

   //top end notif
  const Toast = Swal.mixin({
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

    /*---------------------insert action------------------------*/
  $(document).on("click", ".addc", function () {
    $("#ModalInsertC").modal("show");
  });

  $(document).on('submit', '#FormInsertC', function(e) {
    e.preventDefault();
    var route = $('#FormInsertC').data('route');
    var form_data = $(this);
    $.ajaxSetup({headers:{'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')}});
    $.ajax({
        type: 'POST',
        url: route,
        data: form_data.serialize(),
        beforeSend: function() {
          $('.insertca').prop('disabled', true);
        },
        success: function(data) {
        switch (data.code) {
                case "1":
          Toast.fire({
            icon: 'error',
            title: data.fail
          })
        break;
        case "2":
          Toast.fire({
            icon: 'success',
            title: 'Insert Success'
          })
        break;
                default:
                break;
        }
        },
        complete: function() {
            $('.yajra-datatable').DataTable().ajax.reload();
            $('.insertca').prop('disabled', false);
            $("#ModalInsertC").modal("hide");
        },
        error: function(data,xhr) {
          alert("Failed response")
        },
    });
  });

  /*---------------------get modal edit action------------------------*/
  $(document).on("click", ".upC", function () {
    var id = $(this).attr('data-id')
    $.ajaxSetup({headers:{'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')}});
    Pace.track(function(){
      $.post( '{{ route('ModalEditC') }}', { id1 : id })
        .done(function( data ) {
          $("#RenderFormUpdateC").html(data.modalUpdateaction);
          $("#ModalUpdateC").modal("show");
        })
        .fail(function() { alert( "error" );})
    });
  });

    $(document).on('submit', '#FormUpdateC', function(e) {
      e.preventDefault();
      var route = $('#FormUpdateC').data('route');
      var form_data = $(this);
      $.ajaxSetup({headers:{'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')}});
      Pace.track(function(){
        $.ajax({
            type: 'POST',
            url: route,
            data: form_data.serialize(),
            beforeSend: function() {
              $('.updateus').prop('disabled', true);
            },
            success: function(data) {
            switch (data.code) {
                    case "1":
              Toast.fire({
                icon: 'error',
                title: data.fail
              })
            break;
            case "2":
              Toast.fire({
                icon: 'success',
                title: 'Update Success'
              })
            break;
                    default:
                    break;
                }
            },
            complete: function() {
                $('.yajra-datatable').DataTable().ajax.reload();
                $('.updateus').prop('disabled', false);
                $("#ModalUpdateC").modal("hide");
            },
            error: function(data,xhr) {
              alert("Failed response")
            },
        });
    });
  });

</script>

<script type="text/javascript">

 $(function () {  
    //datatable
    var table = $('.yajra-datatable').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('ShowAction') }}",
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            {data: 'katlabtndid', name: 'katlabtndid'},
            {data: 'katlabnama', name: 'katlabnama'},
            {data: 'katlabsat', name: 'katlabsat'},
            {data: 'katlabnilai', name: 'katlabnilai'},
            {
              data: 'action', 
              name: 'action' 
              // orderable: true, 
              // searchable: true
            },
        ]
    });


    // delete action
    $(document).on('click', '.delC', function () {
        var id = $(this).attr('data-id')
        Swal.fire({
          title: 'Are you sure delete this data ?',
          showCancelButton: true,
          confirmButtonText: 'Yes',
        }).then((result) => {
          if (result.isConfirmed) {
              if (id) {
                return fetch('{{route("DelC", ":id")}}'.replace(":id", id),{
                    method: 'DELETE',
                    headers: {
                      'Content-Type': 'application/json',
                      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                }).then(response => {
                    $('.yajra-datatable').DataTable().ajax.reload();
                    Swal.fire('Success!', '', 'success')
                    return response.json()
                }).catch(error => {
                    Swal.fire('Server Error', '', 'error')
                    console.log(error)
                })
            } else {
                Swal.fire('Server Error', '', 'error')
            }
          }
        })
    });
      
});
</script>
@endsection
