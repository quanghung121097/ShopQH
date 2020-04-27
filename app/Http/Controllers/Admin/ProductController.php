<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Image;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($slug)
    {
        $id = Category::where('slug', $slug)->pluck('id');
        $cate = Category::where('parent_id', '=', $id)->pluck('id');
        $products = Product::with('images')->whereIn('category_id', $cate)->where('deleted_at', NULL)->orWhere('category_id', '=', $id)->where('deleted_at', NULL)->orderBy('created_at', 'desc')->paginate(10);
        return view('admins.product.product', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categoriesAdd = Category::get();
        return view('admins.product.include.addProduct', compact('categoriesAdd'));
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
                'name'         => 'required|max:50|min:5',
                'category_id'   => 'integer',
                'content'   =>  'required',
                'origin_price' => 'required|numeric',
                'sale_price'   => 'required|numeric',
                'images.*' => 'image|max:2000',
                'images' => 'required',
                'status'    =>  'in:1,-1,0',
            ],
            [
                'required' => ':attribute Không được để trống',
                'images.required' => ':attribute Không được để trống',
                'integer' => 'chọn :attribute',
                'min' => ':attribute Không được nhỏ hơn :min',
                'max' => ':attribute Không được lớn hơn :max',
                'image' => ':attribute Không đúng định dạng',
                'in' => 'chọn :attribute',
            ],
            [
                'name' => 'Tên sản phẩm',
                'origin_price' => 'Giá gốc',
                'sale_price' => 'Giá bán',
                'content' => 'Mô tả sản Phẩm',
                'category_id' => 'Danh mục sản Phẩm',
                'images' => 'Ảnh sản phẩm',
                'status'    => 'trạng thái sản phẩm'
            ]

        );
        if ($validator->passes()) {
            $info_img = [];
            if ($request->hasFile('images')) {
                $images = $request->file('images');
                foreach ($images as $key => $image) {
                    $namefile = $image->getClientOriginalName();
                    $url = 'storage/products/' . $namefile;
                    Storage::disk('public')->putFileAs('products', $image, $namefile);
                    $info_img[] = [
                        'url' => $url,
                        'name' => $namefile
                    ];
                }
            } else {
                echo 'Lỗi upfile';
            }


            $product = new Product();
            $product->name = $request->get('name');
            $product->slug = \Illuminate\Support\Str::slug($request->get('name'));
            $product->category_id = $request->get('category_id');
            $product->origin_price = $request->get('origin_price');
            $product->sale_price = $request->get('sale_price');
            $product->content = $request->get('content');
            $product->status = $request->get('status');
            $product->quantity = $request->get('quantity');
            $product->created_at = \Carbon\Carbon::now('Asia/Ho_Chi_Minh');
            $product->user_id = Auth::user()->id;
            $save = $product->save();
            foreach ($info_img as $image) {
                $img = new Image();
                $img->name = $image['name'];
                $img->path = $image['url'];
                $img->product_id = $product->id;
                $img->save();
            }

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
        $categoriesEdit = Category::get();
        $product = Product::find($id);
        return view('admins.product.include.editProduct', compact('product', 'categoriesEdit'));
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
                'name'         => 'required|max:50|min:5',
                'category_id'   => 'integer',
                'origin_price' => 'required|numeric',
                'sale_price'   => 'required|numeric',
                'sold' => 'integer',
                'quantity' => 'integer',
                'status'    =>  'in:1,-1,0',
            ],
            [
                'required' => ':attribute Không được để trống',
                'integer' => 'chọn :attribute',
                'min' => ':attribute Không được nhỏ hơn :min',
                'max' => ':attribute Không được lớn hơn :max',
                'in' => 'chọn :attribute',
            ],
            [
                'name' => 'Tên sản phẩm',
                'origin_price' => 'Giá gốc',
                'sale_price' => 'Giá bán',
                'content' => 'Mô tả sản Phẩm',
                'category_id' => 'Danh mục sản Phẩm',
                'status'    => 'trạng thái sản phẩm'
            ]

        );
        if ($validator->passes()) {

            $id = $request->get('id');
            $product = Product::find($id);
            $product->name = $request->get('name');
            $product->updated_at = \Carbon\Carbon::now('Asia/Ho_Chi_Minh');
            $product->slug = \Illuminate\Support\Str::slug($request->get('name'));
            $product->category_id = $request->get('category_id');
            $product->origin_price = $request->get('origin_price');
            $product->sale_price = $request->get('sale_price');
            if ($request->get('content') != null) {
                $product->content = $request->get('content');
            }
            $product->status = $request->get('status');
            $product->quantity = ($product->quantity) + $request->get('quantity');
            $product->sold = ($product->sold) + $request->get('sold');
            $save = $product->save();
            return response()->json(['success' => 'Added new records.']);
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
        $product = Product::find($request->get('id'));
        $product->deleted_at = \Carbon\Carbon::now('Asia/Ho_Chi_Minh');
        $save = $product->save();
    }
    public function getListImg(Request $request, $slug)
    {
        $productAddImg = Product::where('slug', $slug)->first();
        $images = Image::where('product_id', $productAddImg->id)->get();
        return view('admins.product.include.listImgProduct', compact('images','productAddImg'));
    }
    public function uploadImg(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                
                'images.*' => 'image|max:2000',
                'images' => 'required',
            ],
            [
                'required' => ':attribute Không được để trống',
                'images.required' => ':attribute Không được để trống',
                'max' => ':attribute Không được lớn hơn :max',
                'image' => ':attribute Không đúng định dạng',
                
            ],
            [
                'images' => 'Ảnh sản phẩm',
            ]

        );
        if ($validator->passes()) {
            $info_img = [];
            if ($request->hasFile('images')) {
                $images = $request->file('images');
                foreach ($images as $key => $image) {
                    $namefile = $image->getClientOriginalName();
                    $url = 'storage/products/' . $namefile;
                    Storage::disk('public')->putFileAs('products', $image, $namefile);
                    $info_img[] = [
                        'url' => $url,
                        'name' => $namefile
                    ];
                }
            } else {
                echo 'Lỗi upfile';
            }
            foreach ($info_img as $image) {
                $img = new Image();
                $img->name = $image['name'];
                $img->path = $image['url'];
                $img->product_id = $request->get('id');
                $img->save();
            }

            return response()->json(['success' => 'Added new records.']);
        }


        return response()->json(['error' => $validator->errors()->all()]);
    }
}
