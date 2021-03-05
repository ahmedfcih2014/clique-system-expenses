<div class="modal fade" id="expense-creation-modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Create Your Expense</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('expenses.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    @if($errors->any())
                        @foreach($errors->all() as $e)
                            <div class="alert alert-danger"> {{ $e }} </div>
                        @endforeach
                    @endif
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label> Name </label>
                                <input class="form-control" required placeholder="Name" name="name" value="{{ old('name') }}"/>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label> Date </label>
                                <input class="form-control" required placeholder="YYYY-MM-DD" name="date" type="date" value="{{ old('date') }}"/>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label> Amount </label>
                                <input class="form-control" required placeholder="Amount" name="amount" value="{{ old('amount') }}"/>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label> Attachment </label>
                                <input class="form-control" required placeholder="Attachment" name="attachment" type="file"/>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="clearfix"></div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Create Expense</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>