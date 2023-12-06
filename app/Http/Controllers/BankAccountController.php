<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use App\Models\BankAccount;
use App\Models\Payment;

class BankAccountController extends Controller
{

    public function paginate($items, $perPage = 15, $page = null, $options = [])
    {
        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);

        $items = $items instanceof Collection ? $items : Collection::make($items);

        // return new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, $options);
        return new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, ['path' => Paginator::resolveCurrentPath()]);
    }

    public function index(){
        $result = BankAccount::orderBy('id','desc')->paginate(10);
        return view('admin.bank_account.create',compact('result'));
    }

    public function store(Request $request){
        $request->validate([
            'name' => 'required|unique:bank_accounts',
            'opening_balance' => 'required',
        ]);

        BankAccount::create([
            'name'=>$request->name,
            'opening_balance'=>$request->opening_balance
        ]);

        return back()->with('success','Bank Account created successfully');
    }

    public function history(BankAccount $account)
    {
        // dd($account);
        if (!isset($_GET['page'])) {
            $page = 1;
        } else {
            $page = $_GET['page'];
        }

        // IDENTIFIER

        $payment = Payment::where('bank_account_id', $account->id)
            ->get(['payment_date as payment_date', 'amount as amount', 'payment_type as type', DB::raw('"\\App\\\Payment" as model'), 'id', DB::raw('"" as note')])->toArray();


        $payment = array_merge($payment);
        $payment = collect($payment);
        $history = $payment->sortByDesc('payment_date');
        $history = $this->paginate($history, 20);

        return view('admin.bank_account.history', compact('history', 'account'));
    }
}
