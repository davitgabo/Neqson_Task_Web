<!DOCTYPE html>
<html lang="en">
   <head>
      <title>Neqson</title>
   </head>
   <body>
        @foreach($subcategories as $subcategory)
        <div>
            <a href="{{request()->getRequestUri().'/'.$subcategory->id}}">
            <div><h3>{{$subcategory->name}}</h3></div>
            </a>
        </div>
        @endforeach
   </body>
</html>

