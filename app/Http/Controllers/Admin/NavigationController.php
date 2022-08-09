<?php

namespace App\Http\Controllers\Admin;

use App\Models\Navigation;
use App\Models\Subcategory;
use Illuminate\Http\Request;
use App\Models\GeneralSetting;
use App\Http\Controllers\Controller;

class NavigationController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Navigation::class, 'navigation');
    }

    public function index()
    {
        $generalSetting = GeneralSetting::find(1);
        $navigations = Navigation::with(['category.child'])->orderBy('menu_order')->latest('updated_at')->get();
        return view('admin_dashboard.navigation.index', compact('navigations', 'generalSetting'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $save = GeneralSetting::updateOrCreate(['id'=>1],[
            'menu_limit' => $request->input('menu_limit'),
        ]);

        if ($save) {
            return redirect()->route('admin.navigation.view')->with('success', 'Navigation menu limit successfully saved');
        } else {
            return redirect()->route('admin.navigation.view')->with('error', 'Navigation menu limit not saved');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Navigation  $navigation
     * @return \Illuminate\Http\Response
     */
    public function status(Request $request, $status, Navigation $navigation)
    {
        $permissions = request()->user()->role->permissions->pluck('name')->toArray();

        if (in_array('navigation', $permissions) || request()->user()->role->name == 'admin') {
            $navigation->menu_status = $status;
            
            if ($navigation->save()) {
                if ($status == 0) {
                    $request->session()->flash('success','Navigation status successfully deactivated');
                } else {
                    $request->session()->flash('success','Navigation status successfully activated');
                }
            } else {
                if ($status == 0) {
                    $request->session()->flash('error','Navigation status not successfully deactivated');
                } else {
                    $request->session()->flash('error','Navigation status not successfully activated');
                }
            }
            return redirect()->route('admin.navigation.view');
        } else {
            abort(403, 'you are unauthorized for this service');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Navigation  $navigation
     * @return \Illuminate\Http\Response
     */
    public function edit($type, Navigation $navigation)
    {
        $generalSetting = GeneralSetting::find(1);
        $navigations = Navigation::with(['category.child'])->orderBy('menu_order')->latest('updated_at')->get();

        return view('admin_dashboard.navigation.index', compact(['navigation', 'navigations', 'generalSetting']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Navigation  $navigation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Navigation $navigation)
    {
        $navigation->menu_order = $request->input('menu_order');
        $navigation->menu_status = $request->input('menu_status');
        $navigation->home_status = $request->input('home_status');
        $navigation->footer_status = $request->input('footer_status');

        if ($navigation->save()) {
            return redirect()->route('admin.navigation.view')->with('success', 'Navigation menu successfully updated');
        } else {
            return redirect()->route('admin.navigation.view')->with('error', 'Navigation menu not updated');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Navigation  $navigation
     * @return \Illuminate\Http\Response
     */
    public function destroy(Navigation $navigation)
    {
        $deleted = $navigation->delete();
        
        if ($deleted) { 
            $navigation->category->child()->delete();
            $navigation->category()->delete();           
            foreach ($navigation->category->posts as $post) {
                $post->delete();
                $post->postSlider()->delete();
                $post->postFile()->delete();
                $post->comments()->delete();
            }
            return redirect()->route('admin.navigation.view')->with('success', 'Category successfully deleted');
            
        } else {
            return redirect()->route('admin.navigation.view')->with('error', 'Category not deleted');
        }
    }

    public function destroySubcategory(Subcategory $subcategory)
    {
        $permissions = request()->user()->role->permissions->pluck('name')->toArray();

        if (in_array('navigation', $permissions) || request()->user()->role->name == 'admin') {
            $deleted = $subcategory->delete();
            if ($deleted) {
                foreach ($subcategory->posts as $post) {
                    $post->delete();
                    $post->postSlider()->delete();
                    $post->postFile()->delete();
                    $post->comments()->delete();
                }
                return redirect()->route('admin.navigation.view')->with('success', 'Subcategory successfully deleted');
            } else {
                return redirect()->route('admin.navigation.view')->with('error', 'Subcategory not deleted');
            }
        } else {
            abort(403, 'you are unauthorized for this service');
        }
    }
}
