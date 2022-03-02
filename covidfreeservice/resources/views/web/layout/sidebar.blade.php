<ul class='sidebar__list'>
    <li class='sidebar__logo logo'>
        <a href="{{ route('index') }}">
            <img alt="НИЯУ МИФИ" src="/img/logo1.jpg" />
        </a>
    </li>
    <li>
        <a href="{{ route('user') }}">
            <i class="fa fa-home fa-fw"></i>
            Личная страница
        </a>
    </li>
    @if (Auth::user()->is_admin)
    <li>
        <a href="{{ route('admin') }}">
            <i class="fa fa-home fa-fw"></i>
            Админ-панель
        </a>
    </li>
    @endif
    <li>
        <a href="{{ route('index') }}">
            <i class="fa fa-atom fa-fw"></i>
            Главная
        </a>
    </li>
    <li>
        <a href="{{ route('illness') }}">
            <i class="far fa-frown fa-fw"></i>
            Отметка о заболевании
        </a>
    </li>
    <li>
        <a href="{{ route('recovery') }}">
            <i class="far fa-smile fa-fw"></i>
            Отметка о выздоровлении
        </a>
    </li>
    <li>
        <a href="#">
            <i class="fas fa-question"></i>
            FAQ
        </a>
    </li>
    <!--<li>
        <a href="#">
            <i class="fa fa-sign-out-alt fa-fw"></i>
            Выход
        </a>
    </li>-->
</ul>
