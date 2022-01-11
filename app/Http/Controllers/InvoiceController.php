<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Invoice;
use App\Models\InvoiceItem;

class InvoiceController extends Controller
{
    public function index()
    {
        $invoice = Invoice::orderBy("issue_date", "desc")->get();
        foreach($invoice as $val){
            $val->destination;
            $val->total_amount = $val->invoiceItem->sum(function($data){
                return $data->qty * $data->price;
            });
            unset($val->invoiceItem);
        }
        $res = [
            "status" => "success",
            "message" => "Get Invoice list success",
            "response" => $invoice
        ];
        return response($res);
    }
    public function create(Request $request)
    {
        try{
            \DB::beginTransaction();
            $valid_arr = [
                "destination_id" => "required|exists:App\Models\Destination,id",
                "inv_no" => "required|unique:App\Models\Invoice,inv_no",
                "issue_date" => "required|date_format:Y-m-d",
                "due_date" => "required|date_format:Y-m-d",
                "subject" => "required",
                "item"  => "required|array",
                "item.*.item_id"  => "required|exists:App\Models\Item,id|distinct",
                "item.*.qty"  => "required|integer",
                "item.*.price"  => "required|integer",
            ];
            $valid = Validator::make($request->all(), $valid_arr);
            if ($valid->fails())
                throw new \ValidationException($valid);

            $invoice = Invoice::create([
                "destination_id" => $request->destination_id,
                "inv_no" => $request->inv_no,
                "issue_date" => $request->issue_date,
                "due_date" => $request->due_date,
                "subject" => $request->subject
            ]);
            foreach($request->item as $val) {
                InvoiceItem::create([
                    "invoice_id" => $invoice->id,
                    "item_id" => $val["item_id"],
                    "qty" => $val["qty"],
                    "price" => $val["price"],
                ]);
            }
            \DB::commit();
            $res = [
                "status" => "success",
                "message" => "Create Invoice success",
                "response" => $invoice
            ];
            return response($res);
        } catch (\Throwable $e) {
            \DB::rollback();
            throw $e;
        }
    }
}