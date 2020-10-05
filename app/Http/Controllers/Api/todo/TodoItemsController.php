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
            DB::beginTransaction();
            try {
                if ($item->finish_at == null) {
                    $item->finish_at = Carbon::now();
                    $item->save();
                    TodoItems::where('sub', $id)->where('finish_at', null)->update(['finish_at' => Carbon::now()]);
                    DB::commit();
                    return response()->json(['msg' => '任务减少了！'], $this->successStatus);
                } else {
                    TodoItems::where('sub', $id)->where('finish_at', $item->finish_at)->update(['finish_at' => null]);
                    $item->finish_at = null;
                    $item->save();
                    DB::commit();
                    return response()->json(['msg' => '任务增加了!'], $this->successStatus);
                }
            } catch (Exception $e) {
                DB::rollBack();
                return response()->json(['error' => '好像遇到一点问题!'], $this->errorStatus);
            }
        } else {
            // 没取得id 可能是在未刷新就完成的过？
            return response()->json(['error' => '操作太快了，慢一点吧？'], $this->errorStatus);
        }
    }

    public function updateOrder(Request $request, $id) {
        $order = $request->get('order');
        $item = TodoItems::findOrFail($id);
        $item->order = $order;
        $item->save();
        return response()->json(['msg' => '设置成功']);
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
