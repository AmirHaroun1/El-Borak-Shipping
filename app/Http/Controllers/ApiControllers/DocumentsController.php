<?php

namespace App\Http\Controllers\ApiControllers;

use App\Http\Controllers\Controller;
use App\Http\Resources\documentResource;
use App\Models\document;
use Illuminate\Http\Request;

class DocumentsController extends Controller
{
    public function store(Request $request){
        if ($request->hasFile('document')){
            $request['document'] = document::SaveDocumentPath($request);
        }
        $document = document::create($request->all());

        return new documentResource($document);
    }
    public function update(Request $request,document $document){
        if ($request->hasFile('document')){
            $request['path'] = $document->UpdateDocumentPath($request);
        }
        $document->update($request->all());
        return new documentResource($document);
    }
    public function destroy(document $document){
        if (!is_null($document->path)){
            unlink(public_path().'storage/documents/'.$document->path);
        }
        $document->delete();
    }
}
