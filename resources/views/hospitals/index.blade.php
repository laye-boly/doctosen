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

            @include("menu")
            
     
          

            <section class="section-padding" id="booking">
                <div class="container">
                    
                    <div class="col-lg-8 col-12 mx-auto">
                        <div class="booking-form">
                            
                            @if (session('success-delete'))
                            <div class="alert alert-success">
                                {{session("success-deletion")}}
                            </div>

                            @endif
                            
                            {{-- début On garde le nombre de diplome pour avertir l'utilisateur quand il veut supprimer via JS --}}

                            <div class="alert alert-info">
                               
                               Nombre de Structure Sanitaire : <span  id="hospital-number">{{count($hospitals)}}</span> 
                            </div>

                            {{-- fin On garde le nombre de structure sanitaire pour avertir l'utilisateur quand il veut supprimer via JS --}}

                            {{-- S'il y a des erreurs de lors de la supression d'une structure sanitaire --}}
                            @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{$error}}</li>
                                    @endforeach
                                </ul>
                            </div>

                            @endif

                            
                            <h5 class="text-center mb-lg-3 mb-2"> <a href="{{route('hospital.create')}}">Ajouter une nouvelle structure sanitaire</a></h5>
                            <h5 class="text-center mb-lg-3 mb-2"> Mes structures sanitaires</h5>
                            @if (count($hospitals) != 0)

                            <table class="table table-striped">
                                <thead>
                                  <tr>
                                    <th>Nom</th>
        
                                    <th>Adresse</th>
                                    <th>Téléphone</th>
                                    <th>Modifier</th>
                                    <th>Détail</th>
                                    <th>Supprimer</th>
                                  
                                  </tr>
                                </thead>
                                <tbody>
                                    @foreach ($hospitals as $hospital)
                                    <tr>
                                        <td>
                                           
        
                                            {{ $hospital->name }} 
                                            
                                    </td>
                                        
                                        <td>{{ $hospital->adress }}</td>
                                        <td>{{ $hospital->phone }}</td>
                                    
                                        <td><a class="btn btn-info" href="{{route('hospital.edit', ['hospital' => $hospital->id])}}">Modifier</a></td>
                                        <td><a class="btn btn-info" href="{{route('hospital.show', ['hospital' => $hospital->id])}}">Détail</a></td>
                                        <td>
                                            {!! Form::open(['url'  => route('hospital.delete', ['hospital' => $hospital->id])]) !!}

                                            {{Form::hidden('hospital-id', $hospital->id)}}
                                            {{Form::submit("supprimer", ['class' => 'btn btn-danger'])}}
                                            
                                            {!! Form::close() !!}
                                        </td>
                                        
                                        
                                      </tr>
                                    @endforeach

                            </tbody>
                        </table>
                                
                            @endif
                            
            
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
        <script src="../../../../../js/doctosen.delete.hospital.js"></script>
        <script src="../../../../../js/jquery.min.js"></script>
        <script src="../../../../../js/bootstrap.bundle.min.js"></script>
        <script src="../../../../../js/owl.carousel.min.js"></script>
        <script src="../../../../../js/scrollspy.min.js"></script>
        <script src="../../../../../js/custom.js"></script>

       
<!--

TemplateMo 566 Medic Care

https://templatemo.com/tm-566-medic-care

-->
    </body>
</html>