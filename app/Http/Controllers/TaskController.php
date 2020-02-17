<?php

namespace App\Http\Controllers;

use App\Folder;
use App\Task;
use Illuminate\Http\Request;

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
        $tasks = Task::where('folder_id', $current_folder->id)->get();     // get() を忘れないように

        return view('tasks/index', [
            'folders' => $folders,
            'current_folder_id' => $id,
            'tasks' => $tasks,
        ]);

    }
}
