<?php
namespace App\Http\Controllers\Api\todo;

use App\Http\Controllers\Controller;
use App\Models\todo\Todo;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TodoController extends Controller {

    public $successStatus = 200;
    public $error = 500;

    public function index() {
        try {
            $user = Auth::user();
            $todo = Todo::with(['items' => function ($q) {
                $q->select('id', 'name', 'order', 'sub', 'important', 'finish_at');
            }])->where('user_id', $user->id)->orderBy('priority', 'desc')->get();
            if (!count($todo)) {
                $new_todo = new Todo;
                $new_todo->user_id = $user->id;
                $new_todo->name = '默认';
                $new_todo->save();
            }
            return response()->json(['items' => $todo], $this->successStatus);
        } catch (Exception $e) {
            return response()->json(['msg' => '加载失败，请稍候再试或上报错误信息'], $this->error);
        }
    }

    public function store(Request $request) {
        $user = Auth::user();
        $name = $request->get('name');
        $priority = $request->get('priority');
        $label = $request->get('label');
        if ($name && $priority) {
            DB::beginTransaction();
            try {
                $todo = new Todo;
                $todo->user_id = $user->id;
                $todo->name = $name;
                $todo->priority = $priority;
                $todo->label = $label;
                $todo->save();
                DB::commit();
            } catch (Exception $e) {
                DB::rollBack();
                return response()->json(['error' => $e], $this->error);
            }
            return response()->json(['msg' => '添加成功', 'id' => $todo->id], $this->successStatus);
        } else {
            return response()->json(['error' => '信息不全，请重新填写'], $this->error);
        }
    }

    public function destroy($id) {
        try {
            $todo = Todo::findOrFail($id);
            $todo->delete();
        } catch (Exception $e) {
            return response()->json(['error' => '删除失败, 任务页不存在'], $this->error);
        }
        return response()->json(['msg' => '删除成功'], $this->successStatus);
    }
}