@extends('admin.admin-dashboard')

@section('content')
<div class="content-body" style="min-height: 500px">
    <div class="container-fluid">
        <div class="row">
            <div class="col-5">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Bank Account</h4>
                    </div>
                    <div class="card-body">
                        <div class="basic-form">
                            <form method="POST" action="{{ route('bank_account.store') }}">
                                @csrf
                                <div class="row">
                                    <div class="mb-3 col-md-6">
                                        <label class="form-label">Name<span class="text-danger">*</span> :</label>
                                        <input type="text" class="form-control" placeholder="Account Name"
                                            name="name">
                                        @if($errors->has('name'))
                                            <span class="invalid-feedback">{{ $errors->first('name') }}</span>
                                        @endif
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label class="form-label">Opening Balance<span class="text-danger">*</span> :</label>
                                        <input type="text" class="form-control" placeholder="Opening Balance"
                                            name="opening_balance">
                                        @if($errors->has('opening_balance'))
                                            <span class="invalid-feedback">{{ $errors->first('opening_balance') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-success">Add</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-7">
                <div class="card">
                    <div class="card-header">
                            <h4 class="card-title">Bank Account List</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-responsive-md">
                                <thead>
                                    <tr>
                                        <th class="width80"><strong>#</strong></th>
                                        <th><strong>NAME</strong></th>
                                        <th>Opening Balance</th>
                                        <th>Current Balance</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $i=1; @endphp
                                    @foreach ($result as $item)
                                    <tr>
                                        <td><strong>{{$i++}}</strong></td>
                                        <td>{{$item->name}}</td>
                                        <td>Tk.{{  number_format($item->opening_balance, 2) }}</td>
                                        <td>Tk.{{ number_format($item->balance(), 2) }}</td>
                                        <td>
                                            <a href="{{ route('bank_account.history', $item->id) }}" class="btn btn-primary btn-sm">
                                            <i class="far fa-address-book"></i>
                                            History
                                            </a>
                                        </td>
                                    </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('extra_js')

@endsection
