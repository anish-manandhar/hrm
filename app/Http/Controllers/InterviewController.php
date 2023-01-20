<?php

namespace App\Http\Controllers;

use App\Models\Interview;
use App\Traits\SendSmsTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class InterviewController extends Controller
{
    use SendSmsTrait;

    public function index()
    {
        $data = [
            'page_title' => 'Interview',
            'interview' => Interview::orderBy('id', 'DESC')->paginate(20),
        ];
        return view('admin.recruitment.interview.index', $data);
    }

    public function create()
    {
        $data = [
            'page_title' => 'Add Interview',
        ];
        return view('admin.recruitment.interview.form', $data);
    }

    private function objectValidate()
    {
        return [
            'candidate_id' => 'required',
            'interviewer_id' => 'required',
            'date_time' => 'required',
            'recommendation' => 'nullable',
            'remarks' => 'nullable',
        ];
    }

    private function mapDataInterview($request)
    {
        $data = [
            'candidate_id' => $request->candidate_id,
            'interviewer_id' => $request->interviewer_id,
            'date_time' => $request->date_time,
            'recommendation' => $request->recommendation,
            'remarks' => $request->remarks,
        ];
        if ($request->isMethod('post'))
            $data['created_by'] = auth()->user()->id;
        elseif ($request->isMethod('put'))
            $data['updated_by'] = auth()->user()->id;

        return $data;
    }

    public function store(Request $request)
    {
        Validator::make($request->all(), $this->objectValidate());
        try {
            DB::beginTransaction();
            Interview::create($this->mapDataInterview($request));
            DB::commit();
            showNotification('Interview Created Successfully', 'success');
            return redirect()->route('interview.index');
        } catch (\Throwable $th) {
            DB::rollBack();
            if (config('app.debug'))
                dd($th->getMessage());
            showNotification($th->getMessage(), 'error');
            return back();
        }
    }

    public function edit($id)
    {
        $old_info = Interview::findOrFail($id);
        $data = [
            'page_title' => 'Edit Interview',
            'old_info' => $old_info,
        ];
        return view('admin.recruitment.interview.form', $data);
    }

    public function update(Request $request, $id)
    {
        Validator::make($request->all(), $this->objectValidate());
        try {
            DB::beginTransaction();
            $interview_update = Interview::findOrFail($id);
            $interview_update->update($this->mapDataInterview($request));
            DB::commit();
            showNotification('Interview Updated Successfully', 'success');
            return redirect()->route('interview.index');
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
            $interview = Interview::findOrFail($id);
            $interview->updated_by = auth()->user()->id;
            $interview->save();
            $interview->delete();
            DB::commit();
            showNotification('Interview Removed Successfully', 'success');
            return back();
        } catch (\Throwable $th) {
            DB::rollBack();
            if (config('app.debug'))
                dd($th->getMessage());
            showNotification($th->getMessage(), 'error');
            return back();
        }
    }

    public function select($id)
    {
        try {
            DB::beginTransaction();
            $interview = Interview::findOrFail($id);
            $interview->selected = !$interview->selected;
            $interview->updated_by = auth()->user()->id;
            $interview->save();
            DB::commit();
            showNotification('Interview Shortlisted Successfully', 'success');
            return back();
        } catch (\Throwable $th) {
            DB::rollBack();
            if (config('app.debug'))
                dd($th->getMessage());
            showNotification($th->getMessage(), 'error');
            return back();
        }
    }

    public function sendNotification($id)
    {
        try {
            $interview = Interview::findOrFail($id);
            if ($interview->getCandidate && $interview->getCandidate->phone) {
                $message = 'You Have Been Shortlisted For Interview and The Interview is scheduled for ' . $interview->date_time . ' at ' . get_setting('organization_name') . ' located at ' . get_setting('detail_address');
                $this->sendMessage($interview->getCandidate->phone, $message);
            }
            showNotification('Interview Notification Sent', 'success');
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
