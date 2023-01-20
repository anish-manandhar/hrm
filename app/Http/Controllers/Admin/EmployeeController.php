<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\Employee;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class EmployeeController extends Controller
{
    public function __construct(User $employee)
    {
        $this->employee = $employee->where('user_type', 'Employee');
        $this->route = 'employee';
    }

    protected function getData($request)
    {
        $query = $this->employee->orderBy('id', 'DESC');
        if ($request->keyword) {
            $query = $query->where('name', 'LIKE', "%$request->keyword%");
        }
        if ($request->type) {
            if ($request->type == 'Ex')
                $query = $query->whereHas('employee', function ($query) {
                    $query->where('ex_employee', 1);
                });
            elseif ($request->type == 'Notice')
                $query = $query->whereHas('employee', function ($query) {
                    $query->where('notice_period', 1);
                });
        }
        return $query->paginate(20);
    }

    public function index(Request $request)
    {
        $data = [
            'page_title' => 'Employees',
            'employee' => $this->getData($request),
        ];
        return view('admin.employee.index', $data);
    }

    public function create()
    {
        $data = [
            'page_title' => 'Add Employee',
            'old_info' => null
        ];
        return view('admin.employee.form', $data);
    }

    private function objectValidate()
    {
        return [
            'name' => 'required',
            'status' => 'required',
            'email' => 'required|email',
            'alt_email' => 'nullable|email',
            'phone' => 'required|numeric|digits:10',
            'alt_phone' => 'nullable|numeric|digits:10',
            'father_name' => 'nullable',
            'father_contact' => 'nullable|numeric|digits:10',
            'mother_name' => 'nullable',
            'mother_contact' => 'nullable|numeric|digits:10',

            'temporary_address' => 'required',
            'temporary_address_2' => 'nullable',
            'temporary_city' => 'nullable',
            'temporary_country' => 'nullable|exists:countries,id',
            'temporary_postal_code' => 'nullable',
            'permanent_address' => 'required',
            'permanent_address_2' => 'nullable',
            'permanent_city' => 'nullable',
            'permanent_country' => 'nullable|exists:countries,id',
            'permanent_postal_code' => 'nullable',

            'department_id' => 'required',
            'designation_id' => 'required',
            'division_id' => 'nullable|exists:divisons,id',

            'joining_date' => 'required',
            'salary' => 'nullable|numeric',
            'salary_period' => 'required',
            'duty_type' => 'required',

            'dob' => 'required|date',
            'marital_status' => 'required',
            'gender' => 'required',
            'blood_group' => 'required',

            'password' => 'required|min:7',
            'password_confirmation' => 'required|same:password',

            'pan' => 'nullable',
            'pan_image' => 'nullable',
            'citizenship' => 'nullable',
            'citizenship_image' => 'nullable',

            'bank_name' => 'nullable',
            'account_holder_name' => 'nullable',
            'bank_branch' => 'nullable',
            'bank_account_no' => 'nullable|numeric',
            'bank_remarks' => 'nullable',

            'organization_name' => 'nullabel|exists:employees,organization_name',
            'organization_contact' => 'nullabel|numeric|exists:employees,organization_contact',
            'organization_address' => 'nullabel|exists:employees,organization_address',
            'hr_name' => 'nullabel|exists:employees,hr_name',
            'hr_contact' => 'nullabel|numeric|exists:employees,hr_contact',
            'organization_document' => 'nullabel|exists:employees,organization_document',

            'emergency_contact_person_name' => 'required',
            'emergency_contact_person_contact' => 'required|numeric',
            'emergency_contact_person_address' => 'required',
            'emergency_contact_person_relation' => 'required',

            'college_name' => 'required',
            'college_address' => 'required',
            'completion_year' => 'required',
            'highest_degree_name' => 'required',
            'degree_document' => 'required',
        ];
    }

    private function mapDataUser($request)
    {
        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
            'user_type' => 'Employee',
            'mobile_verified_at' => $request->mobile_verified_at,
            // 'image' => $request->image,
        ];
        if ($request->isMethod('post'))
            $data['created_by'] = auth()->user()->id;
        elseif ($request->isMethod('put'))
            $data['updated_by'] = auth()->user()->id;

        return $data;
    }

    private function mapDataEmployee($request, $user_id)
    {
        $data = [
            'status' => $request->status,
            'alt_email' => $request->alt_email,
            'alt_phone' => $request->alt_phone,
            'otp' => $request->otp,
            'otp_created_at' => $request->otp_created_at,
            'father_name' => $request->father_name,
            'father_contact' => $request->father_contact,
            'mother_name' => $request->mother_name,
            'mother_contact' => $request->mother_contact,

            'temporary_address' => $request->temporary_address,
            'temporary_address_2' => $request->temporary_address_2,
            'temporary_city' => $request->temporary_city,
            'temporary_country' => $request->temporary_country,
            'temporary_postal_code' => $request->temporary_postal_code,
            'permanent_address' => $request->permanent_address,
            'permanent_address_2' => $request->permanent_address_2,
            'permanent_city' => $request->permanent_city,
            'permanent_country' => $request->permanent_country,
            'permanent_postal_code' => $request->permanent_postal_code,

            'designation_id' => $request->designation_id,
            'department_id' => $request->department_id,
            'division_id' => $request->division_id,

            'dob' => $request->dob,
            'gender' => $request->gender,
            'marital_status' => $request->marital_status,
            'blood_group' => $request->blood_group,

            'joining_date' => $request->joining_date,
            'salary' => $request->salary,
            'salary_period' => $request->salary_period,
            'duty_type' => $request->duty_type,

            'pan' => $request->pan,
            'citizenship' => $request->citizenship,

            'organization_name' => $request->organization_name,
            'organization_contact' => $request->organization_contact,
            'organization_address' => $request->organization_address,
            'hr_name' => $request->hr_name,
            'hr_contact' => $request->hr_contact,

            'emergency_contact_person_name' => $request->emergency_contact_person_name,
            'emergency_contact_person_contact' => $request->emergency_contact_person_contact,
            'emergency_contact_person_address' => $request->emergency_contact_person_address,
            'emergency_contact_person_relation' => $request->emergency_contact_person_relation,

            'user_id' => $user_id,

            'bank_name' => $request->bank_name,
            'account_holder_name' => $request->account_holder_name,
            'bank_account_no' => $request->bank_account_no,
            'bank_branch' => $request->bank_branch,
            'bank_remarks' => $request->bank_remarks,

            'college_name' => $request->college_name,
            'college_address' => $request->college_address,
            'completion_year' => $request->completion_year,
            'highest_degree_name' => $request->highest_degree_name,

            'created_by' => $request->created_by,
            'updated_by' => $request->updated_by,
        ];
        if ($request->isMethod('post'))
            $data['created_by'] = auth()->user()->id;
        elseif ($request->isMethod('put'))
            $data['updated_by'] = auth()->user()->id;

        return $data;
    }

    public function store(Request $request)
    {
        $validate = Validator::make($request->all(), $this->objectValidate());
        try {
            DB::beginTransaction();
            $data = $this->mapDataUser($request);
            $user = User::create($data);
            Employee::create($this->mapDataEmployee($request, $user->id));
            if ($request->hasFile('image') && $request->file('image')->isValid())
                $user->addMediaFromRequest('image')->toMediaCollection('image');

            if ($request->hasFile('pan_image') && $request->file('pan_image')->isValid())
                $user->addMediaFromRequest('pan_image')->toMediaCollection('pan_image');

            if ($request->hasFile('citizenship_image') && $request->file('citizenship_image')->isValid())
                $user->addMediaFromRequest('citizenship_image')->toMediaCollection('citizenship_image');

            if ($request->degree_document && count($request->degree_document)) {
                foreach ($request->degree_document as $single_document){
                    $user->addMedia($single_document)->toMediaCollection('educational_document');
                }
            }

            if ($request->organization_document && count($request->organization_document)) {
                foreach ($request->organization_document as $single_document){
                    $user->addMedia($single_document)->toMediaCollection('organization_document');
                }
            }

            DB::commit();
            showNotification('Employee Created Successfully', 'success');
            return redirect()->route('employee.index');
        } catch (\Throwable $th) {
            DB::rollBack();
            if (config('app.debug'))
                dd($th);
            showNotification($th->getMessage(), 'error');
            return back();
        }
    }

    public function edit($id)
    {
        $old_info = User::findOrFail($id);
        $data = [
            'page_title' => 'Edit Employee',
            'old_info' => $old_info,
        ];
        return view('admin.employee.form', $data);
    }

    public function exEmployee($id)
    {
        $old_info = Employee::where('user_id', $id)->first();
        $old_info->ex_employee = !$old_info->ex_employee;
        $old_info->save();
        return back();
    }

    public function noticePeriodEmployee(Request $request, $id)
    {
        $old_info = Employee::where('user_id', $id)->first();
        if (!$old_info->ex_employee) {
            showNotification('Employee is not currently working here!', 'error');
        }
        $old_info->notice_period = 1;
        $old_info->notice_period_start_date = $request->notice_period_start_date;
        $old_info->notice_period_end_date = $request->notice_period_end_date;
        $old_info->notice_period_remarks = $request->notice_period_remarks;
        $old_info->save();
        showNotification('Employee Moved to Notice Period Successfully', 'success');
        return back();
    }

    public function update(Request $request, $id)
    {
        Validator::make($request->all(), $this->objectValidate());

        try {
            DB::beginTransaction();
            $user = User::findOrFail($id);
            $data = $this->mapDataUser($request);
            $user->update($data);
            $user->employee->update($this->mapDataEmployee($request, $user->id));
            if ($request->hasFile('image') && $request->file('image')->isValid())
                $user->addMediaFromRequest('image')->toMediaCollection('image');

            if ($request->hasFile('pan_image') && $request->file('pan_image')->isValid())
                $user->addMediaFromRequest('pan_image')->toMediaCollection('pan_image');

            if ($request->hasFile('citizenship_image') && $request->file('citizenship_image')->isValid())
                $user->addMediaFromRequest('citizenship_image')->toMediaCollection('citizenship_image');

            if ($request->degree_document && count($request->degree_document)) {
                foreach ($request->degree_document as $single_document)
                    $user->addMedia($single_document)->toMediaCollection('educational_document');
            }

            if ($request->organization_document && count($request->organization_document)) {
                foreach ($request->organization_document as $single_document){
                    $user->addMedia($single_document)->toMediaCollection('organization_document');
                }
            }

            DB::commit();
            showNotification('Employee Updated Successfully', 'success');
            return redirect()->route('employee.index');
        } catch (\Throwable $th) {
            DB::rollBack();
            if (config('app.debug'))
                dd($th->getMessage());
            showNotification($th->getMessage(), 'error');
            return back();
        }
    }

    public function show($id)
    {
        // dd($id);
        $employee = User::findorFail($id);
        $data = [
            'page_title' => $employee->name . "'s Details",
            'employee' => $employee,
            'attendance' => Attendance::where('user_id',$id)->get(),
        ];
        return view('admin.employee.show', $data);
    }

    public function destroy($id)
    {
        try {
            DB::beginTransaction();
            $user = User::findOrFail($id);
            $user->updated_by = auth()->user()->id;
            $old_info = Employee::where('user_id', $user->id)->first();
            $old_info->updated_by = auth()->user()->id;
            $old_info->save();
            $user->delete();
            $old_info->delete();
            DB::commit();
            showNotification('Employee Removed Successfully', 'success');
            return back();
        } catch (\Throwable $th) {
            DB::rollBack();
            if (config('app.debug'))
                dd($th->getMessage());
            showNotification($th->getMessage(), 'error');
            return back();
        }
    }

    public function active($id){
        try {
            DB::beginTransaction();
            $user = User::findOrFail($id);
            $user->status = !$user->status;
            $user->updated_by = auth()->user()->id;
            $user->save();
            DB::commit();
            showNotification('User Status Updated Successfully', 'success');
            return back();
        } catch (\Throwable $th) {
            DB::rollBack();
            if (config('app.debug'))
                dd($th->getMessage());
            showNotification($th->getMessage(), 'error');
            return back();
        }
    }
}
