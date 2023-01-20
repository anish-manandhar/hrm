<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SalaryType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SalaryTypeController extends Controller
{
    public function __construct(SalaryType $salaryType)
    {
        $this->salaryType = $salaryType;
        $this->route = 'salary-type';
    }

    public function index()
    {
        $salaryTypes = $this->salaryType->orderBy('id', 'DESC')->paginate(20);
        $data = [
            'page_title' => 'Salary Type',
            'data' => $salaryTypes
        ];
        return view('admin.payroll.salary-type.index', $data);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|string|max:190',
            'type' => 'required|in:Add,Deduct',
            'per_amt' => 'required|in:Percentage,Amount'
        ]);
        try {
            DB::beginTransaction();
            $this->salaryType->create([
                'title' => strip_tags($request->title),
                'type' => strip_tags($request->type),
                'per_amt' => strip_tags($request->per_amt),
            ]);
            DB::commit();
            showNotification('Salary Type created successfully');
            return back();
        } catch (\Throwable $error) {
            DB::rollBack();
            showNotification($error->getMessage(), 'error');
            return back();
        }
    }

    public function destroy($id)
    {
        try {
            DB::beginTransaction();
            $old_info = $this->salaryType->findOrFail($id);
            $old_info->updated_by = auth()->user()->id;
            $old_info->save();
            $old_info->delete();
            DB::commit();
            return back();
        } catch (\Throwable $error) {
            DB::rollBack();
            return back();
        }
    }
}
