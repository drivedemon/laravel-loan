<?php

namespace App\Http\Controllers;

use App\Domain\Loan\LoanService;
use App\Http\Requests\CreateLoanRequest;
use App\Models\Loan;
use Exception;
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
        return view('loans.create',
            [
                'months' => $this->loanService->getMonthScope(),
                'years' => $this->loanService->getYearScope()
            ]
        );
    }

    /**
    * Store a newly created resource in storage.
    *
    * @param  App\Http\Requests\CreateLoanRequest  $request
    * @return \Illuminate\Http\Response
    * @throws Exception
    */
    public function store(CreateLoanRequest $request)
    {
        try {
            $loan = $this->loanService->createLoan(
                $this->loanService->collectLoan(array_merge($request->except('_token'), ['user_id' => \Auth::user()->id]))
            );
        } catch (Exception $e) {
            return redirect()->back()->withErrors($e);
        }

        return view('loans.index');
    }

    /**
    * Display the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function show($id)
    {
        $loan = $this->loanService->getLoanById($id);
        $rePayment = $this->loanService->pmtCalculate($loan);
        return view('loans.show',
            [
                'loans' => $loan,
                'rePayment' => $rePayment
            ]
        );
    }

    /**
    * Show the form for editing the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function edit($id)
    {
        return view('loans.create',
            [
                'loan' => $this->loanService->getLoanById($id),
                'months' => $this->loanService->getMonthScope(),
                'years' => $this->loanService->getYearScope()
            ]
        );
    }

    /**
    * Update the specified resource in storage.
    *
    * @param  App\Http\Requests\CreateLoanRequest  $request
    * @param  int  $id
    * @return \Illuminate\Http\Response
    * @throws Exception
    */
    public function update(CreateLoanRequest $request, $id)
    {
        try {
            $loanModel = $this->loanService->getLoanById($id);
            $this->loanService->updateLoan(
                $this->loanService->collectLoan(array_merge($request->except('_token'), ['user_id' => \Auth::user()->id])),
                $loanModel
            );
        } catch (Exception $e) {
            return redirect()->back()->withErrors($e);
        }

        return view('loans.index');
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
