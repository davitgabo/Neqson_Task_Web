<!DOCTYPE html>
<html lang="en">
   <head>
      <title>Neqson</title>
   </head>
   <body class="main-layout footer_to90 project_page">
      <div class="blue_bg">
         <div class="container">
            <div class="row">
               <div class="col-md-12">
                  <div class="titlepage">
                     <h2>Featured Products</h2>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <div id="project" class="project">
         <div class="container">


            <div class="row">
            <div class="product_main">
                @foreach($products as $product)
                    <a href="/product/{{$product->id}}">
                  <div>
                     <img  src="/images/{{$product->image}}" alt="#"/>
                     <h3>{{$product->name}}</h3>
                  </div>
                    </a>
                @endforeach
            </div>
            </div>
         </div>
      </div>

   </body>
</html>

