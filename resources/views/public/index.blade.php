<!DOCTYPE html>
<html lang="en">
   <head>
      <title>Neqson</title>
   </head>

   <body>
                @foreach($categories as $category)
               <div>
                   <a href="/category/{{$category->id}}">
                  <div>
                     <span>{{$category->name}}</span>
                  </div>
                   </a>
               </div>
                @endforeach
   </body>
</html>

