<?php

namespace App\Http\Controllers;

use App\Folder;
use App\Task;
use Illuminate\Http\Request;
use App\Http\Requests\CreateTask;

class TaskController extends Controller
{
    // index
    public function index(int $id)
    {
        // return "Hello World!";   // for Debug

        // 全フォルダを取得
        $folders = Folder::all();

        // 選ばれたフォルダを取得
        $current_folder = Folder::find($id);

        // current_folder からタスクを取得
        // $tasks = Task::where('folder_id', $current_folder->id)->get();     // get() を忘れないように
        $tasks = $current_folder->tasks()->get();   // リレーションを使用する

        return view('tasks/index', [
            'folders' => $folders,
            'current_folder_id' => $id,
            'tasks' => $tasks,
        ]);

    }

    /**
     * GET /folders/{id}/tasks/create
    */
    public function showCreateForm(int $id)
    {
        return view('tasks/create', [
            'folder_id' => $id
        ]);
    }

    public function create(int $id, CreateTask $request)
    {
        $current_folder = Folder::find($id);

        $task = new Task();
        $task->title = $request->title;
        $task->due_date = $request->due_date;

        // リレーションにより$current_folderに紐づいた状態で保存
        $current_folder->tasks()->save($task);

        return redirect()->route('tasks.index', [
            'id' => $current_folder->id,
        ]);
    }
}
