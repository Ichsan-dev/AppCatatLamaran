<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CompanyController extends Controller
{
    public function index()
    {
        $DataCompany = Company::paginate(4);
        return view('Companies.index', compact('DataCompany'));
    }

    public function store(Request $request)
    {
        $validator = validator::make($request->all(), [
            'companyname'       => 'required',
            'companylocation'   => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator);
        }

        $data['name']       = $request->companyname;
        $data['industry']   = $request->companyindustry;
        $data['location']   = $request->companylocation;
        $data['website']    = $request->companywebsite;

        Company::create($data);
        return redirect()->route('Company')->with('success', 'Data perusahaan berhasil ditambahkan');
    }
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'companyname'       => 'required',
            'companylocation'   => 'required',
        ]); 

        if ($validator->fails()){
            return redirect()->back()->withInput()->withErrors($validator);
        }

        $data =[

            'name'      => $request->companyname,
            'location'  => $request->companylocation,
            'industry'  => $request->companyindustry,
            'website'   => $request->companywebsite
        ];

        Company::findOrFail($id)->update($data);
        return redirect()->route('Company')->with('success', 'Data berhasil diperbarui!');
    }

    public function delete($id)
    {
        $company = Company::find($id);

        if($company)
        {
            $company->delete();
        }
        return redirect()->route('Company')->with('success', 'Data berhasil dihapus!');
    }
}
