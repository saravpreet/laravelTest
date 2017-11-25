<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    </head>
    <body v-on:load="getTotal">
        <div id="app">
            <nav class="navbar navbar-default navbar-static-top">
                <div class="container">
                    <div class="navbar-header">

                        <!-- Collapsed Hamburger -->
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse" aria-expanded="false">
                            <span class="sr-only">Toggle Navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>

                        <!-- Branding Image -->
                        <a class="navbar-brand" href="{{ url('/') }}">
                            {{ config('app.name', 'Laravel') }}
                        </a>
                    </div>

                    <div class="collapse navbar-collapse" id="app-navbar-collapse">
                        <!-- Left Side Of Navbar -->
                        <ul class="nav navbar-nav">
                            &nbsp;
                        </ul>

                        <!-- Right Side Of Navbar -->
                        <ul class="nav navbar-nav navbar-right">
                            <!-- Authentication Links -->
                            @guest
                            <li><a href="{{ route('login') }}">Login</a></li>
                            <li><a href="{{ route('register') }}">Register</a></li>
                            @else
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true">
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu">
                                    <li>
                                        <a href="{{ route('logout') }}"
                                           onclick="event.preventDefault();
                                                   document.getElementById('logout-form').submit();">
                                            Logout
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </li>
                            @endguest
                        </ul>
                    </div>
                </div>
            </nav>

            @yield('content')
        </div>
        

        <!-- Scri            pts -->
        <script src="https://unpkg.com/vue"></script>
        <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
        <script src="https://unpkg.com/lodash@4.17.4/lodash.min.js"></script>
        <!--<script src="{{ asset('js/app.js') }}"></script>-->
        
        
        <script>
            var list = document.querySelectorAll('#tbody tr td:last-child');
            var app = new Vue({
                el: '#app',
                data: {
                    pName: '',
                    quanStock: '',
                    price: '',
                    gTotal: 0,
                },
                created:  function () {
                            
                            
                        for (var i = 0; i < list.length; i++) {
                                
                            
                            let priceJs=parseInt(list[i].innerText);
                                        
                                this.gTotal=this.gTotal+priceJs;
                            }
                            
                            document.querySelector('#gTotal').value=this.gTotal;
                    
                },
                methods: {

                    saveJson: function(){
                        
                        axios.post('/', {
                            pName: this.pName,
                            quanStock: this.quanStock,
                            price:this.price,
                            isAjax:'ajax'
                          })
                          .then(function (response) {
                              
                      
                              if(response.data=='success'){
                                  
                                console.log('fetch data...');
                                axios.get('/?isAjax=ajax')
                                .then(function(response2){
                                    
                                    document.querySelector('#tbody').innerHTML=response2.data;
                                    
                                    var list = document.querySelectorAll('#tbody tr td:last-child');
                                        this.gTotal=0;
                                        for (var i = 0; i < list.length; i++) {
                                            let priceJs=parseInt(list[i].innerText);
                                            this.gTotal=parseInt(this.gTotal)+priceJs;
                                        }
                                        document.querySelector('#gTotal').value=this.gTotal;
                                    
                                })
                                .catch(function (error2) {
                                    console.log(error2);
                                });
                            }
                          })
                          .catch(function (error) {
//                            console.log(error);
                          });                        
                    }
                }
            })
        </script>
    </body>
</html>
