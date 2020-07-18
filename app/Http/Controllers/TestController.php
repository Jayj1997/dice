<?php
namespace App\Http\Controllers;

class TestController
{
    public function test()
    {
        $resp = ['data' => '= = '];
        return json_encode($resp);
    }
}
