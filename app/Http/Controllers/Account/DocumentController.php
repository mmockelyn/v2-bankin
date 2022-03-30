<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use App\Models\Core\DocumentCategory;
use Illuminate\Http\Request;

class DocumentController extends Controller
{
    public function index()
    {
        return view('account.document.index');
    }

    public function gdd()
    {
        $categories = DocumentCategory::all();
        return view('account.document.gdd', compact('categories'));
    }

    public function documentList($category_id)
    {
        $document = DocumentCategory::find($category_id)->documents()->where('customer_id', \request()->user()->customer->id)->orderBy('created_at', 'asc')->get();
        $arr = [];

        foreach ($document as $item) {
            $arr[] = [
                'name' => $item->name,
                'created_at' => $item->created_at->format('d/m/Y'),
                'link' => config('app.url').'/storage/gdd/'.\request()->user()->customer->id.'/'.\Str::slug($item->category->name).'/'.\Str::slug($item->name).'.pdf'
            ];
        }

        return response()->json($arr);
    }
}
