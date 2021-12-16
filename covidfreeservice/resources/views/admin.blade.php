<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

</head>
<body class="antialiased">
    {{ isset($user)? $user : '' }}
    {{ isset($reports)? $reports : '' }}
    {{ isset($chart_data)? $chart_data : '' }}
    {{ isset($messages)? $messages : '' }}
    {{ isset($url_to_doc)? $url_to_doc : '' }}

    <p><input id="url" placeholder="тут текст" name="request">
    <p><input type="submit" value="урл" onclick="addUrl()"></p>

    <form id="form1" action='#' method="post">
        @csrf
        <p><input placeholder="тэг" name="tag">
        <p><textarea placeholder="тут текст" name="post_text"></textarea>
        <p><input type="submit" value="Запостить"></p>
    </form>

    <form id="form2" action='#' method="post">
        @csrf
        <p><input placeholder="ид юзера" name="selected_user_id">
        <p><input type="submit" value="Добавить"></p>
    </form>

    <form id="form3" action='#' method="post">
        @csrf
        <p><input placeholder="сообщение" name="message_text">
        <p>
            <input type="submit" value="Одобрить">
            <input type="submit" value="Отклонить">
            <input type="submit" value="Посмотреть док">
        </p>
    </form>

    <form id="form4" action='#' method="post">
        @csrf
        <p><input placeholder="сообщениe" name="message_text">
        <p><input type="submit" value="отправить"></p>
    </form>
</body>
<script>
    function addUrl() {
        document.getElementById("form1").action = document.getElementById("url").value;
        document.getElementById("form2").action = document.getElementById("url").value;
        document.getElementById("form3").action = document.getElementById("url").value;
        document.getElementById("form4").action = document.getElementById("url").value;
    }
</script>
