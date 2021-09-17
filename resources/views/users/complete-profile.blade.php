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

   
            <link href="../../css/bootstrap.min.css" rel="stylesheet">

            <link href="../../css/bootstrap-icons.css" rel="stylesheet">

            <link href="../../css/owl.carousel.min.css" rel="stylesheet">

            <link href="../../css/owl.theme.default.min.css" rel="stylesheet">

            <link href="../../css/templatemo-medic-care.css" rel="stylesheet">
            
      

    </head>
    
    <body id="top">
    
        <main>
            @include("inc.menu")

            <section class="hero" id="hero">
                <div class="container">
                    <div class="alert alert-info" role="alert">
                        Complétez votre profil avant de pouvoir commencer les consultations.
                    </div>
                    <div class="row">
                        <div class="card col-md-6">
                            <div class="card-header">
                                Renseignement sur votre structure sanitaire
                            </div>
                            <div class="card-body">
                                @if ($errors->has("name") || $errors->has("phone") || $errors->has("adress "))
                                    <div class="alert alert-danger">
                                        <ul>

                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach

                                        </ul>
                                    </div>
                                @endif

                                @if (count($hospitals) == 0 )
                                    
                            
                                    {!! Form::open(['url' => route('hospital.store')]) !!}
                                    <div class="form-group">
                                        {{Form::label('nom ', 'nom')}}
                                        {{Form::text('name', '', ['class' => 'form-control', 'placeholder' => 'nom du lieu de travail'])}}
                                    </div>
                                    <div class="form-group">
                                        {{Form::label('adress ', 'adresse')}}
                                        {{Form::text('adress', '', ['class' => 'form-control', 'placeholder' => 'adresse du lieu de travail'])}}
                                    </div>
                                    <div class="form-group">
                                        {{Form::label('phone ', 'téléphone')}}
                                        {{Form::text('phone', '', ['class' => 'form-control', 'placeholder' => 'lieu de travail'])}}
                                    </div>
                                    {{Form::hidden('uri', '/user/profile/complete')}}

                                    {{Form::submit('Submit', ['class'=>'btn btn-primary'])}}
                                    {!! Form::close() !!}

                                @else

                                    @if (session('success-hospital'))
                                    <div class="alert alert-success">
                                        <p>{{ session('success-hospital') }}</p> 
                                        
                                    </div>
                                    @else
                                    <p class="text-start">Vous avez déja renseigné cette partie</p>
                                    @endif
                                    <div class="text-end"><a href="{{route('hospital.show', ['hospital' => $hospitals[0]->id])}}">Voir les détails</a></div>
                                    <p class="text-end"><a href="{{route('hospital.edit', ['hospital' => $hospitals[0]->id])}}">Modifier</a></p>

                                @endif
                            </div>
                            </div>
                            @if(Auth::user()->type != "hospital")
                            <div class="card col-md-6">
                            <div class="card-header">
                                Télécharger votre diplôme principal
                            </div>
                            <div class="card-body">
                            @if ($errors->has("title") || $errors->has("year") || $errors->has("image "))
                                <div class="alert alert-danger">
                                    <ul>

                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach

                                    </ul>
                                </div>
                                @endif

                            

                                @if (count($diplomas) == 0)

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

                                @else
                                    @if (session('success-diploma'))
                                        <div class="alert alert-success">
                                        <p>{{ session('success-diploma') }}</p> 
                                        
                                    </div>
                                    @else
                                    <p class="text-start">Vous avez déja uploadé votre diplôme</p>
                                    @endif
                                    <p class="text-end"><a href="{{route('diploma.show', ['diploma' => $diplomas[0]->id])}}">Voir les détails</a></p>
                                    <p class="text-end"><a href="{{route('diploma.edit', ['diploma' => $diplomas[0]->id])}}">Modifier</a></p>


                                @endif
                            </div>
                            </div>

                            @endif
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

           
            <script src="../../js/jquery.min.js"></script>
            <script src="../../js/bootstrap.bundle.min.js"></script>
            <script src="../../js/owl.carousel.min.js"></script>
            <script src="../../js/scrollspy.min.js"></script>
            <script src="../../js/custom.js"></script>
     
    </body>
</html>