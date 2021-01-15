<?php

namespace App\Http\Controllers\Frontend;

use App\Services\Interfaces\CategoryServiceInterface;
use App\Services\Interfaces\ConfigServiceInterface;
use App\Services\Interfaces\PageServiceInterface;
use App\Services\Interfaces\PostServiceInterface;
use App\Services\Interfaces\SectionServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ContentController extends Controller
{
    private $config, $page, $section, $category, $post;

    public function __construct(ConfigServiceInterface $config, PageServiceInterface $page, SectionServiceInterface $section, CategoryServiceInterface $category, PostServiceInterface $post)
    {
        $this->config = $config;
        $this->page = $page;
        $this->section = $section;
        $this->category = $category;
        $this->post = $post;
    }

  

    public function page(Request $request, $locale = null, $id)
    {
        $this->config->addVisitor($request);
        $this->page->viewer($id);

        $data['view'] = $this->page->read($id);
        $data['childs'] = $this->page->child($id, 10);
        $data['media'] = $this->page->media($id, 10);

        if ($data['view']['publish'] == 0 || $data['view'] == null) {
            return redirect()->route('frontend');
        }

        $data['meta_title'] = $data['view']->getFieldLang()['title'];
        if ($data['view']['meta_title'] != null) {
            $data['meta_title'] = $data['view']['meta_title'];
        }

        $data['meta_description'] = $this->config->getValue('m_description');
        if ($data['view']['meta_description'] != null) {
            $data['meta_description'] = $data['view']['meta_description'];
        } elseif ($data['view']['meta_description'] == null && $data['view']->getFieldLang()['intro'] != null) {
            $data['meta_description'] = $data['view']->getFieldLang()['intro'];
        } elseif ($data['view']['meta_description'] == null && $data['view']->getFieldLang()['intro'] == null && $data['view']->getFieldLang()['content'] != null) {
            $data['meta_description'] = $data['view']->getFieldLang()['content'];
        }

        $data['meta_keywords'] = $this->config->getValue('m_keywords');
        if ($data['view']['meta_keywords'] != null) {
            $data['meta_keywords'] = $data['view']['meta_keywords'];
        }

        $data['creator'] = $data['view']->userCreated['name'];
        $data['banner'] = asset('userfile/banner/'.$this->config->getValue('b_default'));
        if ($data['view']['banner']['banner_img'] != null) {
            $data['banner'] = asset($data['view']['banner']['banner_img']);
        }
        if ($data['view']['cover']['cover_img'] != null) {
            $data['cover'] = asset($data['view']['cover']['cover_img']);
        }
        
        if ($id == null) {
            return abort(404);
        }

        if (config('app.multiple_lang') == true) {
            $segment = $request->segment(5);
        } else {
            $segment = $request->segment(4);
        }
        
        if ($segment != $data['view']['slug']) {
            return redirect()->route('content.page', ['id' => $id, 'slug' => $data['view']['slug']]);
        }

        if ($data['view']['public'] == 0 && Auth::check() == false) {
            return redirect()->route('frontend.login')->with('warning', 'You must login first');
        }

        $blade = 'index';
        if ($data['view']['custom_view'] != null) {
            $blade = 'custom.'.$data['view']['custom_view'];
        }
        
        return view('frontend.page.'.$blade, compact('data'));
    }

    public function section(Request $request, $locale = null, $id)
    {
        $this->config->addVisitor($request);
        $this->section->viewer($id);

        $data['view'] = $this->section->find($id);

        if ($data['view']['public'] == 0 && Auth::check() == false) {
            return redirect()->route('frontend.login')->with('warning', 'You must login first');
        }

        if ($id == null) {
            return abort(404);
        }

        if (config('app.multiple_lang') == true) {
            $segment = $request->segment(5);
        } else {
            $segment = $request->segment(4);
        }
        
        if ($segment != $data['view']['slug']) {
            return redirect()->route('content.section', ['id' => $id, 'slug' => $data['view']['slug']]);
        }

        $data['creator'] = $data['view']->userCreated['name'];
        $data['banner'] = asset('userfile/banner/'.$this->config->getValue('b_default'));
        if ($data['view']['banner']['banner_img'] != null) {
            $data['banner'] = asset($data['view']['banner']['banner_img']);
        }

        $limit = $this->config->getValue('l_limit');
        $data['category'] = $this->category->bySection($id, $limit);
        $data['post'] = $this->post->bySection($id, $limit);

        $blade = 'index';
        if ($data['view']['list_view'] != null) {
            $blade = 'list.'.$data['view']['list_view'];
        }

        return view('frontend.section.'.$blade, compact('data'));
    }

    public function category(Request $request, $locale = null, $id)
    {
        $this->config->addVisitor($request);
        $this->category->viewer($id);

        $data['view'] = $this->category->find($id);

        if ($data['view']['public'] == 0 && Auth::check() == false) {
            return redirect()->route('frontend.login')->with('warning', 'You must login first');
        }

        if ($id == null) {
            return abort(404);
        }

        if (config('app.multiple_lang') == true) {
            $segment = $request->segment(5);
        } else {
            $segment = $request->segment(4);
        }
        
        if ($segment != $data['view']['slug']) {
            return redirect()->route('content.category', ['id' => $id, 'slug' => $data['view']['slug']]);
        }

        $data['creator'] = $data['view']->userCreated['name'];
        $data['banner'] = asset('userfile/banner/'.$this->config->getValue('b_default'));
        if ($data['view']['banner']['banner_img'] != null) {
            $data['banner'] = asset($data['view']['banner']['banner_img']);
        }

        $limit = $this->config->getValue('l_limit');
        if ($data['view']['list_limit'] != null) {
            $limit = $data['view']['list_limit'];
        }
        $data['post'] = $this->post->byCategory($id, $limit);

        $blade = 'index';
        if ($data['view']['list_view'] != null) {
            $blade = 'list.'.$data['view']['list_view'];
        }

        return view('frontend.category.'.$blade, compact('data'));
    }

    public function post(Request $request, $locale = null, $id)
    {
        $this->config->addVisitor($request);
        $this->post->viewer($id);

        
        $data['view'] = $this->post->read($id);
        $data['media'] = $this->post->media($id, 10);
        $data['latest_post'] = $this->post->latestPost($id, 3);
        $data['prev_post'] = $this->post->prevPost($id);
        $data['next_post'] = $this->post->nextPost($id);

        if ($this->config->getValue('notif_wa') != null) {
            $message = 'Notification from - '.$data['view']->getFieldLang('title').' link : '.$data['view']->url($id, $data['view']['slug']).' Viewer : '.$data['view']['viewer'];
            $to = $this->config->getValue('notif_wa');
            $send = new Visitor();
            $send->whatsapp($to, $message);
        }

        if ($data['view']['publish'] == 0 || $data['view'] == null) {
            return redirect()->route('frontend');
        }

        $data['meta_title'] = $data['view']->getFieldLang('title');
        if ($data['view']['meta_title'] != null) {
            $data['meta_title'] = $data['view']['meta_title'];
        }

        $data['meta_description'] = $this->config->getValue('m_description');
        if ($data['view']['meta_description'] != null) {
            $data['meta_description'] = $data['view']['meta_description'];
        } elseif ($data['view']['meta_description'] == null && $data['view']->getFieldLang('intro') != null) {
            $data['meta_description'] = $data['view']->getFieldLang('intro');
        } elseif ($data['view']['meta_description'] == null && $data['view']->getFieldLang('intro') == null && $data['view']->getFieldLang('content') != null) {
            $data['meta_description'] = $data['view']->getFieldLang('content');
        }

        $data['meta_keywords'] = $this->config->getValue('m_keywords');
        if ($data['view']['meta_keywords'] != null) {
            $data['meta_keywords'] = $data['view']['meta_keywords'];
        }

        $data['creator'] = $data['view']->userCreated['name'];
        $data['banner'] = asset('userfile/banner/'.$this->config->getValue('b_default'));
        if ($data['view']['banner']['banner_img'] != null) {
            $data['banner'] = asset($data['view']['banner']['banner_img']);
        }
        if ($data['view']['cover']['cover_img'] != null) {
            $data['cover'] = asset($data['view']['cover']['cover_img']);
        }

        if ($id == null) {
            return abort(404);
        }

        if (config('app.multiple_lang') == true) {
            $segment = $request->segment(5);
        } else {
            $segment = $request->segment(4);
        }
        
        if ($segment != $data['view']['slug']) {
            return redirect()->route('content.post', ['id' => $id, 'slug' => $data['view']['slug']]);
        }

        if ($data['view']['public'] == 0 && Auth::check() == false) {
            return redirect()->route('frontend.login')->with('warning', 'You must login first');
        }

        $blade = 'post.index';
        if ($data['view']['custom_view'] != null) {
            $blade = 'post.custom.'.$data['view']['custom_view'];
        } elseif ($data['view']->section['detail_view'] != null) {
            $blade = 'section.detail.'.$data['view']->section['detail_view'];
        } elseif ($data['view']->category['detail_view'] != null) {
            $blade = 'category.detail.'.$data['view']->category['detail_view'];
        }

        return view('frontend.'.$blade, compact('data'));
    }
}
