@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Inicio</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    @auth
                        <p>Aquí encontrarás todas las transacciones que has realizado.</p>
                        <p>Puedes ver más información de cada una de estas dando click en el número de referencia</p>
                        <div class="table-responsive">
                            <table class="table table-hover table-bordered">
                                <thead>
                                    <th class="text-center">Referencia</th>
                                    <th class="text-center">Descripción de la transacción</th>
                                    <th class="text-center">Estado de la transacción</th>
                                    <th class="text-center">Detalle</th>
                                </thead>
                                <tbody>
                                    @forelse($transactions as $transaction)
                                        <tr>
                                            <td><a href="{{ route('transaction', $transaction->reference) }}">{{ substr($transaction->reference, 0, 10) }}</a></td>
                                            <td>{{ $transaction->description }}</td>
                                            <td>{{ $transaction->transactionState }}</td>
                                            <td>{{ $transaction->responseReasonText }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4" class="text-center"><strong>No has realizado ninguna transacción!</strong></td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    @else
                        <p>Tienes que <a href="{{ route('login') }}">iniciar sesión</a> para ver las transacciones que has realizado o si deseas hacer una nueva.</p>
                        <p>Si no tienes cuenta, regístrate <a href="{{ route('register') }}">aquí</a></p>
                    @endauth
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
