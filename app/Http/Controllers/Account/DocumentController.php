<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use App\Models\Core\DocumentCategory;
use App\Models\Core\DocumentTransmiss;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\File\Exception\FileException;

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

    public function transmiss(Request $request)
    {
        $documents = $request->user()->customer->transmisses()->where('file_transfered', false)->get();

        return view('account.document.transmiss', compact('documents'));
    }

    public function postDocument(Request $request)
    {
        $file = $request->file('file');
        try {
            $file->storeAs('/gdd/'.$request->user()->customer->id.'/transmiss/', $file->getClientOriginalName(), 'public');

            $document = DocumentTransmiss::find($request->get('document_transmiss_id'));
            $document->file_transfered = true;
            $document->date_transmiss = now();
            $document->file_name = $file->getClientOriginalName();
            $document->save();

            //TODO: Notification de transmission de document à l'agence

            return redirect()->back()->with('success', "Votre document <strong>".$file->getClientOriginalName()."</strong> à été transmis avec succès à votre agence.");
        }catch (FileException $exception) {
            return redirect()->back()->with('error', $exception->getMessage());
        }
    }
}
