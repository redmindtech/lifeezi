  <nav class="navbar navbar-expand-md navbar-white  shadow-sm bg-nav">
            <div class="container">
                <a class="navbar-brand text-white" href="{{ url('/') }}">
                    <img src="{{ url('assets\images\logo.png') }}" width="25" height="25" style="border-radius:50%" />
                    {{ config('app.name', 'Laravel') }}
                </a>
                @auth
                <a onclick=menuToggle()>
                     <i class="fa fa-bars text-white fa-sm" ></i>
                </a>
                @endauth
             
                <script type="text/javascript">
                function menuToggle(){
                 const id = document.getElementById('sidebar');
                 if(id.style.width == '250px')
                 id.style.width = '60px';
                 else
                 id.style.width = '250px';
                }
                    </script>

                
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link " href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                   <i class="fa fa-user-nurse text-white"></i>
                                </a>

                                <div class="dropdown-menu dropdown-menu-end text-white bg-dropdown" aria-labelledby="navbarDropdown">
                                     <a class="dropdown-item bg-profile">
                                        <?php $image = auth()->user()->image ?>
                                        <img src="{{ $image ? url('assets/images/'. $image): url('assets/images/default.jpg')}}" class="bg-image" width="30" height="30" />
                                       <span> {{ auth()->user()->name }}</span>
                                    </a> 
                                    
                                     <a class="dropdown-item" href="{{ route('profile.index') }}" >
                                                     <i class="fa fa-user "></i>
                                        {{ __('Profile') }}
                                    </a>

                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                                     <i class="fa fa-right-from-bracket "></i>
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>