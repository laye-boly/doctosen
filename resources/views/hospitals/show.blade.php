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
                               
                                <h5 class="text-center mb-lg-3 mb-2"> Type du dossier médical : {{$document->type}}</h5>
                                <div class="text-center mb-lg-3 mb-2">
                                    <h6>Information sur la structure de santé du médecin</h6>
                                    <p>Nom : {{$principalHospital->name}}</p>
                                    <p>Adresse : {{$principalHospital->adress}}</p>
                                    <p>Téléphone  : {{$principalHospital->phone}}</p>
                                </div>

                                <div>
                                    <div class="text-start mb-lg-3 mb-2">
                                        <h6>Information sur le patient</h6>
                                        <p>Prénom : {{$document->patient->first_name}}</p>
                                        <p>Nom : {{$document->patient->last_name}}</p>
                                        <p>Téléphone : {{$document->patient->phone}}</p>
                                        <p>Adresse : {{$document->patient->adress}}</p>
                                    </div>
                                    <div class="text-center mb-lg-3 mb-2">
                                        <h6>Corps du document</h6>
                                        @if ($document->upload == 0)
                                            <p>{{$document->body}}</p>

                                        @else
                                            <p>
                                                Ce document à été uploadé dans la plateforme
                                                Vous pouvez le télécharger en cliquant <a href="{{route('medical.downloadMedicalDocument', ['filename' => $document->body])}}">ici</a>
                                            </p>
                                            

                                        @endif
                                    </div>

                                    <div class="text-start mb-lg-3 mb-2">
                                        <h6>Information sur le médecin</h6>
                                        <p>Prénom : {{$author->first_name}}</p>
                                        <p>Nom : {{$author->last_name}}</p>
                                        <p>Téléphone : {{$author->phone}}</p>
                                        <p>Adresse : {{$author->adress}}</p>
                                    </div>
                                </div>
                                </div>
                              
                                    <h6 class="text-center mb-lg-3 mb-2">Médecins ayant accés au documents</h6>
                                    <table class="table table-striped">
                                        <thead>
                                          <tr>
                                            <th>prenom et nom du médecin</th>
                                            <th>spécialite</th>
                                            <th>téléphone</th>
                                            <th>adresse</th>
                                          
                                          </tr>
                                        </thead>
                                        <tbody>
                                        @foreach ($doctors as $doctor)
                                        <tr>
                                            <td>{{$doctor->first_name }} {{$doctor->last_name}}</td>
                                                    <td>{{$doctor->title}}</td>
                                                    <td>{{$doctor->phone }}</td>
                                                    <td>{{$doctor->adress }}</td>
                                                  
                                          </tr>
                                        @endforeach
    
                                    </tbody>
                                </table>
                               
                       

                    
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