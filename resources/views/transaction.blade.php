@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Detalle de la transacción #{{ substr($transaction->reference, 0, 10) }} del {{ $transaction->created_at->format('d/m/Y H:i') }}</div>
                    <div class="panel-body">
                        <ul>
                            <li><strong>Referencia completa:</strong> {{ $transaction->reference }}</li>
                            <li><strong>Descripción:</strong> {{ $transaction->description }}</li>
                            <li><strong>Identificador único de la transacción en Place to Pay:</strong> {{ $transaction->transactionID }}</li>
                            <li><strong>Identificador único de la sesión en Place to Pay:</strong> {{ $transaction->sessionID }}</li>
                            <li><strong>Código único de seguimiento para la operación dado por la red ACH:</strong> {{ $transaction->trazabilityCode }}</li>
                            <li><strong>Información del estado de la transacción: </strong>{{ $transaction->transactionState }}</li>
                            <li><strong>Estado de la operación en PlacetoPay: </strong>{{ $transaction->responseCode }}</li>
                            <li><strong>Motivo de respuesta de la operación en Place to Pay: </strong>{{ $transaction->responseReasonText }}</li>
                            <li><strong>Realizada el:</strong> {{ $transaction->created_at->format('c') }}</li>
                            <li><strong>Ultima actualización el:</strong> {{ $transaction->updated_at->format('c') }}</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
