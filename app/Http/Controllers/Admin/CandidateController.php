<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Candidate;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CandidateController extends Controller
{
    public function index()
    {
        $data = [
            'page_title' => 'Candidates',
            'candidate' => Candidate::paginate(20),
        ];
        return view('admin.recruitment.candidate.index', $data);
    }

    private function objectValidate()
    {
        return [
            'name' => 'required',
            'job_opening_id' => 'required',
            'email' => 'required|email',
            'alt_email' => 'required|email',
            'phone' => 'required|numeric|digits:10',
            'alt_phone' => 'required|numeric|digits:10',
            'dob' => 'nullable|date',
            'marital_status' => 'nullable',
            'gender' => 'nullable',
            'pan' => 'nullable',
            'citizenship' => 'nullable',
            'street_address' => 'required',
            'salary_expectation' => 'required|numeric',
            'salary_period' => 'required',
            'duty_type' => 'required',
            'shortlisted' => 'required',
            'organization_name' => 'nullabel|exists:employees,organization_name',
            'organization_contact' => 'nullabel|numeric|exists:employees,organization_contact',
            'organization_address' => 'nullabel|exists:employees,organization_address',
            'hr_name' => 'nullabel|exists:employees,hr_name',
            'hr_contact' => 'nullabel|numeric|exists:employees,hr_contact',
        ];
    }

    private function mapDataCandidate($request)
    {
        $data = [
            'name' => $request->name,
            'job_opening_id' => $request->job_opening_id,
            'email' => $request->email,
            'alt_email' => $request->alt_email,
            'phone' => $request->phone,
            'alt_phone' => $request->alt_phone,
            'dob' => $request->dob,
            'marital_status' => $request->marital_status,
            'gender' => $request->gender,
            'pan' => $request->pan,
            'citizenship' => $request->citizenship,
            'street_address' => $request->street_address,
            'salary_expectation' => $request->salary_expectation,
            'salary_period' => $request->salary_period,
            'duty_type' => $request->duty_type,
            'organization_name' => $request->organization_name,
            'organization_contact' => $request->organization_contact,
            'organization_address' => $request->organization_address,
            'hr_name' => $request->hr_name,
            'hr_contact' => $request->hr_contact,
        ];
        if ($request->isMethod('post'))
            $data['created_by'] = auth()->user()->id;
        elseif ($request->isMethod('put'))
            $data['updated_by'] = auth()->user()->id;

        return $data;
    }

    public function create(Request $request)
    {
        $data = [
            'page_title' => 'Add Candidate',
        ];
        return view('admin.recruitment.candidate.form', $data);
    }

    public function store(Request $request)
    {
        Validator::make($request->all(), $this->objectValidate());
        try {
            DB::beginTransaction();
            Candidate::create($this->mapDataCandidate($request));
            DB::commit();
            showNotification('Candidate Created Successfully', 'success');
            return redirect()->route('candidate.index');
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
        $candidate = Candidate::findorFail($id);
        $data = [
            'page_title' => $candidate->name . "'s Details",
            'candidate' => $candidate,
        ];
        return view('admin.recruitment.candidate.show', $data);
    }

    public function edit($id)
    {
        $old_info = Candidate::findOrFail($id);
        $data = [
            'page_title' => 'Edit Candidate',
            'old_info' => $old_info,
        ];
        return view('admin.recruitment.candidate.form', $data);
    }

    public function update(Request $request, $id)
    {
        Validator::make($request->all(), $this->objectValidate());
        try {
            DB::beginTransaction();
            $candidate_update = Candidate::findOrFail($id);
            $candidate_update->update($this->mapDataCandidate($request));
            DB::commit();
            showNotification('Candidate Updated Successfully', 'success');
            return redirect()->route('candidate.index');
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
            $candidate = Candidate::findOrFail($id);
            $candidate->updated_by = auth()->user()->id;
            $candidate->save();
            $candidate->delete();
            DB::commit();
            showNotification('Candidate Removed Successfully', 'success');
            return back();
        } catch (\Throwable $th) {
            DB::rollBack();
            if (config('app.debug'))
                dd($th->getMessage());
            showNotification($th->getMessage(), 'error');
            return back();
        }
    }

    public function shortlist($id)
    {
        try {
            DB::beginTransaction();
            $candidate = Candidate::findOrFail($id);
            $candidate->shortlisted = !$candidate->shortlisted;
            $candidate->updated_by = auth()->user()->id;
            $candidate->save();
            DB::commit();
            showNotification('Candidate Shortlisted Successfully', 'success');
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
