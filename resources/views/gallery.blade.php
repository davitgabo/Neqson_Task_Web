<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="/css/styles.css">
</head>
<body>
    <x-navbar/>
    <ul>
    @foreach($products as $product)
            <li> <a href="/admin/gallery/{{$product->id}}"> {{$product->name}} </a></li>
    @endforeach
    </ul>
    <form action="/logout" method="post">
        @csrf
        <button type="submit"> log out</button>
    </form>
</body>
</html>
