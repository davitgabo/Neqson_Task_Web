<!DOCTYPE html>
<html lang="en">
   <head>
      <title>Neqson</title>
   </head>
   <!-- body -->
   <body class="main-layout footer_to90 project_page">
      <!-- loader  -->
      <!-- end loader -->
      <!-- header -->

      <!-- end header inner -->
      <!-- end header -->
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
      <!-- project section -->
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
      <!-- end project section -->

      <!-- Javascript files-->
      <script src="js/jquery.min.js"></script>
      <script src="js/popper.min.js"></script>
      <script src="js/bootstrap.bundle.min.js"></script>
      <script src="js/jquery-3.0.0.min.js"></script>
      <!-- sidebar -->
      <script src="js/jquery.mCustomScrollbar.concat.min.js"></script>
      <script src="js/custom.js"></script>
   </body>
</html>

