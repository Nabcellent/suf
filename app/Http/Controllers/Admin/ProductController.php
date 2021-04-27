<?php

namespace App\Http\Controllers\Admin;

use Exception;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\StoreVariationOptionRequest;
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
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use JsonException;
use Psy\Util\Json;

class ProductController extends Controller
{
    public function showProducts(): Factory|View|Application {
        $products = Product::with('seller');

        if(isSeller()) {
            $products->where('seller_id', Auth::id());
        }

        $products = $products->orderByDesc('id')->get()->toArray();

        return view('Admin.products.list')
            ->with(compact('products'));
    }

    public function showProductForm(): Factory|View|Application {
        $brands = Brand::select('id', 'name')->orderBy('name')->get()->toArray();
        $sellers = Admin::select('user_id', 'username')->orderBy('username')->where('type', 'Seller')->get()->toArray();
        $sections = Category::sections();

        return view('Admin.products.create')
            ->with(compact('brands', 'sellers', 'sections'));
    }

    public function getProduct($id): Factory|View|Application {
        $product = Product::productDetails($id)->first()->toArray();
        $brands = Brand::select('id', 'name')->orderBy('name')->get()->toArray();
        $sellers = Admin::select('user_id', 'username')->orderBy('username')->where('type', 'Seller')->get()->toArray();
        $sections = Category::sections();
        $attributes = Attribute::select('id', 'name')->orderBy('name')->get()->toArray();

        return view('Admin.products.view')
            ->with(compact('product', 'brands', 'sellers', 'sections', 'attributes'));
    }

    public function createProduct(StoreProductRequest $request): View|Factory|Application|RedirectResponse {
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
        //------------------------------------------------
        //  $path = $request->file('main_image')->storePublicly("public/images/products");

        $data = $request->all();

        $file = $request->file('main_image');
        $imageName = date('dmYHis') . "_" . Str::random(7) . "." . $file->guessClientExtension();
        $file->move(public_path('images/products'), $imageName);

        if(isset($data['is_featured']) && $data['is_featured'] === 'on') {
            $isFeatured = "Yes";
        } else {
            $isFeatured = "No";
        }

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
            ]);
        });

        $message = "New Product Created. You must now add a variation before your product becomes available in the store.";
        return redirect(route('admin.product', ['id' => $product->id]))
            ->with('alert', ['type' => 'success', 'intro' => 'Success!', 'message' => $message, 'duration' => 10]);
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
    }

    /**
     * @throws JsonException
     */
    public function createVariation(Request $request, $id): RedirectResponse {
        $data = $request->all();

        $request->validate([
            'attribute' => 'required|integer',
            'variation_options' => 'required|array'
        ]);

        $attribute = Attribute::find($data['attribute'])->name;

        //  Check if variation already exists
        $variations = Variation::where('product_id', $id);
        if($variations->exists()) {
            $variations = $variations->pluck('variation')->toArray();
            foreach($variations as $variation) {
                if(key(json_decode($variation, true, 512, JSON_THROW_ON_ERROR)) === $attribute) {
                    return back()->withErrors(['The attribute you chose already exists.']);
                }
            }
        }

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

    /**
     * @throws JsonException
     */
    public function addVariationOption(StoreVariationOptionRequest $request): RedirectResponse {
        $data = $request->all();

        $variation = Variation::find($data['variation_id']);

        $variationJson = json_decode($variation['variation'], false, 512, JSON_THROW_ON_ERROR);
        $variationValues = array_values(json_decode($variation['variation'], true, 512, JSON_THROW_ON_ERROR))[0];
        $newValues = Arr::prepend($variationValues, Str::ucfirst($data['variant']));
        $newVariation = Json::encode([key($variationJson) => $newValues]);

        $variation->variation = $newVariation;
        $variation->save();

        try {
            DB::transaction(function() use ($data) {
                VariationsOption::create($data);
            });
        } catch(Exception $e) {
            $message = "Something went wrong! Please contact Lil Nabz.";
            return back()->with('alert', ['type' => 'danger', 'intro' => 'Oof!', 'message' => $message, 'duration' => 7]);
        }

        $message = "Product Image Created.";
        return back()->with('alert', ['type' => 'success', 'intro' => 'Success!', 'message' => $message, 'duration' => 7]);
    }

    public function updateVariant(Request $request): JsonResponse|Redirector|Application|RedirectResponse {
        if($request->ajax()) {
            $exists = VariationsOption::where([
                'variation_id' => $request->variationId,
                'variant' => $request->variant
            ])->exists();

            if($exists) {
                return response()->json(['status' => false, 'message' => 'Already exists!']);
            }

            $option = VariationsOption::find($request->optionId);
            $option->variant = Str::ucfirst($request->variant);
            $option->save();

            return response()->json(['status' => true, 'newValue' => $option->variant, 200]);
        }

        return accessDenied();
    }

    public function createImage(Request $request, $id): RedirectResponse {
        if($request->hasFile('images')) {
            $request->validate([
                'images' => 'required|array',
                'images.*' => 'mimes:jpg,png,jpeg|max:5048',
            ]);

            foreach($request->file('images') as $image) {
                $imageName = date('dmYHis') . "_" . Str::random(7) . "." . $image->guessClientExtension();
                $image->move(public_path('images/products'), $imageName);

                DB::transaction(function() use ($imageName, $id) {
                    productsImage::create([
                        'product_id' => $id,
                        'image' => $imageName
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

        if(empty($product)) {
            return redirect()->route('admin.products')
                ->with('alert', alert('info', 'Oops!', 'This product doesn\'t exists', 7));
        }

        $categoryTitle = $product['sub_category']['category']['title'];

        $option = VariationsOption::find($request->variation_option_id);
        $option->stock = $request->stock;
        $option->save();

        $message = "Your $option->variant $categoryTitle stock has been Set to $option->stock.";
        return back()->with('alert', ['type' => 'success', 'intro' => 'Success!', 'message' => $message, 'duration' => 7]);
    }
}
