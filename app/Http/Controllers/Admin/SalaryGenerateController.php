<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SalaryGenerate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class SalaryGenerateController extends Controller
{
    public function __construct(SalaryGenerate $salaryGenerate)
    {
        $this->salaryGenerate = $salaryGenerate;
        $this->route = 'salary-generate';
    }

    public function index()
    {
        $data = [
            'page_title' => 'Salary Generate',
            'data' => $this->salaryGenerate->paginate(20),
        ];
        return view('admin.payroll.salary-generate.index', $data);
    }

    public function create()
    {
        $data = [
            'page_title' => 'Generate Salary',
            'old_info' => null
        ];
        return view('admin.payroll.salary-generate.form', $data);
    }

    private function objectValidate()
    {
        return [
            'employee_id' => 'required|exists:users,id',
            'total_payable' => 'required',
        ];
    }

    private function mapDataUser($request)
    {
        $data = [
            'employee_id' => $request->employee_id,
            'gross_amount' => $request->total_payable,
            'salary_details' => $request->detail,
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
            $user = $this->salaryGenerate->create($data);
            DB::commit();
            showNotification('Salary Generate Created Successfully', 'success');
            return redirect()->route($this->route . '.index');
        } catch (\Throwable $th) {
            DB::rollBack();
            if (config('app.debug'))
                dd($th->getMessage());
            showNotification($th->getMessage(), 'error');
            return back();
        }
    }


    public function destroy($id)
    {
        try {
            DB::beginTransaction();
            $old_info = $this->salaryGenerate->findOrFail($id);
            $old_info->updated_by = auth()->user()->id;
            $old_info->save();
            $old_info->delete();
            DB::commit();
            showNotification('Salary Generate Removed Successfully');
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
