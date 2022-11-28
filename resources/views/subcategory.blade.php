<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="/css/styles.css">
</head>
<body>
    <x-navbar/>

    <form method="post" action="/add/subcategory">
        @csrf
        <input type="text" name="name">
        <button type="submit">add</button>
    </form>
    <ul>
    @foreach($categories as $category)
            <li> <a href="/subcategory/{{$category->name}}">{{$category->name}}</a></li>
    @endforeach
    </ul>
    <form action="/logout" method="post">
        @csrf
        <button type="submit"> log out</button>
    </form>
</body>
</html>
