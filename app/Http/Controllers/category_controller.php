<?php

namespace App\Http\Controllers;

use App\Models\category;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class category_controller extends Controller
{
    public function category_list()
    {
        if (session()->get('admin_id')) {
            return view('category.list');
        } else {
            return redirect('/');
        }
    }

    public function category_get()
    {
        if (session()->get('admin_id')) {
            try {
                $categories = category::all();
                return view('category.response', ['categories' => $categories]);
            } catch (Exception $e) {
                return response()->json(['status' => 'false', 'msg' => 'Category Could Not Found']);
            }
        } else {
            return redirect('/');
        }
    }

    public function category_add()
    {
        if (session()->get('admin_id')) {
            return view('category.add');
        } else {
            return redirect('/');
        }
    }

    public function category_store(Request $request)
    {
        if (session()->get('admin_id')) {
            $request->validate([
                'category' => 'required',
            ]);
            $check = category::where('name', '=', Str::lower(preg_replace('/[^A-Za-z\-]/', '', $request->category)))->get();
            if (count($check) > 0) {
                return response()->json(['status' => 'true', 'msg' => 'Juice Already Exists']);
            } else {
                try {
                    DB::beginTransaction();
                    category::create([
                        'name' => Str::lower(preg_replace('/[^A-Za-z\-]/', '', $request->category)),
                        'date' => date('Y-m-d'),
                        'status' => 1,
                    ]);
                    $lastId = DB::getPdo()->lastInsertId();
                    $code = md5($lastId);
                    category::where('category_id', $lastId)->update([
                        'code' => $code
                    ]);
                    DB::commit();
                    return response()->json(['status' => 'true', 'msg' => 'Category Added Succeffully']);
                } catch (Exception $e) {
                    DB::rollBack();
                    return response()->json(['status' => 'false', 'msg' => 'Category Could not Register']);
                }
            }
        } else {
            return redirect('/');
        }
    }

    public function category_edit($code)
    {
        if (session()->get('admin_id')) {
            try {
                $category = category::where('code', $code)->first();
                return view('category.edit', ['category' => $category]);
            } catch (Exception $e) {
                return response()->json(['status' => 'false', 'msg' => 'Category Could Not Found']);
            }
        } else {
            return redirect('/');
        }
    }

    public function category_update(Request $request)
    {
        if (session()->get('admin_id')) {
            $request->validate([
                'code' => 'required',
                'category' => 'required',
            ]);
            try {
                DB::beginTransaction();
                category::where('code', $request->code)->update([
                    'name' => Str::lower(preg_replace('/[^A-Za-z\-]/', '', $request->category)),
                    'status' => $request->status,
                ]);
                DB::commit();
                return response()->json(['status' => 'true', 'msg' => 'Category Updated Succeffully']);
            } catch (Exception $e) {
                DB::rollBack();
                return response()->json(['status' => 'false', 'msg' => 'Category Could not Updated']);
            }
        } else {
            return redirect('/');
        }
    }

    public function category_delete($code)
    {
        if (session()->get('admin_id')) {
            try {
                DB::beginTransaction();
                $category = category::where('code', $code)->first();
                if (!is_null($category)) {
                    category::where('code', $code)->delete();
                    DB::commit();
                    return response()->json(['status' => 'true', 'msg' => 'Category Delete Successfully']);
                }
            } catch (Exception $e) {
                DB::rollBack();
                return response()->json(['status' => 'false', 'msg' => 'Category Could Not Delete']);
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
