<?php

// @formatter:off
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * App\Models\Address
 *
 * @mixin IdeHelperAddress
 * @property int $id
 * @property int $user_id
 * @property int $sub_county_id
 * @property string $address
 * @property int $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\SubCounty $subCounty
 * @property-read \App\Models\User $user
 * @method static \Database\Factories\AddressFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Address newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Address newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Address query()
 * @method static \Illuminate\Database\Eloquent\Builder|Address whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Address whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Address whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Address whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Address whereSubCountyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Address whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Address whereUserId($value)
 */
	class IdeHelperAddress extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Admin
 *
 * @mixin IdeHelperAdmin
 * @property int $id
 * @property int $user_id
 * @property string|null $username
 * @property int $national_id
 * @property string $type
 * @property int|null $pin
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @property-read \App\Models\User $user
 * @method static \Database\Factories\AdminFactory factory(...$parameters)
 * @method static Builder|Admin newModelQuery()
 * @method static Builder|Admin newQuery()
 * @method static Builder|Admin query()
 * @method static Builder|Admin whereCreatedAt($value)
 * @method static Builder|Admin whereId($value)
 * @method static Builder|Admin whereNationalId($value)
 * @method static Builder|Admin wherePin($value)
 * @method static Builder|Admin whereType($value)
 * @method static Builder|Admin whereUpdatedAt($value)
 * @method static Builder|Admin whereUserId($value)
 * @method static Builder|Admin whereUsername($value)
 */
	class IdeHelperAdmin extends \Eloquent implements \Illuminate\Contracts\Auth\MustVerifyEmail {}
}

namespace App\Models{
/**
 * App\Models\Attribute
 *
 * @mixin IdeHelperAttribute
 * @property int $id
 * @property string $name
 * @property mixed $values
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Variation[] $Variations
 * @property-read int|null $variations_count
 * @method static \Illuminate\Database\Eloquent\Builder|Attribute newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Attribute newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Attribute query()
 * @method static \Illuminate\Database\Eloquent\Builder|Attribute whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Attribute whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Attribute whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Attribute whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Attribute whereValues($value)
 */
	class IdeHelperAttribute extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Banner
 *
 * @mixin IdeHelperBanner
 * @property int $id
 * @property string $image
 * @property string $title
 * @property string|null $link
 * @property string|null $alt
 * @property string|null $description
 * @property string $type
 * @property int $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Banner newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Banner newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Banner query()
 * @method static \Illuminate\Database\Eloquent\Builder|Banner whereAlt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Banner whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Banner whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Banner whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Banner whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Banner whereLink($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Banner whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Banner whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Banner whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Banner whereUpdatedAt($value)
 */
	class IdeHelperBanner extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Brand
 *
 * @mixin IdeHelperBrand
 * @property int $id
 * @property string $name
 * @property int $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Product[] $products
 * @property-read int|null $products_count
 * @method static Builder|Brand newModelQuery()
 * @method static Builder|Brand newQuery()
 * @method static Builder|Brand query()
 * @method static Builder|Brand whereCreatedAt($value)
 * @method static Builder|Brand whereId($value)
 * @method static Builder|Brand whereName($value)
 * @method static Builder|Brand whereStatus($value)
 * @method static Builder|Brand whereUpdatedAt($value)
 */
	class IdeHelperBrand extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Cart
 *
 * @mixin IdeHelperCart
 * @property int $id
 * @property int|null $user_id
 * @property string $session_id
 * @property int $product_id
 * @property array|null $details
 * @property int $quantity
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Product $product
 * @property-read \App\Models\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder|Cart newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Cart newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Cart query()
 * @method static \Illuminate\Database\Eloquent\Builder|Cart whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Cart whereDetails($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Cart whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Cart whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Cart whereQuantity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Cart whereSessionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Cart whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Cart whereUserId($value)
 */
	class IdeHelperCart extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Category
 *
 * @mixin IdeHelperCategory
 * @property int $id
 * @property string $title
 * @property int|null $section_id
 * @property int|null $category_id
 * @property int $discount
 * @property string|null $description
 * @property int $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read Collection|Category[] $categories
 * @property-read int|null $categories_count
 * @property-read Category|null $category
 * @property-read Collection|\App\Models\Product[] $products
 * @property-read int|null $products_count
 * @property-read Category|null $section
 * @property-read Collection|Category[] $subCategories
 * @property-read int|null $sub_categories_count
 * @method static \Database\Factories\CategoryFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Category newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Category newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Category query()
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereDiscount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereSectionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereUpdatedAt($value)
 */
	class IdeHelperCategory extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\CmsPage
 *
 * @mixin IdeHelperCmsPage
 * @property int $id
 * @property string $title
 * @property mixed $description
 * @property string $url
 * @property string|null $meta_title
 * @property mixed|null $meta_desc
 * @property string|null $meta_keywords
 * @property int $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|CmsPage newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CmsPage newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CmsPage query()
 * @method static \Illuminate\Database\Eloquent\Builder|CmsPage whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CmsPage whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CmsPage whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CmsPage whereMetaDesc($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CmsPage whereMetaKeywords($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CmsPage whereMetaTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CmsPage whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CmsPage whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CmsPage whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CmsPage whereUrl($value)
 */
	class IdeHelperCmsPage extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\County
 *
 * @mixin IdeHelperCounty
 * @property int $id
 * @property string $name
 * @property int $status
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\SubCounty[] $subCounties
 * @property-read int|null $sub_counties_count
 * @method static \Illuminate\Database\Eloquent\Builder|County newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|County newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|County query()
 * @method static \Illuminate\Database\Eloquent\Builder|County whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|County whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|County whereStatus($value)
 */
	class IdeHelperCounty extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Coupon
 *
 * @mixin IdeHelperCoupon
 * @property int $id
 * @property string $option
 * @property string $code
 * @property string $categories
 * @property string $users
 * @property string $coupon_type
 * @property string $amount_type
 * @property float $amount
 * @property string $expiry
 * @property int $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Coupon newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Coupon newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Coupon query()
 * @method static \Illuminate\Database\Eloquent\Builder|Coupon whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Coupon whereAmountType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Coupon whereCategories($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Coupon whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Coupon whereCouponType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Coupon whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Coupon whereExpiry($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Coupon whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Coupon whereOption($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Coupon whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Coupon whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Coupon whereUsers($value)
 */
	class IdeHelperCoupon extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Order
 *
 * @mixin IdeHelperOrder
 * @property int $id
 * @property int $user_id
 * @property int $address_id
 * @property int|null $coupon_id
 * @property string $order_no
 * @property int $phone
 * @property float $discount
 * @property float $delivery_fee
 * @property string $payment_method
 * @property string $payment_type
 * @property float $total
 * @property string $courier
 * @property string $tracking_number
 * @property string $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Address $address
 * @property-read \App\Models\Coupon|null $coupon
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\OrdersLog[] $orderLogs
 * @property-read int|null $order_logs_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\OrdersProduct[] $sellersOrders
 * @property-read int|null $sellers_orders_count
 * @property-read \App\Models\User $user
 * @method static \Database\Factories\OrderFactory factory(...$parameters)
 * @method static Builder|Order newModelQuery()
 * @method static Builder|Order newQuery()
 * @method static Builder|Order query()
 * @method static Builder|Order whereAddressId($value)
 * @method static Builder|Order whereCouponId($value)
 * @method static Builder|Order whereCourier($value)
 * @method static Builder|Order whereCreatedAt($value)
 * @method static Builder|Order whereDeliveryFee($value)
 * @method static Builder|Order whereDiscount($value)
 * @method static Builder|Order whereId($value)
 * @method static Builder|Order whereOrderNo($value)
 * @method static Builder|Order wherePaymentMethod($value)
 * @method static Builder|Order wherePaymentType($value)
 * @method static Builder|Order wherePhone($value)
 * @method static Builder|Order whereStatus($value)
 * @method static Builder|Order whereTotal($value)
 * @method static Builder|Order whereTrackingNumber($value)
 * @method static Builder|Order whereUpdatedAt($value)
 * @method static Builder|Order whereUserId($value)
 */
	class IdeHelperOrder extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\OrdersLog
 *
 * @mixin IdeHelperOrdersLog
 * @property int $id
 * @property int $order_id
 * @property string $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|OrdersLog newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|OrdersLog newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|OrdersLog query()
 * @method static \Illuminate\Database\Eloquent\Builder|OrdersLog whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrdersLog whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrdersLog whereOrderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrdersLog whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrdersLog whereUpdatedAt($value)
 */
	class IdeHelperOrdersLog extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\OrdersProduct
 *
 * @mixin IdeHelperOrdersProduct
 * @property int $id
 * @property int $order_id
 * @property int $product_id
 * @property array $details
 * @property int $quantity
 * @property float $price
 * @property int $is_ready
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Product $loggedSeller
 * @property-read \App\Models\Order $order
 * @property-read \App\Models\Product $product
 * @method static \Database\Factories\OrdersProductFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|OrdersProduct newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|OrdersProduct newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|OrdersProduct query()
 * @method static \Illuminate\Database\Eloquent\Builder|OrdersProduct whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrdersProduct whereDetails($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrdersProduct whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrdersProduct whereIsReady($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrdersProduct whereOrderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrdersProduct wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrdersProduct whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrdersProduct whereQuantity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrdersProduct whereUpdatedAt($value)
 */
	class IdeHelperOrdersProduct extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Phone
 *
 * @mixin IdeHelperPhone
 * @property int $id
 * @property int $user_id
 * @property int $phone
 * @property int $primary
 * @property int $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User $user
 * @method static \Database\Factories\PhoneFactory factory(...$parameters)
 * @method static Builder|Phone newModelQuery()
 * @method static Builder|Phone newQuery()
 * @method static Builder|Phone query()
 * @method static Builder|Phone whereCreatedAt($value)
 * @method static Builder|Phone whereId($value)
 * @method static Builder|Phone wherePhone($value)
 * @method static Builder|Phone wherePrimary($value)
 * @method static Builder|Phone whereStatus($value)
 * @method static Builder|Phone whereUpdatedAt($value)
 * @method static Builder|Phone whereUserId($value)
 */
	class IdeHelperPhone extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Product
 *
 * @method static create(array $array)
 * @mixin IdeHelperProduct
 * @property int $id
 * @property int $category_id
 * @property int $seller_id
 * @property int $brand_id
 * @property string $title
 * @property string $main_image
 * @property string|null $keywords
 * @property string|null $description
 * @property string|null $label
 * @property float $base_price
 * @property float|null $discount
 * @property int $stock
 * @property string $is_featured
 * @property int $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Brand $brand
 * @property-read float $average_rating
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\ProductsImage[] $images
 * @property-read int|null $images_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Review[] $reviews
 * @property-read int|null $reviews_count
 * @property-read \App\Models\User $seller
 * @property-read \App\Models\Category $subCategory
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Variation[] $variations
 * @property-read int|null $variations_count
 * @method static \Database\Factories\ProductFactory factory(...$parameters)
 * @method static Builder|Product newModelQuery()
 * @method static Builder|Product newQuery()
 * @method static Builder|Product query()
 * @method static Builder|Product whereBasePrice($value)
 * @method static Builder|Product whereBrandId($value)
 * @method static Builder|Product whereCategoryId($value)
 * @method static Builder|Product whereCreatedAt($value)
 * @method static Builder|Product whereDescription($value)
 * @method static Builder|Product whereDiscount($value)
 * @method static Builder|Product whereId($value)
 * @method static Builder|Product whereIsFeatured($value)
 * @method static Builder|Product whereKeywords($value)
 * @method static Builder|Product whereLabel($value)
 * @method static Builder|Product whereMainImage($value)
 * @method static Builder|Product whereSellerId($value)
 * @method static Builder|Product whereStatus($value)
 * @method static Builder|Product whereStock($value)
 * @method static Builder|Product whereTitle($value)
 * @method static Builder|Product whereUpdatedAt($value)
 */
	class IdeHelperProduct extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\ProductsImage
 *
 * @mixin IdeHelperproductsImage
 * @property int $id
 * @property int $product_id
 * @property string $image
 * @property int $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Product $product
 * @method static \Illuminate\Database\Eloquent\Builder|ProductsImage newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductsImage newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductsImage query()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductsImage whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductsImage whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductsImage whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductsImage whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductsImage whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductsImage whereUpdatedAt($value)
 */
	class IdeHelperProductsImage extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Review
 *
 * @mixin IdeHelperReview
 * @property int $id
 * @property int $user_id
 * @property int $product_id
 * @property mixed|null $review
 * @property int|null $rating
 * @property int $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Product $product
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|Review newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Review newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Review query()
 * @method static \Illuminate\Database\Eloquent\Builder|Review whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Review whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Review whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Review whereRating($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Review whereReview($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Review whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Review whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Review whereUserId($value)
 */
	class IdeHelperReview extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\StkCallback
 *
 * @mixin IdeHelperStkCallback
 * @property int $id
 * @property string $merchant_request_id
 * @property string $checkout_request_id
 * @property int $result_code
 * @property string $result_desc
 * @property float|null $amount
 * @property string|null $mpesa_receipt_number
 * @property string|null $balance
 * @property string|null $transaction_date
 * @property string|null $phone_number
 * @property string $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\StkRequest $request
 * @method static Builder|StkCallback newModelQuery()
 * @method static Builder|StkCallback newQuery()
 * @method static Builder|StkCallback query()
 * @method static Builder|StkCallback whereAmount($value)
 * @method static Builder|StkCallback whereBalance($value)
 * @method static Builder|StkCallback whereCheckoutRequestId($value)
 * @method static Builder|StkCallback whereCreatedAt($value)
 * @method static Builder|StkCallback whereId($value)
 * @method static Builder|StkCallback whereMerchantRequestId($value)
 * @method static Builder|StkCallback whereMpesaReceiptNumber($value)
 * @method static Builder|StkCallback wherePhoneNumber($value)
 * @method static Builder|StkCallback whereResultCode($value)
 * @method static Builder|StkCallback whereResultDesc($value)
 * @method static Builder|StkCallback whereStatus($value)
 * @method static Builder|StkCallback whereTransactionDate($value)
 * @method static Builder|StkCallback whereUpdatedAt($value)
 */
	class IdeHelperStkCallback extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\StkRequest
 *
 * @mixin IdeHelperStkRequest
 * @property int $id
 * @property int $user_id
 * @property int $phone
 * @property float $amount
 * @property string $reference
 * @property string $description
 * @property string $merchant_request_id
 * @property string $checkout_request_id
 * @property string $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\StkCallback|null $response
 * @method static \Illuminate\Database\Eloquent\Builder|StkRequest newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|StkRequest newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|StkRequest query()
 * @method static \Illuminate\Database\Eloquent\Builder|StkRequest whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StkRequest whereCheckoutRequestId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StkRequest whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StkRequest whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StkRequest whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StkRequest whereMerchantRequestId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StkRequest wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StkRequest whereReference($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StkRequest whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StkRequest whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StkRequest whereUserId($value)
 */
	class IdeHelperStkRequest extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\SubCounty
 *
 * @mixin IdeHelperSubCounty
 * @property int $id
 * @property int $county_id
 * @property string $name
 * @property int $status
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Address[] $addresses
 * @property-read int|null $addresses_count
 * @property-read \App\Models\County $county
 * @method static \Illuminate\Database\Eloquent\Builder|SubCounty newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SubCounty newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SubCounty query()
 * @method static \Illuminate\Database\Eloquent\Builder|SubCounty whereCountyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SubCounty whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SubCounty whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SubCounty whereStatus($value)
 */
	class IdeHelperSubCounty extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\User
 *
 * @mixin IdeHelperUser
 * @property int $id
 * @property string $first_name
 * @property string $last_name
 * @property string $gender
 * @property string|null $image
 * @property int $status
 * @property string $ip_address
 * @property int $is_admin
 * @property string $email
 * @property string $password
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Address[] $addresses
 * @property-read int|null $addresses_count
 * @property-read \App\Models\Admin|null $admin
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Order[] $orders
 * @property-read int|null $orders_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\Spatie\Permission\Models\Permission[] $permissions
 * @property-read int|null $permissions_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Phone[] $phones
 * @property-read int|null $phones_count
 * @property-read \App\Models\Phone|null $primaryPhone
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Product[] $products
 * @property-read int|null $products_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Review[] $reviews
 * @property-read int|null $reviews_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\Spatie\Permission\Models\Role[] $roles
 * @property-read int|null $roles_count
 * @method static \Database\Factories\UserFactory factory(...$parameters)
 * @method static Builder|User newModelQuery()
 * @method static Builder|User newQuery()
 * @method static Builder|User permission($permissions)
 * @method static Builder|User query()
 * @method static Builder|User role($roles, $guard = null)
 * @method static Builder|User whereCreatedAt($value)
 * @method static Builder|User whereEmail($value)
 * @method static Builder|User whereEmailVerifiedAt($value)
 * @method static Builder|User whereFirstName($value)
 * @method static Builder|User whereGender($value)
 * @method static Builder|User whereId($value)
 * @method static Builder|User whereImage($value)
 * @method static Builder|User whereIpAddress($value)
 * @method static Builder|User whereIsAdmin($value)
 * @method static Builder|User whereLastName($value)
 * @method static Builder|User wherePassword($value)
 * @method static Builder|User whereRememberToken($value)
 * @method static Builder|User whereStatus($value)
 * @method static Builder|User whereUpdatedAt($value)
 */
	class IdeHelperUser extends \Eloquent implements \Illuminate\Contracts\Auth\MustVerifyEmail {}
}

namespace App\Models{
/**
 * App\Models\Variation
 *
 * @mixin IdeHelperVariation
 * @property int $id
 * @property int $product_id
 * @property int $attribute_id
 * @property array $options
 * @property int $status
 * @property string|null $created_at
 * @property string|null $updated_at
 * @property-read \App\Models\Attribute $attribute
 * @property-read \App\Models\Product $product
 * @method static \Illuminate\Database\Eloquent\Builder|Variation newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Variation newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Variation query()
 * @method static \Illuminate\Database\Eloquent\Builder|Variation whereAttributeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Variation whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Variation whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Variation whereOptions($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Variation whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Variation whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Variation whereUpdatedAt($value)
 */
	class IdeHelperVariation extends \Eloquent {}
}

