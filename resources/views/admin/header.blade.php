<div class="container portfolio_title">

    <!-- Title -->
    <div class="section-title">
        <h2>{{$title}}</h2>
    </div>
    <!--/Title -->

</div>
<!-- Container -->

<div class="portfolio">

    <div id="filters" class="sixteen columns">
        <ul style="padding:0">
            <li><a  href="{{route('pages')}}">
                    <h5>Страницы</h5>
                </a>
            </li>

            <li><a  href="{{route('portfolio')}}">
                    <h5>Порфолио</h5>
                </a>
            </li>

            <li><a href="{{route('services')}}">
                    <h5>Сервисы</h5>
                </a>
            </li>

            <li class="nav navbar-nav navbar-right admin-exit">
                <div class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true" v-pre>
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
                </div>
            </li>

        </ul>



    </div>



</div>
