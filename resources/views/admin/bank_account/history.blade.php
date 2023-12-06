@extends('admin.admin-dashboard')

@section('content')
<div class="content-body" style="min-height: 500px">
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">{{  $account->name  }} - Transection History</h4>
            </div>
            <div class="row">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-responsive-md">
                            <thead>
                                <tr>
                                   <th class="width80"><strong>#</strong></th>
                                   <th><strong>Date</strong></th>
                                   <th><strong>Type</strong></th>
                                   <th><strong>Credit</strong></th>
                                   <th><strong>Debit</strong></th>
                                </tr>
                            </thead>
                            <tbody>
                               @if($history->currentPage()==1)
                                    <tr>
                                    <td>0</td>
                                    <td>{{ date("d/m/Y",strtotime($account->created_at)) }}</td>
                                    <td>Opening Balance</td>
                                    <td><span class="text-success">{{ $account->opening_balance }}</span></td>
                                    <td><span class="text-danger">0</span></td>
                                </tr>
                                @endif
                                @php $counter=1;@endphp

                                @foreach($history as $key => $item)
                                @php
                                $model=$item['model'];
                                @endphp
                                <tr>
                                   <td><strong>{{ $history->currentPage()!=1?$history->currentPage()*$history->perPage()+$counter+1:$counter }}</strong></td>
                                   <td>{{ date("d/m/Y",strtotime($item['payment_date'])) }}</td>
                                   <td>{{ $item['type']=="pay"?"Spent / Pay":"Received" }}</td>
                                    <td>
                                        @if($model == "App\Payment" && $item['type'] == "receive")
                                        <span class="text-success">{{ $item['amount'] }}</span>
                                        @else
                                        <span class="text-success">0</span>
                                        @endif
                                   </td>
                                   <td>
                                        @if($model == "App\Payment" && $item['type'] == "pay")
                                        <span class="text-danger">{{ $item['amount'] }}</span>
                                        @else
                                        <span class="text-danger">0</span>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $history->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection