<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

</head>
<body class="antialiased">
    {{ isset($user)? $user : '' }}
    {{ isset($last_report)? $last_report : '' }}
    {{ isset($tracker_cards)? $tracker_cards : '' }}
    {{ isset($messages)? $messages : '' }}

    <p><input id="url" placeholder="тут текст" name="request">
    <p><input type="submit" value="урл" onclick="addUrl()"></p>

    <form id="form1" action='#' method="post">
        @csrf
        <p><input placeholder="сообщениe" name="message_text">
        <p><input type="submit" value="отправить"></p>
    </form>

    <form id="form2" action='#' method="post">
        @csrf
        <p><input placeholder="температура" name="temperature">
        <p>
            <input type="radio" name="health_rate" value=1><label>1/5</label>
            <input type="radio" name="health_rate" value=2><label>2/5</label>
            <input type="radio" name="health_rate" value=3><label>3/5</label>
            <input type="radio" name="health_rate" value=4><label>4/5</label>
            <input type="radio" name="health_rate" value=5><label>5/5</label>
        </p>
        <p><input type="submit" value="отправить"></p>
    </form>
</body>
<script>
    function addUrl() {
        document.getElementById("form1").action = document.getElementById("url").value;
        document.getElementById("form2").action = document.getElementById("url").value;
    }
</script>
