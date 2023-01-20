<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DepartmentController extends Controller
{
    public function __construct(Department $department)
    {
        $this->department = $department;
        $this->route = 'department';
    }

    public function index()
    {
        $departments = Department::paginate(20);
        $data = [
            'page_title' => 'Department',
            'data' => $departments
        ];
        return view('admin.department.index', $data);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|string|max:190'
        ]);
        try {
            DB::beginTransaction();
            $this->department->create([
                'title' => strip_tags($request->title),
                'created_by' => auth()->user()->id,
            ]);
            DB::commit();
            showNotification('Department created successfully');
            return back();
        } catch (\Throwable $error) {
            DB::rollBack();
            showNotification($error->getMessage(), 'error');
            return back();
        }
    }

    public function edit($id){
        $old_info = Department::findOrFail($id);
        $data = [
            'page_title' => 'Edit Department',
            'old_info' => $old_info,
        ];
        return view('admin.department.form', $data);
    }

    public function update(Request $request,$id){
        $validate = $this->validate($request, [
            'title' => 'required|string|max:190',
            'status'=> 'required',
        ]);
        try {
            DB::beginTransaction();
            $department_update = Department::findOrFail($id);
            $validate['updated_by'] = auth()->user()->id;
            $department_update->update($validate);
            DB::commit();
            showNotification('Department Updated Successfully', 'success');
            return redirect()->route('department.index');
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
            $department = Department::findOrFail($id);
            $department->updated_by = auth()->user()->id;
            $department->save();
            $department->delete();
            showNotification('Department Removed Successfully', 'success');
            DB::commit();
            return back();
        } catch (\Throwable $error) {
            DB::rollBack();
            if (config('app.debug'))
                dd($error->getMessage());
            showNotification($error->getMessage(), 'error');
            return back();
        }
    }
}
