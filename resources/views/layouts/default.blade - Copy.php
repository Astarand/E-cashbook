
<!doctype html>
<html lang="en">

<head>
    @include('includes.head')
</head>
<body>

        @include('includes.header')
    

    <!--<div id="main" class="content">-->

            @yield('content')

    <!--</div>-->

    <footer class="mainFooter">
        @include('includes.footer')
    </footer>


</body>
</html>