<?php

namespace App\Http\Controllers;

use App\Domain\Loan\LoanService;
use App\Http\Requests\CreateLoanRequest;
use App\Models\Loan;
use Illuminate\Http\Request;

class LoansController extends Controller
{
    /**
     * @var LoanService
     */
    private LoanService $loanService;

    /**
     * LoansController constructor.
     * @param LoanService $loanService
     */
    public function __construct(LoanService $loanService)
    {
        $this->loanService = $loanService;
    }

    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function index()
    {
        return view('loans.index');
    }

    /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function create()
    {
        $months = [];
        foreach (range(1, 12) as $month) {
            $months[] = date('F',  mktime(0, 0, 0, $month, 1));
        }
        $years = range(2017, 2050);

        return view('loans.create', ['months' => $months, 'years' => $years]);
    }

    /**
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
    public function store(CreateLoanRequest $request)
    {
        $loan = $this->loanService->createLoan(
            $this->loanService->collectLoan(array_merge($request->except('_token'), ['user_id' => \Auth::user()->id]))
        );
    }

    /**
    * Display the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function show($id)
    {
        return view('loans.show');
    }

    /**
    * Show the form for editing the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function edit($id)
    {
        return view('loans.create');
    }

    /**
    * Update the specified resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function update(Request $request, $id)
    {
        dd($request->all());
    }

    /**
    * Remove the specified resource from storage.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function destroy($id)
    {
        dd($id);
    }
}
