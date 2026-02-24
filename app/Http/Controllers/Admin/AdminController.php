<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Project;
use App\Models\Skill;
use App\Models\Post;
use App\Models\Subscriber;

class AdminController extends Controller
{
    public function index()
    {
        $stats = [
            'projects' => Project::count(),
            'skills' => Skill::count(),
            'posts' => Post::count(),
            'subscribers' => Subscriber::count(),
        ];
        return view('admin.dashboard', compact('stats'));
    }
}
