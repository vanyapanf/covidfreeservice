<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

</head>
<body class="antialiased">
    {{ isset($posts)? $posts : '' }}
    {{ isset($illnessesCount)? $illnessesCount : '' }}
    {{ isset($recoveriesCount)? $recoveriesCount : '' }}
    {{ isset($comments)? $comments : '' }}

    <p><input id="url" placeholder="тут текст" name="request">
    <p><input type="submit" value="урл" onclick="addUrl()"></p>

    <form id="form" action='#' method="post">
        @csrf
        <p><input placeholder="комментарий" name="comment_text">
        <p><input type="submit" value="Отправить"></p>
    </form>

</body>
<script>
    function addUrl() {
        document.getElementById("form").action = document.getElementById("url").value;
    }
</script>

