<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="/css/styles.css">
    <title> {{ucfirst($title)}}</title>
</head>
<body>
    <x-navbar/>

    <x-add_form>{{$title}}</x-add_form>

    <x-category_list :categories="$categories" :title="$title"/>
</body>
</html>
