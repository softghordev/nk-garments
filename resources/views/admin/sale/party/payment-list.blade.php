@extends('admin.admin-dashboard')

@section('content')
<div class="content-body" style="min-height: 500px">
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Party Sale Payments List</h4>
            </div>
            <div class="row">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-responsive-md">
                            <thead>
                                <tr>
                                   <th class="width80"><strong>#</strong></th>
                                   <th><strong>Payment Date</strong></th>
                                   <th><strong>Bank Account</strong></th>
                                   <th><strong>Type</strong></th>
                                   <th><strong>Source Of Payment</strong></th>
                                   <th><strong>Invoice Number</strong></th>
                                   <th><strong>Amount</strong></th>
                                   <th><strong>Action</strong></th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $i=1; @endphp
                                @foreach ($payments as $payment)
                                <tr>
                                   <td>{{ $payment->id}}</td>
                                   <td>{{date('d M, Y', strtotime($payment->payment_date))}}</td>
                                   <td>{{ $payment->account->name}}</td>
                                   <td>{{ $payment->payment_type}}</td>
                                   <td>{{ $payment->source_of_payment}}</td>
                                   <td>{{ $payment->paymentable_id}}</td>
                                   <td>{{ $payment->amount}}</td>
                                   <td>
                                       <div class="btn-group" role="group">
                                            <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown">Action</button>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item" href="" data-bs-toggle="modal" data-bs-target=".delete-modal" onclick="handle({{ $payment->id }})">Delete</a>
                                            </div>
                                        </div>
                                   </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {!! $payments->appends(Request::except('_token'))->links() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@include('admin.inc.delete-modal')
@endsection

@section('extra_js')
<script>
    //Delete Code
    function handle(id) {
       var url = "{{ route('payment.destroy', 'payment_id') }}".replace('payment_id', id);
        $("#delete-form").attr('action', url);
       $("#confirm-modal").modal('show');
     }

    //Side Menu Hidden
    // $('#main-wrapper').toggleClass("menu-toggle");
</script>
@endsection
