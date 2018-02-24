<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateTransactionRequest;
use App\Soap\Structures\Person;
use App\Soap\Structures\PSETransaction;
use App\Soap\Structures\PSETransactionResponse;
use App\Transaction;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Soap\Facades\PlacetoPay;


class SoapController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the form for creating a new transaction.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $banks = $this->banks();
        return view('payment', compact('banks'));
    }

    /**
     * Create Soap Person Structures from input request.
     * It will search for an input named $personNameCheck, e.g. buyerCheck in $request
     * If said input doesn't exist it will create Object from $personName input
     * If it exists and $dataSrc is null, it will attempt to create the object from
     * $personName input
     * If $dataSrc is not null and the check passed, it will create the object from
     * $dataSrc input in $request
     *
     * @param \Illuminate\Http\Request $request
     * @param $personName
     * @param null $dataSrc
     * @return \App\Soap\Structures\Person
     */
    private function createPersonFromInput(Request $request, $personName, $dataSrc = null)
    {
        $person = new Person();

        $personCheck = $personName.'Check';

        if ($request->has($personCheck)) {
            if (! is_null($dataSrc)) {
                $person->fill($request->$dataSrc);
            } else {
                $person->fill($request->$personName);
            }
        } else {
            $person->fill($request->$personName);
        }

        return $person;
    }

    /**
     * Create an unique reference to identify the transaction
     *
     * @return string
     */
    private function createTransactionReference()
    {
        $reference = str_random(32);
        while (! Transaction::where('reference', $reference)->get()->isEmpty()) {
            $reference = str_random(32);
        }
        return $reference;
    }

    /**
     * Create Soap PSETransactionRequest Structure from input.
     *
     * @param \Illuminate\Http\Request $request
     * @return \App\Soap\Structures\PSETransaction
     */
    private function createPSETransactionFromInput(Request $request)
    {
        $pse = new PSETransaction();

        $pse->fill($request->except(['_token','paymentType','payer','buyerCheck','shippingCheck','buyer','shipping','finish']));

        $pse->reference = $this->createTransactionReference();
        $pse->returnURL = route('transaction', ['reference' => $pse->reference, 'bank' => true]);

        $pse->ipAddress = $request->ip();
        $pse->userAgent = $request->userAgent();

        $pse->payer = $this->createPersonFromInput($request, 'payer');
        $pse->buyer = $this->createPersonFromInput($request, 'buyer', 'payer');
        $pse->shipping = $this->createPersonFromInput($request, 'shipping', 'payer');

        return $pse;
    }

    /**
     * Create \App\Transaction from PSETransaction request.
     *
     * @param \App\Soap\Structures\PSETransaction $pseTransaction
     * @param \App\Soap\Structures\PSETransactionResponse $response
     * @param \App\User $user
     */
    private function createTransactionFromResponse(PSETransaction $pseTransaction, PSETransactionResponse $response, User $user)
    {
        $transaction = new Transaction();
        $transaction->fill($response->toArray());
        $transaction->fill($pseTransaction->toArray());

        $transaction->user()->associate($user);

        $transaction->save();
    }

    /**
     * Setup necessary data to perform a PSETransactionRequest and resolve its response
     *
     * @param \App\Http\Requests\CreateTransactionRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateTransactionRequest $request)
    {
        $pseTransaction = $this->createPSETransactionFromInput($request);

        $transactionResponse = new PSETransactionResponse($this->transaction($pseTransaction));

        if ($transactionResponse->returnCode == 'SUCCESS') {
            $this->createTransactionFromResponse($pseTransaction, $transactionResponse, $request->user());

            return redirect($transactionResponse->bankURL);
        }

        return back()->withErrors(['error' => $transactionResponse->responseReasonText]);
    }

    /**
     * It will try to update the transaction information before showing its details.
     * Them it displays the specified transaction with all details.
     *
     * @param \Illuminate\Http\Request $request
     * @param $reference
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function show(Request $request, $reference)
    {
        $transaction = Transaction::where('reference', $reference)->firstOrFail();

        $this->authorize('show', $transaction);

        $transaction = $this->update($transaction, $request);

        return view('transaction', compact('transaction'));
    }

    /**
     * Update the specified transaction in storage.
     * Note: if transaction wasn't updated, just
     * update the update_at property.
     *
     * @param \App\Transaction $transaction
     * @param Request $request
     * @return \App\Transaction
     */
    public function update(Transaction $transaction, Request $request)
    {
        if ($this->shouldUpdate($transaction, $request)) {
            $transactionData = $this->getTransactionInformation($transaction);

            $transaction->fill($transactionData);

            if (! $transaction->wasChanged()) {
                $transaction->touch();
            }

            $transaction->save();
        }

        return $transaction;
    }

    /**
     * Resolve if the transaction should update or not, depending on its state and age.
     *
     * @param \App\Transaction $transaction
     * @param \Illuminate\Http\Request $request
     * @return bool
     */
    private function shouldUpdate(Transaction $transaction, Request $request)
    {
        if ($request->has('bank')) {
            return true;
        }

        if ($transaction->transactionState == 'PENDING' || is_null($transaction->transactionState)) {
            if (Carbon::now()->diffInMinutes($transaction->created_at) >= 7 && Carbon::now()->diffInMinutes($transaction->updated_at) >= 12) {
                return true;
            }
        }

        return false;
    }

    /**
     * Perform a SOAP WebService call.
     * Request banks list.
     *
     * @return mixed
     */
    private function banks()
    {
        return PlacetoPay::getBankList();
    }

    /**
     * Perform a SOAP WebService call.
     * Request a transaction creation.
     *
     * @return mixed
     */
    private function transaction(PSETransaction $transaction)
    {
        return PlacetoPay::createTransaction($transaction);
    }

    /**
     * Perform a SOAP WebService call
     * Request a transaction information.
     *
     * @return mixed
     */
    private function getTransactionInformation(Transaction $transaction)
    {
        return PlacetoPay::getTransactionInformation($transaction->transactionID);
    }
}
