<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\Jobs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ApplicationController extends Controller
{
    public function index()
    {
        $dataApp = Application::with(['jobs.company'])->paginate(4);
        $dataJobs = Jobs::all(); // Ambil semua data dari tabel Jobs
        return view('Application.index', compact('dataApp', 'dataJobs'));
    }
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'job_id'            => 'required',
            'application_date'  => 'required|date',
            'status'            => 'required|in:Pending,Interview,Accepted,Rejected',
        ]);

        if($validator->fails()){
            return redirect()->back()->withInput()->withErrors($validator);
        }

        $data['job_id']                 = $request->job_id;
        $data['application_date']       = $request->application_date;
        $data['status']                 = $request->status;
        $data['notes']                  = $request->notes;

        Application::create($data);
        return redirect()->route('Apps')->with('success', 'Data lamaran pekerjaan berhasil ditambahkan! 🙂');
    }
    public function update(Request $request, $id)
    {
          $validator = Validator::make($request->all(), [
            'job_id'            => 'required',
            'application_date'  => 'required|date',
            'status'            => 'required|in:Pending,Interview,Accepted,Rejected',
        ]);

        if($validator->fails()){
            return redirect()->back()->withInput()->withErrors($validator);
        }

        $data['job_id']                 = $request->job_id;
        $data['application_date']       = $request->application_date;
        $data['status']                 = $request->status;
        $data['notes']                  = $request->notes;

        Application::findOrFail($id)->update($data);
        return redirect()->route('Apps')->with('success', 'Data lamaran pekerjaan berhasil diperbarui! 🙂');
    }
    public function destroy($id)
    {
        $app = Application::find($id);
        if($app)
        {
            $app->delete();
        }
        return redirect()->route('Apps')->with('success', '💥 Data Lamaran Berhasil Dihapus! 💥');
    }
}
