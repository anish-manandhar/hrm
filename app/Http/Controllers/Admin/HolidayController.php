<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Holiday;
use App\Notifications\SlackGeneralNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class HolidayController extends Controller
{
    public function __construct(Holiday $holiday)
    {
        $this->holiday = $holiday;
        $this->route = 'holiday';
    }

    public function index()
    {
        $data = [
            'page_title' => 'Holidays',
            'data' => $this->holiday->paginate(20),
        ];
        return view('admin.leave.holiday.index', $data);
    }

    private function objectValidate()
    {
        return [
            'title' => 'required',
            'from' => 'required|date_format:Y-m-d',
            'to' => 'required|date_format:Y-m-d',
            'repeat' => 'nullable|in:Weekly,Monthly,Yearly',
        ];
    }

    private function mapDataUser($request)
    {
        $data = [
            'title' => $request->title,
            'from' => $request->from,
            'to' => $request->to,
            'repeat' => $request->repeat,
        ];
        if (!$request->to)
            $data['days'] = 1;
        if ($request->department)
            $data['department'] = $request->department;
        if ($request->from && $request->to) {
            $start = \DateTime::createFromFormat('Y-m-d', $request->from);
            $end = \DateTime::createFromFormat('Y-m-d', $request->to);
            $interval = $start->diff($end);
            $days = $interval->format('%a');
            $data['days'] = $days;
        }
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
            $holiday = $this->holiday->create($data);
            DB::commit();
            auth()->user()->notify(new SlackGeneralNotification($holiday));
            $holiday->notify(new SlackGeneralNotification($holiday));
            showNotification('Holiday Created Successfully', 'success');
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
            $old_info = $this->holiday->findOrFail($id);
            $old_info->updated_by = auth()->user()->id;
            $old_info->save();
            DB::commit();
            showNotification('Holiday Removed Successfully');
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
