@extends('layouts.contentLayoutMaster')
{{-- page title --}}
@section('title','Category Action')
{{-- vendor styles --}}
@section('vendor-styles')
<link rel="stylesheet" type="text/css" href="{{asset('vendors/css/ui/prism.min.css')}}">  
<link rel="stylesheet" type="text/css" href="{{asset('vendors/css/tables/datatable/dataTables.bootstrap4.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('vendors/css/tables/datatable/responsive.bootstrap4.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('vendors/css/tables/datatable/buttons.bootstrap4.min.css')}}">

{{-- sweetalert2 --}}
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

{{-- pace --}}
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/pace-js@latest/pace-theme-default.min.css">

@endsection
{{-- page styles --}}
@section('page-styles')
<link rel="stylesheet" type="text/css" href="{{asset('css/pages/app-users.css')}}">
 
@endsection

@section('content')

<section id="description" class="card">
    <div class="card-header">
        <h4 class="card-title">Dashboard Category Action</h4>
    </div>
    <div class="card-body">
        <div class="card-text">
        {{-- batas table --}}
        <div class="table-responsive">
            <button type="button" class="btn btn-primary round addca"><i class="bx bx-plus-circle"></i> 
              Create Category Action
            </button>
        <hr>
            <table class="table yajra-datatable table-inverse table-hover" width="100%">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Category</th>
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

<script src="{{asset('vendors/js/forms/select/select2.full.min.js')}}"></script>
<script src="{{asset('vendors/js/forms/validation/jquery.validate.min.js')}}"></script>

{{-- modal insert ca --}}
<div class="modal fade" id="ModalInsertCA" data-keyboard="false" data-backdrop="static">  
  <div class="modal-dialog ">
    <div class="modal-content" id="modal-content">
      <div class="row">
        <div class="col-lg-12">
          <div class="modal-header bg-info p-2">
            <h5 class="modal-title white" id="staticBackdropLabel">Insert Category Action</h5> 
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"> 
              <span aria-hidden="true">&times;</span> 
            </button>
          </div>
          <form id="FormInsertCa" data-route="{{ route('PostCa') }}" role="form" method="POST" accept-charset="utf-8">
          <div class="modal-body" >

              <div class="form-group">
                  <label for="select-country">Category</label>
                  <select class="form-control" id="category" name="category">
                    <option value="">Select Category</option>
                      @forelse($category as $key => $valcategory)
                        <option value="{{ $valcategory->kattndid }}">{{ $valcategory->kattndnama }}</option>
                      @empty
                        <option value="">Data not found</option>
                      @endforelse
                  </select>
              </div>

              <div class="form-group">
                  <label class="form-label" for="basic-default-id">ID</label>
                  <input type="text" class="form-control" id="basic-default-id" value="L{{ $count+1 }}" name="id_cat" placeholder="John Doe"/>
              </div>
              <div class="form-group">
                  <label class="form-label" for="basic-default-name">Name</label>
                  <input type="text" class="form-control" id="basic-default-name" name="nama" placeholder="Name" />
              </div>
              <div class="form-group">
                  <label class="form-label" for="basic-default-price">Price</label>
                  <input type="number" class="form-control" id="basic-default-price" name="harga" placeholder="Price" />
              </div>    
              <div class="form-group">
                  <label class="form-label" for="basic-default-note">Note</label>
                  <input type="text" class="form-control" id="basic-default-note" name="note" placeholder="Note" />
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

<script type="text/javascript">

 $(function () {  
    var table = $('.yajra-datatable').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('ShowCategoryAction') }}",
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            {data: 'kattndnama', name: 'kattndnama'},
            {data: 'tndid', name: 'tndid'},
            {data: 'tndnama', name: 'tndnama'},
            {data: 'tndharga', name: 'tndharga'},
            {data: 'tndnote', name: 'tndnote'},
            {
              data: 'action', 
              name: 'action' 
              // orderable: true, 
              // searchable: true
            },
        ]
    });

    // delete role
    $(document).on('click', '.delCategory', function () {
        var id = $(this).attr('data-id')
        Swal.fire({
          title: 'Are you sure delete this category ?',
          showCancelButton: true,
          confirmButtonText: 'Yes',
        }).then((result) => {
          /* Read more about isConfirmed, isDenied below */
          if (result.isConfirmed) {
              if (id) {
                return fetch('{{route("DelCategory", ":id")}}'.replace(":id", id),{
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

    //update role
    $(document).on('click', '.upCategory', function () {
        var id = $(this).attr('data-id')
        var nameRole = $(this).attr('vall')
        Swal.fire({
          title: 'Update category',
          input: 'text',
          inputValue: nameRole,
          inputAttributes: {
            autocapitalize: 'off'
          },
          showCancelButton: true,
          confirmButtonText: 'Update',
          showLoaderOnConfirm: true,
          allowOutsideClick: false,
          preConfirm: (data) => {
            if (data) {
                return fetch('{{route("PutCategory", ":id")}}'.replace(":id", id),{
                    method: 'POST',
                    headers: {
                      'Content-Type': 'application/json',
                      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    body: JSON.stringify({NewUpdateCategory: data})
                }).then(response => {
                    
                    $('.yajra-datatable').DataTable().ajax.reload();
                    return response.json()
                }).catch(error => {
                    Swal.showValidationMessage(
                      `Request failed: ${error}`
                    )
                    console.log(error)
                })
            } else {
                Swal.showValidationMessage('First input missing')   
            }
          },
        }).then((result) => {
          if (result.isConfirmed) {
            Swal.fire({
              title: `Success`,
            })
          }
        })
    }); 
    
});
</script>

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

  /*---------------------insert CA------------------------*/
  $(document).on("click", ".addca", function () {
    $("#ModalInsertCA").modal("show");
  });

  $(document).on('submit', '#FormInsertCa', function(e) {
    e.preventDefault();
    var route = $('#FormInsertCa').data('route');
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
        },
        error: function(data,xhr) {
          alert("Failed response")
        },
    });
  });
</script>



@endsection
