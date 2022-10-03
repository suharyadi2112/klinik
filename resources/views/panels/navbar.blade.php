{{-- navabar  --}}
<div class="header-navbar-shadow"></div>
<nav class="header-navbar main-header-navbar navbar-expand-lg navbar navbar-with-menu
@if(isset($configData['navbarType'])){{$configData['navbarClass']}} @endif"
data-bgcolor="@if(isset($configData['navbarBgColor'])){{$configData['navbarBgColor']}}@endif">
  <div class="navbar-wrapper">
    <div class="navbar-container content">
      <div class="navbar-collapse" id="navbar-mobile">
        <div class="mr-auto float-left bookmark-wrapper d-flex align-items-center">
          @if (request()->is('sk-layout-1-column'))
          <ul class="nav navbar-nav nav-back">
            <li class="nav-item mobile-menu d-xl-none mr-auto">
              <a class="nav-link nav-menu-main hidden-xs font-small-3 d-flex align-items-center" href="{{asset('sk-layout-2-columns')}}">
                <i class="bx bx-left-arrow-alt"></i>Back
              </a>
            </li>
          </ul>
          @else
          <ul class="nav navbar-nav">
            <li class="nav-item mobile-menu d-xl-none mr-auto">
              <a class="nav-link nav-menu-main menu-toggle hidden-xs" href="#">
                <i class="ficon bx bx-menu"></i>
              </a>
            </li>
          </ul>
          @endif
       </div>

        <ul class="nav navbar-nav float-right">
          {{-- <li class="dropdown dropdown-notification nav-item">
            <a class="nav-link nav-link-label ChangeThemeTod" href="#"><i class="bx bx-sun"></i>
           </a>
          </li> --}}
          <li class="dropdown dropdown-notification nav-item" id="RenderNotify">

          </li>
          <li class="dropdown dropdown-user nav-item">
            <a class="dropdown-toggle nav-link dropdown-user-link" href="#" data-toggle="dropdown">
              <div class="user-nav d-sm-flex d-none">
                <span class="user-name">{{ Auth::user()->name ?? 'none' }}</span>
                <span class="user-status text-muted">
                  @if(Auth::user())
                    {{ Auth::user()->getRoleNames()[0] }}
                  @endif
                </span>
              </div>
              <span><img class="round" src="{{asset('images/portrait/small/user.png')}}" alt="avatar" height="40" width="40"></span>
            </a>
            <div class="dropdown-menu dropdown-menu-right pb-0">
              
              <a class="dropdown-item" href="#">
                <i class="bx bx-user mr-50"></i> Edit Profile
              </a>
             
              @if(Auth::user())
                @if(auth()->user()->can('change_pass users')/* && $some_other_condition*/)
                  <a class="dropdown-item" href="#" @if(Auth::user()) onclick="ModalChangePassword('{{ auth()->user()->id; }}')" @endif>
                    <i class="bx bx-key mr-50"></i> Change Password
                  </a>
                @endif
              @endif
             
                <div class="dropdown-divider mb-0"></div>
                <a class="dropdown-item" href="{{ Route('logout') }}" onclick="
                  event.preventDefault(); 
                  var result = confirm('Want to Logout ?');
                if (result) {
                  document.getElementById('logout-form').submit();
                }"><i class="bx bx-power-off mr-50"></i> Logout</a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    {{ csrf_field() }}
                </form>
            </div>
          </li>
        </ul>
      </div>
    </div>
  </div>
</nav>

{{-- modal insert users --}}
<div class="modal fade" id="Modalcp" data-keyboard="false" data-backdrop="static">  
  <div class="modal-dialog modal-sm">
    <div class="modal-content" id="modal-content">
      <div class="row">
        <div class="col-lg-12">
          <div class="modal-header bg-info p-2">
            <h5 class="modal-title white" id="staticBackdropLabel">Change Password</h5> 
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"> 
              <span aria-hidden="true">&times;</span> 
            </button>
          </div>
          <form id="FormChangePassUser"  data-route="{{ route('ChangePass') }}" role="form" method="POST" accept-charset="utf-8">
          <div class="modal-body" >
              <div class="form-group">
                    <label class="form-label" for="basic-default-name">Current Password</label>
                    <input type="password" class="form-control" id="basic-default-current-password" name="current_password" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"/>
              </div>
              <div class="form-group">
                  <label class="form-label" for="basic-default-username">New Password</label>
                  <input type="password" class="form-control" id="basic-default-new-password" name="password" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" />
              </div>
              <div class="form-group">
                  <label class="form-label" for="basic-default-username">Confirm Password</label>
                  <input type="password" class="form-control" id="basic-default-confirm-password" name="password_confirmation" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" />
              </div>
          </div>
          <div class="modal-footer">
              <button type="button" class="btn btn-outline-secondary" data-dismiss="modal"> Cancel</button>
              <button type="submit" class="ccp btn btn-primary"><i class='bx bx-edit-alt' ></i> Update</button>
          </div>

          </form>
          {{-- tutup form --}}
        </div>
      </div>
    </div>
  </div>
</div>

@if(Auth::user())
<script>
function ModalChangePassword (id_users) {
  $("#Modalcp").modal()
}
var pusher = new Pusher('{{env("MIX_PUSHER_APP_KEY")}}', {
  cluster: '{{env("PUSHER_APP_CLUSTER")}}',
  encrypted: true
});

var channel = pusher.subscribe('notify-channel');
channel.bind('App\\Events\\Notify', function(data) {
  alert('tes')
});

RenderNotfy("0");

function RenderNotfy(status){
    const csrfToken = document.head.querySelector("[name~=csrf-token][content]").content;

    fetch('{{ route('GetNotif') }}', {
      method: 'POST', // or 'PUT'
      headers: {
            "Content-Type": "application/json",
            "Accept": "application/json",
            "X-Requested-With": "XMLHttpRequest",
            'X-CSRF-TOKEN': csrfToken,
          },
      data: {
              user_id : '{{ auth()->user()->id }}',
              status : status,
            },
      credentials: "same-origin",
    })
    .then((response) => response.json())
    .then((data) => {
      var wadahnotif = document.getElementById('RenderNotify');
      wadahnotif.innerHTML = data.notifyy;
    })
    .catch((error) => {
      console.error('Error:', error);
    });
}
</script>
@endif
