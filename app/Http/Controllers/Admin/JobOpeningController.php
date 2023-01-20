<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\JobOpening;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class JobOpeningController extends Controller
{
    public function __construct(JobOpening $jobOpening)
    {
        $this->jobOpening = $jobOpening;
        $this->route = 'job-opening';
    }

    public function index()
    {
        $jobOpenings = $this->jobOpening->paginate(20);
        $data = [
            'page_title' => 'Job Openings',
            'data' => $jobOpenings
        ];
        return view('admin.recruitment.job-opening.index', $data);
    }

    public function store(Request $request)
    {
        $status = $this->validate($request, [
            'title' => 'required|string|max:190',
            'total_vacancies' => 'nullable',
            'application_deadline' => 'nullable',
            'salary' => 'nullable',
            'experience' => 'nullable',
            'skills' => 'nullable',
            'image' => 'nullable|mimes:jpg,jpeg,png',         
            'department_id' => 'required|exists:departments,id',         
            'designation_id' => 'required|exists:designations,id',         
            // 'division_id' => 'nullable|exists:divisons,id', 
            'offerings' => 'nullable',
            'description' => 'required',        
        ]);
        try {
            DB::beginTransaction();
            $jobOpening = $this->jobOpening->create([
                'title' => strip_tags($request->title),
                'total_vacancies' => strip_tags($request->total_vacancies),
                'application_deadline' => strip_tags($request->application_deadline),
                'salary' => strip_tags($request->salary),
                'experience' => strip_tags($request->experience),
                'skills' => strip_tags($request->skills),
                'description' => strip_tags($request->description),
                'offerings' => strip_tags($request->offerings),
                'department_id' => strip_tags($request->department_id),
                'designation_id' => strip_tags($request->designation_id),
                // 'division_id' => strip_tags($request->division_id),
            ]);
            if ($request->hasFile('image') && $request->file('image')->isValid())
                $jobOpening->addMediaFromRequest('image')->toMediaCollection('image');
            DB::commit();
            showNotification('Job Opening created successfully');
            return back();
        } catch (\Throwable $error) {
            DB::rollBack();
            if(config('app.debug'))
            dd($error->getMessage());
            showNotification($error->getMessage(), 'error');
            return back();
        }
    }

    public function show($id){
        $jobOpening = $this->jobOpening->findOrFail($id);
        $data = [
            'page_title' => $jobOpening->title . " 's Details",
            'jobOpening' => $jobOpening,
        ];
        return view('admin.recruitment.job-opening.show', $data);
    }

    public function edit($id)
    {
        $old_info = $this->jobOpening::findOrFail($id);
        $data = [
            'page_title' => 'Edit Job Opening',
            'old_info' => $old_info,
        ];
        return view('admin.recruitment.job-opening.edit', $data);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'title' => 'required|string|max:190',
            'total_vacancies' => 'nullable',
            'application_deadline' => 'nullable',
            'salary' => 'nullable',
            'experience' => 'nullable',
            'skills' => 'nullable',
            'image' => 'nullable|mimes:jpg,jpeg,png',         
            'department_id' => 'required|exists:departments,id',         
            'designation_id' => 'required|exists:designations,id',         
            // 'division_id' => 'nullable|exists:divisons,id', 
            'offerings' => 'nullable',
            'description' => 'required',        
        ]);
        try {
            DB::beginTransaction();
            $jobOpening_update = $this->jobOpening->findOrFail($id);
            $jobOpening_update->update([
                'title' => strip_tags($request->title),
                'total_vacancies' => strip_tags($request->total_vacancies),
                'application_deadline' => strip_tags($request->application_deadline),
                'salary' => strip_tags($request->salary),
                'experience' => strip_tags($request->experience),
                'skills' => strip_tags($request->skills),
                'description' => strip_tags($request->description),
                'offerings' => strip_tags($request->offerings),
                'department_id' => strip_tags($request->department_id),
                'designation_id' => strip_tags($request->designation_id),
                // 'division_id' => strip_tags($request->division_id),
            ]);            
            if ($request->hasFile('image') && $request->file('image')->isValid())
                $jobOpening_update->addMediaFromRequest('image')->toMediaCollection('image');
            DB::commit();
            showNotification('Job-Opening Updated Successfully', 'success');
            return redirect()->route('job-opening.index');
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
            $jobOpening = $this->jobOpening->findOrFail($id);
            $jobOpening->updated_by = auth()->user()->id;
            $jobOpening->save();
            $jobOpening->delete();
            DB::commit();
            showNotification('Job Recruitment Removed Successfully', 'success');
            return back();
        } catch (\Throwable $error) {
            DB::rollBack();
            showNotification($error->getMessage(), 'error');
            return back();
        }
    }
}
