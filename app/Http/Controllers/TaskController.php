<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

/**
 * Class TaskController
 * @package App\Http\Controllers
 */
class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return \Illuminate\Contracts\View\View
     */
    public function index(): \Illuminate\Contracts\View\View
    {
        $tasks = auth()->user()->tasks();
        return view('dashboard', compact('tasks'));
    }

    /**
     * Show the form for creating a new resource.
     * @return \Illuminate\Contracts\View\View
     */
    public function create(): \Illuminate\Contracts\View\View
    {
        return view('create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $this->validate($request, [
            'description' => 'required'
        ]);
        $task = new Task();
        $task->description = $request->description;
        $task->user_id = auth()->user()->id;
        $task->save();
        return redirect('/dashboard');
    }

    /**
     * Show the form for editing the specified resource.
     * @param Task $task
     * @return \Illuminate\Contracts\View\View|RedirectResponse
     */
    public function edit(Task $task): \Illuminate\Contracts\View\View|RedirectResponse
    {
        if (auth()->user()->id == $task->user_id) {
            return view('edit', compact('task'));
        } else {
            return redirect('/dashboard');
        }
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param Task $task
     * @return RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request, Task $task): RedirectResponse
    {
        $this->validate($request, [
            'description' => 'required'
        ]);
        $task->description = $request->description;
        $task->save();
        return redirect('/dashboard');
    }

    /**
     * Patch the specified resource with Ajax (mark a message).
     * @param Task $task
     * @return int
     */
    public function mark(Task $task): int
    {
        $status = ($task->marked == 0) ? 1 : 0;
        $task->update(['marked' => $status]);
        return $status;
    }

    /**
     * Remove the specified resource from storage.
     * @param Task $task
     * @return RedirectResponse
     */
    public function destroy(Task $task): RedirectResponse
    {
        $task->delete();
        return redirect('/dashboard');
    }

    /**
     * Remove all resources from storage for current user.
     * @return RedirectResponse
     */
    public function destroyAll(): RedirectResponse
    {
        Task::where('user_id', auth()->user()->id)->delete();
        return redirect('/dashboard');
    }
}
