<div class="deznav">
    <div class="deznav-scroll">
        <ul class="metismenu" id="menu">
            <li><a href="{{url('home')}}">
                    <i class="flaticon-381-networking"></i>
                    <span class="nav-text">Dashboard</span>
                </a>
            </li>

            <li>
                <a href="{{route('bank_account.index')}}">
                    <i class="fas fa-university"></i>
                    <span class="nav-text">Bank Account</span>
                </a>
            </li>

            <li>
                <a href="{{route('department.create')}}">
                    <i class="fas fa-hotel"></i>
                    <span class="nav-text">Department</span>
                </a>
            </li>

            <li>
                <a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                    <i class="fas fa-box"></i>
                    <span class="nav-text">Items</span>
                </a>
                <ul aria-expanded="false">
                    <li><a href="{{route('item.create')}}">Item Create</a></li>
                    <li><a href="{{route('item.index')}}">Item List</a></li>
                    <li><a href="{{route('brand.create')}}">Brand Create</a></li>
                    <li><a href="{{route('unit.create')}}">Unit Create</a></li>
                    <li><a href="{{route('item.stock')}}">Stock</a></li>
                </ul>
            </li>
        
            <li>
                <a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                    <i class="fas fa-shopping-cart"></i>                    
                    <span class="nav-text">Purchase</span>
                </a>
                <ul aria-expanded="false">
                    <li><a class="has-arrow" href="javascript:void()" aria-expanded="false">Party Purchase</a>
                        <ul aria-expanded="false">
                            <li><a href="{{ route('party-purchase.create') }}">Party Purchase Create</a></li>
                            <li><a href="{{ route('party-purchase.index') }}">Party Purchase List</a></li>
                            <li><a href="{{ route('party-purchase.report') }}">Party Purchase Report</a></li>
                        </ul>
                    </li>
                </ul>
                <ul aria-expanded="false">
                    <li><a class="has-arrow" href="javascript:void()" aria-expanded="false">Petty Purchase</a>
                        <ul aria-expanded="false">
                            <li><a href="{{ route('petty-purchase.create') }}">Petty Purchase Create</a></li>
                            <li><a href="{{ route('petty-purchase.index') }}">Petty Purchase List</a></li>
                            <li><a href="{{ route('petty-purchase.report') }}">Petty Purchase Report</a></li>
                        </ul>
                    </li>
                </ul>
            </li>

            <li>
                <a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                    <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                    <span class="nav-text">Sales</span>
                </a>
                <ul aria-expanded="false">
                    <li><a class="has-arrow" href="javascript:void()" aria-expanded="false">Party Sale</a>
                        <ul aria-expanded="false">
                            <li><a href="{{route('party-sale.create')}}">Add Party Sale</a></li>
                            <li><a href="{{ route('party-sale.index') }}">Party Sales List</a></li>
                            <li><a href="{{ route('party-sale.report') }}">Party Sales Report</a></li>
                        </ul>
                    </li>
                </ul>

                <ul aria-expanded="false">
                    <li><a class="has-arrow" href="javascript:void()" aria-expanded="false">Cash Sale</a>
                        <ul aria-expanded="false">
                            <li><a href="{{route('cash-sale.create')}}">Add Cash Sale</a></li>
                            <li><a href="{{ route('cash-sale.index') }}">Cash Sales List</a></li>
                            <li><a href="{{ route('cash-sale.report') }}">Cash Sales Report</a></li>
                        </ul>
                    </li>
                </ul>

                <ul aria-expanded="false">
                    <li><a class="has-arrow" href="javascript:void()" aria-expanded="false">Wastage Sale</a>
                        <ul aria-expanded="false">
                            <li><a href="{{route('wastage-sale.create')}}">Add Wastage Sale</a></li>
                            <li><a href="{{ route('wastage-sale.index') }}">Wastage Sales List</a></li>
                            <li><a href="{{ route('wastage-sale.report') }}">Wastage Sales Report</a></li>
                        </ul>
                    </li>
                </ul>
            </li>

            <li>
                <a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                    <i class="fas fa-truck"></i>
                    <span class="nav-text">Challan</span>
                </a>
                <ul aria-expanded="false">
                    <li><a class="has-arrow" href="javascript:void()" aria-expanded="false">Receive Challan</a>
                        <ul aria-expanded="false">
                            <li><a href="{{ route('receive-challan.index') }}">Receive Challan List</a></li>
                            <li><a href="{{ route('receive-challan.report') }}">Receive Challan Report</a></li>
                        </ul>
                    </li>
                </ul>
                
                <ul aria-expanded="false">
                    <li><a class="has-arrow" href="javascript:void()" aria-expanded="false">Delivery Challan</a>
                        <ul aria-expanded="false">
                            <li><a href="{{ route('delivery-challan.index') }}">Delivery Challan List</a></li>
                            <li><a href="{{ route('delivery-challan.report') }}">Delivery Challan Report</a></li>
                        </ul>
                    </li>
                </ul>

                <ul aria-expanded="false">
                    <li><a class="has-arrow" href="javascript:void()" aria-expanded="false">Moving Challan</a>
                        <ul aria-expanded="false">
                            <li><a href="{{route('moving-challan.create')}}">Add Moving Challan</a></li>
                            <li><a href="{{ route('moving-challan.index') }}">Moving Challan List</a></li>
                            <li><a href="{{ route('moving-challan.report') }}">Moving Challan Report</a></li>
                        </ul>
                    </li>
                </ul>
            </li>

            <li>
                <a href="{{route('payment.index')}}">
                    <i class="fa-regular fa-money-bill-1"></i>
                    <span class="nav-text">Payments List</span>
                </a>
            </li>

            <li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                   <i class="fas fa-users-cog"></i>
                    <span class="nav-text">Employee</span>
                </a>
                <ul aria-expanded="false">
                    <li><a href="{{route('employee.index')}}">Employee List</a></li>
                    <li><a href="{{route('employee.create')}}">Employee Create</a></li>
                </ul>
            </li>

            <li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                    <i class="fas fa-book"></i>
                    <span class="nav-text">Reports</span>
                </a>
                <ul aria-expanded="false">
                    <li><a href="{{route('top-sale-item.report')}}">Top Sale Item</a></li>
                    <li><a href="{{route('top-purchase-item.report')}}">Top Purchase Item</a></li>
                    <li><a href="{{route('top-sale-party.report')}}">Top Sale Party</a></li>
                    <li><a href="{{route('top-purchase-party.report')}}">Top Purchase Party</a></li>
                </ul>
            </li>

            <li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                    <i class="fas fa-user-friends"></i>
                    <span class="nav-text">Party</span>
                </a>
                <ul aria-expanded="false">
                    <li><a href="{{route('party.create')}}">Party Create</a></li>
                    <li><a href="{{route('party.index')}}">Party List</a></li>
                </ul>
            </li>

            <li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                    <i class="fas fa-user-tag"></i>
                    <span class="nav-text">Roles</span>
                </a>
                <ul aria-expanded="false">
                    <li><a href="{{route('roles.index')}}">Roles List</a></li>
                    <li><a href="{{route('roles.create')}}">Roles Create</a></li>
                    <li><a href="{{route('permission.create')}}">Permission Create</a></li>
                </ul>
            </li>

        </ul>

        <div class="copyright">
            <p><strong>softghor Limited</strong> © {{ date('Y') }} All Rights Reserved</p>
            {{-- <p>Made with <span class="heart"></span> by zendbot</p> --}}
        </div>
    </div>
</div>
