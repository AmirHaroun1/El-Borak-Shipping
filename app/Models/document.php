<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class document extends Model
{
    use HasFactory;


    public function getDocumentFile(){
        if(!is_null($this->path) && !file_exists(public_path().'/storage/Documents'.$this->path))
        {
            return asset('storage/documents/'.$this->path);
        }
        return null;
    }
    public static function SaveDocumentPath(Request $request){
        $path = $request->file('document')->store('Documents');
        return $path;
    }
    public function UpdateDocumentPath(Request $request){
        if (!is_null($this->getDocumentFile()))
            unlink(public_path().'storage/documents/'.$this->path);
        $path = $request->file('document')->store('Documents');;
        return $path;
    }
}
