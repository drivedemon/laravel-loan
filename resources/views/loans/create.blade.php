<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create Loan') }}
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
                            <form action="{{ isset($loan) ? route('loans.update', $loan->id) : route('loans.store') }}" method="post">
                                @csrf
                                @if (isset($loan))
                                @method('put')
                                @endif
                                <label for="loan_amount">{{ __('Loan Amount') }}</label>
                                <div class="input-group mb-2">
                                    <input type="number" class="form-control" name="loan_amount" value="{{ $loan->amount ?? '' }}">
                                    <div class="input-group-append">
                                        <span class="input-group-text">฿</span>
                                    </div>
                                </div>
                                <label for="loan_term">{{ __('Loan Term') }}</label>
                                <div class="input-group mb-2">
                                    <input type="number" class="form-control" name="loan_term" value="{{ $loan->term ?? '' }}">
                                    <div class="input-group-append">
                                        <span class="input-group-text">Years</span>
                                    </div>
                                </div>
                                <label for="rate">{{ __('Interest Rate') }}</label>
                                <div class="input-group mb-2">
                                    <input type="number" class="form-control" name="rate" value="{{ $loan->rate ?? '' }}">
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
                                            @php ($index++)
                                            <option value="{{ $index }}" {{ $loan->start_month == $index ? 'selected' : '-' }}>
                                                {{ $month }}
                                            </option>
                                            @endforeach
                                        </select>
                                        <div class="col-1"></div>
                                        <select class="col-5 custom-select" name="start_year">
                                            <option value="">-</option>
                                            @foreach($years as $index => $year)
                                            <option value="{{ $year }}" {{ $loan->start_year == $year ? 'selected' : '-' }}>
                                                {{ $year }}
                                            </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="flex items-center justify-end mt-4">
                                    <x-jet-button class="btn-primary">
                                        {{ isset($loan) ? __('Update') : __('Create') }}
                                    </x-jet-button>
                                    <x-jet-button class="btn-secondary ml-2" href="{{ route('loans.index') }}">
                                        {{ __('Back') }}
                                    </x-jet-nav-link>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
