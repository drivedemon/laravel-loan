<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('All Loans') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="container">
                    <div class="card mt-3 mb-3">
                        <div class="card-header">
                            <a href="{{ route('loans.create') }}" class="btn btn-primary">Add New Loan</a>
                        </div>
                        <div class="card-body">
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
                                            <a href="{{ route('loans.show', 1) }}" class="btn btn-sm btn-info">View</a>
                                            <a href="{{ route('loans.edit', 1) }}" class="btn btn-sm btn-success">Edit</a>
                                            <a href="{{ route('loans.destroy', 1) }}" class="btn btn-sm btn-danger">Delete</a>
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
</x-app-layout>
