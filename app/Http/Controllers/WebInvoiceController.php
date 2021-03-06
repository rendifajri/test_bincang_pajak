<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Invoice;
use App\Models\Destination;
use App\Models\Item;

class WebInvoiceController extends Controller
{
    public function index(Request $request){
        $data['title'] = 'Invoice List';

        $invoice = Invoice::orderBy("issue_date", "desc")->get();
        foreach($invoice as $val){
            $val->destination;
            $val->total_amount = $val->invoiceItem->sum(function($data){
                return $data->qty * $data->price;
            });
            unset($val->invoiceItem);
        }
        $data['invoice'] = $invoice;
        return view('index', $data);
    }

    public function create(Request $request){
        $data['title'] = 'Invoice Create';

        $data['destination'] = Destination::orderBy("name")->get();
        $item = Item::orderBy("name")->get();
        $data['item'] = [];
        foreach($item as $val){
            $data['item'][$val->id] = $val;
        }
        $data['item_type'] = Item::orderBy("item_type")->select("item_type")->groupBy('item_type')->get();
        $data['item_by_type'] = [];
        foreach($data['item_type'] as $val){
            $data['item_by_type'][$val->item_type] = Item::where("item_type", $val->item_type)->get();
        }
        return view('create', $data);
    }

    public function update($id, Request $request){
        $data['title'] = 'Invoice Update';

        $data['destination'] = Destination::orderBy("name")->get();
        $item = Item::orderBy("name")->get();
        $data['item'] = [];
        foreach($item as $val){
            $data['item'][$val->id] = $val;
        }
        $data['item_type'] = Item::orderBy("item_type")->select("item_type")->groupBy('item_type')->get();
        $data['item_by_type'] = [];
        foreach($data['item_type'] as $val){
            $data['item_by_type'][$val->item_type] = Item::where("item_type", $val->item_type)->get();
        }

        $invoice = Invoice::find($id);
        $invoice->total_amount = $invoice->invoiceItem->sum(function($data){
            return $data->qty * $data->price;
        });
        foreach($invoice->invoiceItem as $val){
            $val->amount = $val->qty * $val->price;;
            $val->item;
        }
        $data['invoice'] = $invoice;
        return view('update', $data);
    }

    public function detail($id, Request $request){
        $data['title'] = 'Invoice Detail';

        $data['destination'] = Destination::orderBy("name")->get();

        $invoice = Invoice::find($id);
        $invoice->total_amount = $invoice->invoiceItem->sum(function($data){
            return $data->qty * $data->price;
        });
        foreach($invoice->invoiceItem as $val){
            $val->amount = $val->qty * $val->price;;
            $val->item;
        }
        $data['invoice'] = $invoice;
        return view('detail', $data);
    }

    public function delete($id, Request $request){
        Invoice::find($id)->delete();
        return redirect('/');
    }
}
