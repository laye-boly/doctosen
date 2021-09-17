<h2 class="text-center mb-lg-3 mb-2" id="consultation-booking">Détail du Rv</h2>
                                    
                                    <h5 class="card-title">Information sur le patient</h5>
                                    
                                    <table class="table">
                                      <tbody>
                                          <tr>
                                              <td>Prénom et nom du patient</td>
                                              <td>{{$patient->first_name}} {{$patient->last_name}}</td>
                                            </tr>
                                            <tr>
                                              <td>Téléphone</td>
                                              <td>{{$patient->phone}}</td>
                                            </tr>
                                            <tr>
                                              <td>Adresse</td>
                                              <td>{{$patient->adress}}</td>
                                            </tr>
                                          </tbody>
                                        </table>

                                        <h5 class="card-title">Information sur la structure sanitaire</h5>
                          <table class="table">
                            <tbody>
                                <tr>
                                    <td>Nom</td>
                                    <td>{{$appointement[0]->hospitalName}} </td>
                                  </tr>
                                  <tr>
                                    <td>Téléphone</td>
                                    <td>{{$appointement[0]->hospitalPhone}}</td>
                                  </tr>
                                  <tr>
                                    <td>Adresse</td>
                                    <td>{{$appointement[0]->hospitalAdress}}</td>
                                  </tr>
                                </tbody>
                              </table>
                              <h5 class="card-title">Information sur le rendez-vous</h5>
                          <table class="table">
                            <tbody>
                                <tr>
                                    <td>Date</td>
                                    <td>{{$appointement[0]->appointement_date}}</td>
                                  </tr>
                                  <tr>
                                    <td>Heure</td>
                                    <td>{{$appointement[0]->appointement_hour}}</td>
                                  </tr>
                                  <tr>
                                    <td>Statut</td>
                                    <td>{{$appointement[0]->status}}</td>
                                  </tr>
                                 
                                </tbody>
                              </table>

                              <h5 class="card-title">Information sur les vaccins</h5>
                              <table class="table table-striped">
                                <thead>
                                  <tr>
                                    <th>Nom du vaccin</th>
        
                                    <th>Type du vaccin</th>
                                    <th>Quantité disponible</th>
                                  
                    
                                  
                                  </tr>
                                </thead>
                                <tbody>
                                    @foreach ($appointement as $appointementVaccine)
                                    <tr>
                                        <td>
                                           
        
                                            {{ $appointementVaccine->vaccineName }} 
                                            
                                    </td>
                                        
                                        <td>{{ $appointementVaccine->vaccineType }}</td>
                                        <td>{{ $appointementVaccine->vaccineTotal }}</td>
                                    
                                        
                                    
                                        
                                        
                                      </tr>
                                    @endforeach

                            </tbody>
                        </table>