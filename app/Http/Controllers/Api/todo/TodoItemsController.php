<?php
namespace App\Http\Controllers\Api\todo;

use App\Http\Controllers\Controller;
use App\Models\todo\TodoItems;
use App\Models\User;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class TodoItemsController extends Controller {

    public $successStatus = 200;
    public $errorStatus = 500;


    public function index() {

    }

    public function store(Request $request) {
        $data = $request->get('data');
        if ($data) {
            $item = TodoItems::create($data);
            return response()->json(['msg' => '增加了一件任务', 'id' => $item->id], $this->successStatus);
        } else {
            return response()->json(['error' => '添加失败'], $this->errorStatus);
        }
    }

    public function update($id) {
        if ($id) {
            $item = TodoItems::findOrfail($id);
            $item->finish_at = Carbon::now();
            $item->save();
            return response()->json(['msg' => '减少了一件任务！', 'finish_at' => Carbon::now()->toDateTimeString()], $this->successStatus);
        } else {
            // 没取得id 可能是在未刷新就完成的过？
            return response()->json(['error' => '添加失败，刷新试试？'], $this->errorStatus);
        }
    }

    public function destroy($id) {
        if ($id) {
            DB::beginTransaction();
            try {
                $item = TodoItems::findOrFail($id);
                $item->delete();
                DB::commit();
                return response()->json(['msg' => '删除一件任务！'], $this->successStatus);
            } catch (Exception $e) {
                DB::rollBack();
                return response()->json(['error' => '请不要同时做多项操作哦'], $this->errorStatus);
            }
        } else {
            return response()->json(['error' => '删除失败，刷新试试？'], $this->errorStatus);
        }
    }

    public function addCommon(Request $request) {

    }

    public function deleteCommon($id) {

    }

    public function addSchedule(Request $request) {

    }

    public function deleteSchedule($id) {

    }
}
