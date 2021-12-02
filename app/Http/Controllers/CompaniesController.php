<?php

namespace App\Http\Controllers;

use App\Company;
use App\User;
use App\CompanyUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CompaniesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        if(Auth::check()){
            $companies = Company::where('user_id', Auth::user()->id)->get();
            $companyUsers = CompanyUser::where('user_id',  Auth::user()->id)->get();

            return view('companies.index', ['companies' => $companies, 'companyUsers' => $companyUsers]);
        }
         return view('auth.login');

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('companies.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        if(Auth::check()){
            $company = Company::create([
                'name' => $request->input('name'),
                'description' => $request->input('description'),
                'user_id' => Auth::user()->id
            ]);

            if($company){
                return redirect()->route('companies.show', ['company'=>$company->id])
                ->with('success','Sukses Membuat Company');
            }
        }

        return back()->withInput()->with('errors','Gagal Membuat Company');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function show(Company $company)
    {
        //
        //$company = Company::where('id', $company->id)->first();
        $company = Company::find($company->id);
        $companyUser = $company->companiesUsers->where('company_id', $company->id)->first();
        $delete = $company->companiesUsers->first();
    //$companyusers = CompanyUser::where('user_id',  Auth::user()->id)->first();
        //menampilkan user pemilik company
        $member = User::where('id', $company->user_id)->first();
        return view('companies.show', ['company' => $company, 'companyUser' => $companyUser, 'member'=>$member, 'delete'=>$delete]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function edit(Company $company)
    {
        //
        $company = Company::find($company->id);

        return view('companies.edit', ['company' => $company]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Company $company)
    {
        //save data
        $companyUpdate = Company::where('id', $company->id)->update([
            'name'=>$request->input('name'),
            'description'=>$request->input('description')
        ]);
        if($companyUpdate){
            return redirect()->route('companies.show', ['company'=>$company->id])->with('success','Sukses Update Company');
        }
        //redirect
        return back()->withInput();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function destroy(Company $company)
    {
        //
        $findCompany = Company::find($company->id);
        if($findCompany->delete()){
            return redirect()->route('companies.index')->with('success','Sukses Hapus Company');
        }
        return back()->withInput()->with('errors','Gagal Hapus Company');
    }

    public function adduser(Request $request){
        //add user ke project
        
        //mengambil project, add user ke project
        $company = Company::find($request->input('company_id'));
       
        if(Auth::user()->id == $company->user_id){
            $user = User::where('email', $request->input('email'))->first(); //single record
            //cek jika user sudah ada di project
            $companyUser = CompanyUser::where('user_id', $user->id)
                                        ->where('company_id', $company->id)
                                        ->first();

            if($companyUser){
                //jika user sudah ada, keluar
                return redirect()->route('companies.show', ['company'=>$company->id])
                ->with('success', $request->input('email').' Sudah Menjadi Member Di Company Ini');
            }
            

            if($user && $company){
                $company->users()->attach($user->id);

                return redirect()->route('companies.show', ['company'=>$company->id])
                ->with('success', $request->input('email').' Sukses Ditambah Ke Company');
            }

        }

        return redirect()->route('companies.show', ['company'=>$company->id])
        ->with('errors', ' Gagal Menambah Member Ke Company');
    }

    public function deleteMember(Company $company)
    {
        //
        $findcompanyUser = $company->companiesUsers::find('id');
        if($findcompanyUser->delete()){
            return redirect()->route('companies.show', ['company'=>$company->id])->with('success','Sukses Hapus Member');
        }
        return back()->withInput()->with('errors','Gagal Hapus Member');
    }
}
