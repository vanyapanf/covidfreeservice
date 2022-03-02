<!doctype html>
<html lang="en">
<head>
    @include('web.layout.head')
</head>
<body>
    <div id='wrapper'>
        <header id="header">
            @include('web.layout.header')
        </header>
        <aside id="sidebar">
            @include('web.layout.sidebar')
        </aside>
        <main id="main" class="main-width-large">
            @section('main')
            @show
        </main>
        <footer id="footer" class="text-blue py-5">
            @include('web.layout.footer')
        </footer>
    </div>
</body>
</html>
