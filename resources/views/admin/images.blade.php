<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="/css/styles.css">
</head>
<body>
    <x-navbar/>
    <h1>{{$title}}</h1>
    <form action="/add/image" method="post" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="id" value="{{$id}}">
        <input type="file" name="image">
        <button type="submit"> Add </button>
    </form>
    <ul>
    @foreach($images as $image)
           <img height="100px" width="100px" src="/images/{{$image->source}}" alt="{{$title}}">
        <form action="/delete/image" method="post">
            @csrf
            @method('DELETE')
            <input type="hidden" name="id" value="{{$image->id}}">
            <input type="hidden" name="image" value="{{$image->source}}">
            <button type="submit" > delete </button>
        </form>

        <form action="/change/image" method="post">
            @csrf
            @method('PUT')
            <input type="hidden" name="id" value="{{$image->id}}">
            <input type="hidden" name="product_id" value="{{$image->product_id}}">
            <button type="submit" > make main </button>
        </form>
    @endforeach
    </ul>
    <form action="/logout" method="post">
        @csrf
        <button type="submit"> log out</button>
    </form>
</body>
</html>