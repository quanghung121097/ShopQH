<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::where('deleted_at', NULL)->orderBy('updated_at', 'desc')->paginate(5);
        return view('admins.category.category', compact('categories'));
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
        $validator = Validator::make(
            $request->all(),
            [
                'name'         => 'required|max:30|min:5',
                'logo' => 'required|image|max:2000',
            ],
            [
                'required' => ':attribute Không được để trống',
                'min' => ':attribute Không được nhỏ hơn :min ký tự',
                'max' => ':attribute Không được lớn hơn :max ký tự',
            ],

        );
        if ($validator->passes()) {
            if ($request->hasFile('logo')) {
                $logo = $request->file('logo');
                $namefile = $logo->getClientOriginalName();
                $url = 'storage/logo/' . $namefile;
                Storage::disk('public')->putFileAs('logo', $logo, $namefile);
            } else {
                echo 'Lỗi';
            }
            $category = new Category();
            $category->logo = $url;
            $category->name = $request->get('name');
            $category->parent_id = $request->get('parent_id');
            $category->slug = \Illuminate\Support\Str::slug($request->get('name'));
            $category->depth = $request->get('depth');
            $category->created_at = \Carbon\Carbon::now('Asia/Ho_Chi_Minh');
            $category->updated_at = \Carbon\Carbon::now('Asia/Ho_Chi_Minh');
            $save = $category->save();

            return response()->json(['success' => 'Added new records.']);
        }


        return response()->json(['error' => $validator->errors()->all()]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $categoryEdit = Category::find($id);
        $categories = Category::get();
        return view('admins.category.include.editCategory', compact('categoryEdit', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'name'         => 'required|max:30|min:5',

            ],
            [
                'required' => ':attribute Không được để trống',
                'min' => ':attribute Không được nhỏ hơn :min ký tự',
                'max' => ':attribute Không được lớn hơn :max ký tự',
            ],

        );
        if ($validator->passes()) {
            $category = Category::find($request->get('id'));
            if ($request->hasFile('logo')) {
                $logo = $request->file('logo');
                $namefile = $logo->getClientOriginalName();
                $url = 'storage/logo/' . $namefile;
                Storage::disk('public')->putFileAs('logo', $logo, $namefile);
                $category->logo = $url;
            }
            $category->name = $request->get('name');
            $category->depth = $request->get('depth');
            $category->parent_id = $request->get('parent_id');
            $category->slug=\Illuminate\Support\Str::slug($request->get('name'));
            $category->updated_at = \Carbon\Carbon::now('Asia/Ho_Chi_Minh');
            $save = $category->save();

            return response()->json(['success' => 'Edit success.']);
        }


        return response()->json(['error' => $validator->errors()->all()]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function deleteAT(Request $request)
    {
        $category = category::find($request->get('id'));
        $category->deleted_at = \Carbon\Carbon::now('Asia/Ho_Chi_Minh');
        $save = $category->save();
    }
}
