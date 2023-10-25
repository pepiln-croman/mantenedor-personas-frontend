@include('layouts.header')

    <section id="dashboard" class="py-5">
        <div class="container-fluid">

            @if(session('success'))
                <p class="alert alert-success">
                    {{ session('success') }}
                </p>
            @elseif(session('error'))
                <p class="alert alert-danger">
                    {{ session('error') }}
                </p>
            @endif

            <table id="personsTable" class="table table-striped">
                <thead>
                    <tr class="text-uppercase">
                        <th>RUT</th>
                        <th>Nombre</th>
                        <th>Fecha de Nacimiento</th>
                        <th>Sexo</th>
                        <th>Dirección</th>
                        <th>Comuna</th>
                        <th>Regi&oacute;n</th>
                        <th>¿Eliminar?</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                       <tr>
                            <td>
                                <a href="#" class="text-danger fw-bold" data-bs-toggle="modal" data-bs-target="#modalUpdateUser-{{ $user['id'] }}">
                                    {{ $user['rut'] }}
                                </a>
                                <!-- User modal ID {{ $user['id'] }} -->
                                <form action="{{ url('/updateUser') }}" method="POST" class="modal fade" id="modalUpdateUser-{{ $user['id'] }}" tabindex="-1" aria-labelledby="modal-update-user-{{ $user['id'] }}-label" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="modal-update-user-{{ $user['id'] }}-label">Editar persona</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="row">
                                                    @csrf
                                                    <div class="col-lg-6">
                                                        <label for="rut">{{ 'RUT' }}</label>
                                                        <input type="text" name="rut" class="form-control mb-3" disabled value="{{ $user['rut'] }}">
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <label for="names">{{ 'Nombres' }}</label>
                                                        <input type="text" name="names" class="form-control mb-3" value="{{ $user['names'] }}">
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <label for="first_surname">{{ 'Apellido Paterno' }}</label>
                                                        <input type="text" name="first_surname" class="form-control mb-3" value="{{ $user['first_surname'] }}">
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <label for="second_surname">{{ 'Apellido Materno' }}</label>
                                                        <input type="text" name="second_surname" class="form-control mb-3" value="{{ $user['second_surname'] }}">
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <?php
                                                            $strISO8601 = $user['date_of_birth'];
                                                            $format = "Y-d-m\TH:i:s.uO";
                                                            $dateTime = DateTime::createFromFormat($format, $strISO8601); ?>
                                                        <label for="date_of_birth">{{ 'Fecha de Nacimiento' }}</label>
                                                        <input type="date" name="date_of_birth" data-date="" data-date-format="DD MMMM YYYY" class="form-control mb-3" placeholder="{{ $dateTime->format('d-m-Y') }}" value="{{ $dateTime->format('Y-m-d') }}">
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <label for="gender">{{ 'Sexo' }}</label>
                                                        <select name="gender" class="form-control mb-3">
                                                            <option value="1">{{ 'Masculino' }}</option>
                                                            <option value="2">{{ 'Femenino' }}</option>
                                                            <option value="3">{{ 'Otro' }}</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-lg-10">
                                                        <label for="address">{{ 'Dirección' }}</label>
                                                        <input type="text" name="address" class="form-control mb-3" value="{{ $user['address'] }}">
                                                    </div>
                                                    <div class="col-lg-2">
                                                        <label for="building_number">{{ 'Número' }}</label>
                                                        <input type="number" name="building_number" class="form-control mb-3" value="{{ $user['building_number'] }}">
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <label for="region">{{ 'Región' }}</label>
                                                        <input type="text" name="region" class="form-control mb-3" value="{{ $user['region'] }}">
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <label for="city">{{ 'Comuna' }}</label>
                                                        <input type="text" name="city" class="form-control mb-3" value="{{ $user['city'] }}">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                                <button type="submit" class="btn btn-primary">Actualizar datos</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </td>
                            <td>{{ $user['names'] . ' ' . $user['first_surname'] . ' ' . $user['first_surname'] . ' ' . $user['second_surname'] }}</td>
                            <td>
                                <?php
                                    $strISO8601 = $user['date_of_birth'];
                                    $format = "Y-d-m\TH:i:s.uO";
                                    $dateTime = DateTime::createFromFormat($format, $strISO8601);

                                    echo $dateTime->format('d/m/Y');
                                ?>
                            </td>
                            <td>
                                <?php
                                $gender = $user['gender'];

                                if($gender == 1) :
                                    echo 'Masculino';
                                elseif($gender == 2) :
                                    echo 'Femenino';
                                else :
                                    echo 'Otro';
                                endif; ?>
                            </td>
                            <td>{{ $user['address'] . ' ' . $user['building_number'] }}</td>
                            <td>{{ $user['city'] }}</td>
                            <td>{{ $user['region'] }}</td>
                            <td>
                                <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#modalDeleteUser-{{ $user['id'] }}">{{ 'Eliminar' }}</button>
                                <!-- User modal ID {{ $user['id'] }} -->
                                <form action="{{ url('/deleteUser') }}" method="DELETE" class="modal fade" id="modalDeleteUser-{{ $user['id'] }}" tabindex="-1" aria-labelledby="modal-delete-user-{{ $user['id'] }}-label" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="modal-delete-user-{{ $user['id'] }}-label">Eliminar persona</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ 'Cancelar' }}</button>
                                                <button type="submit" class="btn btn-primary">{{ 'Eliminar persona' }}</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </td>
                       </tr>
                    @endforeach
                    {{-- <tr>
                        <td>Tiger Nixon</td>
                        <td>System Architect</td>
                        <td>Edinburgh</td>
                        <td>61</td>
                        <td>2011-04-25</td>
                        <td>$320,800</td>
                        <td>$320,800</td>
                    </tr> --}}
                </tbody>
            </table>
        </div>
    </section>

@include('layouts.footer')