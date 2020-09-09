<?php
namespace App\Http\Controllers\Api\todo;

use App\Http\Controllers\Controller;
use App\Models\todo\TodoItems;
use App\Models\User;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\DB;

class TodoItemsController extends Controller {

    public $successStatus = 200;
    public $errorStatus = 500;


    public function index() {

    }

    public function store(Request $request) {
        $data = $request->get('data');
        if ($data) {
            TodoItems::create($data);
            return response()->json(['msg' => '添加成功'], $this->successStatus);
        } else {
            return response()->json(['error' => '添加失败'], $this->errorStatus);
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
