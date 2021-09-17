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
        <link href="../../../css/bootstrap.min.css" rel="stylesheet">

        <link href="../../../css/bootstrap-icons.css" rel="stylesheet">

        <link href="../../../../css/owl.carousel.min.css" rel="stylesheet">

        <link href="../../../css/owl.theme.default.min.css" rel="stylesheet">

        <link href="../../../css/templatemo-medic-care.css" rel="stylesheet">
      

    </head>
    
    <body id="top">
    
        <main>
            @include("inc.menu")

                <section class="section-padding" id="booking">
                    <div class="container">
                        <div class="row">
                        
                            <div class="col-lg-12 col-12 mx-auto">
                                <div class="booking-form">
                                    
                                    <h5 class="text-center mb-lg-3 mb-2"> Ajouter un diplôme</h5>
                                    @if(session('success-diploma'))
                                        <div class="alert alert-danger">
                                            {{ session('success-diploma') }}
                                        </div>
                                    @endif
                                    @if($errors->any())
                                        <ul class="alert alert-danger">
                                            @foreach ($errors->all() as $error )
                                                <li>{{$error}}</li>
                                            @endforeach
                                        </ul>
                                    @endif

                                    @if ($duplication == true)
                                        <div class="alert alert-danger">
                                            Vous déja un diplôme avec le même titre
                                        </div>
                                    @endif

                            {!! Form::open(['url' => route("diploma.store"), 'files' => true]) !!}

                                <div class="form-group">
                                    {{Form::label('title ', 'titre du diplome')}}
                                    {{Form::text('title', '', ['class' => 'form-control', 'placeholder' => 'le titre du diplome'])}}
                                </div>
                                <div class="form-group">
                                    {{Form::label('year ', "année d'obtention du diplôme")}}
                                    {{Form::text('year', '', ['class' => 'form-control', 'placeholder' => "année d'obtention du diplôme"])}}
                                </div>
                                <div class="form-group">
                                    {{Form::label('image', "télécharger votre diplôme ")}}
                                    {{Form::file('image')}}
                                </div>

                                {{Form::submit('Submit', ['class'=>'btn btn-primary'])}}
                            {!! Form::close() !!}
                            
                            
            
                            

                                </div>

                            </div>

                        </div>
                    </div>
                </section>
                <section class="hero" id="hero">
                    <div class="container">
                        <div class="row">

                            <div class="col-12">
                                <div id="myCarousel" class="carousel slide carousel-fade" data-bs-ride="carousel">
                                    <div class="carousel-inner">
                                        <div class="carousel-item active">
                                            <img src="images/slider/portrait-successful-mid-adult-doctor-with-crossed-arms.jpg" class="img-fluid" alt="">
                                        </div>

                                        <div class="carousel-item">
                                            <img src="images/slider/young-asian-female-dentist-white-coat-posing-clinic-equipment.jpg" class="img-fluid" alt="">
                                        </div>

                                        <div class="carousel-item">
                                            <img src="images/slider/doctor-s-hand-holding-stethoscope-closeup.jpg" class="img-fluid" alt="">
                                        </div>
                                    </div>
                                </div>

                                <div class="heroText d-flex flex-column justify-content-center">

                                    <h1 class="mt-auto mb-2">
                                        Better
                                        <div class="animated-info">
                                            <span class="animated-item">health</span>
                                            <span class="animated-item">days</span>
                                            <span class="animated-item">lives</span>
                                        </div>
                                    </h1>

                                    <p class="mb-4">Medic Care is a Bootstrap 5 Template provided by TemplateMo website. Credits go to FreePik and RawPixel for images used in this template.</p>

                                    <div class="heroLinks d-flex flex-wrap align-items-center">
                                        <a class="custom-link me-4" href="#about" data-hover="Learn More">Learn More</a>

                                        <p class="contact-phone mb-0"><i class="bi-phone"></i> 010-020-0340</p>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </section>

                <section class="section-padding" id="about">
                    <div class="container">
                        <div class="row">

                            <div class="col-lg-6 col-md-6 col-12">
                                <h2 class="mb-lg-3 mb-3">Meet Dr. Carson</h2>

                                <p>Protect yourself and others by wearing masks and washing hands frequently. Outdoor is safer than indoor for gatherings or holding events. People who get sick with Coronavirus disease (COVID-19) will experience mild to moderate symptoms and recover without special treatments.</p>

                                <p>You can feel free to use this CSS template for your medical profession or health care related websites. You can <a rel="nofollow" href="http://paypal.me/templatemo" target="_blank">support us a little</a> via PayPal if this template is good and useful for your work.</p>
                            </div>

                            <div class="col-lg-4 col-md-5 col-12 mx-auto">
                                <div class="featured-circle bg-white shadow-lg d-flex justify-content-center align-items-center">
                                    <p class="featured-text"><span class="featured-number">12</span> Years<br> of Experiences</p>
                                </div>
                            </div>

                        </div>
                    </div>
                </section>

                <section class="gallery">
                    <div class="container">
                        <div class="row">

                            <div class="col-lg-6 col-6 ps-0">
                                <img src="images/gallery/medium-shot-man-getting-vaccine.jpg" class="img-fluid galleryImage" alt="get a vaccine" title="get a vaccine for yourself">
                            </div>

                            <div class="col-lg-6 col-6 pe-0">
                                <img src="images/gallery/female-doctor-with-presenting-hand-gesture.jpg" class="img-fluid galleryImage" alt="wear a mask" title="wear a mask to protect yourself">
                            </div>

                        </div>
                    </div>
                </section>
        
                <section class="section-padding pb-0" id="timeline">
                    <div class="container">
                        <div class="row">

                            <h2 class="text-center mb-lg-5 mb-4">Nos services</h2>
                            
                            <div class="timeline">
                                <div class="row g-0 justify-content-end justify-content-md-around align-items-start timeline-nodes">
                                    <div class="col-9 col-md-5 me-md-4 me-lg-0 order-3 order-md-1 timeline-content bg-white shadow-lg">
                                        <h3 class=" text-light">Téléconsultation</h3>

                                        <p>Donec facilisis urna dui, a dignissim mauris pretium a. Quisque quis libero fermentum, tempus felis eu, consequat nibh.</p>
                                    </div>

                                    <div class="col-3 col-sm-1 order-2 timeline-icons text-md-center">
                                        <i class="bi bi-camera-video-fill"></i>
                                    </div>

                                    <div class="col-9 col-md-5 ps-md-3 ps-lg-0 order-1 order-md-3 py-4 timeline-date">
                                        <p>Réservez un rendez-vous avec un de nos médecins et faîtes vous
                                            consulter depuis le confort de chez vous !
                                        </p>
                                    </div>
                                </div>

                                <div class="row g-0 justify-content-end justify-content-md-around align-items-start timeline-nodes my-lg-5 my-4">
                                    <div class="col-9 col-md-5 ms-md-4 ms-lg-0 order-3 order-md-1 timeline-content bg-white shadow-lg">
                                        <h3 class=" text-light">Consulation en présentiel</h3>

                                        <p>Donec facilisis urna dui, a dignissim mauris pretium a. Quisque quis libero fermentum, tempus felis eu, consequat nibh.</p>
                                    </div>

                                    <div class="col-3 col-sm-1 order-2 timeline-icons text-md-center">
                                        <i class="bi bi-person-square"></i>
                                    </div>

                                    <div class="col-9 col-md-5 pe-md-3 pe-lg-0 order-1 order-md-3 py-4 timeline-date">
                                        <p>Réservez un rendez-vous avec un de nos médecins ! Télécharger votre rendez-vous depuis votre
                                            tableau de bord et rendez-vous chez le médecin !
                                        </p>
                                    </div>
                                </div>

                                <div class="row g-0 justify-content-end justify-content-md-around align-items-start timeline-nodes">
                                    <div class="col-9 col-md-5 me-md-4 me-lg-0 order-3 order-md-1 timeline-content bg-white shadow-lg">
                                        <h3 class=" text-light">Vaccination</h3>

                                        <p>Phasellus eleifend, urna interdum congue viverra, arcu neque ultrices ligula, id pulvinar nisi nibh et lacus. Vivamus gravida, ipsum non euismod tincidunt, sapien elit fermentum mi, quis iaculis enim ligula at arcu.</p>
                                    </div>

                                    <div class="col-3 col-sm-1 order-2 timeline-icons text-md-center">
                                        <i class="bi bi-eyedropper"></i>
                                    </div>

                                    <div class="col-9 col-md-5 ps-md-3 ps-lg-0 order-1 order-md-3 py-4 timeline-date">
                                        <p>Réservez un rendez-vous avec une de nos structures sanitaires sur place ! Télécharger votre rendez-vous depuis votre
                                            tableau de bord et présentez-le jours du rendez vous !
                                        </p>
                                    </div>
                                </div>

                     
                            </div>

                        </div>
                    </div>
                </section>
          
                <section class="section-padding pb-0" id="reviews">
                    <div class="container">
                        <div class="row">

                            <div class="col-12">
                                <h2 class="text-center mb-lg-5 mb-4"></h2>

                                <div class="owl-carousel reviews-carousel">

                                    <figure class="reviews-thumb d-flex flex-wrap align-items-center rounded">
                                        <div class="reviews-stars">
                                            <i class="bi-star-fill"></i>
                                            <i class="bi-star-fill"></i>
                                            <i class="bi-star-fill"></i>
                                            <i class="bi-star-fill"></i>
                                            <i class="bi-star"></i>
                                        </div>

                                        <p class="text-primary d-block mt-2 mb-0 w-100"><strong>Best Health Care</strong></p>

                                        <p class="reviews-text w-100">Phasellus ligula ante, tempus ac imperdiet ut, mattis ac nibh. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.</p>

                                        <img src="images/reviews/beautiful-woman-face-portrait-brown-background.jpeg" class="img-fluid reviews-image" alt="">

                                        <figcaption class="ms-4">
                                            <strong>Marie</strong>

                                            <span class="text-muted">Patient</span>
                                        </figcaption>
                                    </figure>

                                    <figure class="reviews-thumb d-flex flex-wrap align-items-center rounded">
                                        <div class="reviews-stars">
                                            <i class="bi-star-fill"></i>
                                            <i class="bi-star-fill"></i>
                                            <i class="bi-star-fill"></i>
                                            <i class="bi-star-fill"></i>
                                            <i class="bi-star"></i>
                                        </div>

                                        <p class="text-primary d-block mt-2 mb-0 w-100"><strong>Doctor cares everyone!</strong></p>

                                        <p class="reviews-text w-100">Donec in elementum orci, nec posuere ligula. Quisque vulputate diam et ullamcorper ullamcorper. Pellentesque vestibulum neque at leo fermentum mattis.</p>

                                        <img src="images/reviews/senior-man-wearing-white-face-mask-covid-19-campaign-with-design-space.jpeg" class="img-fluid reviews-image" alt="">

                                        <figcaption class="ms-4">
                                            <strong>Ben Walker</strong>

                                            <span class="text-muted">Recovered</span>
                                        </figcaption>
                                    </figure>

                                    <figure class="reviews-thumb d-flex flex-wrap align-items-center rounded">
                                        <div class="reviews-stars">
                                            <i class="bi-star-fill"></i>
                                            <i class="bi-star-fill"></i>
                                            <i class="bi-star-fill"></i>
                                            <i class="bi-star-fill"></i>
                                            <i class="bi-star-fill"></i>
                                        </div>

                                        <p class="text-primary d-block mt-2 mb-0 w-100"><strong>Great services!</strong></p>

                                        <p class="reviews-text w-100">Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae; Donec sit amet velit vitae purus aliquam efficitur.</p>

                                        <img src="images/reviews/portrait-british-woman.jpeg" class="img-fluid reviews-image" alt="">

                                        <figcaption class="ms-4">
                                            <strong>Laura Zono</strong>

                                            <span class="text-muted">New Patient</span>
                                        </figcaption>
                                    </figure>

                                    <figure class="reviews-thumb d-flex flex-wrap align-items-center rounded">
                                        <div class="reviews-stars">
                                            <i class="bi-star-fill"></i>
                                            <i class="bi-star-fill"></i>
                                            <i class="bi-star-fill"></i>
                                            <i class="bi-star"></i>
                                            <i class="bi-star"></i>
                                        </div>

                                        <p class="text-primary d-block mt-2 mb-0 w-100"><strong>Best Advices</strong></p>

                                        <p class="reviews-text w-100">Integer posuere erat a ante venenatis dapibus posuere velit aliquet. Maecenas faucibus mollis interdum. Donec ullamcorper nulla non metus auctor fringilla.</p>

                                        <img src="images/reviews/woman-wearing-mask-face-closeup-covid-19-green-background.jpeg" class="img-fluid reviews-image" alt="">

                                        <figcaption class="ms-4">
                                            <strong>Rosey</strong>

                                            <span class="text-muted">Almost Recovered</span>
                                        </figcaption>
                                    </figure>
                                
                                </div>
                            </div>

                        </div>
                    </div>
                </section>
         
                
  

        </main>

            <footer class="site-footer section-padding" id="contact">
                <div class="container">
                    <div class="row">

                        <div class="col-lg-5 me-auto col-12">
                            <h5 class="mb-lg-4 mb-3">Opening Hours</h5>

                            <ul class="list-group list-group-flush">
                                <li class="list-group-item d-flex">
                                    Sunday : Closed
                                </li>

                                <li class="list-group-item d-flex">
                                    Monday, Tuesday - Firday
                                    <span>8:00 AM - 3:30 PM</span>
                                </li>

                                <li class="list-group-item d-flex">
                                    Saturday
                                    <span>10:30 AM - 5:30 PM</span>
                                </li>
                            </ul>
                        </div>

                        <div class="col-lg-2 col-md-6 col-12 my-4 my-lg-0">
                            <h5 class="mb-lg-4 mb-3">Our Clinic</h5>

                            <p><a href="mailto:hello@company.co">hello@company.co</a><p>

                            <p>123 Digital Art Street, San Diego, CA 92123</p>
                        </div>

                        <div class="col-lg-3 col-md-6 col-12 ms-auto">
                            <h5 class="mb-lg-4 mb-3">Socials</h5>

                            <ul class="social-icon">
                                <li><a href="#" class="social-icon-link bi-facebook"></a></li>

                                <li><a href="#" class="social-icon-link bi-twitter"></a></li>

                                <li><a href="#" class="social-icon-link bi-instagram"></a></li>

                                <li><a href="#" class="social-icon-link bi-youtube"></a></li>
                            </ul>
                        </div>

                        <div class="col-lg-3 col-12 ms-auto mt-4 mt-lg-0">
                            <p class="copyright-text">Copyright © Medic Care 2021 
                            <br><br>Design: <a href="https://templatemo.com" target="_parent">TemplateMo</a></p>
                        </div>

                    </div>
                </section>
            </footer>

           
            <!-- JAVASCRIPT FILES -->
          <!-- JAVASCRIPT FILES -->
         
          <script src="../../../../../js/jquery.min.js"></script>
          <script src="../../../../../js/bootstrap.bundle.min.js"></script>
          <script src="../../../../../js/owl.carousel.min.js"></script>
          <script src="../../../../../js/scrollspy.min.js"></script>
          <script src="../../../../../js/custom.js"></script>
     
    </body>
</html>