<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
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
    */
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->currentUser = \Auth::user();

            return $next($request);
        });
    }
}
