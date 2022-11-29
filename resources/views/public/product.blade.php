<!DOCTYPE html>
<html lang="en">
   <head>
      <title>Neqson</title>
   </head>
   <body>
                @foreach($images as $image)
                  <div>
                     <img  src="/images/{{$image->source}}" />
                  </div>
                @endforeach
   </body>
</html>

