@if($expense->status == 'pending')
    <a href="{{ route('expenses.cancel' ,['expense_id' => $expense->id]) }}" class="btn btn-danger circled" title="Cencel {{ $expense->name }}">
        <i class="fa fa-times"></i>
    <a>
@endif