<nav class='header__navbar navbar'>
    <div class='name'>
        <a href="/">
            #mephicovidfreeservice
        </a>
    </div>
    <ul class='profile navbar-right'>
        <div class="profile__menu">
            <span class="profile__status"><i class="fa fa-circle user-online-status user-online"></i></span>
            <span class="profile__username">{{ Auth::user()->name }} {{ Auth::user()->surname }}</span>
            <a class="profile__exit" href="{{ route('logout') }}"><i class="fas fa-sign-out-alt"></i></a>
        </div>
    </ul>
</nav>
