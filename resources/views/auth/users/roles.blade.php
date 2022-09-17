@extends('layouts.contentLayoutMaster')
{{-- title --}}
@section('title','Users')

{{-- vendor styles --}}
@section('vendor-styles')
<link rel="stylesheet" type="text/css" href="{{asset('vendors/css/ui/prism.min.css')}}">  
<link rel="stylesheet" type="text/css" href="{{asset('vendors/css/tables/datatable/dataTables.bootstrap4.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('vendors/css/tables/datatable/responsive.bootstrap4.min.css')}}">

{{-- sweetalert2 --}}
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
 

@endsection

@section('content')
<!-- Description -->
<section id="description" class="card">
    <div class="card-header">
        <h4 class="card-title">Dashboard Roles</h4>
    </div>
    <div class="card-body">
        <div class="card-text">
        {{-- batas table --}}
        <div class="table-responsive">
            <button type="button" class="btn btn-primary round addroles"><i class="bx bx-plus-circle"></i> Create role</button>
            <table class="table yajra-datatable table-inverse table-hover" width="100%">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Name</th>
                  <th>Guard Name</th>
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

<div class="modal fade" id="permissionRoles" data-keyboard="false" data-backdrop="static">  
    <div class="modal-dialog modal-lg">
        <div class="modal-content" id="modal-content">
            <div class="row">
                <div class="col-lg-12">
                    <div class="modal-header bg-primary p-2">
                        <h5 class="modal-title white" id="staticBackdropLabel">Permissions</h5> 
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"> 
                            <span aria-hidden="true">&times;</span> 
                        </button>
                    </div>
                    <form id="FormUpdatePermission" data-route="{{ route('UpdatePermission') }}" role="form" method="POST" accept-charset="utf-8">        
                        {{-- render modal --}}
                        <div id="RenderFormPermissionRole"></div>

                        <div class="modal-footer">
                          <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Cancel</button>
                          <button type="submit" class="updatepers btn btn-primary"><i class='bx bx-pencil' ></i> Update</button>
                      </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

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

    //datatable
    var table = $('.yajra-datatable').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('ShowRolesUsers') }}",
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            {data: 'name', name: 'name'},
            {data: 'guard_name', name: 'guard_name'},
            {
              data: 'action', 
              name: 'action' 
              // orderable: true, 
              // searchable: true
            },
        ]
    });


    /*---------------------get modal for permission users------------------------*/
    $(document).on("click", ".CekPermission", function () {
        var id = $(this).attr('data-id')
        $.ajaxSetup({headers:{'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')}});
        Pace.track(function(){
            $.post( '{{ route('ShowModalPermission') }}', { rolesid : id })
              .done(function( data ) {
                // $("#ModalUpdateUser").modal("show");
                switch (data.code) {
                    case "1":
                        Toast.fire({ icon: 'warning', title: 'Role no have permission, <b>ignore if superadmin role</b>'})
                    break;
                    case "2":
                        $("#RenderFormPermissionRole").html(data.modalData);
                        $("#permissionRoles").modal("show");
                    break;
                    case "3":
                        Toast.fire({ icon: 'error', title: data.fail})
                    break;
                    default:
                    break;
                }
              })
              .fail(function() { alert( "error" );})
        });
    });

    /*---------------------Update Permission roles------------------------*/
    $(document).on('submit', '#FormUpdatePermission', function(e) {
        e.preventDefault();
        var route = $('#FormUpdatePermission').data('route');
        var form_data = $(this);
        $.ajaxSetup({headers:{'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')}});
        Pace.track(function(){
            $.ajax({
                type: 'POST',
                url: route,
                data: form_data.serialize(),
                beforeSend: function() {
                    $('.updatepers').prop('disabled', true);
                },
                success: function(data) {
                    switch (data.code) {
                        case "1":
                            Toast.fire({ icon: 'error',title: data.fail })
                        break;
                        case "2":
                            Toast.fire({ icon: 'success', title: 'Update Permissions success' })
                        break;
                        default:
                        break;
                    }
                },
                complete: function() {
                    $('#users-list-datatable').DataTable().ajax.reload();
                    $('.updatepers').prop('disabled', false);
                },
                error: function(data,xhr) {
                    alert("Failed response")
                },
            });
        });
    });

    //add role
    $(document).on('click', '.addroles', function () {
        Swal.fire({
          title: 'New role',
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
                return fetch(`{{ Route('StoreRoles') }}`,{
                    method: 'POST',
                    headers: {
                      'Content-Type': 'application/json',
                      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    body: JSON.stringify({nameroles: data})
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

    // delete role
    $(document).on('click', '.delRole', function () {
        var id = $(this).attr('data-id')
        Swal.fire({
          title: 'Are you sure delete this role ?',
          showCancelButton: true,
          confirmButtonText: 'Yes',
        }).then((result) => {
          /* Read more about isConfirmed, isDenied below */
          if (result.isConfirmed) {
              if (id) {
                return fetch('{{route("DelRoles", ":id")}}'.replace(":id", id),{
                    method: 'DELETE',
                    headers: {
                      'Content-Type': 'application/json',
                      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                })
                .then((response) => response.json())
                .then((data) => {
                    switch (data.code) {
                        case "6":
                            Toast.fire({icon: 'error',title: 'Cant delete role, because have '+data.data.users_count+' user used it, please delete user first' })
                        break;
                        case "1":
                            Toast.fire({ icon: 'success', title: 'Deleted!'})
                        break;
                        default:
                        break;
                    }
                    $('.yajra-datatable').DataTable().ajax.reload();
                })
                .catch(error => {
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
    $(document).on('click', '.upRole', function () {
        var id = $(this).attr('data-id')
        var nameRole = $(this).attr('vall')
        Swal.fire({
          title: 'Update role',
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
                return fetch('{{route("PutRoles", ":id")}}'.replace(":id", id),{
                    method: 'POST',
                    headers: {
                      'Content-Type': 'application/json',
                      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    body: JSON.stringify({NewUpdateRoles: data})
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
