<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Jobs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class JobsController extends Controller
{
    public function index()
    {
        $dataJobs       = Jobs::paginate(4);
        $dataCompany    = Company::all();
        return view('Jobs.index', compact('dataJobs', 'dataCompany' ));
    }
    public function store(Request $request)
    {
          $validator = Validator::make($request->all(), [
            'companyname'       => 'required',
            'jobsposition'      => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator);
        }

        $data['company_id']       = $request->companyname;
        $data['position']         = $request->jobsposition;
        $data['requirements']     = $request->jobsrequirements;
        $data['description']      = $request->jobsdescription;

        Jobs::create($data);
        return redirect()->route('Jobs')->with('success', 'Data pekerjaan berhasil ditambahkan! 🙂');
    }
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'companyname'       => 'required',
            'jobsposition'      => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator);
        }

        $data['company_id']       = $request->companyname;
        $data['position']         = $request->jobsposition;
        $data['requirements']     = $request->jobsrequirements;
        $data['description']      = $request->jobsdescription;

        Jobs::findOrFail($id)->update($data);
        return redirect()->route('Jobs')->with('success', 'Data pekerjaan berhasil diperbarui! 😉');
    }
    public function destroy($id)
    {
        $job = Jobs::find($id);
        if($job)
        {
            $job->delete();
        }
        return redirect()->route('Jobs')->with('success', 'Data pekerjaan berhasil dihapus!💥');
    }
}
