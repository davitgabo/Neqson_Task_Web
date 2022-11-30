<!DOCTYPE html>
<html lang="en">
   <head>
      <title>Neqson</title>
   </head>
   <body>
        @foreach($categories as $subcategory)
        <div>
            <a href="{{request()->getRequestUri().'/'.$subcategory->id}}">
            <div><h3>{{$subcategory->name}}</h3></div>
            </a>
        </div>
        @endforeach
   </body>
</html>

