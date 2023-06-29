<?php

namespace App\Http\Controllers;

use App\Models\invoice;
use App\Models\item;
use App\Models\product;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;

class invoice_controller extends Controller
{
    public function invoice_list()
    {
        if (session()->get('admin_id')) {
            return view('invoice.list');
        } else {
            return redirect('/');
        }
    }

    public function invoice_get()
    {
        if (session()->get('admin_id')) {
            try {
                $invoices = invoice::all();
                return view('invoice.response', ['invoices' => $invoices]);
            } catch (Exception $e) {
                return response()->json(['status' => 'false', 'msg' => 'Invoice Could Not Found']);
            }
        } else {
            return redirect('/');
        }
    }

    public function invoice_add()
    {
        if (session()->get('admin_id')) {
            $product = product::join('categories', 'categories.category_id', '=', 'products.type')
                ->get(['products.*', 'categories.name as product_type']);
            return view('invoice.add', ['product' => $product]);
        } else {
            return redirect('/');
        }
    }

    public function invoice_product($code)
    {
        if (session()->get('admin_id')) {
            $product = product::where('product_id', '=', $code)->first();
            return response()->json(['product' => $product]);
        } else {
            return redirect('/');
        }
    }

    public function invoice_store(Request $request)
    {
        if (session()->get('admin_id')) {
            try {
                DB::beginTransaction();
                invoice::create([
                    'invoice_no' => $request->invoice_no,
                    'name' => $request->name,
                    'contact' => $request->contact,
                    'date' => date('Y-m-d'),
                    'sub_total' => $request->sub_total,
                    'sub_discount' => $request->sub_discount,
                    'grand_total' => $request->grand_total,
                    'status' => 1,
                ]);
                $lastId = DB::getPdo()->lastInsertId();
                $code = md5($lastId);
                invoice::where('invoice_id', $lastId)->update([
                    'code' => $code
                ]);
                $item_id = json_decode($request->item_id, true);
                $item_qty = json_decode($request->item_qty, true);
                $item_price = json_decode($request->item_price, true);
                $item_net_amount = json_decode($request->item_net_amount, true);
                $item_discount = json_decode($request->item_discount, true);
                $item_gross_amount = json_decode($request->item_gross_amount, true);
                for ($i = 0; $i < count($item_id); $i++) {
                    item::create([
                        'invoice_id' => $lastId,
                        'product_id' => $item_id[$i],
                        'product_qty' => $item_qty[$i],
                        'product_price' => $item_price[$i],
                        'net_amount' => $item_net_amount[$i],
                        'discount' => $item_discount[$i],
                        'gross_amount' => $item_gross_amount[$i],
                        'date' => date('Y-m-d'),
                        'status' => 1,
                    ]);
                }
                DB::commit();
                return response()->json(['status' => 'true', 'msg' => 'Invoice Added Succeffully', 'lastId' => $lastId]);
            } catch (Exception $e) {
                DB::rollBack();
                return response()->json(['status' => 'false', 'msg' => 'Invoice Could not Register']);
            }
        } else {
            return redirect('/');
        }
    }

    public function invoice_print($code)
    {
        $invoice = invoice::where('invoice_id', '=', $code)->first();
        $id = $invoice->invoice_id;
        $items = DB::table('items')
        ->join('products', 'items.product_id', '=', 'products.product_id')
        ->where('items.invoice_id', '=', $id)
        ->select('items.*', 'products.name as product_name')->get();
        $data = [
            'title' => 'BF Fresh Juice',
            'date' => date('m/d/Y'),
            'invoice' => $invoice,
            'items' => $items
        ]; 
        $pdf = PDF::loadView('invoice.pdf', $data);
        return $pdf->stream();
    }
}
