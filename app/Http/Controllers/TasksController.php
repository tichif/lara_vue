<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Task;

class TasksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request('search') !== null) {
            $tasks['data'] = Task::orderBy('created_at', 'DESC')->where('name', 'like', '%' . request('search') . '%')->get();
        } else {
            $tasks = $this->fetchTasksByOrder();
        }

        return response()->json([
            'tasks' => $tasks
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Task::create(['name' => $request->name]);
        $tasks = $this->fetchTasksByOrder();
        if (request()->expectsJson()) {
            return response()->json([
                'message' => 'Tache créée',
                'tasks' => $tasks
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $task = Task::findOrFail($id);
        if (request()->expectsJson()) {
            return response()->json([
                'task' => $task
            ]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $task  = Task::findOrFail($id);
        $task->name = $request->name;
        $task->save();

        $tasks = $this->fetchTasksByOrder();

        if (request()->expectsJson()) {
            return response()->json([
                'message' => 'Tache modifié',
                'tasks' => $tasks
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $task  = Task::findOrFail($id);
        $task->delete();
        $tasks = $this->fetchTasksByOrder();

        if (request()->expectsJson()) {
            return response()->json([
                'message' => 'Tache supprimée',
                'tasks' => $tasks
            ]);
        }
    }

    public function fetchTasksByOrder()
    {
        return Task::orderBy('created_at', 'DESC')->paginate(5);
    }
}
