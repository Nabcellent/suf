<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductRequest;
use App\Models\Admin;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

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

        return view('Admin.products.view')
            ->with(compact('product', 'brands', 'sellers', 'sections'));
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

        $mainImage = $data['main_image'];
        $newImageName = time() . '-' . $mainImage->getClientOriginalName();
        $mainImage->move(public_path('images/products'), $newImageName);

        if(isset($data['is_featured']) && $data['is_featured'] === 'on') {
            $isFeatured = "Yes";
        } else {
            $isFeatured = "No";
        }

        $product = DB::transaction(function() use ($isFeatured, $newImageName, $data) {
            return Product::create([
                'category_id' => $data['sub_category'],
                'seller_id' => $data['seller'],
                'brand_id' => $data['brand'],
                'title' => $data['title'],
                'main_image' => $newImageName,
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

    public function deleteProduct(Request $request): RedirectResponse {
        $image = Product::find($request->product_id);
        Product::destroy($request->product_id);

        if(File::exists('images/products/'  . $image['main_image'])) {
            File::delete('images/products/' . $image['main_image']);
        }

        $message = "Product Deleted.";
        return redirect(route('admin.products'))
            ->with('alert', ['type' => 'success', 'intro' => '‼', 'message' => $message, 'duration' => 7]);
    }





    /**
     * ----------------------------------------------------------------------------------------------   AJAX FETCH CALLS
     * */

    public function getSubCategoriesByCategoryId(Request $request): JsonResponse {
        $id = $request -> id;

        $subCats = Category::where('category_id', $id)->get()->toArray();

        $result = '<option selected hidden value="">Select a sub-category *</option>';

        foreach($subCats as $subCat) {
            $result .= '<option value="' . $subCat['id'] . '">' . $subCat['title'] . '</option>';
        }

        return response()->json(['subCategories' => $result, 200]);
    }
}
