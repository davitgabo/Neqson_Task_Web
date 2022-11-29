<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="/css/styles.css">
</head>
<body>
    <x-navbar/>
    <h1>{{$title}}</h1>
    <form action="/add/image" method="post">
        @csrf
        <input type="hidden" name="id" value="{{$id}}">
        <input type="file" name="image">
        <button type="submit"> Add </button>
    </form>
    <ul>
    @foreach($images as $image)
           <img src="{{$image->source}}" alt="{{$title}}">
    @endforeach
    </ul>
    <form action="/logout" method="post">
        @csrf
        <button type="submit"> log out</button>
    </form>
</body>
</html>
