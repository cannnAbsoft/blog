<html>
<header>
    <link rel="stylesheet" href="/app.css">
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
</header>
<body>
<h1>Đây là layout, bạn đã kế thừa thành công.</h1>
@if(session()->has('success'))
<div x-data="{show:true}"
x-init="setTimeout(()=> show = false,4000)"
x-show="show"
>
    <p>{{session('success')}}</p>
</div>
@endif
<article>
    @auth
        <a style="color: red">Welcome, {{auth()->user()->name}}</a>
        <form action="/logout" method="post">
            @csrf
            <button type="submit">Logout</button>
        </form>
    @else
    <a href="/register">Register</a>
        <a href="/login">Login</a>
    @endauth
   @yield('content')
</article>
</body>
</html>
