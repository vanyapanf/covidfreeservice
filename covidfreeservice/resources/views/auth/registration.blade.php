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
                <h3>Регистрация</h3>
                <form class="login__form" method="post" action="{{ route('registration') }}" >
                    @csrf
                    <div class='login__input form-group'>
                        <input type="text" name="email" id="email" placeholder="Email" class="login__email form-control form-control-lg" />
                        @error('email')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class='login__input form-group'>
                        <input type="text" name="name" id="name" placeholder="Имя пользователя" class="login__name form-control form-control-lg" />
                        @error('name')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class='login__input form-group'>
                        <input type="text" name="surname" id="surname" placeholder="Фамилия пользователя" class="login__surname form-control form-control-lg" />
                        @error('surname')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class='login__input form-group'>
                        <input type="text" name="study_group" id="study_group" placeholder="Группа (для студентов)" class="login__group form-control form-control-lg" />
                        @error('study_group')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class='login__input form-group'>
                        <input type="password" name="password" id="password" placeholder="Пароль" class="login__password form-control form-control-lg" />
                        @error('password')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class='login__actions form-actions'>
                        <button name="button" type="submit" class="btn btn-primary">
                            Зарегистрироваться
                        </button>
                    </div>
                </form>
            </div>
        </main>
    </div>

    <footer class="footer">
        <div class='mephi-title'>
            © НИЯУ МИФИ, 2021–2022
        </div>
        <div class='dev-title'>Dev by vanyapanf</div>
    </footer>
</div>

</body>
