<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LeaveType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LeaveTypeController extends Controller
{

    public function __construct(LeaveType $leaveType)
    {
        $this->leaveType = $leaveType;
        $this->route = 'leave-type';
    }

    public function index()
    {
        $leaveTypes = $this->leaveType->orderBy('id', 'DESC')->paginate(20);
        $data = [
            'page_title' => 'Leave Type',
            'data' => $leaveTypes
        ];
        return view('admin.leave.leave-type.index', $data);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|string|max:190',
            'days' => 'required|numeric'
        ]);
        try {
            DB::beginTransaction();
            $this->leaveType->create([
                'title' => strip_tags($request->title),
                'days' => strip_tags($request->days),
            ]);
            DB::commit();
            showNotification('Leave Type created successfully');
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
            $old_info = $this->leaveType->findOrFail($id);
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
