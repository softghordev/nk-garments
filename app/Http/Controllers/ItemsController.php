<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Helpers\InputHelper;
use App\Models\brand;
use App\Models\items;
use App\Models\Unit;
use App\Models\ItemVariation;
class ItemsController extends Controller
{

    private $file_path;
    private $default_image;

    public function __construct()
    {
        $this->file_path = 'asset/item_image/';
        $this->default_image = 'asset/placeholder_190x140c.png';
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $result = items::orderBy('id','desc')->paginate(20);
        return view('admin.item.index',compact('result'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $brand = brand::all();
        $unit_exist = Unit::first();
        if(!$unit_exist){
            session()->flash('error','No Unit Exist');
            return back();
        }

        $data['units']=Unit::all();
        $data['first_unit']=Unit::first();
        return view('admin.item.create',$data, compact('brand'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

     
    public function update_variations($item){
        if ($item->sizes->count() > 0 && $item->colors->count() > 0) {
            foreach ($item->sizes as $size) {
                foreach ($item->colors as $color) {
                    $exist = $item->variations()->where('item_size_id', $size->id)
                        ->where('item_color_id', $color->id)
                        ->first();
                    if (!$exist) {
                        $item->variations()->create([
                            'item_size_id' => $size->id,
                            'item_color_id' => $color->id
                        ]);
                    }
                }
            }
        } elseif ($item->sizes->count() > 0) {
            foreach ($item->sizes as $size) {
                $exist = $item->variations()->where('item_size_id', $size->id)
                    ->whereNull('item_color_id')
                    ->first();
                if (!$exist) {
                    $item->variations()->create([
                        'item_size_id' => $size->id,
                    ]);
                }
            }
        } elseif ($item->colors->count() > 0) {
            foreach ($item->colors as $color) {
                $exist = $item->variations()->where('item_color_id', $color->id)
                    ->whereNull('item_size_id')
                    ->first();
                if (!$exist) {
                    $item->variations()->create([
                        'item_color_id' => $color->id
                    ]);
                }
            }
        }
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'main_unit_id' => 'required',
            'unit_price' => 'required',
            'unit_price_for_salary' => 'required',
        ]);
        
        try {
            DB::beginTransaction();

        if ($request->hasFile('image')) {
            $item_image = InputHelper::upload($request->image, $this->file_path);
        } else {
            $item_image = $this->default_image;
        }

        $item = new items();
        $item->type = $request->type;
        $item->name = $request->name;
        $item->weight = $request->weight;
        $item->count = $request->count;
        $item->brand = $request->brand;
        $item->single_dye = $request->single_dye;
        $item->double_dye = $request->double_dye;
        $item->wash = $request->wash;
        $item->roll = $request->roll;
        $item->main_unit_id=$request->main_unit_id;
        $item->sub_unit_id=$request->sub_unit_id;
        $item->finished = $request->finished;
        $item->gsm = $request->gsm;
        $item->source = $request->source;
        $item->cone = $request->cone;
        $item->production_type = $request->production_type;
        $item->csp = $request->csp;
        $item->twist = $request->twist;
        $item->image = $item_image;
        $item->unit_price = $request->unit_price;
        $item->unit_price_for_salary = $request->unit_price_for_salary;
        $item->note = $request->note;
        $item->show_variation=$request->show_variation;
        $item->save();

         //update_variations
         if ($item) {
            foreach ($request->size as $size) {
                if ($size != null) {
                    $item->sizes()->create([
                        'size' => $size
                    ]);
                }
            }

            foreach ($request->color as $color) {
                if ($color != null) {
                    $item->colors()->create([
                        'color' => $color
                    ]);
                }
            }
            
            $this->update_variations($item);
        }
     


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
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // Your show logic here
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // Your edit logic here
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // Your update logic here
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Your destroy logic here
    }

    public function stock()
    {
        $result = items::orderBy('id','desc')->paginate(20);
        return view('admin.item.stock',compact('result'));
    }


    public function getVariations($itemId)
    {
        $variations = items::where('show_variation', 1)
            ->findOrFail($itemId)
            ->variations()
            ->with('item_size', 'item_color')
            ->get();
    
        // Include stock information in the response
        foreach ($variations as $variation) {
            $variation->stock = $variation->stock(); // Make sure the stock method is defined in the ItemVariation model
        }
    
        return response()->json($variations);
    }

}
