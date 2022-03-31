<!doctype html>
<html lang="en">
<head>
    @include('web.layout.head')
</head>
<body>
    <div class='wrapper'>
        <header class="header">
            @include('web.layout.header')
        </header>
        <div class="main-wrapper">
            <aside class="sidebar">
                @include('web.layout.sidebar')
            </aside>
            <main class="main main-width-large">
                @section('main')
                @show
            </main>
        </div>
        <footer class="footer">
            @include('web.layout.footer')
        </footer>
    </div>
</body>
</html>
