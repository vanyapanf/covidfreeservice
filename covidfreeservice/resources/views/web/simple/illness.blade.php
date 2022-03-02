<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

</head>
<body class="antialiased">
    {{ isset($user)? $user : '' }}

    <p><input id="url" placeholder="тут текст" name="request">
    <p><input type="submit" value="урл" onclick="addUrl()"></p>

    <form id="form1" action='#' method="post">
        @csrf
        <p><input type="radio" name="has_tracker"><label>подключить трекер</label>
        <p><input type="submit" value="Отправить"></p>
    </form>
    <form id="form2" action='#' method="post" enctype="multipart/form-data">
        @csrf
        <p><input type="file" name="doc">
        <p><input type="submit" value="Подтвердить"></p>
    </form>
</body>
<script>
    function addUrl() {
        document.getElementById("form1").action = document.getElementById("url").value;
        document.getElementById("form2").action = document.getElementById("url").value;
    }
</script>
