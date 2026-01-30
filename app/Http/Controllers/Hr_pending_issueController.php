<?php

namespace App\Http\Controllers;

use App\Models\Hr_pending_issue;
use App\Models\Professional;
use App\Models\Hr_pending_issue_document;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;


class Hr_pending_issueController extends Controller
{

    public function index()
    {
        $user = Auth::user();
        if($user->role_id != 1){
            return redirect()->route('dashboard')->with('success', 'No tens acces a questa pagina.');   
        }
        else{
            $hr_pending_issues = Hr_pending_issue::with([
                'registered_by_professional',
                'affected_professional',
                'derived_to_professional',
                'documents'
            ])->orderBy('opened_at', 'desc')->get();
        
            return view('rrhh.index', compact('hr_pending_issues'));
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user = Auth::user();
        if($user->role_id != 1){
            return redirect()->route('dashboard')->with('success', 'No tens acces a questa pagina.');   
        }
        else{
            $professionals = Professional::all();
            return view('rrhh.create',compact('professionals'));
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user = Auth::user();
        if($user->role_id != 1){
            return redirect()->route('dashboard')->with('success', 'No tens acces a questa pagina.');   
        }
        else{
            $validated = $request->validate([
                'affected_professional_id' => 'required|exists:professionals,id',
                'derived_to_professional_id' => 'nullable|exists:professionals,id',
                'opened_at' => 'required|date',
                'context' => 'required|string',
                'status' => 'nullable|in:in_process,urgent,completed',
                'description' => 'required|string',
                'files.*' => 'file|max:10240',
            ]);
            $validated['center_id'] = session('center_id');

            $registered_by = Auth::id();

            // No es pot derivar a la mateixa persona que registra l'assumpte
            if ($validated['derived_to_professional_id'] && $validated['derived_to_professional_id'] == $registered_by) {
                return back()->withErrors([
                    'derived_to_professional_id' => 'No es pot derivar a la mateixa persona que registra l\'assumpte.'
                ])->withInput();
            }

            // Crear el tema pendiente
            $issue = Hr_pending_issue::create([
                'center_id' => $validated['center_id'],
                'affected_professional_id' => $validated['affected_professional_id'],
                'registered_by_professional_id' => $registered_by,
                'derived_to_professional_id' => $validated['derived_to_professional_id'],
                'opened_at' => $validated['opened_at'],
                'description' => $validated['description'],
                'context' => $validated['context'],
                'status' => $validated['status'],
            ]);

            
            if ($request->hasFile('files')) {
                foreach ($request->file('files') as $file) {
                    $safeName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
                    $extension = $file->getClientOriginalExtension();
                    $fileName = $safeName . '.' . $extension;

                    $storage_path = Storage::disk('hr_pending_issue')->putFileAs('', $file, $fileName);
                    

                    Hr_pending_issue_document::create([
                        'hr_pending_issue_id' => $issue->id,
                        'path' => $storage_path,
                    ]);
                }
            }
            return redirect()->route('hr_pending_issue.index')
                            ->with('success', 'Tema pendent creat correctament.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Hr_pending_issue $hr_pending_issue)
    {
        $user = Auth::user();
        if($user->role_id != 1){
            return redirect()->route('dashboard')->with('success', 'No tens acces a questa pagina.');   
        }
        else{
            $issue = $hr_pending_issue->load([
                'registered_by_professional',
                'affected_professional',
                'derived_to_professional',
                'documents'
            ]);

            return view('rrhh.show',compact('issue'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Hr_pending_issue $hr_pending_issue)
    {
        $user = Auth::user();
        if($user->role_id != 1){
            return redirect()->route('dashboard')->with('success', 'No tens acces a questa pagina.');   
        }
        else{
            $professionals = Professional::all();
            return view('rrhh.edit', compact('hr_pending_issue', 'professionals'));
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Hr_pending_issue $hr_pending_issue)
    {
        $user = Auth::user();
        if($user->role_id != 1){
            return redirect()->route('dashboard')->with('success', 'No tens acces a questa pagina.');   
        }
        else{
            $validated = $request->validate([
                'affected_professional_id' => 'required|exists:professionals,id',
                'derived_to_professional_id' => 'nullable|exists:professionals,id',
                'opened_at' => 'required|date',
                'context' => 'required|string',
                'status' => 'required|in:pending,in_process,urgent,completed',
                'description' => 'required|string',
            ]);
            if ($validated['derived_to_professional_id'] && $validated['derived_to_professional_id'] == $hr_pending_issue->registered_by_professional_id) {
                return back()->withErrors([
                    'derived_to_professional_id' =>
                        'No es pot derivar a la mateixa persona que ha registrat el tema.'
                ])->withInput();
            }
            $hr_pending_issue->update([
                'affected_professional_id' => $validated['affected_professional_id'],
                'derived_to_professional_id' => $validated['derived_to_professional_id'],
                'opened_at' => $validated['opened_at'],
                'context' => $validated['context'],
                'status' => $validated['status'],
                'description' => $validated['description'],
            ]);

            return redirect()
                ->route('hr_pending_issue.show', $hr_pending_issue)
                ->with('success', 'Tema pendent actualitzat correctament.');
        }
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Hr_pending_issue $hr_pending_issue)
    {
        //
    }
    public function download(Hr_pending_issue_document $document)
    {
        $user = Auth::user();
        if($user->role_id != 1){
            return redirect()->route('dashboard')->with('success', 'No tens acces a questa pagina.');   
        }
        else{
            return Storage::disk('hr_pending_issue')->download($document->path);
        }
    }
}
