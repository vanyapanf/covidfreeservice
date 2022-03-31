<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- csrf token-->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Covidfree Service</title>

    <!-- Bootstrap CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <!-- font awesome icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:wght@700&family=Rubik:wght@500&display=swap" rel="stylesheet">

    <!-- Custom CSS file -->
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
</head>
<body>
<div class='wrapper'>
    <header class="header">
        <nav class='header__navbar navbar'>
            <div class='name'>
                <a href="/">
                    #mephicovidfreeservice
                </a>
            </div>
        </nav>
    </header>

    <div class="main-wrapper">
        <main class="main main-width-mid">
            <div class="login card">
                <li class='login__logo logo'>
                    <a href="/">
                        <img alt="НИЯУ МИФИ" src="/img/logo1.jpg" />
                    </a>
                </li>
                <form class="login__form" method="post" action="{{ route('login') }}" >
                    @csrf
                    <div class='login__input input-group input-group-lg'>
                        <input type="text" name="email" id="email" placeholder="Email" class="login__email form-control" />
                        @error('email')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class='login__input input-group input-group-lg'>
                        <input type="password" name="password" id="password" placeholder="Пароль" class="login__password form-control" />
                        @error('password')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class='login__actions form-actions'>
                        <div class='pull-right'>
                            <div><a class="text-muted" href="/registration">Регистрация студентов</a></div>
                            <div><a class="text-muted" href="">Забыли пароль?</a></div>
                        </div>
                        <button name="button" type="submit" class="btn btn-primary">
                            Войти
                        </button>
                    </div>
                </form>
            </div>
        </main>
    </div>

    <footer class="footer">
        <div class='mephi-title'>
            © НИЯУ МИФИ, 2021–2021
        </div>
        <div class='dev-title'>Dev by vanyapanf</div>
    </footer>
</div>
</body>
