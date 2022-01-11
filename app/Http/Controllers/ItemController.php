<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;

class ItemController extends Controller
{
    public function index()
    {
        $item = Item::orderBy("name")->get();
        $res = [
            "status" => "success",
            "message" => "Get Item list success",
            "response" => $item
        ];
        return response($res);
    }
}