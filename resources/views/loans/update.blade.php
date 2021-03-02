<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Update Loan') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
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
                            <form action="{{ route('loans.update', $loan->getId()) }}" method="post">
                                @csrf
                                @method('put')
                                <label for="amount">{{ __('Loan Amount') }}</label>
                                <div class="input-group mb-2">
                                    <input type="number" class="form-control" name="amount" value="{{ $loan->getAmount() }}">
                                    <div class="input-group-append">
                                        <span class="input-group-text">฿</span>
                                    </div>
                                </div>
                                <label for="term">{{ __('Loan Term') }}</label>
                                <div class="input-group mb-2">
                                    <input type="number" class="form-control" name="term" value="{{ $loan->getTerm() }}">
                                    <div class="input-group-append">
                                        <span class="input-group-text">Years</span>
                                    </div>
                                </div>
                                <label for="rate">{{ __('Interest Rate') }}</label>
                                <div class="input-group mb-2">
                                    <input type="number" class="form-control" name="rate" step=".01" min="0" value="{{ $loan->getRate() }}">
                                    <div class="input-group-append">
                                        <span class="input-group-text">%</span>
                                    </div>
                                </div>
                                <label for="start_date">{{ __('Start Date') }}</label>
                                <div class="form-group mb-3 ml-5">
                                    <div class="container row">
                                        <select class="col-5 custom-select" name="start_month">
                                            <option value="">-</option>
                                            @foreach($months as $index => $month)
                                            <option value="{{ $index }}"
                                                @if ($loan->getStartMonth() == $index)
                                                    selected
                                                @endif
                                            >{{ $month }}</option>
                                            @endforeach
                                        </select>
                                        <div class="col-1"></div>
                                        <select class="col-5 custom-select" name="start_year">
                                            <option value="">-</option>
                                            @foreach($years as $index => $year)
                                            <option value="{{ $year }}"
                                                @if ($loan->getStartYear() == $year)
                                                    selected
                                                @endif
                                            >{{ $year }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="flex items-center justify-end mt-4">
                                    <button type="submit" class="btn btn-primary">{{ __('Update') }}</button>
                                    <a href="{{ route('loans.index') }}" class="btn btn-secondary ml-2">Back</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
