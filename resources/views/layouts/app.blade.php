<html>
<head>
    <title>@yield('title') | UA-Help.pp.ua</title>
</head>
<body>
<form method="POST" action="{{ route('locale.switch') }}">

</form>
@yield('top-menu')

<div class="container">
    *** @yield('content') ***
</div>
</body>
</html>
