    <div class="row">
        <div class="col-sm-5 col-sm-offset-1">
            <div class="form-group">
                <label for="{{ $subject }}_documentType">Tipo de documento</label>
                <select class="form-control validate {{ $errors->has("$subject.documentType") ? 'error' : '' }}" id="{{ $subject }}_documentType" name="{{ $subject }}[documentType]" required>
                    <option value="">Selecciona un tipo de documento</option>
                    <option value="CC" {{ old("$subject.documentType") == "CC" ? 'selected' : '' }}>Cédula de ciudadanía colombiana</option>
                    <option value="CE" {{ old("$subject.documentType") == "CE" ? 'selected' : '' }}>Cédula de extranjería</option>
                    <option value="TI" {{ old("$subject.documentType") == "TI" ? 'selected' : '' }}>Tarjeta de identidad</option>
                    <option value="PPN" {{ old("$subject.documentType") == "PPN" ? 'selected' : '' }}>Pasaporte</option>
                    <option value="NIT" {{ old("$subject.documentType") == "NIT" ? 'selected' : '' }}>Número de identificación tributaria</option>
                    <option value="SSN" {{ old("$subject.documentType") == "SSN" ? 'selected' : '' }}>Social Security Number</option>
                </select>
            </div>
        </div>
        <div class="col-sm-5">
            <div class="form-group">
                <label for="{{ $subject }}_document">Número de identificación</label>
                <input type="text" class="form-control validate {{ $errors->has("$subject.document") ? 'error' : '' }}" id="{{ $subject }}_document" name="{{ $subject }}[document]" value="{{ old("$subject.document") }}" placeholder="Ej: 1234567890" required maxlength="12" onkeypress="return soloNumeros(event)">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-5 col-sm-offset-1">
            <div class="form-group">
                <label for="{{ $subject }}_firstName">Nombres</label>
                <input type="text" class="form-control validate {{ $errors->has("$subject.firstName") ? 'error' : '' }}" id="{{ $subject }}_firstName" name="{{ $subject }}[firstName]" value="{{ old("$subject.firstName") }}" placeholder="Ej: John" required maxlength="60" onkeypress="return soloLetras(event)">
            </div>
        </div>
        <div class="col-sm-5">
            <div class="form-group">
                <label for="{{ $subject }}_lastName">Apellidos</label>
                <input type="text" class="form-control validate {{ $errors->has("$subject.lastName") ? 'error' : '' }}" id="{{ $subject }}_lastName" name="{{ $subject }}[lastName]" value="{{ old("$subject.lastName") }}" placeholder="Ej: Doe" required maxlength="60" onkeypress="return soloLetras(event)">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-5 col-sm-offset-1">
            <div class="form-group">
                <label for="{{ $subject }}_company">Nombre de la compañía en la cual labora o representa</label>
                <input type="text" class="form-control validate {{ $errors->has("$subject.company") ? 'error' : '' }}" id="{{ $subject }}_company" name="{{ $subject }}[company]" value="{{ old("$subject.company") }}" placeholder="Ej: PlacetoPay" required maxlength="60">
            </div>
        </div>
        <div class="col-sm-5">
            <div class="form-group">
                <label for="{{ $subject }}_emailAddress">Correo electrónico</label>
                <input type="email" class="form-control validate {{ $errors->has("$subject.emailAddress") ? 'error' : '' }}" id="{{ $subject }}_emailAddress" name="{{ $subject }}[emailAddress]" value="{{ old("$subject.emailAddress") }}" placeholder="Ej: johndoe@gmail.com" required maxlength="80">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-5 col-sm-offset-1">
            <div class="form-group">
                <label for="{{ $subject }}_address">Dirección de residencia</label>
                <input type="text" class="form-control validate {{ $errors->has("$subject.address") ? 'error' : '' }}" id="{{ $subject }}_address" name="{{ $subject }}[address]" value="{{ old("$subject.address") }}" placeholder="Ej: 221B Baker Street" required maxlength="100">
            </div>
        </div>
        <div class="col-sm-5">
            <div class="form-group">
                <label for="{{ $subject }}_country">Código  del país (ISO 3166-1)</label>
                <input type="text" class="form-control validate {{ $errors->has("$subject.country") ? 'error' : '' }}" id="{{ $subject }}_country" name="{{ $subject }}[country]" value="CO" placeholder="Ej (Colombia): CO" readonly required maxlength="2" onkeypress="return soloLetras(event)">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-5 col-sm-offset-1">
            <div class="form-group">
                <label for="{{ $subject }}_province">Provincia/Departamento</label>
                <input type="text" class="form-control validate {{ $errors->has("$subject.province") ? 'error' : '' }}" id="{{ $subject }}_province" name="{{ $subject }}[province]" value="{{ old("$subject.province") }}" placeholder="Ej: Risaralda" required maxlength="50" onkeypress="return soloLetras(event)">
            </div>
        </div>
        <div class="col-sm-5">
            <div class="form-group">
                <label for="{{ $subject }}_city">Ciudad</label>
                <input type="text" class="form-control validate {{ $errors->has("$subject.city") ? 'error' : '' }}" id="{{ $subject }}_city" name="{{ $subject }}[city]" value="{{ old("$subject.city") }}" placeholder="Ej: Pereira" maxlength="50" required onkeypress="return soloLetras(event)">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-5 col-sm-offset-1">
            <div class="form-group">
                <label for="{{ $subject }}_phone">Teléfono fijo</label>
                <input type="text" class="form-control validate {{ $errors->has("$subject.phone") ? 'error' : '' }}" id="{{ $subject }}_phone" name="{{ $subject }}[phone]" value="{{ old("$subject.phone") }}" placeholder="Ej: (6) 3319432" required maxlength="30" onkeypress="return soloNumeros(event)">
            </div>
        </div>
        <div class="col-sm-5">
            <div class="form-group">
                <label for="{{ $subject }}_mobile">Teléfono celular</label>
                <input type="text" class="form-control validate {{ $errors->has("$subject.mobile") ? 'error' : '' }}" id="{{ $subject }}_mobile" name="{{ $subject }}[mobile]" value="{{ old("$subject.mobile") }}" placeholder="Ej: 3124567890" required maxlength="30" onkeypress="return soloNumeros(event)">
            </div>
        </div>
    </div>

@section('scripts')
    @parent
    <script src="{{ asset('js/only-numbers.js') }}"></script>
    <script src="{{ asset('js/only-letters.js') }}"></script>
@endsection