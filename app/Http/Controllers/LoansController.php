<?php

namespace App\Http\Controllers;

use App\Domain\Loan\LoanService;
use App\Domain\Loan\LoanDTO;
use App\Http\Requests\CreateLoanRequest;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

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
        parent::__construct();
        $this->loanService = $loanService;
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return Application|Factory|View|Response
     */
    public function index(Request $request): Factory|View|Response|Application
    {
        $loan = $this->loanService->getLoans();

        return view('loans.index',
            [
                'loans' => $loan->paginate(30),
            ]
        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View|Response
     */
    public function create(): Factory|View|Response|Application
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
     * @param CreateLoanRequest $request
     * @return RedirectResponse
     */
    public function store(CreateLoanRequest $request): RedirectResponse
    {
        try {
            $payload = new LoanDTO(array_merge($request->except('_token'), ['user_id' => $this->currentUser->id]));
            $loan = $this->loanService->createLoan((array) $payload->toArray());
        } catch (Exception $e) {
            return redirect()->back()->withErrors($e);
        }

        Session()->flash('success', 'Created successfully');
        return redirect()->action(
            [LoansController::class, 'show'], $loan->id
        );
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Application|Factory|View|Response
     */
    public function show(int $id): Factory|View|Response|Application
    {
        $loan = new LoanDTO($this->loanService->getLoanById($id));
        $rePayments = $this->loanService->pmtCalculate($loan);

        return view('loans.show',
            [
                'loan' => $loan,
                'rePayments' => $rePayments
            ]
        );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return Application|Factory|View|Response
     */
    public function edit(int $id): Factory|View|Response|Application
    {
        return view('loans.update',
            [
                'loan' => new LoanDTO($this->loanService->getLoanById($id)),
                'months' => $this->loanService->getMonthScope(),
                'years' => $this->loanService->getYearScope()
            ]
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param CreateLoanRequest $request
     * @param int $id
     * @return RedirectResponse
     */
    public function update(CreateLoanRequest $request, int $id): RedirectResponse
    {
        try {
            $payload = new LoanDTO(array_merge($request->except('_token'), ['user_id' => $this->currentUser->id]));
            $loan = $this->loanService->getLoanById($id);
            $this->loanService->updateLoan((array) $payload->toArray(), $loan);
        } catch (Exception $e) {
            return redirect()->back()->withErrors($e);
        }

        Session()->flash('success', 'Updated successfully');
        return redirect()->action(
            [LoansController::class, 'show'],
            $loan->id
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return RedirectResponse
     */
    public function destroy(int $id): RedirectResponse
    {
        try {
            $this->loanService->deleteLoan($id);
        } catch (Exception $e) {
            return redirect()->back()->withErrors($e);
        }

        Session()->flash('success', 'Deleted successfully');
        return redirect()->action(
            [LoansController::class, 'index']
        );
    }
}
