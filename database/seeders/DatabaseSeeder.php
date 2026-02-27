<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::create([
            'name' => 'Imran Ali',
            'email' => 'ranaimranali2210@gmail.com',
            'password' => Hash::make('00003310'),
            'is_admin' => true,
        ]);

        \App\Models\PageContent::create([
            'key' => 'home_hero',
            'value' => 'I build <strong style="color:#e2e8f0;">reliable, performant</strong> web applications using <strong style="color:#00d4ff;">Laravel & PHP</strong>. From idea to deployment — clean code, great UX.'
        ]);

        \App\Models\PageContent::create([
            'key' => 'about_text',
            'value' => '<p>Hello! I\'m <strong style="color:#e2e8f0;">Imran Ali</strong>, a results-driven full-stack web developer based in Rawalpindi, Pakistan, with a passion for building clean, scalable web applications.</p><p>With <strong style="color:#00d4ff;">3+ years</strong> of hands-on experience, I specialise in the <strong style="color:#e2e8f0;">Laravel ecosystem</strong> — from architecting robust backends and RESTful APIs to crafting responsive, accessible frontends.</p><p>I believe great software is equal parts engineering and empathy. Every line of code I write is guided by the question: <em style="color:#e2e8f0;">"Does this genuinely help the end user?"</em></p><p>When I\'m not coding, I\'m exploring new frameworks, contributing to open-source, or diving deep into system design concepts.</p>'
        ]);
    }
}
