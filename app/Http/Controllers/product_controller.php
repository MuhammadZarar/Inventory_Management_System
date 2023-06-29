<?php

namespace App\Http\Controllers;

use App\Models\category;
use App\Models\product;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class product_controller extends Controller
{
    public function product_list()
    {
        if (session()->get('admin_id')) {
            return view('product.list');
        } else {
            return redirect('/');
        }
    }

    public function product_get()
    {
        if (session()->get('admin_id')) {
            try {
                $products = product::join('categories', 'categories.category_id', '=', 'products.type')
                    ->get(['products.*', 'categories.name as product_type']);
                return view('product.response', ['products' => $products]);
            } catch (Exception $e) {
                return response()->json(['status' => 'false', 'msg' => 'Product Could Not Found']);
            }
        } else {
            return redirect('/');
        }
    }

    public function product_add()
    {
        if (session()->get('admin_id')) {
            $category = category::all();
            return view('product.add', (['category' => $category]));
        } else {
            return redirect('/');
        }
    }

    public function product_store(Request $request)
    {
        if (session()->get('admin_id')) {
            $request->validate([
                'product' => 'required',
                'type' => 'required',
                'price' => 'required',
            ]);
            try {
                DB::beginTransaction();
                product::create([
                    'name' => $request->product,
                    'type' => $request->type,
                    'price' => $request->price,
                    'date' => date('Y-m-d'),
                    'status' => 1,
                ]);
                $lastId = DB::getPdo()->lastInsertId();
                $code = md5($lastId);
                product::where('product_id', $lastId)->update([
                    'code' => $code
                ]);
                DB::commit();
                return response()->json(['status' => 'true', 'msg' => 'Product Added Succeffully']);
            } catch (Exception $e) {
                DB::rollBack();
                return response()->json(['status' => 'false', 'msg' => 'Product Could not Register']);
            }
        } else {
            return redirect('/');
        }
    }

    public function product_edit($code)
    {
        if (session()->get('admin_id')) {
            try {
                $category = category::all();
                $product = product::where('code', $code)->first();
                return view('product.edit', ['category' => $category, 'product' => $product]);
            } catch (Exception $e) {
                return response()->json(['status' => 'false', 'msg' => 'Product Could Not Found']);
            }
        } else {
            return redirect('/');
        }
    }

    public function product_update(Request $request)
    {
        if (session()->get('admin_id')) {
            $request->validate([
                'code' => 'required',
                'product' => 'required',
                'type' => 'required',
                'price' => 'required',
            ]);
            try {
                DB::beginTransaction();
                product::where('code', $request->code)->update([
                    'name' => $request->product,
                    'type' => $request->type,
                    'price' => $request->price,
                ]);
                DB::commit();
                return response()->json(['status' => 'true', 'msg' => 'Product Updated Successfully']);
            } catch (Exception $e) {
                DB::rollBack();
                return response()->json(['status' => 'false', 'msg' => 'Product Could not Updated']);
            }
        } else {
            return redirect('/');
        }
    }

    public function product_delete($code)
    {
        if (session()->get('admin_id')) {
            try {
                DB::beginTransaction();
                $product = product::where('code', $code)->first();
                if (!is_null($product)) {
                    product::where('code', $code)->delete();
                    DB::commit();
                    return response()->json(['status' => 'true', 'msg' => 'Product Delete Successfully']);
                }
            } catch (Exception $e) {
                DB::rollBack();
                return response()->json(['status' => 'false', 'msg' => 'Product Could Not Delete']);
            }
        } else {
            return redirect('/');
        }
    }

    // public function item_pdf()
    // {
    //     $item = item::all();
    //     $pdf = Pdf::loadView('items.pdf', compact('item'));
    //     return $pdf->download('items.pdf');
    // }
}
