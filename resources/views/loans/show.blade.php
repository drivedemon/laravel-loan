<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Loan Detail') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="container">
                    <div class="card mt-3 mb-3">
                        <div class="card-header">
                            @if (Session::has('success'))
                            <div class="alert alert-success">
                                <ul class="list-group">
                                    <li class="list-group-item">{{ Session::get('success') }}</li>
                                </ul>
                            </div>
                            @elseif ($errors->any())
                            <div class="alert alert-danger">
                                <ul class="list-group">
                                    @foreach($errors->all() as $error)
                                    <li class="list-group-item">{{$error}}</li>
                                    @endforeach
                                </ul>
                            </div>
                            @endif
                        </div>
                        <div class="card-body">
                            <form>
                                <div class="form-group row">
                                    <label for="loan_amount" class="col-sm-4 font-weight-bold col-form-label">{{ __('ID:') }}</label>
                                    <div class="col-sm-8">
                                        <input type="text" readonly class="form-control-plaintext" value="{{ $loan->getId() }}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="loan_amount" class="col-sm-4 font-weight-bold col-form-label">{{ __('Loan Amount:') }}</label>
                                    <div class="col-sm-8">
                                        <input type="text" readonly class="form-control-plaintext" value="{{ $loan->getAmount() }} ฿">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="loan_amount" class="col-sm-4 font-weight-bold col-form-label">{{ __('Loan Term:') }}</label>
                                    <div class="col-sm-8">
                                        <input type="text" readonly class="form-control-plaintext" value="{{ $loan->getTerm() }} Years">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="loan_amount" class="col-sm-4 font-weight-bold col-form-label">{{ __('Interest Rate:') }}</label>
                                    <div class="col-sm-8">
                                        <input type="text" readonly class="form-control-plaintext" value="{{ $loan->getRate() }} %">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="loan_amount" class="col-sm-4 font-weight-bold col-form-label">{{ __('Created At:') }}</label>
                                    <div class="col-sm-8">
                                        <input type="text" readonly class="form-control-plaintext" value="{{ $loan->getCreatedAt() }}">
                                    </div>
                                </div>
                                <a href="{{ route('loans.index') }}" class="btn btn-secondary">Back</a>
                            </form>
                        </div>
                    </div>

                    <div class="card mt-3 mb-3">
                        <div class="card-header">
                            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                                {{ __('Repament Schedules') }}
                            </h2>
                        </div>
                        <div class="card-body">
                            <table class="table table-striped table-hover" style="width:100%;">
                                <thead>
                                    <tr>
                                        <th style="width:15%;">Payment NO</th>
                                        <th style="width:20%;">Date</th>
                                        <th style="width:20%;">Payment Amount</th>
                                        <th style="width:10%;">Principal</th>
                                        <th style="width:15%;">Interest</th>
                                        <th style="width:20%;">Balance</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($rePayments as $index => $payment)
                                    @php ($index++)
                                    <tr>
                                        <td>{{ $index }}</td>
                                        <td>{{ $payment['current_date'] }}</td>
                                        <td>{{ round($payment['payment_amount'], 2) }}</td>
                                        <td>{{ round($payment['principal'], 2) }}</td>
                                        <td>{{ round($payment['interest'], 2) }}</td>
                                        <td>{{ round($payment['balance'], 2) }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <a href="{{ route('loans.index') }}" class="btn btn-secondary">Back</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</x-app-layout>
