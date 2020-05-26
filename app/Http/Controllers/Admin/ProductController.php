<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use App\Product;
use File;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Yajra\Datatables\Datatables;

class ProductController extends BaseController
{
    private $viewPath = 'admin.product';
    public function __construct()
    {
        parent::__construct();
        $this->data['routeType'] = 'product';

    }

    public function index()
    {

        if (request()->ajax()) {

            $products = auth()->user()->products()->latest()->select('id', 'name');
            return Datatables::of($products)->addColumn('action', function ($p) {
                return (string) view('admin.product.options', ['product' => $p]);
            })->rawColumns(['action'])->make(true);

        }

        return view($this->viewPath . '.view', $this->data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->data['edit'] = false;
        return view('admin.product.create', $this->data);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:50|string|unique:products',
            'description' => 'nullable|max:500',

        ]);

        $product = Product::create([
            'name' => $request->input('name'),
            'slug' => bsb_str_slug($request->name),
            'user_id' => auth()->user()->id,
            'description' => $request->input('description'),

        ]);

        $images = $request->file('images');
        $image_path_from_public = "products";
        if ($images) {

            foreach ($images as $image) {
                $image_name = upload_image($image, $image_path_from_public);
                $product->images()->create([
                    'image' => $image_name,
                ]);

                // $image = new ProductImage();
                // $image->image = $image_name;
                // $image->product_id = $product->id;
                // $image->save();
            }
        }

        if ($product) {
            if (request()->ajax()) {
                return response()->json(['status' => true, 'product' => $product, 'message' => 'Data added successfully!']);
            } else {
                return redirect()->route($this->data['routeType'] . '.index')->with('success_message', 'Product successfully added.');

            }

        } else {
            if (request()->ajax()) {
                return response()->json(['status' => false, 'message' => 'Something went wrong!']);
            }
            return redirect()->route($this->data['routeType'] . '.index')->with('failure_message', 'Product could not be added. Please try again later.');

        }

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
    public function edit(Product $product)
    {
        $this->data['edit'] = true;
        $this->data['model'] = $product;

        return view($this->viewPath . '.create', $this->data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $this->validate($request, [
            'name' => ['required', 'string', 'max:50',
                Rule::unique('products')->ignore($product->id),
            ],
            'description' => 'nullable|max:500',
        ]);

        $product->update([
            'name' => $request->input('name'),
            'user_id' => auth()->user()->id,
            'description' => $request->input('description'),

        ]);

        if ($product) {

            /*multiple image uploading*/
            $images = $request->file('images');
            $image_path_from_public = "products";

            if ($images) {

                foreach ($images as $image) {
                    $image_name = upload_image($image, $image_path_from_public);
                    $product->images()->create([
                        'image' => $image_name,
                    ]);

                }
            }

            return redirect()->back()->with('success_message', 'Product successfully updated.');

        } else {

            return redirect()->back()->with('failure_message', 'Product could not be updated. Please try again later.');

        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        try {
            $product->delete();
            if ($product->images->count() > 0) {
                foreach ($product->images as $image) {
                    $image_path = public_path('uploads/products/') . $image->image;
                    File::delete($image_path);

                }

            }

            return back()->with('success_message', 'Product successfully deleted.');
        } catch (\Exception $exception) {
            return back()->with('failure_message', 'Product could not be deleted. Please try again later.');
        }
    }
}
