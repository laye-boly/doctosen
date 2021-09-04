<div class="container">

                <div class="row">
                    <div class="card col-sm-8" style="width: 18rem;">

                        <div class="card-body">
                          <h5 class="card-title">Information sur le patient</h5>
                          <table class="table">
                            <tbody>
                                <tr>
                                    <td>Prénom et nom du patient</td>
                                    <td>{{$appointement->patient->first_name}} {{$appointement->patient->last_name}}</td>
                                  </tr>
                                  <tr>
                                    <td>Téléphone</td>
                                    <td>{{$appointement->patient->phone}}</td>
                                  </tr>
                                  <tr>
                                    <td>Adresse</td>
                                    <td>{{$appointement->patient->adress}}</td>
                                  </tr>
                                </tbody>
                              </table>

                              <h5 class="card-title">Information sur le médecin</h5>
                          <table class="table">
                            <tbody>
                                <tr>
                                    <td>Prénom et nom du médecin</td>
                                    <td>{{$appointement->doctor->first_name}} {{$appointement->doctor->last_name}}</td>
                                  </tr>
                                  <tr>
                                    <td>Téléphone</td>
                                    <td>{{$appointement->doctor->phone}}</td>
                                  </tr>
                                  <tr>
                                    <td>Adresse</td>
                                    <td>{{$appointement->doctor->adress}}</td>
                                  </tr>
                                </tbody>
                              </table>

                              <h5 class="card-title">Information sur le rendez-vous</h5>
                          <table class="table">
                            <tbody>
                                <tr>
                                    <td>Date</td>
                                    <td>{{$appointement->appointement_date}}</td>
                                  </tr>
                                  <tr>
                                    <td>Heure</td>
                                    <td>{{$appointement->appointement_hour}}</td>
                                  </tr>
                                  <tr>
                                    <td>Statut</td>
                                    <td>{{$appointement->status}}</td>
                                  </tr>
                                  <tr>
                                    <td>Raison</td>
                                    <td>{{$appointement->appointement_reason}}</td>
                                  </tr>
                                </tbody>
                              </table>




                        </div>
                      </div>
                </div>
            </div>
