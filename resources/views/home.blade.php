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

   
            <link href="css/bootstrap.min.css" rel="stylesheet">

            <link href="css/bootstrap-icons.css" rel="stylesheet">

            <link href="css/owl.carousel.min.css" rel="stylesheet">

            <link href="css/owl.theme.default.min.css" rel="stylesheet">

            <link href="css/templatemo-medic-care.css" rel="stylesheet">
            <link rel="stylesheet" href="css/style.doctosen.css">
      

    </head>
    
    <body id="top">
    
        <main>
            <nav class="navbar navbar-expand-lg bg-light fixed-top shadow-lg">
                <div class="container">
                    <a class="navbar-brand mx-auto d-lg-none" href="index.html">
                        Medic Care
                        <strong class="d-block">Health Specialist</strong>
                    </a>
            
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
            
                    <div class="collapse navbar-collapse" id="navbarNav">
                        <ul class="navbar-nav mx-auto">
                            <li class="nav-item active">
                                <a class="nav-link" href="/">Home</a>
                            </li>
            
                            <li class="nav-item">
                                <a class="nav-link" href="{{route('home')}}#about">Qui sommes nous</a>
                            </li>
            
                            <li class="nav-item">
                                <a class="nav-link" href="{{route('home')}}#timeline">Nos services</a>
                            </li>
            
                            
            
                            <li class="nav-item">
                                <a class="nav-link" href="{{route('home')}}#reviews">T??moignages</a>
                            </li>
            
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle"  id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">Prendre un rv</a>
                                <ul class="dropdown-menu bg-F8F9FA" aria-labelledby="dropdownMenuLink">
                    
                                    <li><a class="dropdown-item BDBEC0-color" href="{{route('home')}}#consultation-booking">Consultation en ligne ou en pr??sentiel</a></li>
                                    <li><a class="dropdown-item BDBEC0-color" href="{{route('home')}}#vaccination-booking">Vaccination</a></li>
                                    
                                </ul>
                            </li>
            
                            <li class="nav-item">
                                <a class="nav-link" href="{{route('home')}}#contact">Contact</a>
                            </li>
            
                            @if (Route::has('login'))
            
                                @auth
                                    <li class="nav-item">
                                        <a href="{{ url('/dashboard') }}" class="nav-link">Dashboard</a>
                                    </li>
                            @else
                                <li class="nav-item">
            
                                    <a href="{{ route('login') }}#consultation-booking" class="nav-link">Se connecter</a>
                                </li>
                                @if (Route::has('register'))
                                    <li class="nav-item">
            
                                        <a href="{{ route('register') }}" class="nav-link">S'inscrire</a>
                                    </li>
                                @endif
                                @endauth
            
                             @endif
            
                        </ul>
                    </div>
            
                </div>
            </nav>

                <section class="section-padding" id="booking">
                    <div class="container">
                        <div class="row">
                        
                            <div class="col-lg-12 col-12 mx-auto">
                                <div class="booking-form">
                                    
                                    <h2 class="text-center mb-lg-3 mb-2" id="consultation-booking">Consulation en ligne ou en pr??sentiel</h2>
                                    <div class="form-search">
                                        {!! Form::open(['url' => route('home'), 'class' => 'row g-3 needs-validation', 'id' => 'registration-form']) !!}

                                       <div class="col-md-6">           
                                            {{ Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'nom ou pr??nom du m??decin']) }}
                                        </div>
                                        <div class="col-md-6">           
                                            {{ Form::text('title', null, ['class' => 'form-control', 'placeholder' => 'sp??cialit?? du m??decin']) }}
                                        </div>
                                        <div class="col-md-4">           
                                            {{ Form::text('adress', null, ['class' => 'form-control',  'placeholder' => 'adresse du m??decin']) }}
                                        </div>

                                        <div class="col-md-4">           
                                            {{ Form::date('date', null, ['class' => 'form-control',  'placeholder' => 'date de rendez vous']) }}
                                        </div>

                                        <div class="col-md-6">           
                                            {{Form::select('order_column', ['schedule_date' => 'date du rendez-vous', 'doctor_name' => 'nom du m??decin', 'doctor_title' => 'sp??cialit??', 'doctor_adress' => 'adresse du m??decin'], null, ['placeholder' => 'Ordonner par']) }}
                                        </div>

                                        <div class="col-md-6">           
                                            {{Form::select('order_by', ['asc' => 'Par odre croissant', 'desc' => 'Par odre d??croissant'], null, ['placeholder' => "Le sens de l'ordre"]) }}
                                        </div>
                                        {{Form::hidden('table_name', 'schedules') }}
                                        <div class="col-md-4"> 
                                            {{Form::submit('Rechercher', ['class'=>'btn btn-primary'])}}
                                        </div>
                                        
                                        {!! Form::close() !!}
                                    </div>
                                    @if(count($consultationsSchedules) > 0)
                                        <table class="table table-striped mt-5 mb-5">
                                            <thead>
                                            <tr>
                                                <th>Pr??nom et nom du m??decin </th>
                                                <th>Titre / Sp??cialit??</th>
                                                <th>date de disponibilit??</th>
                                                <th>Intervalle de disponibilt??</th>
                                                <th>Prendre un Rv</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($consultationsSchedules as $consultationSchedule)
                                                    <tr>
                                                        <td>{{ $consultationSchedule->userFirstName}} {{ $consultationSchedule->userLastName }}</td>
                                                        <td>{{ $consultationSchedule->userTitle }}</td>
                                                        <td>{{ $consultationSchedule->scheduleDate }}</td>
                                                        <td>{{ $consultationSchedule->scheduleStartTime }} - {{ $consultationSchedule->scheduleEndTime }}</td>
                                                        <td><a href="{{ route('appointement.create', ['schedule' => $consultationSchedule->scheduleId, 'doctor' => $consultationSchedule->userId]) }}"><i class="bi bi-calendar-date"></i></a></td>
                                                    </tr>
                                                @endforeach
        
                                            </tbody>
                                        </table>
                                        
                                        <div class="d-flex justify-content-center">
                                            {!! $consultationsSchedules->links() !!}
                                        </div>
                                    @else
                                        <div>
                                            <h6 class="text-center">Aucun r??sultat ne correspond ?? votre</h6>
                                        </div>
                                    @endif
                                   
            
                                </div>

                                <div class="booking-form mt-5 pd-5">
                                    <h2 class="text-center mb-lg-3 mb-2" id="vaccination-booking">Vaccination</h2>
                                    <div class="form-search">
                                        {!! Form::open(['url' => route('home'), 'class' => 'row g-3 needs-validation']) !!}

                                       <div class="col-md-6">           
                                            {{ Form::text('name', null, ['class' => 'form-control', 'placeholder' => "nom de l'h??pital"]) }}
                                        </div>
                                        <div class="col-md-6">           
                                            {{ Form::text('vaccine_name', null, ['class' => 'form-control', 'placeholder' => 'nom du vaccin']) }}
                                        </div>
                                        <div class="col-md-6">           
                                            {{ Form::text('vaccine_type', null, ['class' => 'form-control', 'placeholder' => 'type du vaccin']) }}
                                        </div>
                                        <div class="col-md-4">           
                                            {{ Form::text('adress', null, ['class' => 'form-control',  'placeholder' => "adresse de l'h??pital"]) }}
                                        </div>

                                        <div class="col-md-4">           
                                            {{ Form::date('date', null, ['class' => 'form-control',  'placeholder' => 'date de rendez vous']) }}
                                        </div>

                                        <div class="col-md-6">           
                                            {{Form::select('order_column', ['schedule_date' => 'date du rendez-vous', 'vaccine_name' => 'nom du vaccin', 'vaccine_type' => 'type de vaccin', 'hospital_name' => "nom de l'h??pital"], null, ['placeholder' => 'Ordonner par']) }}
                                        </div>

                                        <div class="col-md-6">           
                                            {{Form::select('order_by', ['asc' => 'Par odre croissant', 'desc' => 'Par odre d??croissant'], null, ['placeholder' => "Le sens de l'ordre"]) }}
                                        </div>
                                        {{Form::hidden('table_name', 'hospitals') }}
                                        <div class="col-md-4"> 
                                            {{Form::submit('Rechercher', ['class'=>'btn btn-primary'])}}
                                        </div>
                                        
                                        {!! Form::close() !!}
                                    </div>
                                    @if(count($vaccinesSchedules) > 0)
                                        <table class="table table-striped mt-5">
                                            <thead>
                                            <tr>
                                                <th>Nom du vaccin </th>
                                                <th>type du vaccin</th>
                                                <th>Quantit?? disponible</th>
                                                <th>Date de vaccination</th>
                                                <th>Heure de d??but</th>
                                                <th>Heure de fin</th>
                                                <th>H??pital</th>
                                                <th>Adresse</th>
                                                <th>T??l??phone</th>
                                                <th>Prendre RV</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($vaccinesSchedules as $vaccineSchedule)
                                                    <tr>
                                                        <td>{{ $vaccineSchedule->vaccineName}} </td>
                                                        <td>{{ $vaccineSchedule->vaccineType }}</td>
                                                        <td>{{ $vaccineSchedule->vaccineTotal }}</td>
                                                        <td>{{ $vaccineSchedule->scheduleDate }}</td>
                                                        <td>{{ $vaccineSchedule->scheduleStartTime }}</td>
                                                        <td>{{ $vaccineSchedule->scheduleEndTime }}</td>
                                                        <td>{{ $vaccineSchedule->hospitalName }}</td>
                                                        <td>{{ $vaccineSchedule->hospitalAdress }}</td>
                                                        <td>{{ $vaccineSchedule->hospitalPhone }}</td>
                                                       
                                                        <td>
                                                            @if(Auth::user())
                                                                <a href="{{ route('vaccine.appointement.create', ['schedule_id' => $vaccineSchedule->scheduleId, 'patient_id' => Auth::user()->id]) }}"><i class="bi bi-calendar-date"></i></a>
                                                            @else
                                                            <a href="{{route('login')}}">Connctez vous !</a>
                                                            @endif
                                                        </td>
                                                        
                                                    </tr>
                                                @endforeach
        
                                            </tbody>
                                        </table>
                                    
                                        
                                        <div class="d-flex justify-content-center">
                                            {!! $vaccinesSchedules->links() !!}
                                        </div>
                                    @else
                                        <div>
                                            <h6 class="text-center">Aucun r??sultat ne correspond ?? cette recherche</h6>
                                        </div>
                                    @endif
                                   

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
                                        <h3 class=" text-light">T??l??consultation</h3>

                                        <p>Donec facilisis urna dui, a dignissim mauris pretium a. Quisque quis libero fermentum, tempus felis eu, consequat nibh.</p>
                                    </div>

                                    <div class="col-3 col-sm-1 order-2 timeline-icons text-md-center">
                                        <i class="bi bi-camera-video-fill"></i>
                                    </div>

                                    <div class="col-9 col-md-5 ps-md-3 ps-lg-0 order-1 order-md-3 py-4 timeline-date">
                                        <p>R??servez un rendez-vous avec un de nos m??decins et fa??tes vous
                                            consulter depuis le confort de chez vous !
                                        </p>
                                    </div>
                                </div>

                                <div class="row g-0 justify-content-end justify-content-md-around align-items-start timeline-nodes my-lg-5 my-4">
                                    <div class="col-9 col-md-5 ms-md-4 ms-lg-0 order-3 order-md-1 timeline-content bg-white shadow-lg">
                                        <h3 class=" text-light">Consulation en pr??sentiel</h3>

                                        <p>Donec facilisis urna dui, a dignissim mauris pretium a. Quisque quis libero fermentum, tempus felis eu, consequat nibh.</p>
                                    </div>

                                    <div class="col-3 col-sm-1 order-2 timeline-icons text-md-center">
                                        <i class="bi bi-person-square"></i>
                                    </div>

                                    <div class="col-9 col-md-5 pe-md-3 pe-lg-0 order-1 order-md-3 py-4 timeline-date">
                                        <p>R??servez un rendez-vous avec un de nos m??decins ! T??l??charger votre rendez-vous depuis votre
                                            tableau de bord et rendez-vous chez le m??decin !
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
                                        <p>R??servez un rendez-vous avec une de nos structures sanitaires sur place ! T??l??charger votre rendez-vous depuis votre
                                            tableau de bord et pr??sentez-le jours du rendez vous !
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
                            <p class="copyright-text">Copyright ?? Medic Care 2021 
                            <br><br>Design: <a href="https://templatemo.com" target="_parent">TemplateMo</a></p>
                        </div>

                    </div>
                </section>
            </footer>

           
            <script src="js/jquery.min.js"></script>
            <script src="js/bootstrap.bundle.min.js"></script>
            <script src="js/owl.carousel.min.js"></script>
            <script src="js/scrollspy.min.js"></script>
            <script src="js/custom.js"></script>
     
    </body>
</html>