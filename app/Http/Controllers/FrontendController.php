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
        $projects = Project::latest()->take(3)->get();
        $skills = Skill::all();
        $posts = Post::latest()->take(3)->get();
        return view('frontend.home', compact('content', 'projects', 'skills', 'posts'));
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

    public function posts()
    {
        $posts = Post::latest()->paginate(9);
        return view('frontend.posts', compact('posts'));
    }

    public function post($slug)
    {
        $post = Post::where('slug', $slug)->firstOrFail();
        return view('frontend.post', compact('post'));
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
