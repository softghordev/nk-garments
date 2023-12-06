@extends('admin.admin-dashboard')

@section('content')
<div class="content-body" style="min-height: 500px">
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Items List</h4>
            </div>
            <div class="row">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-responsive-md">
                            <thead>
                                <tr>
                                    <th class="width80"><strong>#</strong></th>
                                    <th><strong>Itme Type</strong></th>
                                    <th><strong>Item Name</strong></th>
                                    <th><strong>Item Details</strong></th>
                                    <th><strong>Image</strong></th>
                                    <th><strong>Note</strong></th>
                                    <th><strong>Action</strong></th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $i=1; @endphp
                                @foreach ($result as $item)
                                <tr>
                                    <td><strong>{{$i++}}</strong></td>
                                    <td>{{$item->type}}</td>
                                    <td>{{$item->name}}</td>
                                    <td>{{'Color: '.$item->color.' ,'.' Brand: '.$item->brand}}</td>
                                    <td>
                                        <img src="{{ asset($item->image) }}" alt="item image" width="20%">
                                    </td>
                                    <td>{!! $item->note !!}</td>
                                <td>
                                    <button type="button" class="btn btn-info mb-2" data-bs-toggle="modal" data-bs-target=".bd-example-modal-lg{{$item->id}}">
                                    <i class="fa fa-eye" title="View Details"></i>
                                    </button>
                                    <div class="modal fade bd-example-modal-lg{{$item->id}}" tabindex="-1" role="dialog" aria-hidden="true">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">{{$item->name.' Details'}}</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal">
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="table-responsive">
                                                    <table class="table table-responsive">
                                                        <thead>
                                                            <tr>
                                                                <th><strong>Size</strong></th>
                                                                <th><strong>Weight</strong></th>
                                                                <th><strong>Count</strong></th>
                                                                <th><strong>Single Dye</strong></th>
                                                                <th><strong>Double Dye</strong></th>
                                                                <th><strong>Wash</strong></th>
                                                                <th><strong>Roll</strong></th>
                                                                <th><strong>Finished</strong></th>
                                                                <th><strong>GSM</strong></th>
                                                                <th><strong>Source</strong></th>
                                                                <th><strong>Cone</strong></th>
                                                                <th><strong>Production Type</strong></th>
                                                                <th><strong>CSP</strong></th>
                                                                <th><strong>Twist</strong></th>
                                                                <th><strong>Unit Price</strong></th>
                                                                <th><strong>Unit Price For Salary</strong></th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>

                                                            <tr>
                                                                <td>
                                                                    @if($item->variations->count()>0)
                                                                        @foreach ($item->variations as $variation)
                                                                        {{ $variation->name }},
                                                                        @endforeach
                                                                    @endif
                                                                <td>{{ $item->weight }}</td>
                                                                <td>{{ $item->count }}</td>
                                                                <td>{{ $item->single_dye }}</td>
                                                                <td>{{ $item->double_dye }}</td>
                                                                <td>{{ $item->wash }}</td>
                                                                <td>{{ $item->roll }}</td>
                                                                <td>{{ $item->finished }}</td>
                                                                <td>{{ $item->gsm }}</td>
                                                                <td>{{ $item->source }}</td>
                                                                <td>{{ $item->cone }}</td>
                                                                <td>{{ $item->production_type }}</td>
                                                                <td>{{ $item->csp }}</td>
                                                                <td>{{ $item->twist }}</td>
                                                                <td>{{ $item->unit_price }}</td>
                                                                <td>{{ $item->unit_price_for_salary }}</td>
                                                            </tr>

                                                        </tbody>
                                                    </table>
                                                    </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {!! $result->appends(Request::except('_token'))->links() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
