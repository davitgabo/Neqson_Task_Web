<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="/css/styles.css">
</head>
<body>
    <x-navbar/>

    <form method="post" action="/add/product">
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
        <button type="submit">add</button>
    </form>
    <ul>
    @foreach($products as $product)
        <div class="manipulations">
            <li> {{$product->name}} : {{$product->description}}</li>
            <form action="/edit/path" method="post">
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
        </div>
    @endforeach
    </ul>
    <form action="/logout" method="post">
        @csrf
        <button type="submit"> log out</button>
    </form>
</body>
</html>
