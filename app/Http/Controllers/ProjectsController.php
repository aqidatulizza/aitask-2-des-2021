<?php

namespace App\Http\Controllers;

use App\Project;
use App\Company;
use App\User;
use App\ProjectUser;
use App\CompanyUser;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProjectsController extends Controller
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
            $projects = Project::where('user_id', Auth::user()->id)->get();
            $projectUsers = ProjectUser::where('user_id',  Auth::user()->id)->get();

            return view('projects.index', ['projects' => $projects, 'projectUsers' => $projectUsers]);
        }
         return view('auth.login');

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($company_id = null)
    {
        //
        $companies=null;
        $companyUsers = null;
        if(!$company_id){
            $companies=Company::where('user_id', Auth::user()->id)->get();
            $companyUsers = CompanyUser::where('user_id',  Auth::user()->id)->get();
        }
        return view('projects.create', ['company_id'=>$company_id, 'companies'=>$companies, 'companyUsers'=>$companyUsers]);
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
            $project = Project::create([
                'name' => $request->input('name'),
                'description' => $request->input('description'),
                'company_id' => $request->input('company_id'),
                'user_id' => Auth::user()->id
            ]);

            if($project){
                return redirect()->route('projects.show', ['project'=>$project->id])
                ->with('success','Sukses Membuat project');
            }
        }

        return back()->withInput()->with('errors','Gagal Membuat project');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\project  $project
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        //
        //$project = Project::where('id', $project->id)->first();
        $project = Project::find($project->id);
        $company = Company::where('id', $project->company_id)->first();
        //menampilkan user pemilik project
        $member = User::where('id', $project->user_id)->first();
        $comments = $project->comments;

        return view('projects.show', ['project' => $project,'company'=>$company ,'member'=>$member ,'comments'=> $comments]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\project  $project
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        //

        $project = Project::find($project->id);
        $company_id = $project->company_id;

        return view('projects.edit', ['project' => $project, 'company_id' => $company_id]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Project $project)
    {
        //save data
        $projectUpdate = Project::where('id', $project->id)->update([
            'name'=>$request->input('name'),
            'description'=>$request->input('description'),
            'company_id' => $request->input('company_id'),
        ]);
        if($projectUpdate){
            return redirect()->route('projects.show', ['project'=>$project->id])->with('success','Sukses Update project');
        }
        //redirect
        return back()->withInput();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        //
        $findproject = Project::find($project->id);
        if($findproject->delete()){
            return redirect()->route('projects.index')->with('success','Sukses Hapus project');
        }
        return back()->withInput()->with('errors','Gagal Hapus project');
    }

    public function adduser(Request $request){
        //add user ke project
        
        //mengambil project, add user ke project
        $project = Project::find($request->input('project_id'));
       
        if(Auth::user()->id == $project->user_id){
            $user = User::where('email', $request->input('email'))->first(); //single record
            //cek jika user sudah ada di project
            $projectUser = ProjectUser::where('user_id', $user->id)
                                        ->where('project_id', $project->id)
                                        ->first();

            if($projectUser){
                //jika user sudah ada, keluar
                return redirect()->route('projects.show', ['project'=>$project->id])
                ->with('success', $request->input('email').' Sudah Menjadi Member Di Project Ini');
            }
            if(!$user){
                return redirect()->route('projects.show', ['project'=>$project->id])
                ->with('errors', ' Gagal Menambah Member Ke Project');
            }
            

            if($user && $project){
                $project->users()->attach($user->id);

                return redirect()->route('projects.show', ['project'=>$project->id])
                ->with('success', $request->input('email').' Sukses Ditambah Ke Project');
            }

        }

        return redirect()->route('projects.show', ['project'=>$project->id])
        ->with('errors', ' Gagal Menambah Member Ke Project');
    }
}
