@extends('includes.bootstrap-layout')

@push('styles')
    <style>
        .body-cart {
            padding: 50px;
        }
        div.table-responsive{
            margin-top: 50px
        }
        a{
            color: black;
            margin-left: 10px;
        }
        a:hover{
            color: gray;
            text-decoration: none
        }
        a.circled {
            border-radius: 50%;
            height: 40px;
            width: 40px;
        }
    </style>
@endpush
@section('content')
    <div class="body-cart">
        <div class="row">
            <div class="col-md-12">
                <div class="col-md-12">
                    <a class="float-right btn btn-warning" href="{{ route('logout') }}">Logout</a>
                    @if($user_role == 'employee')
                        <button class="float-right btn btn-info" id="modal-btn" data-toggle="modal" data-target="#expense-creation-modal">
                            Create An Expense
                        </button>
                    @endif
                </div>
                <div class="table-responsive">
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th> ID </th>
                                @if($user_role == 'employee')
                                    <th> Employee Name </th>
                                @endif
                                <th> Name </th>
                                <th> Date </th>
                                <th> Attachment </th>
                                <th> Amount </th>
                                <th> Status </th>
                                <th> Actions </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($expenses_collection as $expense)
                                <tr>
                                    <td> {{ $expense->id }} </td>
                                    @if($user_role == 'employee')
                                        <td> {{ optional($expense->employee)->name }} </td>
                                    @endif
                                    <td> {{ $expense->name }} </td>
                                    <td> {{ $expense->date }} </td>
                                    <td>
                                        <a href="{{ $expense->attachment }}" target="_blank"> Show {{ $expense->name }} Attachment </a>
                                    </td>
                                    <td> {{ $expense->amount }} </td>
                                    <td> {{ ucfirst($expense->status) }} </td>
                                    <td>
                                        @if($user_role == 'manager')
                                            @include('expenses.manager-actions')
                                        @else
                                            @include('expenses.employee-actions')
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $expenses_collection->links() }}
                </div>
            </div>
        </div>
    </div>
    @if($user_role == 'employee')
        @include('expenses.create-form')
    @endif
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            @if(session()->has('warning'))
                swal('Warning' ,'{{ session('warning') }}' ,'warning')
            @endif
            @if(session()->has('success'))
                swal('Success' ,'{{ session('success') }}' ,'success')
            @endif
            @if(session()->has('error'))
                swal('Error' ,'{{ session('error') }}' ,'error')
            @endif
            @if($errors->any())
                $("#modal-btn").click()
            @endif
        })
    </script>
@endpush