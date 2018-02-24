<?php

namespace App\Policies;

use App\Transaction;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class TransactionPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the given transaction details can be seen by the user.
     *
     * @param \App\User $user
     * @param \App\Transaction $transaction
     * @return bool
     */
    public function show(User $user, Transaction $transaction)
    {
        return $user->id === $transaction->user_id;
    }
}
