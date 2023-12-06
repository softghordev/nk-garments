<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Helpers\InputHelper;
use App\Models\Department;
use App\Models\Employee;
use App\Models\EmployeeEducationalTraining;
use App\Models\EmployeePersonalInformation;
use App\Models\EmployeeSalary;
class EmployeeController extends Controller
{
    private $file_path;
    private $default_image;

    public function __construct()
    {
        $this->file_path = 'asset/employee/';
        $this->default_image = 'asset/placeholder_190x140c.png';
    }

    public function index(){
        $result =  Employee::orderBy('id','desc')->paginate(20);
        return view('admin.employee.index',compact('result'));
    }

    function create(Request $request)
    {
        $departments = Department::all();
        return view('admin.employee.create',compact('departments'));
    }

    function store(Request $request){
        $validated = $request->validate([
            'employee_name' => 'required|max:255',
            'department_id' => 'required',
            'designation' => 'required',
            'employee_type' => 'required',
            'join_date' => 'required',
            'phone' => 'required',
            'current_address' => 'required',
            'fathers_name' => 'required|max:255',
            'mothers_name' => 'required|max:255',
            'date_of_birth' => 'required',
            'blood_group' => 'required',
            'permanent_address' => 'required',
            'educational_qualification' => 'required',
            'basic_salary' => 'required',
            'total_salary' => 'required',
            'photo' => 'image|mimes:jpeg,png,jpg,gif,svg'
        ]);

        try {
            DB::beginTransaction();
            
            if ($request->hasFile('image')) {
                $employee_image = InputHelper::upload($request->image, $this->file_path);
            } else {
                $employee_image = $this->default_image;
            }
            //Employee Basic Information
            $employee = Employee::create([
                'employee_name'   => $request->employee_name,
                'department_id'   => $request->department_id,
                'designation'     => $request->designation,
                'employee_type'   => $request->employee_type,
                'join_date'       => $request->join_date,
                'phone'           => $request->phone,
                'email'           => $request->email,
                'image'           => $employee_image,
            ]);
            
            //Employee Personal Information
            $employee->personal()->create([
                'fathers_name'      => $request->employee_name,
                'mothers_name'      => $request->mothers_name,
                'spouse_name'       => $request->spouse_name,
                'date_of_birth'     => $request->date_of_birth,
                'nid'               => $request->nid,
                'blood_group'       => $request->blood_group,
                'permanent_address' => $request->permanent_address,
                'emergency_contact' => $request->emergency_contact,
            ]);

            //Employee Educational Information
            $employee->educational()->create([
                'educational_qualification'  => $request->educational_qualification,
                'educational_details'        => $request->educational_details,
                'training'                   => $request->training,
                'experience'                 => $request->experience,
            ]);
            
            //Employee Salary Information
            $employee->salary()->create([
                'basic_salary'            => $request->basic_salary,
                'house_rent'              => $request->house_rent,
                'medical_allowance'       => $request->medical_allowance,
                'child_allowance'         => $request->child_allowance,
                'communication_allowance' => $request->communication_allowance,
                'special_allowance'       => $request->special_allowance,
                'lta'                     => $request->lta,
                'bonus'                   => $request->bonus,
                'total_salary'            => $request->total_salary,
            ]);

            DB::commit();
            return back()->with('success', 'data saved!');

        } catch (\Exception $e) {
            DB::rollback();
            info($e);
            return back()->with('warning', 'Opps operation failed!');
         }
    }

    public function destroy(Employee $employee)
    {
        if ($employee->delete()) {
            session()->flash('success', 'Employee Deleted Successfully.');
        } else {
            session()->flash('warning', 'Deletion Failed.');
        }
        return back();
    }
}
