<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Experience;
use App\Http\Requests\ExperienceRequest;

class ExperienceController extends Controller
{
    public function index()
    {
        $experiences = Experience::latest()->get();
        return view('admin.experience.index', compact('experiences'));
    }

    public function create()
    {
        return view('admin.experience.create');
    }

    public function store(ExperienceRequest $request)
    {
        Experience::create($request->validated());
        return redirect()->route('admin.experience.index')->with('success', 'Experience created successfully.');
    }

    public function edit(Experience $experience)
    {
        return view('admin.experience.edit', compact('experience'));
    }

    public function update(ExperienceRequest $request, Experience $experience)
    {
        $experience->update($request->validated());
        return redirect()->route('admin.experience.index')->with('success', 'Experience updated successfully.');
    }

    public function destroy(Experience $experience)
    {
        $experience->delete();
        return redirect()->route('admin.experience.index')->with('success', 'Experience deleted successfully.');
    }
}
