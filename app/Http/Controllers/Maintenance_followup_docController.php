<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Maintenance_followup_doc;
use Illuminate\Support\Facades\Storage;

class Maintenance_followup_docController extends Controller
{
    public function download(Maintenance_followup_doc $doc)
    {
        return Storage::disk('maintenance_followups')->download(
            $doc->path,
            $doc->name
        );
    }
}
