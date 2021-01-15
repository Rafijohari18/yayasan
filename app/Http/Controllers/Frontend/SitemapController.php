<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Config;
use App\Models\Content;
use App\Models\Page;
use App\Models\PageLang;
use App\Models\PageMedia;
use Carbon\Carbon;

class SitemapController extends Controller
{
    
    public function index()
    {
        return response()->view('sitemap.index')->header('Content-Type', 'text/xml');
    }
    
    
    
}