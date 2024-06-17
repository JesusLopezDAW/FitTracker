<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>@yield('title')</title>
</head>

<body style="background-color: #eee">
    <div>

    </div>
    <div class="wrapper">
        <h1 class="title">@yield('title')</h1>
        <p>@yield('message')</p>
    </div>
</body>
<style>
    @import url('https://fonts.googleapis.com/css?family=Lobster&display=swap') repeat scroll 0 0 rgba(0, 0, 0, 0);

    body {
        margin: 0;
        background: #fff;
    }

    .title {
        font-size: 5.6rem;
        font-family: 'Lobster', cursive;
    }
    p{
        font-size: 1.6rem;
    }

    .wrapper {
        background: url("https://images.unsplash.com/photo-1465146633011-14f8e0781093?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=3450&q=80");
        color: #eee;
        width: 100%;
        height: 100vh;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        perspective: 1000px;
        perspective-origin: 50% 50%;
        animation: animation 100s linear infinite;
    }

    @keyframes animation {
        100% {
            background-position: 0px -3000px;
        }
    }
</style>

</html>
