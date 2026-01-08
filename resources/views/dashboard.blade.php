<!DOCTYPE html>
<html lang="fa">
<head>
    <meta charset="UTF-8">
    <title>داشبورد</title>
</head>
<body>
    <h1>سلام {{ auth()->user()->name }}</h1>

    <form method="POST" action="/logout">
        @csrf
        <button type="submit">خروج</button>
    </form>
</body>
</html>