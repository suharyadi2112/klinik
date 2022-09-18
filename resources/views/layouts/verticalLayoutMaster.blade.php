<!-- BEGIN: Body-->
<body class="vertical-layout vertical-menu-modern 2-columns
@if($configData['isMenuCollapsed'] == true){{'menu-collapsed'}}@endif
@if($configData['theme'] === 'dark'){{'dark-layout'}} @elseif($configData['theme'] === 'semi-dark'){{'semi-dark-layout'}} @else {{'light-layout'}} @endif
@if($configData['isContentSidebar'] === true) {{'content-left-sidebar'}} @endif @if(isset($configData['navbarType'])){{$configData['navbarType']}}@endif
@if(isset($configData['footerType'])) {{$configData['footerType']}} @endif
{{$configData['bodyCustomClass']}}
@if($configData['mainLayoutType'] === 'vertical-menu-boxicons'){{'boxicon-layout'}}@endif
@if($configData['isCardShadow'] === false) {{'no-card-shadow'}} @endif"
data-open="click" data-menu="vertical-menu-modern" data-col="2-columns" data-framework="laravel">
{{-- sweetalert2 --}}
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>


  <!-- BEGIN: Header-->
  @include('panels.navbar')
  <!-- END: Header-->

  <!-- BEGIN: Main Menu-->
  @include('panels.sidebar')
  <!-- END: Main Menu-->

  <!-- BEGIN: Content-->
  <div class="app-content content">
  {{-- Application page structure --}}
	@if($configData['isContentSidebar'] === true)
		<div class="content-area-wrapper">
			<div class="sidebar-left">
				<div class="sidebar">
					@yield('sidebar-content')
				</div>
			</div>
			<div class="content-right">
          <div class="content-overlay"></div>
				<div class="content-wrapper">
          <div class="content-header row">
          </div>
          <div class="content-body">
            @yield('content')
          </div>
        </div>
			</div>
		</div>
	@else
    {{-- others page structures --}}
    <div class="content-overlay"></div>
		<div class="content-wrapper">
			<div class="content-header row">
        @if($configData['pageHeader']=== true && isset($breadcrumbs))
          @include('panels.breadcrumbs')
        @endif
			</div>
			<div class="content-body">
				@yield('content')
			</div>
		</div>
	@endif
  </div>
  <!-- END: Content-->

  <div class="sidenav-overlay"></div>
  <div class="drag-target"></div>

  <!-- BEGIN: Footer-->
    @include('panels.footer')
  <!-- END: Footer-->

  @include('panels.scripts')

  <script type="text/javascript">
    //top end notif
    const ToastChangePass = Swal.mixin({
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
$(document).ready(function(){
    $(document).on('submit', '#FormChangePassUser', function(e) {
        e.preventDefault();
        var route = $('#FormChangePassUser').data('route');
        var form_data = $(this);
        $.ajaxSetup({headers:{'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')}});
        Pace.track(function(){
          Pace.restart();
          $.ajax({
              type: 'POST',
              url: route,
              data: form_data.serialize(),
              beforeSend: function() {
                $('.ccp').prop('disabled', true);
              },
              success: function(data) {
                switch (data.code) {
                    case "1":
                      ToastChangePass.fire({  icon: 'error', title: data.fail  })
                    break;
                    case "2":
                      ToastChangePass.fire({  icon: 'success',title: 'Change Password Success'})
                      window.location.href = "{{ url('/login')}}";
                    break;
                    case "3":
                      ToastChangePass.fire({  icon: 'warning',title: "old password doesn't match"})
                    break;
                    default:
                    break;
                }
              },
              complete: function() {
                  $('.ccp').prop('disabled', false);
              },
              error: function(data,xhr) {
                alert("Failed response")
              },
          });
      });
    });
  });

  </script>
</body>
<!-- END: Body-->
