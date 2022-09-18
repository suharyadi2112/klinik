@extends('layouts.contentLayoutMaster')
{{-- title --}}
@section('title','Category')

{{-- vendor styles --}}
@section('vendor-styles')
<link rel="stylesheet" type="text/css" href="{{asset('vendors/css/ui/prism.min.css')}}">  
<link rel="stylesheet" type="text/css" href="{{asset('vendors/css/tables/datatable/dataTables.bootstrap4.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('vendors/css/tables/datatable/responsive.bootstrap4.min.css')}}">

{{-- sweetalert2 --}}
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
 

@endsection

@section('content')

@if(auth()->user()->can('view cat')/* && $some_other_condition*/)
<section id="description" class="card">
    <div class="card-header">
        <h4 class="card-title">Dashboard Category</h4>
    </div>
    <div class="card-body">
        <div class="card-text">
        {{-- batas table --}}
        <div class="table-responsive">

        @if(auth()->user()->can('create cat')/* && $some_other_condition*/)
            <button type="button" class="btn btn-primary round addcategory"><i class="bx bx-plus-circle"></i> Create Category</button>
        @endif
            <table class="table yajra-datatable table-inverse table-hover" width="100%">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Category</th>
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
<script src="{{asset('vendors/js/ui/prism.min.js')}}"></script> 
<script src="{{asset('vendors/js/tables/datatable/jquery.dataTables.min.js') }}"></script>
<script src="{{asset('vendors/js/tables/datatable/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{asset('vendors/js/tables/datatable/dataTables.responsive.min.js') }}"></script>



<script type="text/javascript">

 $(function () {  
    //datatable
    var table = $('.yajra-datatable').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('ShowCategory') }}",
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            {data: 'kattndnama', name: 'kattndnama'},
            {
              data: 'action', 
              name: 'action' 
              // orderable: true, 
              // searchable: true
            },
        ]
    });

    //ADD CATEGORY//
    $(document).on('click', '.addcategory', function () {
        Swal.fire({
          title: 'New Category',
          input: 'text',
          inputAttributes: {
            autocapitalize: 'off'
          },
          showCancelButton: true,
          confirmButtonText: 'Submit',
          showLoaderOnConfirm: true,
          allowOutsideClick: false,
          preConfirm: (data) => {
            if (data) {
                return fetch(`{{ Route('StoreCategory') }}`,{
                    method: 'POST',
                    headers: {
                      'Content-Type': 'application/json',
                      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    body: JSON.stringify({namecategory: data})
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

    // DELETE CATEGORY//
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

    //UPDATE CATEGORY//
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
@endsection
