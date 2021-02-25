<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('All Loans') }}
        </h2>
    </x-slot>

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

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="container">
                    <div class="card mt-3 mb-3">
                        <div class="card-header">
                            <a href="{{ route('loans.create') }}" class="btn btn-primary">Add New Loan</a>
                            <a class="btn btn-dark float-right" data-toggle="collapse" href="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                                Advanced Search
                            </a>
                        </div>
                        <div class="card-body">
                            @php ($checkQuery = request()->get('min_amount') ? 'show' : '-')
                            <div class="collapse {{ $checkQuery }}" id="collapseExample">
                                <div class="card-header font-weight-bold">
                                    Advanced Search
                                </div>
                                <div class="card card-body">
                                    <form action="{{route('loans.index')}}" method="get">
                                        @csrf
                                        <div class="form-group row">
                                            <label class="col-sm-12 font-weight-bold">Loan Amount(THB)</label>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-1 font-weight-bold">Min:</label>
                                            <input type="number" class="col-sm-2 form-control" placeholder="10000" name="min_amount" value="{{ request()->get('min_amount') ?? '-' }}">
                                            <label class="col-sm-1 font-weight-bold">Max:</label>
                                            <input type="number" class="col-sm-2 form-control" placeholder="100000000" name="max_amount" value="{{ request()->get('max_amount') ?? '-' }}">
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-12 font-weight-bold">Interest Rate(%)</label>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-1 font-weight-bold">Min:</label>
                                            <input type="number" class="col-sm-2 form-control" placeholder="1" name="min_rate" value="{{ request()->get('min_rate') ?? '-' }}">
                                            <label class="col-sm-1 font-weight-bold">Max:</label>
                                            <input type="number" class="col-sm-2 form-control" placeholder="100" name="max_rate" value="{{ request()->get('max_rate') ?? '-' }}">
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-12 font-weight-bold">Payment Amount</label>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-1 font-weight-bold">Min:</label>
                                            <input type="number" class="col-sm-2 form-control" placeholder="1000" name="min_rate" value="{{ request()->get('min_rate') ?? '-' }}">
                                            <label class="col-sm-1 font-weight-bold">Max:</label>
                                            <input type="number" class="col-sm-2 form-control" placeholder="50000" name="max_rate" value="{{ request()->get('max_rate') ?? '-' }}">
                                        </div>

                                        <input type="submit" name="Search" value="Search" title="Search" class="btn btn-sm btn-secondary">
                                    </form>
                                </div>
                                <br>
                            </div>
                            <table class="table table-hover" style="width:100%;">
                                <thead>
                                    <tr>
                                        <th style="width:5%;">ID</th>
                                        <th style="width:20%;">Loan Amount</th>
                                        <th style="width:20%;">Loan Term</th>
                                        <th style="width:15%;">Interest Rate</th>
                                        <th style="width:20%;">Created at</th>
                                        <th style="width:20%;">Edit</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($loans as $index => $loan)
                                    @php ($index++)
                                    <tr>
                                        <td>{{ $index }}</td>
                                        <td>{{ $loan->amount }} ฿</td>
                                        <td>{{ $loan->term }} Years</td>
                                        <td>{{ round($loan->rate, 2) }} %</td>
                                        <td>{{ $loan->created_at }}</td>
                                        <td>
                                            <form class="delete_form" action="{{route('loans.destroy', $loan->id)}}" method="post">
                                                @csrf
                                                <input type="hidden" name="_method" value="DELETE">
                                                <a href="{{ route('loans.show', $loan->id) }}" class="btn btn-sm btn-info">View</a>
                                                <a href="{{ route('loans.edit', $loan->id) }}" class="btn btn-sm btn-success">Edit</a>
                                                <input type="submit" name="Delete" value="Delete" title="Delete" class="btn btn-sm btn-danger">
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {{ $loans->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
    $(document).ready(function() {
        $('.delete_form').on('submit', function() {
            if (confirm('Confirm to delete!')) {
                return true;
            } else {
                return false;
            }
        })
    })
    </script>
</x-app-layout>
