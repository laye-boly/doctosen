<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <meta name="description" content="">
        <meta name="author" content="">

        <title>Doctose -  @yield('title')</title>

        <!-- CSS FILES -->        
        <link rel="preconnect" href="https://fonts.googleapis.com">
        
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        
        <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600;700&display=swap" rel="stylesheet">

        @yield("css")
            
    </head>
    
    <body id="top">
    
        <main>
            @yield("menu")
            
        

            @yield('section-hero')

            @yield("section-booking")
     
            @yield("section-booking")
            @yield("section-about")

            @yield("section-gallery")
        
            @yield("section-timeline")

            
            @yield("section-reviews")
   

        </main>

        @yield("footer")
      
        @yield("js-files")

           
            
       

    </body>
</html>