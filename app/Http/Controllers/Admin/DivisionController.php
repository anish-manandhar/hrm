<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Division;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DivisionController extends Controller
{
    public function __construct(Division $division)
    {
        $this->division = $division;
        $this->route = 'division';
    }

    public function index()
    {
        $divisions = $this->division->paginate(20);
        $data = [
            'page_title' => 'Division',
            'data' => $divisions
        ];
        return view('admin.division.index', $data);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|string|max:190',
            'department_id' => 'nullable|exists:departments,id'
        ]);
        try {
            DB::beginTransaction();
            $this->division->create([
                'title' => strip_tags($request->title),
                'department_id' => strip_tags($request->department_id),
            ]);
            DB::commit();
            showNotification('Division created successfully');
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
            DB::commit();
            return back();
        } catch (\Throwable $error) {
            DB::rollBack();
            return back();
        }
    }
}
