<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CopyrightRule;
use Inertia\Inertia;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;

class CopyrightRulesController  extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $copyright_rules = CopyrightRule::paginate();
        //
        return Inertia::render('Admin/CopyrightRules/Index', compact(
            'copyright_rules'
        ));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Admin/CopyrightRules/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'description' => 'required',
            'notes' => 'required',
        ]);
                
        CopyrightRule::create([
            'description' => $request->description,
            'notes' => $request->notes,
            'active' => true
        ]);

        return Redirect::route('admin.copyright-rules.index');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $copyright_rule = CopyrightRule::findOrFail($id);

        return Inertia::render('Admin/CopyrightRules/Edit', compact('copyright_rule'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
  
        $copyright_rule = CopyrightRule::findOrFail($id);

        return Inertia::render('Admin/CopyrightRules/Edit', compact('copyright_rule'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'description' => 'required',
            'notes' => 'required',
        ]);
        
        $copyright_rule = CopyrightRule::findOrFail($id);
        $copyright_rule->description = $request->description;
        $copyright_rule->notes = $request->notes;

        $copyright_rule->save();

        return Redirect::route('admin.copyright-rules.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $model = CopyrightRule::findOrFail($request->id);

        if($request->action === 'change-status'){
            $model->active= !$model->active;
            $model->save();
        } else if($request->action === 'delete'){
            $model->delete();
        }

        return Redirect::route('admin.copyright-rules.index');
    }
}
