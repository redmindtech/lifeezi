<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Lifeezi') }}</title>
     <link rel="icon" type="image/x-icon" href="{{ url('assets\images\logo.png') }}">

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
  <link href="https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap4.min.css" rel="stylesheet" />
  <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.13.1/js/dataTables.bootstrap4.min.js"></script>
 @yield('js_user_page')
    <style>
        /* width */
::-webkit-scrollbar {
  width: 8px;
}

/* Track */
::-webkit-scrollbar-track {
  background: #f1f1f1; 
}
 
/* Handle */
::-webkit-scrollbar-thumb {
  background: #888; 
}

/* Handle on hover */
::-webkit-scrollbar-thumb:hover {
  background: #555; 
}
        a,button {
            cursor: pointer;
        }
    .bg-nav{
    background:#023047 !important;
    color:white !important;
    height: 40px !important;
}
.bg-dropdown{
    width: 200px !important;
    padding:0px !important;

}

.bg-profile {
    background:#403d39 !important;
    color: white !important;
    height: 45px;
}
.bg-profile {
    font-size: 20px;
}
.bg-image{
    border-radius: 50%;
}
.bg-sidebar {
    box-shadow: 0 5px 15px rgba(145, 92, 182, .4),10px 5px 15px rgba(145, 92, 182, .4),20px 5px 15px rgba(145, 92, 182, .4),30px 5px 15px rgba(145, 92, 182, .4),;
}
.bg-card {
    display: block;
    box-shadow: 2px 10px 15px #023047;
    overflow: auto
}
.bg-card::-webkit-scrollbar{
    width: 14px;
}

.bg-card .card-body {
    height: 90vh;
}
.bg-nav-p{
    padding:0px 10px;
}
.bg-sidebar-link{
    width:220px !important;
}
.error {
    color:red;
}
label {
    font-weight: 600;
}

.guest{
    display: grid;
    place-items: center;
     margin-top: 80px;
    padding: 0 24px;
    background-repeat: no-repeat;
    background-size: cover;
    animation: pan 6s infinite alternate linear;
}

.login-card {
    width: 100%;
    padding: 70px 30px 44px;
    border-radius: 24px;
    background: #ffffff;
    text-align: center;
}

.login-card > h2 {
    margin: 0 0 12px;
    font-size: 36px;
    font-weight: 600;
}

.login-card > h3 {
    margin: 0 0 30px;
    font-weight: 500;
    font-size: 16px;
    color:rgba(0,0,0,0.30)
}

.login-form {
    width: 100%;
    margin: 0;
    display: grid;
    gap: 16px;
}

.login-form > a {
    color:#216cef;
}

.nav-item{
    font-size: 15px !important;
}

.login-form > input,
.login-form > button {
    width:100%;
    height:56px;
    padding: 0 16px;
    border-radius: 8px;
}

.login-form > input {
    border: 2px solid #ebebeb;
}

.login-form > button {
    width:100%;
    height: 56px;
    border: 0;
    background: #216ce7;
    color:#f9f9f9;
    font-weight: 600;
}
.login-form input::placeholder {
    font-weight: 700;
}

summary {
    color:#216ce7;
    margin:0 0 5px -10px;
}

.details{
    margin-left: 7px; 
}

details {
    transition: 8s ease-in-out;
}

details > summary:first-of-type {
    list-style-type: none;
}

/* Chrome, Safari, Edge, Opera */
input::-webkit-outer-spin-button,
input::-webkit-inner-spin-button {
  -webkit-appearance: none;
  margin: 0;
}

/* Firefox */
input[type=number] {
  -moz-appearance: textfield;
}

@keyframes pan {
    100%{
        background-position: 15% 50%;
    }
}

@media (width >=500px) {
    .guest {
        padding: 0px;
    }

    .login-card {
        margin: 0;
        width: 400px;
    }
}
        </style>

    <!-- Scripts -->


    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <!-- CSS only -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>

</head>
<body 
    style="background-image:url('{{ url('assets/images/grid.svg' )}}')"
    @guest
    class="guest"
@endguest>
    <div id="app">
      @auth
          @include('include.navbar')
      @endauth
        <main>
            @include('alerts.messages')
            <div class="d-flex">
                @auth
                    @include('include.sidebar')
                @endauth
            @yield('content')
         
            </div>
            </div>
        </main>
    </div>
</body>
</html>