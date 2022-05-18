@extends('web.layout')@section('main')
    <div class="profile card">
        <h3>Пользовательские данные</h3>
        <form class="profile__form" method="post" action="{{ route('save_profilechanges') }}" >
            @csrf
            <div class='profile__group form-group'>
                <label class="profile__title">Электронная почта</label>
                <input type="email" name="email" id="email" placeholder="{{ Auth::user()->email }}" class="profile__input form-control form-control-lg" />
                @error('email')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class='profile__group form-group'>
                <label class="profile__title">Имя</label>
                <input type="text" name="name" id="name" placeholder="{{ Auth::user()->name }}" class="profile__input form-control form-control-lg" />
                @error('name')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class='profile__group form-group'>
                <label class="profile__title">Фамилия</label>
                <input type="text" name="surname" id="surname" placeholder="{{ Auth::user()->surname }}" class="profile__input form-control form-control-lg" />
                @error('surname')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class='profile__group form-group'>
                <label class="profile__title">Учебная группа (для студентов)</label>
                <input type="text" name="study_group" id="study_group" placeholder="{{ Auth::user()->study_group }}" class="profile__input form-control form-control-lg" />
                @error('study_group')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class='profile__group form-group'>
                <label class="profile__title">Новый пароль</label>
                <input type="password" name="password" id="password" placeholder="1234567" class="profile__input form-control form-control-lg" />
                @error('password')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class='profile__actions form-actions'>
                <button name="button" type="submit" class="btn btn-primary">
                    Сохранить
                </button>
            </div>
        </form>
    </div>

@endsection
