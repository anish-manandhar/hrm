<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Designation;
use Illuminate\Support\Facades\DB;

class DesignationController extends Controller
{
    public function __construct(Designation $designation)
    {
        $this->designation = $designation;
        $this->route = 'designation';
    }

    public function index()
    {
        $designations = Designation::paginate(20);
        $data = [
            'page_title' => 'Designation',
            'data' => $designations
        ];
        return view('admin.designation.index', $data);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|string|max:190',
            'rank' => 'required|numeric',
        ]);
        try {
            DB::beginTransaction();
            $this->designation->create([
                'title' => strip_tags($request->title),
                'rank' => strip_tags($request->rank),
            ]);
            DB::commit();
            showNotification('Designation created successfully');
            return back();
        } catch (\Throwable $error) {
            DB::rollBack();
            showNotification($error->getMessage(), 'error');
            return back();
        }
    }

    public function edit($id){
        $old_info = Designation::findOrFail($id);
        $data = [
            'page_title' => 'Edit Designation',
            'old_info' => $old_info,
        ];
        return view('admin.designation.form', $data);
    }

    public function update(Request $request,$id){
        $validate = $this->validate($request, [
            'title' => 'required|string|max:190',
            'status'=> 'required',
            'working'=> 'required',
            'rank' => 'required|numeric',
        ]);
        try {
            DB::beginTransaction();
            $designation_update = designation::findOrFail($id);
            $designation_update->update($validate);
            DB::commit();
            showNotification('Designation Updated Successfully', 'success');
            return redirect()->route('designation.index');
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
            $designation = Designation::findOrFail($id);
            $designation->save();
            $designation->delete();
            DB::commit();
            showNotification('Designation Removed Successfully', 'success');
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
