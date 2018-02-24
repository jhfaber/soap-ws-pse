@section('styles')
    @parent
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <link href="{{ asset('css/gsdk-bootstrap-wizard.css') }}" rel="stylesheet" />
@endsection

<!--      Wizard container        -->
<div class="wizard-container" style="padding-top: 0; margin-bottom: 22px;">
    <div class="card wizard-card" data-color="green" id="wizard">
        <form method="POST" action="{{ route('pay') }}">
            {{ csrf_field() }}
            <!--        You can switch ' data-color="green" '  with one of the next bright colors: "blue", "green", "orange", "red"          -->

            <div class="wizard-header">
                <h3>
                    Realizar transacción
                </h3>
            </div>
            <div class="wizard-navigation">
                <ul>
                    <li><a href="#transaction_info" data-toggle="tab">Compra</a></li>
                    <li><a href="#payment_type" data-toggle="tab">Tipo de Pago</a></li>
                    <li><a href="#banks" data-toggle="tab">Bancos</a></li>
                    <li><a href="#payment_data" data-toggle="tab">Pagador</a></li>
                    <li><a href="#shipment_data" data-toggle="tab">Envío</a></li>
                </ul>
            </div>

            <div class="tab-content">
                <div class="tab-pane" id="transaction_info">
                    <h4 class="info-text">Información de la compra</h4>
                    <div class="row">
                        <div class="col-sm-10 col-sm-offset-1">
                            <div class="form-group">
                                <label for="description">Descripción de la compra</label>
                                <textarea id="description" name="description" class="form-control validate {{ $errors->has('description') ? 'error' : ''}}" placeholder="Compra del producto XYZ..." rows="4" required maxlength="255">{{ old('description') }}</textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-5 col-sm-offset-1">
                            <div class="form-group">
                                <label for="language">Idioma para las transacciones (ISO 631-1)</label>
                                <input type="text" class="form-control validate {{ $errors->has('language') ? 'error' : '' }}" id="language" name="language" value="ES" placeholder="Ej (Español): ES" readonly required maxlength="2" onkeypress="return soloLetras(event)">
                            </div>
                        </div>
                        <div class="col-sm-5">
                            <div class="form-group">
                                <label for="currency">Moneda a usar (ISO 4217)</label>
                                <input type="text" class="form-control validate {{ $errors->has('currency') ? 'error' : '' }}" id="currency" name="currency" value="COP" placeholder="Ej (Colombia): COP" readonly required maxlength="3" onkeypress="return soloLetras(event)">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-2 col-sm-offset-1">
                            <div class="form-group">
                                <label for="devolutionBase">Subtotal</label>
                                <input type="number" class="form-control validate {{ $errors->has('devolutionBase') ? 'error' : '' }}" id="devolutionBase" name="devolutionBase" value="{{ old('devolutionBase') }}" min="0" required onkeypress="return soloNumeros(event)">
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <div class="form-group">
                                <label for="taxAmount">IVA</label>
                                <input type="number" class="form-control validate {{ $errors->has('taxAmount') ? 'error' : '' }}" id="taxAmount" name="taxAmount" value="{{ old('taxAmount') ?? 0.19 }}" placeholder="0.19" min="0" step="0.01" required onkeypress="return soloNumeros(event)">
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <div class="form-group">
                                <label for="tipAmount">Propina</label>
                                <input type="number" class="form-control validate {{ $errors->has('tipAmount') ? 'error' : '' }}" id="tipAmount" name="tipAmount" value="{{ old('tipAmount') ?? 0 }}" min="0" required onkeypress="return soloNumeros(event)">
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <div class="form-group">
                                <label for="totalAmount">Total</label>
                                <input type="number" class="form-control validate {{ $errors->has('totalAmount') ? 'error' : '' }}" id="totalAmount" name="totalAmount" value="{{ old('totalAmount') }}" min="0" readonly required onkeypress="return soloNumeros(event)">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane" id="payment_type">
                    <div class="row">
                        <div class="col-sm-12">
                            <h4 class="info-text">Indique el método de pago a utilizar</h4>
                        </div>
                        <div class="col-sm-6 col-sm-offset-3">
                            <div class="form-group">
                                <label for="paymentType">Método de pago</label>
                                <select id="paymentType" name="paymentType" class="form-control validate {{ $errors->has('paymentType') ? 'error' : '' }}" required>
                                    <option value="">Selecciona una opción</option>
                                    <option value="0" {{ old('paymentType') == '0' ? 'selected' : '' }}>Tarjeta débito</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane" id="banks">
                    <div class="row">
                        <h4 class="info-text">Selecciona el tipo de cuenta</h4>
                        <div class="col-sm-10 col-sm-offset-1">
                            <div class="col-sm-6 col-sm-offset-3">
                                <div class="choice {{ old('bankInterface') == '0' ? 'active' : '' }}" data-toggle="wizard-radio" rel="tooltip" title="Selecciona esta opción si vas a pagar como persona natural">
                                    <input type="radio" name="bankInterface" value="0" id="bankPersonalInterface" class="form-control validate {{ $errors->has('bankInterface') ? 'error' : '' }}" required {{ old('bankInterface') == '0' ? 'checked' : '' }}>
                                    <div class="icon">
                                        <i class="fa fa-user"></i>
                                    </div>
                                    <h6>Persona</h6>
                                </div>
                            </div>
                            {{--<div class="col-sm-4">--}}
                                {{--<div class="choice" disabled data-toggle="wizard-radio" rel="tooltip" title="Selecciona esta opción si vas a pagar como persona jurídica">--}}
                                    {{--<input type="radio" name="bankInterface" value="1" id="bankCompanyInterface" class="form-control validate" required>--}}
                                    {{--<div class="icon">--}}
                                        {{--<i class="fa fa-building"></i>--}}
                                    {{--</div>--}}
                                    {{--<h6>Empresa</h6>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                        </div>
                    </div>
                    <br />
                    <div class="row">
                        <h4 class="info-text">Selecciona un banco</h4>
                        <div class="col-sm-10 col-sm-offset-1">
                            <div class="form-group">
                                <label for="bankCode"></label>
                                <select id="bankCode" name="bankCode" class="form-control validate {{ $errors->has('bankCode') ? 'error' : '' }}" required>
                                    @forelse($banks as $bank)
                                        <option value="{{ $bank->bankCode != 0 ? $bank->bankCode : '' }}" {{ old('bankCode') == $bank->bankCode ? 'selected' : '' }}>{{ $bank->bankName }}</option>
                                    @empty
                                    @endforelse
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane" id="payment_data">
                    <h4 class="info-text">Información del pagador</h4>
                    @include('partials.payment_form', ['subject' => 'payer'])
                    <br />
                    <h4 class="info-text">Información del comprador</h4>
                    <div class="row">
                        <div class="col-sm-6 col-sm-offset-3">
                            <div id="buyerWizardCheck" class="choice {{ old('buyerCheck') == 'true' ? 'active' : '' }}" data-toggle="wizard-checkbox" rel="tooltip" title="Selecciona si son los mismos datos del pagador" style="margin-top: 0">
                                <input type="checkbox" class="form-control validate {{ $errors->has('buyerCheck') ? 'error' : '' }}" name="buyerCheck" value="true" id="buyerCheck" {{ old('buyerCheck') == 'true' ? 'checked' : '' }}>
                                <div class="icon" style="height: 90px; width: 90px">
                                    <i class="fa fa-user" style="line-height: 80px"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="buyerForm"></div>
                </div>
                <div class="tab-pane" id="shipment_data">
                    <h4 class="info-text">Información del envío</h4>
                    <div class="row">
                        <div class="col-sm-6 col-sm-offset-3">
                            <div id="shippingWizardCheck" class="choice {{ old('shippingCheck') == 'true' ? 'active' : '' }}" data-toggle="wizard-checkbox" rel="tooltip" title="Selecciona si son los mismos datos del pagador" style="margin-top: 0">
                                <input type="checkbox" class="form-control validate {{ $errors->has('shippingCheck') ? 'error' : '' }}" name="shippingCheck" value="true" id="shippingCheck" {{ old('shippingCheck') == 'true' ? 'checked' : '' }}>
                                <div class="icon" style="height: 90px; width: 90px">
                                    <i class="fa fa-user" style="line-height: 80px"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="shippingForm"></div>
                </div>
            </div>
            <div class="wizard-footer">
                <div class="pull-right">
                    <input type='button' class='btn btn-next btn-fill btn-success btn-wd btn-sm' name='next' value='Siguiente' />
                    <input type='submit' class='btn btn-finish btn-fill btn-success btn-wd btn-sm' name='finish' value='Enviar' />

                </div>
                <div class="pull-left">
                    <input type='button' class='btn btn-previous btn-fill btn-default btn-wd btn-sm' name='previous' value='Anterior' />
                </div>
                <div class="clearfix"></div>
            </div>
        </form>
    </div>
</div> <!-- wizard container -->

@section('scripts')
    @parent
    <script src="{{ asset('js/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('js/jquery.bootstrap.wizard.js') }}"></script>
    <script src="{{ asset('js/gsdk-bootstrap-wizard.js') }}"></script>
    <script>
        $(document).ready(function () {
            var buyerFormData = `@include('partials.payment_form', ['subject' => 'buyer'])`;
            var shippingFormData = `@include('partials.payment_form', ['subject' => 'shipping'])`;

            var buyerForm = $("#buyerForm");
            var buyerWizardCheck = $("#buyerWizardCheck");

            var shippingForm = $("#shippingForm");
            var shippingWizardCheck = $("#shippingWizardCheck");

            function checkCheckbox(targetCheckbox, targetFormContainer, targetFormData) {
                if (targetCheckbox.hasClass('active')) {
                    targetFormContainer.empty();
                    targetFormContainer.hide();
                } else {
                    targetFormContainer.html(targetFormData);
                    targetFormContainer.show();
                }
            }

            buyerWizardCheck.click(function () {
                checkCheckbox(buyerWizardCheck, buyerForm, buyerFormData);
            });

            shippingWizardCheck.click(function () {
                checkCheckbox(shippingWizardCheck, shippingForm, shippingFormData)
            });

            checkCheckbox(buyerWizardCheck, buyerForm, buyerFormData);
            checkCheckbox(shippingWizardCheck, shippingForm, shippingFormData);
        });
    </script>
    <script>
        $(document).ready(function () {
            var subtotal = $("#devolutionBase");
            var iva = $("#taxAmount");
            var tip = $("#tipAmount");
            var total = $("#totalAmount");

            function setTotal(sub, iva, tip) {
                return sub + (sub * iva) + tip;
            }

            subtotal.on('keyup', function (event) {
                total.val(setTotal(Number(event.target.value), Number(iva.val()), Number(tip.val())));
            });

            iva.on('keyup', function (event) {
                total.val(setTotal(Number(subtotal.val()), Number(event.target.value), Number(tip.val())));
            });

            tip.on('keyup', function (event) {
                total.val(setTotal(Number(subtotal.val()), Number(iva.val()), Number(event.target.value)));
            });
        });
    </script>
@endsection