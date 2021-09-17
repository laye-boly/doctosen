<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <meta name="description" content="">
        <meta name="author" content="">

        <title>Doctosen - @yield("title")</title>
{{-- 
        <!-- CSS FILES -->
        <link rel="preconnect" href="https://fonts.googleapis.com">

        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

        <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600;700&display=swap" rel="stylesheet">

       
        <link href="../../../../../css/bootstrap.min.css" rel="stylesheet">

            <link href="../../../../../css/bootstrap-icons.css" rel="stylesheet">

            <link href="../../../../../css/owl.carousel.min.css" rel="stylesheet">

            <link href="../../../../../css/owl.theme.default.min.css" rel="stylesheet">

            <link href="../../../../../css/templatemo-medic-care.css" rel="stylesheet"> --}}

    
<!--

TemplateMo 566 Medic Care

https://templatemo.com/tm-566-medic-care

-->
    </head>

    <body id="top">

        <main>



            <section class="section-padding" id="booking">
                <div class="container">
                    
                        
                        <div class="col-lg-8 col-12 mx-auto">
                            <div class="booking-form">
                               
                                <h5 class="text-center mb-lg-3 mb-2"> Type du dossier médical : {{$document->type}}</h5>
                                @if ($principalHospital != null)
                                <div class="text-center mb-lg-3 mb-2">
                                    <h6>Information sur la structure de santé du médecin</h6>
                                    <p>Nom : {{$principalHospital->name}}</p>
                                    <p>Adresse : {{$principalHospital->adress}}</p>
                                    <p>Téléphone  : {{$principalHospital->phone}}</p>
                                </div>
                                    
                                @endif

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
                                        <p>{{$document->body}}</p>
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


    
        

     

  

     


    </body>
</html>