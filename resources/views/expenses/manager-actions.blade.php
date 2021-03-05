<a href="{{ route('expenses.approve' ,['expense_id' => $expense->id]) }}" class="btn btn-success circled" title="Approve {{ $expense->name }}">
    <i class="fa fa-check"></i>
<a>
<a href="{{ route('expenses.reject' ,['expense_id' => $expense->id]) }}" class="btn btn-danger circled" title="Reject {{ $expense->name }}">
    <i class="fa fa-ban"></i>
<a>