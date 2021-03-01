<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Models\User;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
    * @var User
    */
    protected User $currentUser;

    /**
    * LoansController constructor.
    * @param LoanService $loanService
    */
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->currentUser = \Auth::user();

            return $next($request);
        });
    }
}
