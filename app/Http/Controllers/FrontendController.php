<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Project;
use App\Models\Skill;
use App\Models\Experience;
use App\Models\Post;
use App\Models\PageContent;

class FrontendController extends Controller
{
    public function home()
    {
        $content = PageContent::where('key', 'home_hero')->first();
        return view('frontend.home', compact('content'));
    }

    public function about()
    {
        $content = PageContent::where('key', 'about_text')->first();
        return view('frontend.about', compact('content'));
    }

    public function skills()
    {
        $skills = Skill::all()->groupBy('category');
        return view('frontend.skills', compact('skills'));
    }

    public function projects()
    {
        $projects = Project::latest()->get();
        return view('frontend.projects', compact('projects'));
    }

    public function experience()
    {
        $experiences = Experience::latest()->get();
        return view('frontend.experience', compact('experiences'));
    }

    public function contact()
    {
        return view('frontend.contact');
    }

    public function resume()
    {
        $path = storage_path('app/public/resume.pdf');
        if (!file_exists($path)) {
            return back()->with('error', 'Resume not found.');
        }
        return response()->download($path);
    }
}
