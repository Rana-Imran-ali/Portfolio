<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Project;
use App\Models\Skill;
use App\Models\Experience;
use App\Models\Post;
use App\Models\PageContent;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\File;

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

    public function downloadResumeAPI()
    {
        // Try common image names the user might upload
        $possibleNames = ['resume.png', 'resume.jpg', 'resume.jpeg', 'cv.png', 'cv.jpg', 'cv.jpeg'];
        $imagePath = null;

        foreach ($possibleNames as $name) {
            $path = storage_path('app/public/' . $name);
            if (File::exists($path)) {
                $imagePath = $path;
                break;
            }
        }

        if (!$imagePath) {
            return response()->json(['error' => 'CV image not found on the server. Please manually upload it to storage/app/public/resume.png'], 404);
        }

        // Read image and encode as base64
        $type = pathinfo($imagePath, PATHINFO_EXTENSION);
        $data = file_get_contents($imagePath);
        $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);

        // Generate HTML structure rendering the image for PDF
        $html = '<!DOCTYPE html>
        <html>
        <head>
            <style>
                @page { margin: 0px; }
                body { margin: 0px; padding: 0px; text-align: center; background: #fff; }
                img { max-width: 100%; height: auto; }
            </style>
        </head>
        <body>
            <img src="' . $base64 . '" alt="Resume">
        </body>
        </html>';

        // Load into DOMPDF
        $pdf = Pdf::loadHTML($html)->setPaper('a4', 'portrait');

        // Return direct PDF file download via streams
        return response($pdf->output(), 200, [
            'Content-Type'        => 'application/pdf',
            'Content-Disposition' => 'attachment; filename="Imran-Ali-Resume.pdf"',
        ]);
    }

    public function projects()
    {
        $projects = Project::latest()->get();
        return view('frontend.projects', compact('projects'));
    }
}
