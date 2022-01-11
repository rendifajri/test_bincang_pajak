<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Destination;

class DestinationController extends Controller
{
    public function index()
    {
        $destination = Destination::orderBy("name")->get();
        $res = [
            "status" => "success",
            "message" => "Get Destination list success",
            "response" => $destination
        ];
        return response($res);
    }
}