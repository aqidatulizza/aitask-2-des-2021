<?php

namespace App\Http\Controllers;

use App\Task;
use App\User;
use App\Status;
use App\Company;
use App\Project;
use App\TaskUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TasksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('tasks.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($project_id)
    {
        //
        $project = Project::find($project_id);
        $company_id = $project->company_id;
        return view('tasks.create', ['project_id'=>$project_id, 'project'=>$project, 'company_id'=>$company_id]);
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
            $task = Task::create([
                'name' => $request->input('name'),
                'description' => $request->input('description'),
                'status_id' => $request->input('status_id'),
                'deadline' => $request->input('deadline'),
                'company_id' => $request->input('company_id'),
                'project_id' => $request->input('project_id'),
                'user_id' => Auth::user()->id
                
            ]);

            if(request()->hasFile('file')){
                $file = request()->file('file')->getClientOriginalName();
                request()->file('file')->storeAs('FileTugas', $task->id.'/'.$file, '');
                $task->update(['file'=>$file]);
            }


            if($task){
                return redirect()->route('tasks.show', ['task'=>$task->id])
                ->with('success','Sukses Membuat project');
            }
        }

        return back()->withInput()->with('errors','Gagal Membuat project');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function show(Task $task)
    {
        //
         //$task = Task::where('id', $task->id)->first();
         $task = Task::find($task->id);
         $status = Status::where('id', $task->status_id)->first();
         $company = Company::where('id', $task->company_id)->first();
         $project = Project::where('id', $task->project_id)->first();
         //menampilkan user pemilik project
         $member = User::where('id', $task->user_id)->first();
         
         $comments = $task->comments;
 
         return view('tasks.show', ['task' => $task,'member'=>$member ,'comments'=> $comments, 'status'=>$status, 'company'=>$company, 'project'=>$project]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function edit(Task $task)
    {
        //
        $task = Task::find($task->id);
        $company_id = $task->company_id;
        $project_id = $task->project_id;

        return view('tasks.edit', ['task' => $task, 'project_id' => $project_id, 'company_id' => $company_id]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Task $task)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function destroy(Task $task)
    {
        //
    }

    public function adduser(Request $request){
        //add user ke task
        
        //mengambil task, add user ke task
        $task = Task::find($request->input('task_id'));
       
        if(Auth::user()->id == $task->user_id){
            $user = User::where('email', $request->input('email'))->first(); //single record
            //cek jika user sudah ada di project
            $taskUser = TaskUser::where('user_id', $user->id)
                                        ->where('task_id', $task->id)
                                        ->first();

            if($taskUser){
                //jika user sudah ada, keluar
                return redirect()->route('tasks.show', ['task'=>$task->id])
                ->with('success', $request->input('email').' Sudah Menjadi Member Di Task Ini');
            }
            if(!$user){
                return redirect()->route('tasks.show', ['task'=>$task->id])
                ->with('errors', ' Gagal Menambah Member Ke Task');
            }
            

            if($user && $task){
                $task->users()->attach($user->id);

                return redirect()->route('tasks.show', ['task'=>$task->id])
                ->with('success', $request->input('email').' Sukses Ditambah Ke Task');
            }

        }

        return redirect()->route('tasks.show', ['task'=>$task->id])
        ->with('errors', ' Gagal Menambah Member Ke Task');
    }
}
