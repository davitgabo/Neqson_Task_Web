<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="/css/styles.css">
</head>
<body>
    <x-navbar/>

    <form method="post" action="/add/product"  enctype="multipart/form-data">
        @csrf
        <label for="name"> Product Name</label>
        <input type="text" name="name" id="name">
        <label for="description"> Product description</label>
        <input type="text" name="description" id="description">
        <label for="category"> choose category</label>
        <select name="category" id="category">
            @foreach($categories as $category)
                <option value="{{$category->id}}">{{$category->name}}</option>
            @endforeach
        </select>
        <label for="category"> choose subcategory</label>
        <select name="subcategory" id="subcategory">
            @foreach($subcategories as $category)
                <option value="{{$category->id}}">{{$category->name}}</option>
            @endforeach
        </select>
        <label for="category"> choose subsubcategory</label>
        <select name="subsubcategory" id="subsubcategory">
            @foreach($subsubcategories as $category)
                <option value="{{$category->id}}">{{$category->name}}</option>
            @endforeach
        </select>
        <label for="image"> Upload main image</label>
        <input type="file" name="image" id="image">
        <button type="submit">add</button>
    </form>

    @foreach($products as $product)
        <div class="manipulations">
            <a href="/admin/gallery/{{$product->id}}">
                <img width="100px" src="/images/{{$product->image}}">
                <h3>{{$product->name}} : {{$product->description}}</h3>
            </a>
            <form action="/edit/product/path" method="post">
                @csrf
                @method('PUT')
                <input type="hidden" name="id" value="{{$product->id}}">
                <select name="category" id="category">
                    @foreach($categories as $category)
                        <option value="{{$category->id}}" @if($category->name == $product->category) selected @endif>
                            {{$category->name}}
                        </option>
                    @endforeach
                </select>
                <select name="subcategory" id="subcategory">
                    @foreach($subcategories as $category)
                        <option value="{{$category->id}}" @if($category->name == $product->subcategory) selected @endif>
                            {{$category->name}}
                        </option>
                    @endforeach
                </select>
                <select name="subsubcategory" id="subsubcategory">
                    @foreach($subsubcategories as $category)
                        <option value="{{$category->id}}" @if($category->name == $product->subsubcategory) selected @endif>
                            {{$category->name}}
                        </option>
                    @endforeach
                </select>
                <button type="submit">change</button>
            </form>

            <form action="/delete/product/{{$product->id}}" method="post">
                @csrf
                @method('DELETE')
                <button type="submit" style="background-color: red"> DELETE</button>
            </form>
        </div>
    @endforeach

</body>
</html>
