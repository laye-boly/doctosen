<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <meta name="description" content="">
        <meta name="author" content="">

        <title>Medic Care Bootstrap 5 CSS Template</title>

        <!-- CSS FILES -->
        <link rel="preconnect" href="https://fonts.googleapis.com">

        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

        <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600;700&display=swap" rel="stylesheet">

        <link href="../../../css/bootstrap.min.css" rel="stylesheet">

        <link href="../../../css/bootstrap-icons.css" rel="stylesheet">

        <link href="../../../../css/owl.carousel.min.css" rel="stylesheet">

        <link href="../../../css/owl.theme.default.min.css" rel="stylesheet">

        <link href="../../../css/templatemo-medic-care.css" rel="stylesheet">
<!--

TemplateMo 566 Medic Care

https://templatemo.com/tm-566-medic-care

-->
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
                                <a class="nav-link" href="#hero">Home</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="#about">About</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="#timeline">Timeline</a>
                            </li>

                            <a class="navbar-brand d-none d-lg-block" href="index.html">
                                Medic Care
                                <strong class="d-block">Health Specialist</strong>
                            </a>

                            <li class="nav-item">
                                <a class="nav-link" href="#reviews">Testimonials</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="#booking">Booking</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="#contact">Contact</a>
                            </li>

                            @if (Route::has('login'))

                                @auth
                                    <li class="nav-item">
                                        <a href="{{ url('/dashboard') }}" class="nav-link">Dashboard</a>
                                    </li>
                            @else
                                <li class="nav-item">

                                    <a href="{{ route('login') }}" class="nav-link">Log in</a>
                                </li>
                                @if (Route::has('register'))
                                    <li class="nav-item">

                                        <a href="{{ route('register') }}" class="nav-link">Register</a>
                                    </li>
                                @endif
                                @endauth

                             @endif

                        </ul>
                    </div>

                </div>
            </nav>

            <section class="hero" id="hero">
                <div class="container">
                    <div class="alert alert-info" role="alert">
                        Vos emplois de temps
                    </div>
                    @if ($errorTime != "no")
                    <div class="alert alert-danger" role="alert">
                        {{$errorTime}}
                    </div>
                    @endif

                    @if ($errorDate != "no")
                    <div class="alert alert-danger" role="alert">
                        {{$errorDate}}
                    </div>
                    @endif
                <div class="row">
                    <div class="card col-md-6">
                        {!! Form::open(['route' => ['schedule.update', $schedule->id]]) !!}

                        <div class="mb-3">
                        {{ Form::label('scheduleDate', 'date de votre disponibilité',  ['class' => 'form-label']) }}
                        {{ Form::date('scheduleDate', $schedule->schedule_date,  ['class' => 'form-control']) }}
                        </div>
                        <div class="mb-3">
                        {{ Form::label('startTime', 'heure de début de votre disponibilité',  ['class' => 'form-label']) }}
                        {{ Form::text('startTime', $schedule->start_time,  ['class' => 'form-control']) }}
                        </div>
                        <div class="mb-3">
                        {{ Form::label('endTime', 'heure de fin de votre disponibilité',  ['class' => 'form-label']) }}
                        {{ Form::text('endTime', $schedule->end_time,  ['class' => 'form-control']) }}
                        </div>
                        <div class="mb-3">
                        {{ Form::label('consultationDuration', 'durée moyenne de la consultation en minutes',  ['class' => 'form-label']) }}
                        {{ Form::text('consultationDuration', $schedule->consultation_duration,  ['class' => 'form-control']) }}

                        </div>

                        <div class="mb-3">
                            {{ Form::label('status', 'status',  ['class' => 'form-label']) }}
                            {{ Form::number('status', '',  ['class' => 'form-control', 'placeholder' => "1 si c'est actif 0 sinon"]) }}

                            </div>

                        {{Form::submit('Valider', ['class'=>'btn btn-primary'])}}

                        {!! Form::close() !!}
                    </div>
                </div>











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
        <script src="../../js/jquery.min.js"></script>
        <script src="../../js/bootstrap.bundle.min.js"></script>
        <script src="../../js/owl.carousel.min.js"></script>
        <script src="../../js/scrollspy.min.js"></script>
        <script src="../../js/custom.js"></script>
<!--

TemplateMo 566 Medic Care

https://templatemo.com/tm-566-medic-care

-->
    </body>
</html>