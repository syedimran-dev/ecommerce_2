<?php

namespace Database\Seeders;

use App\Models\CmsPage;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CmsPageTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $cmsPagesRecord = [
             ['id' => 1, 'title' => 'About Us', 'Description' => 'Content is Coming Soon', 'url' => 'about-us',  'meta_title' => 'About Us', 'meta_description' => 'About Us Content', 'meta_keywords' => 'about us, about', 'status' => 1],
             ['id' => 2, 'title' => 'Terms & Conditions', 'Description' => 'Terms & Conditions is Coming Soon', 'url' => 'terms_conditions',  'meta_title' => 'Terms & Conditions', 'meta_description' => 'Terms & Conditions Content', 'meta_keywords' => 'terms conditions, terms', 'status' => 1],
             ['id' => 3, 'title' => 'Privacy Policy', 'Description' => 'Privacy Policy is Coming Soon', 'url' => 'privacy-policy',  'meta_title' => 'Privacy Policy', 'meta_description' => 'Privacy Policy Content', 'meta_keywords' => 'privacy policy, policy', 'status' => 1]
        ];
        CmsPage::insert($cmsPagesRecord);
    }
}
