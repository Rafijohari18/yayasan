<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PageRequest;
use App\Services\Interfaces\ConfigServiceInterface;
use App\Services\Interfaces\PageServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\PageMedia;
use File;


class PagesController extends Controller{

    private $pageService, $configService;

    public function __construct(PageServiceInterface $pageService, ConfigServiceInterface $configService)
    {
        $this->pageService = $pageService;
        $this->configService = $configService;
    }

    public function index(Request $request)
    {
        $data['title'] = 'Pages';
        $data['pages'] = $this->pageService->get($request);
        $data['total'] = $this->pageService->count($request);
        
        return view('backend.pages.index', compact('data'));
    }

    public function create(Request $request)
    {
        $data['title'] = 'Create';
        
        if ($request->get('parent') > 0) {
            $data['parent'] = $this->pageService->find($request->get('parent'));
        }
        

        return view('backend.pages.form', compact('data'));
    }

    public function store(PageRequest $request)
    {
        try {
            
            $this->pageService->create($request);

            return redirect()->route('pages.index')->with('success', 'Create page successfully');
        } catch (\Throwable $th) {
            //throw $th;
            return back()->with('failed', 'Create page failed. Please try again');
        }
    }

    public function edit($id)
    {
        $data['title'] = 'Edit';
        $data['page'] = $this->pageService->find($id);
        $data['language'] = $this->configService->getLangNot();
        
        return view('backend.pages.form', compact('data'));
    }

    public function update(Request $request, $id)
    {
        
         $this->pageService->update($request, $id);
        
        return redirect()->route('pages.index')->with('success', 'Edit page successfully');
    }

    public function status($id)
    {
        try {
            
            $this->pageService->status($id);

            return back()->with('success', 'Update status successfully');
        } catch (\Throwable $th) {
            //throw $th;
            return back()->with('failed', 'Update status failed. Please try again');
        }
    }

    public function position($id, $position, $parent)
    {
        try {
            
            $this->pageService->position($id, $position, $parent);

            return back()->with('success', 'Change position successfully');
        } catch (\Throwable $th) {
            //throw $th;
            return back()->with('failed', 'Change position failed. Please try again');
        }
    }

    public function destroy($id)
    {
        try {
            
            $this->pageService->delete($id);

            return back()->with('success', 'Delete page successfully');
        } catch (\Throwable $th) {
            //throw $th;
            return back()->with('failed', 'Delete page failed. Please try again');
        }
    }

    /**media */
    public function media($pageId)
    {
        $data['title'] = 'Media';
        $data['page'] = $this->pageService->find($pageId);
        $data['media'] = $this->pageService->getMedia($pageId);

        return view('backend.pages.media', compact('data'));
    }

    public function storeMedia(Request $request, $pageId)
    {
        $this->pageService->createMedia($request, $pageId);
        return back()->with('success', 'Add file successfully');
    }

    public function updateMedia(Request $request, $id)
    {
        try {
            
            $this->pageService->updateMedia($request, $id);
            
            return back()->with('success', 'Edit file successfully');
        } catch (\Throwable $th) {
            //throw $th;
            return back()->with('failed', 'Edit file failed. Please try again');
        }
    }

    public function positionMedia($id, $position, $pageId)
    {
        try {
            
            $this->pageService->positionMedia($id, $position, $pageId);
            
            return back()->with('success', 'Change position successfully');
        } catch (\Throwable $th) {
            //throw $th;
            return back()->with('failed', 'Change position failed. Please try again');
        }
    }

    public function sortMedia()
    {
        $i = 0;

        foreach ($_POST['datas'] as $value) {
            $i++;
            $this->pageService->sortMedia($value, $i);
        }

    }

    public function destroyMedia($id)
    {
       
            $data['pages'] = PageMedia::where('id',$id)->first();
            
            PageMedia::where('id',$id)->delete();
            File::delete($data['pages']->file);

            return back()->with('success', 'Delete file successfully');
       
    }

}
