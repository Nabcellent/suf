<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\StoreVariationRequest;
use Exception;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductRequest;
use App\Models\Admin;
use App\Models\Attribute;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\productsImage;
use App\Models\Variation;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Throwable;

class ProductController extends Controller {
    public function index(): Factory|View|Application {
        $products = Product::with('seller');

        if(isSeller()) $products->where('seller_id', Auth::id());

        $products = $products->orderByDesc('id')->get();

        return view('admin.products.list')
            ->with(compact('products'));
    }

    public function create(): Factory|View|Application {
        $brands = Brand::select(['id', 'name'])->orderBy('name')->get();
        $sellers = Admin::select(['user_id', 'username'])->orderBy('username')->where('type', 'Seller')->get();
        $sections = Category::sections();

        return view('admin.products.create')
            ->with(compact('brands', 'sellers', 'sections'));
    }

    public function show($id): Factory|View|Application {
        $data = [
            'product' => Product::productDetails($id)->first(),
            'brands' => Brand::select(['id', 'name'])->orderBy('name')->get(),
            'sellers' => Admin::select(['user_id', 'username'])->orderBy('username')->where('type', 'Seller')->get(),
            'sections' => Category::sections(),
            'attributes' => Attribute::select(['id', 'name'])->orderBy('name')->get()
        ];

        return view('admin.products.view', $data);
    }

    public function store(StoreProductRequest $request): View|Factory|Application|RedirectResponse {
        $data = $request->all();

        $file = $request->file('main_image');
        $imageName = date('dmYHis') . "_" . Str::random(7) . "." . $file->guessClientExtension();
        $file->move(public_path('images/products'), $imageName);

        $isFeatured = isset($data['is_featured']) && $data['is_featured'] === 'on';

        try {
            $product = DB::transaction(function() use ($isFeatured, $imageName, $data) {
                return Product::create([
                    'category_id' => $data['sub_category'],
                    'seller_id' => $data['seller'],
                    'brand_id' => $data['brand'],
                    'title' => $data['title'],
                    'main_image' => $imageName,
                    'keywords' => $data['keywords'],
                    'description' => $data['description'],
                    'label' => $data['label'],
                    'base_price' => $data['base_price'],
                    'discount' => $data['discount'],
                    'is_featured' => $isFeatured,
                    ]
                );
            });

            $message = "New Product Created. You must now add a variation before your product becomes available in the store.";
            return redirect(route('admin.product', ['id' => $product->id]))->with('alert', ['type' => 'success', 'intro' => 'Success!', 'message' => $message, 'duration' => 10]);
        } catch(Throwable $e) {
            Log::error($e->getMessage());
            return back()->withErrors(['Error creating product.']);
        }
    }

    public function updateProduct(StoreProductRequest $request, $id): RedirectResponse {
        $data = $request->all();
        if(isset($data['is_featured']) && $data['is_featured'] === 'on') {
            $isFeatured = "Yes";
        } else {
            $isFeatured = "No";
        }

        $product = Product::find($id);

        if($request->hasFile('image')) {
            $file = $request->file('image');
            $imageName = date('dmYHis') . "_" . Str::random(7) . "." . $file->guessClientExtension();
            $file->move(public_path('images/products'), $imageName);

            if(File::exists(public_path('images/products/' . $product->main_image))){
                File::delete(public_path('images/products/' . $product->main_image));
            }

            $product->main_image = $imageName;
            $product->save();
        }

        try {
            DB::transaction(function() use ($product, $isFeatured, $data) {
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
        } catch(Throwable $e) {
            Log::error($e->getMessage());
            return back()->withErrors(['Error updating product.']);
        }
    }

    public function createVariation(StoreVariationRequest $request, $id): RedirectResponse {
        $data = $request->all();
        $options = [];

        try {
            foreach($data['options'] as $option) {
                $options[$option] = [
                    'stock' => 0,
                    'extra_price' => 0,
                    'image' => '',
                    'status' => 1
                ];
            }

            $data['options'] = $options;
            $data['attribute_id'] = $data['attribute'];
            $data['product_id'] = $id;

            DB::transaction(function() use ($data) {
                Variation::create($data);
            });

            $message = "Variation Created.";
            return back()->with('alert', ['type' => 'success', 'intro' => 'Success!', 'message' => $message, 'duration' => 7]);
        } catch(Throwable $e) {
            Log::error($e->getMessage());
            return back()->withErrors(['Error creating variation.']);
        }
    }

    /**
     * @throws Exception
     */
    public function addVariationOption(Request $request): RedirectResponse {
        $request->validate([
            'variant' => 'required',
            'stock' => 'required|min:1',
        ], []);

        $data = $request->all();

        try {
            DB::transaction(function() use ($data) {
                $variation = Variation::findOrFail($data['variation_id']);

                $options = $variation->options;
                $options[$data['variant']] = [
                    'stock' => 0,
                    'extra_price' => $data['extra_price'] ?? 0,
                    'image' => '',
                    'status' => 1
                ];

                $variation->options = $options;
                $variation->save();
            });
        } catch(Exception | Throwable $e) {
            Log::error($e->getMessage());

            $message = "Something went wrong! Please contact Lil Nabz.";
            return back()->with('alert', ['type' => 'danger', 'intro' => 'Oof!', 'message' => $message, 'duration' => 7]);
        }

        $message = "Product Image Created.";
        return back()->with('alert', ['type' => 'success', 'intro' => 'Success!', 'message' => $message, 'duration' => 7]);
    }

    public function updateVariant(Request $request): JsonResponse|Redirector|Application|RedirectResponse {
        $data = $request->all();

        try {
            $variation = Variation::findOrFail($data['variationId']);

            $options = $variation->options;
            if(Arr::exists($options, $data['variant']))
                return response()->json(['status' => false, 'message' => 'Already exists!']);

            $options[$data['variant']] = $options[$data['option']];
            Arr::forget($options, $data['option']);
            $variation->options = $options;
            $variation->save();

            return response()->json(['status' => true, 'newValue' => $data['variant'], 200]);
        } catch(Exception $e) {
            Log::error($e->getMessage());
            return response()->json(['status' => false, 'message' => 'Error updating!']);
        }
    }

    /**
     * @throws Throwable
     */
    public function createImage(Request $request, $id): RedirectResponse {
        if($request->hasFile('images')) {
            $request->validate([
                'images' => 'required|array',
                'images.*' => 'mimes:jpg,png,jpeg|max:5048',
            ]);

            $images = [];
            foreach($request->file('images') as $image) {
                $imageName = date('dmYHis') . "_" . Str::random(7) . "." . $image->guessClientExtension();
                $image->move(public_path('images/products'), $imageName);

                array_push($images, [
                    'product_id' => $id,
                    'image' => $imageName
                ]);
            }

            DB::transaction(function() use ($images) {
                ProductsImage::insert($images);
            });

            $message = "Product Image Created.";
            return back()->with('alert', ['type' => 'success', 'intro' => 'Success!', 'message' => $message, 'duration' => 7]);
        }

        $message = "You didn't upload any image.";
        return back()->with('alert', ['type' => 'danger', 'intro' => 'Oops!', 'message' => $message, 'duration' => 7]);
    }

    public function setStock(Request $request, $id): RedirectResponse {
        $request->validate(['stock' => 'required|integer']);
        $data = $request->all();

        try {
            $product = Product::where('id', $id)->with('subCategory')->firstOrFail();
            $categoryTitle = $product->subCategory->category->title;

            $variation = Variation::findOrFail($data['variation_id']);

            $varOptions = $variation->options;
            $varOptions[$data['option']]['stock'] = $data['stock'];
            $variation->options = $varOptions;
            $variation->save();

            $message = "Your {$data["option"]} $categoryTitle stock has been Set to {$data["stock"]}";

            return back()->with('alert', ['type' => 'success', 'intro' => 'Success!', 'message' => $message, 'duration' => 7]);
        } catch(Exception $e) {
            Log::error($e->getMessage());
            return back()->withErrors(['Error setting stock!']);
        }
    }
    public function setPrice(Request $request, $id): RedirectResponse {
        $request->validate(['price' => 'required|numeric']);
        $data = $request->all();

        try {
            $product = Product::where('id', $id)->with('subCategory')->firstOrFail();
            $categoryTitle = $product->subCategory->category->title;

            $variation = Variation::findOrFail($data['variation_id']);

            $varOptions = $variation->options;
            $varOptions[$data['option']]['extra_price'] = $data['price'];
            $variation->options = $varOptions;
            $variation->save();

            $message = "You have added an extra KSH {$data["price"]} to your {$data["price"]} " . Str::singular($categoryTitle);

            return back()->with('alert', ['type' => 'success', 'intro' => 'Success!', 'message' => $message, 'duration' => 7]);
        } catch(Exception $e) {
            Log::error($e->getMessage());
            return back()->withErrors(['Error setting prices!']);
        }
    }
}
