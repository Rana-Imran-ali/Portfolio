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
        $about_content = PageContent::where('key', 'about_text')->first();
        
        $projects = Project::latest()->get();
        $skills = Skill::all()->groupBy('category');
        $experiences = Experience::latest()->get();
        $posts = Post::latest()->take(6)->get(); // Limit posts slightly so the page isn't endless if there are many

        return view('frontend.home', compact(
            'content', 
            'about_content', 
            'projects', 
            'skills', 
            'experiences', 
            'posts'
        ));
    }

    public function post($slug)
    {
        $post = Post::where('slug', $slug)->firstOrFail();
        return view('frontend.post', compact('post'));
    }

    public function resume()
    {
        $path = storage_path('app/public/resume.pdf');
        if (!file_exists($path)) {
            return back()->with('error', 'Resume not found.');
        }
        return response()->download($path);
    }

    public function projects()
    {
        $projects = Project::latest()->get();
        return view('frontend.projects', compact('projects'));
    }
}
