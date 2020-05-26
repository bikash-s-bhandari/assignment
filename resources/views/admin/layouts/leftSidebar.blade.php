<div class="sidebar"
     data-active-color="rose"
     data-background-color="black"
     data-image="{{material_dashboard_url('img/sidebar-3.jpg')}}">

  {{--<div class="logo">
    <a href="{{ route('admin_home') }}" class="simple-text logo-mini">
      <i class="material-icons">dashboard</i>
    </a>
    <a href="{{ route('admin_home') }}" class="simple-text logo-normal">
      {{$company->name}}
    </a>
  </div>--}}
  <div class="sidebar-wrapper">
    <div class="user">
      <div class="photo">
       
      </div>
      <div class="info">
        <a data-toggle="collapse" href="#collapseExample" class="collapsed">
          <span>
              {{auth()->user()->name}}
            <b class="caret"></b>
          </span>
        </a>
        <div class="clearfix"></div>
        <div class="collapse"
             id="collapseExample">
          <ul class="nav">
            <li @if(request()->is('admin/my-profile')) class="active" @endif>
              <a href="">
                <span class="sidebar-mini">&nbsp;</span>
                <span class="sidebar-normal">My Profile</span>
              </a>
            </li>
            
            <li>
              <a href="{{ url('/logout') }}"
                 onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <span class="sidebar-mini">&nbsp;</span>
                <span class="sidebar-normal">Logout</span>
              </a>
              <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                {{ csrf_field() }}
              </form>
            </li>
          </ul>
        </div>
      </div>
    </div>
    <ul class="nav">
     @if(auth()->user()->hasRole('admin') || auth()->user()->hasRole('normal'))
        {{--product--}}
        <li @if(request()->is('admin/product*')) class="active" @endif>
          <a data-toggle="collapse" href="#product">
           <i class="fa fa-shopping-bag"></i>
            <p>{{ ucfirst('product') }}
              <b class="caret"></b>
            </p>
          </a>
          <div class="collapse @if(request()->is('admin/product*')) in @endif" id="product">
            <ul class="nav">
              <li @if(request()->is('admin/product')) class="active" @endif>
                <a href="{{ route('product.index') }}">
                  <span class="sidebar-mini">A</span>
                  <span class="sidebar-normal">All {{ ucfirst(str_plural('product')) }}</span>
                </a>
              </li>
              <li @if(request()->is('admin/product/create')) class="active" @endif>
                <a href="{{ route('product.create') }}">
                  <span class="sidebar-mini">N</span>
                  <span class="sidebar-normal">New {{ ucfirst('product') }}</span>
                </a>
              </li>
            </ul>
          </div>
        </li>
        {{--./product--}}
  @endif

  @if(auth()->user()->hasRole('admin'))

  {{--news--}}
  <li @if(request()->is('admin/user*')) class="active" @endif>
    <a data-toggle="collapse" href="#news">
      <i class="material-icons">dvr</i>
      <p>{{ ucfirst('users') }}
        <b class="caret"></b>
      </p>
    </a>
    <div class="collapse @if(request()->is('admin/user*')) in @endif" id="news">
      <ul class="nav">
        <li @if(request()->is('admin/user')) class="active" @endif>
          <a href="{{ route('user.index') }}">
            <span class="sidebar-mini">&nbsp;</span>
            <span class="sidebar-normal">All {{ ucfirst(str_plural('users')) }}</span>
          </a>
        </li>
        
      </ul>
    </div>
  </li>
  {{--./news--}}


  


  @endif

        

      

      

        

        


      

     

    </ul>
  </div>
</div>