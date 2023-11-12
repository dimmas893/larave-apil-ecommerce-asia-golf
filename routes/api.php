<?php


// use App\Models\Product;

use App\Http\Controllers\Api\TransaksiController;
use App\Http\Controllers\Api\v2\AuthorisedDealerController;
use App\Http\Controllers\Api\v2\BrandController;
use App\Http\Controllers\Api\v2\CartController;
use App\Http\Controllers\Api\v2\CategorieController;
use App\Http\Controllers\Api\v2\DiscountController;
use App\Http\Controllers\Api\v2\DiscussionAnswerController;
use App\Http\Controllers\Api\v2\DiscussionController;
use App\Http\Controllers\Api\v2\ExclusiveDistributorController;
use App\Http\Controllers\Api\v2\ItemBundlingController;
use App\Http\Controllers\Api\v2\ItemController;
use App\Http\Controllers\Api\v2\ItemPhotoController;
use App\Http\Controllers\Api\v2\ItemVariantController;
use App\Http\Controllers\Api\v2\ProductController;
use App\Http\Controllers\Api\v2\ProductItemController;
use App\Http\Controllers\Api\v2\UserController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/** use your controller */

use App\Http\Controllers\Api\v2\WishlistController;
use App\Http\Controllers\Api\v2\AddressController;
use App\Http\Controllers\Api\v2\CheckoutController;
use App\Http\Controllers\Api\v2\CheckPostageController;
use App\Http\Controllers\Api\v2\CouponController;
use App\Http\Controllers\Api\v2\CourierController;
use App\Http\Controllers\Api\v2\ProfileController;
use App\Http\Controllers\Api\v2\RegionController;
use App\Http\Controllers\Api\v2\TransactionHistoryController;

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/register', [RegisterController::class, 'index']);
// Route::post('/login', [\App\Http\Controllers\Api\Auth\LoginController::class, 'index']);
Route::post('/login', [LoginController::class, 'index']);



Route::prefix('home')->group(function () {
    Route::prefix('item')->group(function () {
        Route::get('/', [ItemController::class, 'ProdukItemindex']);
        Route::get('/limit', [ItemController::class, 'limit']);
    });

    Route::prefix('other-offers')->group(function () {
        Route::get('/', [ItemController::class, 'otherOffers']); // ini all produk item, dan
        Route::get('/limit', [ItemController::class, 'limitOtherOffers']); // ini all produk item, dan

    });

    Route::prefix('exclusive-distributor')->group(function () {
        Route::get('', [ExclusiveDistributorController::class, 'index']);
        Route::get('/limit', [ExclusiveDistributorController::class, 'limit']);
    });

    Route::prefix('flashsale')->group(function () {
        Route::get('', [DiscountController::class, 'index']);
        Route::get('/limit', [DiscountController::class, 'limit']);
    });

    Route::prefix('authorised-dealer')->group(function () {
        Route::get('', [AuthorisedDealerController::class, 'index']);
        Route::get('/limit', [AuthorisedDealerController::class, 'limit']);
    });
});

Route::middleware('auth:sanctum')->group(function () {
    // Route::middleware(['auth'])->group(function () {
    Route::get('/current-user', [\App\Http\Controllers\Api\Auth\CurrentUserController::class, 'index']);
    Route::post('/logout', [\App\Http\Controllers\Api\Auth\LogoutController::class, 'index']);
    /** Route v2 */

    Route::prefix('user')->group(function () {
        Route::get('/', [UserController::class, 'index']);
        Route::prefix('{user}')->group(function () {
            Route::put('', [UserController::class, 'detail']);
            Route::delete('', [UserController::class, 'delete']);
        });
    });

    Route::prefix('transaction')->group(function () {
        Route::get('/', [TransactionHistoryController::class, 'index']);
        Route::get('/unpaid', [TransactionHistoryController::class, 'unpaid']);
        Route::prefix('{order}')->group(function () {
            Route::get('/', [TransactionHistoryController::class, 'detail']);
        });
    });

    Route::prefix('profile')->group(function () {
        Route::post('/', [ProfileController::class, 'updateProfil']);
        Route::post('/update-password', [ProfileController::class, 'updatePassword']);
        Route::post('/nonaktif-akun', [ProfileController::class, 'nonAktifAkun']);
        Route::post('/aktifkan-akun', [ProfileController::class, 'aktifkanAkun']);
        Route::post('/delete-akun-permanen', [ProfileController::class, 'deleteAkunPermanen']);
    });

    Route::prefix('product')->group(function () {
        Route::get('/', [ProductController::class, 'index']);
        Route::prefix('{product}')->group(function () {
            Route::get('/', [ProductController::class, 'details']);
            Route::put('/', [ProductController::class, 'update']); // belom selesai
            Route::delete('/', [ProductController::class, 'delete']);
        });

        Route::prefix('item')->group(function () {
            Route::prefix('{item}')->group(function () {
                Route::post('/', [ProductController::class, 'createItem']);
            });
        });

        Route::prefix('variant')->group(function () {
            Route::prefix('{itemVariant}')->group(function () {
                Route::post('/', [ProductController::class, 'createVariant']);
            });
        });

        Route::prefix('bundling')->group(function () {
            Route::prefix('{itemBundling}')->group(function () {
                Route::post('/', [ProductController::class, 'createBundling']);
            });
        });
    });

    Route::prefix('brand')->group(function () {
        Route::get('', [BrandController::class, 'index']);
        Route::post('', [BrandController::class, 'post']);
        Route::prefix('{brand}')->group(function () {
            Route::put('', [BrandController::class, 'update']);
            Route::delete('', [BrandController::class, 'delete']);
        });
    });

    Route::prefix('categorie')->group(function () {
        Route::get('', [CategorieController::class, 'index']);
        Route::post('', [CategorieController::class, 'post']);
        Route::prefix('{categorie}')->group(function () {
            Route::put('', [CategorieController::class, 'update']);
            Route::delete('', [CategorieController::class, 'delete']);
        });
    });

    Route::prefix('item')->group(function () {
        Route::get('/', [ItemController::class, 'index']);
        Route::get('/limit', [ItemController::class, 'limit']);
        Route::post('/', [ItemController::class, 'create']);
        Route::prefix('{item}')->group(function () {
            Route::put('', [ItemController::class, 'update']);
            Route::delete('', [ItemController::class, 'delete']);
            Route::get('/', [ItemController::class, 'detail']);
        });
    });

    Route::prefix('variant')->group(function () {
        Route::post('/', [ItemVariantController::class, 'create']);
        Route::prefix('{itemVariant}')->group(function () {
            Route::put('', [ItemVariantController::class, 'update']);
            Route::delete('', [ItemVariantController::class, 'delete']);
        });
    });

    Route::prefix('bundling')->group(function () {
        // Route::get('', [ItemBundlingController::class, 'index']);
        Route::post('', [ItemBundlingController::class, 'create']);
        Route::prefix('{itemBundling}')->group(function () {
            Route::delete('', [ItemBundlingController::class, 'delete']);
            Route::put('', [ItemBundlingController::class, 'update']);
        });
    });

    Route::prefix('item-photo')->group(function () {
        Route::post('/', [ItemPhotoController::class, 'create']);
        Route::prefix('{item_photo}')->group(function () {
            Route::put('', [ItemPhotoController::class, 'update']);
            Route::delete('', [ItemPhotoController::class, 'delete']);
        });
    });

    Route::prefix('discount')->group(function () {
        Route::post('', [DiscountController::class, 'create']);
        Route::prefix('{itemDiscount}')->group(function () {
            Route::delete('', [DiscountController::class, 'delete']);
            Route::put('', [DiscountController::class, 'update']);
        });
    });



    Route::prefix('wishlist')->group(function () {
        Route::get('/', [WishlistController::class, 'index']);
        Route::prefix('{item}')->group(function () {
            Route::post('', [WishlistController::class, 'create']);
            Route::delete('', [WishlistController::class, 'delete']);
        });
    });

    Route::prefix('cart')->group(function () {
        Route::get('/', [CartController::class, 'index']);
        Route::post('', [CartController::class, 'create']);
        Route::delete('/all', [CartController::class, 'allDelete']);
        Route::prefix('{cart}')->group(function () {
            Route::put('', [CartController::class, 'update']);
            Route::delete('', [CartController::class, 'delete']);
        });
    });

    Route::prefix('discussion')->group(function () {
        Route::post('/', [DiscussionController::class, 'create']);
        Route::prefix('{discussion}')->group(function () {
            Route::put('/', [DiscussionController::class, 'update']);
            Route::delete('/', [DiscussionController::class, 'delete']);
        });
    });

    Route::prefix('discussion-answer')->group(function () {
        Route::post('/', [DiscussionAnswerController::class, 'create']);
        Route::prefix('{discussion_answer}')->group(function () {
            Route::put('/', [DiscussionAnswerController::class, 'update']);
            Route::delete('/', [DiscussionAnswerController::class, 'delete']);
        });
    });

    Route::prefix('checkout')->group(function () {
        Route::get('/', [CheckoutController::class, 'index']);
    });

    Route::prefix('coupon')->group(function () {
        Route::get('/', [CouponController::class, 'index']);
    });

    Route::prefix('address')->group(function () {
        Route::get('/', [AddressController::class, 'index']);
        Route::post('/', [AddressController::class, 'create']);
        Route::prefix('{address}')->group(function () {
            Route::post('/', [AddressController::class, 'choose']);
            Route::delete('/', [AddressController::class, 'delete']);
            Route::get('/detail', [AddressController::class, 'detail']);
            Route::put('/', [AddressController::class, 'update']);
        });
    });

    Route::post('/shipping', [CheckPostageController::class, 'shipping']);
});

Route::prefix('subdistrict')->group(function () {
    Route::post('/', [RegionController::class, 'subDistrict']);
});


Route::prefix('city')->group(function () {
    Route::post('/', [RegionController::class, 'city']);
});

Route::prefix('province')->group(function () {
    Route::post('/', [RegionController::class, 'province']);
});

Route::prefix('courier')->group(function () {
    Route::post('/', [CourierController::class, 'courier']);
});
