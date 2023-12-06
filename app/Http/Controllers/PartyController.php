<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Helpers\InputHelper;
use App\Models\Party;
class PartyController extends Controller
{

    private $file_path;
    private $default_image;

    public function __construct()
    {
        $this->file_path = 'asset/party/';
        $this->default_image = 'asset/placeholder_190x140c.png';
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $result =  Party::orderBy('id','desc')->paginate(20);
        return view('admin.party.index',compact('result'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.party.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'party_type' => 'required',
            'party_name' => 'required',
            'company_name' => 'required',
            'owner_name' => 'required',
            'phone' => 'required',
            'photo' => 'image|mimes:jpeg,png,jpg,gif,svg'
        ]);

        try {
            DB::beginTransaction();
            
            if ($request->hasFile('image')) {
                $party_image = InputHelper::upload($request->image, $this->file_path);
            } else {
                $party_image = $this->default_image;
            }

            //Party Create
            $party = Party::create([
                'party_type'         => $request->party_type,
                'party_name'         => $request->party_name,
                'company_name'       => $request->company_name,
                'owner_name'         => $request->owner_name,
                'company_address'    => $request->company_address,
                'email'              => $request->email,
                'web_page'           => $request->web_page,
                'business_phone'     => $request->business_phone,
                'home_phone'         => $request->home_phone,
                'phone'              => $request->phone,
                'country'            => $request->country,
                'party_bank_details' => $request->party_bank_details,
                'image'              => $party_image,
                'registration_date'  => $request->registration_date,
                'note'               => $request->note,
            ]);

            DB::commit();
            return back()->with('success', 'data saved!');

        } catch (\Exception $e) {
            DB::rollback();
            info($e);
            return back()->with('warning', 'Opps operation failed!');
         }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Party $party)
    {
        if ($party->delete()) {
            session()->flash('success', 'Party Deleted Successfully.');
        } else {
            session()->flash('warning', 'Deletion Failed.');
        }
        return back();
    }
}
