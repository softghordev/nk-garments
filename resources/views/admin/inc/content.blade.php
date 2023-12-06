@extends('admin.admin-dashboard')

@section('content')
     <div class="content-body">
            <!-- row -->
			<div class="container-fluid">
				<div class="form-head mb-4">
					<h2 class="text-black font-w600 mb-0">Dashboard</h2>
				</div>
				<div class="row">
					<div class="col-xl-6">
						<div class="row">
							<div class="col-xl-8 col-lg-6 col-md-7 col-sm-8">
								<div class="card-bx stacked">
									<img src="{{asset('asset/images/card/card.png')}}" alt="" class="mw-100">
									<div class="card-info text-white">
										<p class="mb-1">Main Balance</p>
										<h2 class="fs-36 text-white mb-sm-4 mb-3">{{ \App\Models\BankAccount::sumAllBalances() }} BDT</h2>
										<div class="d-flex align-items-center justify-content-between mb-sm-5 mb-3">
											<img src="{{asset('asset/images/dual-dot.png')}}" alt="" class="dot-img">
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>

				</div>
            </div>
        </div>
@endsection