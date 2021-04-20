<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductRequest;
use App\Models\Admin;
use App\Models\Attribute;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\productsImage;
use App\Models\Variation;
use App\Models\VariationsOption;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Psy\Util\Json;

class ProductController extends Controller
{
    public function showProducts(): Factory|View|Application {
        $products = Product::with('seller')->orderByDesc('id')->get()->toArray();

        return view('Admin.products.list')
            ->with(compact('products'));
    }

    public function getProduct($id): Factory|View|Application {
        $product = Product::productDetails($id)->first()->toArray();
        $brands = Brand::select('id', 'name')->orderBy('name')->get()->toArray();
        $sellers = Admin::select('id', 'username')->orderBy('username')->where('type', 'Seller')->get()->toArray();
        $sections = Category::sections();
        $attributes = Attribute::select('id', 'name')->orderBy('name')->get()->toArray();

        return view('Admin.products.view')
            ->with(compact('product', 'brands', 'sellers', 'sections', 'attributes'));
    }

    public function updateProduct(StoreProductRequest $request, $id): RedirectResponse {
        $data = $request->all();
        if(isset($data['is_featured']) && $data['is_featured'] === 'on') {
            $isFeatured = "Yes";
        } else {
            $isFeatured = "No";
        }

        DB::transaction(function() use ($id, $isFeatured, $data) {
            $product = Product::find($id);
            $product->update([
                'category_id' => $data['sub_category'],
                'seller_id' => $data['seller'],
                'brand_id' => $data['brand'],
                'title' => $data['title'],
                'keywords' => $data['keywords'],
                'description' => $data['description'],
                'label' => $data['label'],
                'base_price' => $data['base_price'],
                'discount' => $data['discount'],
                'is_featured' => $isFeatured,
            ]);
        });

        $message = "Product Updated.";
        return back()->with('alert', ['type' => 'success', 'intro' => 'Success!', 'message' => $message, 'duration' => 7]);
    }

    public function showProductForm(): Factory|View|Application {
        $brands = Brand::select('id', 'name')->orderBy('name')->get()->toArray();
        $sellers = Admin::select('id', 'username')->orderBy('username')->where('type', 'Seller')->get()->toArray();
        $sections = Category::sections();

        return view('Admin.products.create')
            ->with(compact('brands', 'sellers', 'sections'));
    }

    public function getCreateProduct(StoreProductRequest $request): View|Factory|Application|RedirectResponse {
        //  METHODS THAT CAN BE USED ON FILE REQUESTS
        //  guessExtension()            ---Gets the file extension
        //  guessClientExtension()      ---Similar to guessExtension
        //  getSize()                   ---Get File Size
        //  getMimeType()
        //  getClientMimeType()         ---Similar to getMimeType
        //  store()
        //  asStore()
        //  storePublicly()
        //  move()
        //  getClientOriginalName()     ---Gets the name of the file
        //  getError()                  ---Check if Error
        //  isValid()                   ---Check if Valid

        $data = $request->all();

        $path = $request->file('main_image')->store("public/images/products");

        if(isset($data['is_featured']) && $data['is_featured'] === 'on') {
            $isFeatured = "Yes";
        } else {
            $isFeatured = "No";
        }

        $product = DB::transaction(function() use ($isFeatured, $path, $data) {
            return Product::create([
                'category_id' => $data['sub_category'],
                'seller_id' => $data['seller'],
                'brand_id' => $data['brand'],
                'title' => $data['title'],
                'main_image' => class_basename($path),
                'keywords' => $data['keywords'],
                'description' => $data['description'],
                'label' => $data['label'],
                'base_price' => $data['base_price'],
                'discount' => $data['discount'],
                'is_featured' => $isFeatured,
            ]);
        });

        $message = "New Product Created. You must now add a variation before your product becomes available in the store.";
        return redirect(route('admin.product', ['id' => $product->id]))
            ->with('alert', ['type' => 'success', 'intro' => 'Success!', 'message' => $message, 'duration' => 10]);
    }

    public function createVariation(Request $request, $id): RedirectResponse {
        $data = $request->all();

        $request->validate([
            'attribute' => 'required|integer'
        ]);

        $attribute = Attribute::find($data['attribute'])->value('name');
        $variation = Json::encode([$attribute => $data['variation_options']]);

        DB::transaction(function() use ($variation, $id, $data) {
            $variation = Variation::create([
                'product_id' => $id,
                'variation' => $variation
            ]);

            foreach($data['variation_options'] as $option) {
                VariationsOption::create([
                    'variation_id' => $variation->id,
                    'variant' => $option
                ]);
            }
        });

        $message = "Variation Created.";
        return back()->with('alert', ['type' => 'success', 'intro' => 'Success!', 'message' => $message, 'duration' => 7]);
    }

    public function createImage(Request $request, $id): RedirectResponse {
        if($request->hasFile('images')) {
            $request->validate([
                'images' => 'required|array',
                'images.*' => 'mimes:jpg,png,jpeg|max:5048',
            ]);

            foreach($request->file('images') as $image) {
                $path = $image->store("public/images/products");

                DB::transaction(function() use ($path, $id) {
                    productsImage::create([
                        'product_id' => $id,
                        'image' => class_basename($path)
                    ]);
                });
            }

            $message = "Product Image Created.";
            return back()->with('alert', ['type' => 'success', 'intro' => 'Success!', 'message' => $message, 'duration' => 7]);
        }

        $message = "You didn't upload any image.";
        return back()->with('alert', ['type' => 'danger', 'intro' => 'Oops!', 'message' => $message, 'duration' => 7]);
    }

    public function setPrice(Request $request, $id): RedirectResponse {
        $request->validate(['price' => 'required|numeric']);
        $product = Product::where('id', $id)->with('subCategory')->first()->toArray();
        $categoryTitle = $product['sub_category']['category']['title'];

        $option = VariationsOption::find($request->variation_option_id);
        $option->extra_price = $request->price;
        $option->save();

        $message = "You have added an extra KSH $request->price to your $option->variant " . Str::singular($categoryTitle);
        return back()->with('alert', ['type' => 'success', 'intro' => 'Success!', 'message' => $message, 'duration' => 7]);
    }

    public function setStock(Request $request, $id): RedirectResponse {
        $request->validate(['stock' => 'required|integer']);
        $product = Product::where('id', $id)->with('subCategory')->first()->toArray();
        $categoryTitle = $product['sub_category']['category']['title'];

        $option = VariationsOption::find($request->variation_option_id);
        $option->stock = $request->stock;
        $option->save();

        $message = "Your $option->variant $categoryTitle stock has been Set.";
        return back()->with('alert', ['type' => 'success', 'intro' => 'Success!', 'message' => $message, 'duration' => 7]);
    }
}
