<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <meta name="description" content="">
        <meta name="author" content="">

        <title>Doctosen - @yield("title")</title>

        <!-- CSS FILES -->
        <link rel="preconnect" href="https://fonts.googleapis.com">

        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

        <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600;700&display=swap" rel="stylesheet">

        <link href="../../../../../css/bootstrap.min.css" rel="stylesheet">

        <link href="../../../../../css/bootstrap-icons.css" rel="stylesheet">

        <link href="../../../../../css/owl.carousel.min.css" rel="stylesheet">

        <link href="../../../../../css/owl.theme.default.min.css" rel="stylesheet">

        <link href="../../../../../css/templatemo-medic-care.css" rel="stylesheet">

    
<!--

TemplateMo 566 Medic Care

https://templatemo.com/tm-566-medic-care

-->
    </head>

    <body id="top">

        <main>

            @include("inc.menu")


            <section class="section-padding" id="booking">
                <div class="container">
                    
                    <div class="col-lg-8 col-12 mx-auto">
                        <div class="booking-form">
                            <h2 class="text-center mb-lg-3 mb-2">Modifier le document médical</h2>

                               
                                @if($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        
                        
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                        
                                    </ul>
                                </div>
                        
                                @endif

                                {!! Form::open(['route' => ['medical.update', $medical->id ]])!!}

            
            @if($medical->upload == 0)
            <div class="form-group">
                {{Form::label('body ', "Le corps du document")}}
                {{Form::textarea ('body', $medical->body, ['class' => 'form-control'])}}
            </div>
            @endif
            
            
            <br><br>
            <div class="form-group">
                {{Form::label('type', "Le type de document ")}}
                

                {{Form::select('type', ['certificat medical' => 'certificat médical', 'ordonnance' => 'ordonnance', 'recommandation' => 'recommandation'], $medical->type, ['placeholder' => $medical->type]) }}

            </div>

            <div class="form-group">
                {{Form::label('doctors', "Donnez accès à d'autres médecins ")}}
                {{Form::select('doctors[]', $doctors, null, array('multiple' => true, 'class' => 'form-select')) }}

            </div>
            <br>

            {{Form::submit('Submit', ['class'=>'btn btn-primary'])}}
            {!! Form::close() !!}
                            </div>
                        </div>
                        {{-- fin --}}
                        <div class="col-lg-8 col-12 mx-auto">
                            <div class="booking-form">

                                <h2 class="text-center mb-lg-3 mb-2">Médecins ayant accès au document </h2>

                                <table class="table table-striped">
                                    <thead>
                                      <tr>
                                        <th>prenom et nom du médecin</th>
                                        <th>spécialite</th>
                                        <th>téléphone</th>
                                        {{-- <th>structure sanitaire</th> --}}
                                        {{-- <th>adresse de la structure sanitaire</th> --}}
                                      </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($doctorMedicals as $doctorMedical)
                                    <tr>
                                        <td>{{$doctorMedical->first_name }} {{$doctorMedical->last_name}}</td>
                                                <td>{{$doctorMedical->title}}</td>
                                                <td>{{$doctorMedical->phone }}</td>
                                                {{-- <td>{{$user->hospitals }}</td> --}}
                                      </tr>
                                    @endforeach

                                </tbody>
                            </table>
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
        <script src="js/jquery.min.js"></script>
        <script src="js/bootstrap.bundle.min.js"></script>
        <script src="js/owl.carousel.min.js"></script>
        <script src="js/scrollspy.min.js"></script>
        <script src="js/custom.js"></script>

       
<!--

TemplateMo 566 Medic Care

https://templatemo.com/tm-566-medic-care

-->
    </body>
</html>