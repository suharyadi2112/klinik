@extends('layouts.contentLayoutMaster')
{{-- title --}}
@section('title','Users')

{{-- vendor styles --}}
@section('vendor-styles')
<link rel="stylesheet" type="text/css" href="{{asset('vendors/css/ui/prism.min.css')}}">  
<link rel="stylesheet" type="text/css" href="{{asset('vendors/css/tables/datatable/dataTables.bootstrap4.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('vendors/css/tables/datatable/responsive.bootstrap4.min.css')}}">

@endsection

@section('content')
<!-- Description -->
@if(auth()->user()->can('view log')/* && $some_other_condition*/)
<section id="description" class="card">
    <div class="card-header">
        <h4 class="card-title">Dashboard Log</h4>
    </div>
    <div class="card-body">
        <div class="card-text">
        {{-- batas table --}}
        <div class="table-responsive">
            <table class="table yajra-datatable table-inverse table-hover table-sm" width="100%">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Subject</th>
                  <th>Url</th>
                  <th>Method</th>
                  <th>IP</th>
                  <th>Agent</th>
                  <th>Data</th>
                  <th>User id</th>
                  <th>Created at</th>
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
        ajax: "{{ route('Log') }}",
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            {data: 'subject', name: 'subject'},
            {data: 'url', name: 'url'},
            {data: 'method', name: 'method'},
            {data: 'ip', name: 'ip'},
            {data: 'agent', name: 'agent'},
            {data: 'data', name: 'data'},
            {data: 'user_id', name: 'user_id'},
            {data: 'created_at', name: 'created_at'},
        ]
    });
});
</script>
@endsection
