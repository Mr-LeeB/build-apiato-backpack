<?php

namespace App\Containers\Product\UI\WEB\Controllers;

use App\Containers\Product\UI\WEB\Requests\CreateProductRequest;
use App\Containers\Product\UI\WEB\Requests\DeleteBulkProductRequest;
use App\Containers\Product\UI\WEB\Requests\DeleteProductRequest;
use App\Containers\Product\UI\WEB\Requests\GetAllProductsRequest;
use App\Containers\Product\UI\WEB\Requests\FindProductByIdRequest;
use App\Containers\Product\UI\WEB\Requests\SortRequest;
use App\Containers\Product\UI\WEB\Requests\UpdateProductRequest;
use App\Ship\Parents\Controllers\WebController;
use Apiato\Core\Foundation\Facades\Apiato;
use App\Ship\Transporters\DataTransporter;

/**
 * Class Controller
 *
 * @package App\Containers\Product\UI\WEB\Controllers
 */
class Controller extends WebController
{
  private function sortFunc(int $num, $products)
  {
    $product_description = [];

    $productID = [];
    $created_at = [];
    $productName = [];

    foreach ($products as $key => $value) {
      if (strlen($value->description) > 20) {
        $value->description = substr($value->description, 0, 20) . '...';
      }
      array_push($product_description, $value);
      array_push($productID, $value->id);
      array_push($created_at, $value->created_at);
      array_push($productName, strtoupper($value->name));
    }
    // sort by id
    if ($num == 1) {
      array_multisort($productID, SORT_ASC, $product_description);
    } elseif ($num == 2) {
      array_multisort($productID, SORT_DESC, $product_description);
    }
    // sort by name
    elseif ($num == 3) {
      array_multisort($productName, SORT_ASC, $product_description);
    } elseif ($num == 4) {
      array_multisort($productName, SORT_DESC, $product_description);
    }
    // sort by created_at
    elseif ($num == 5) {
      array_multisort($created_at, SORT_ASC, $product_description);
    } elseif ($num == 6) {
      array_multisort($created_at, SORT_DESC, $product_description);
    }
    return $product_description;
  }
  /**
   * Show all entities
   *
   * @param GetAllProductsRequest $request
   */
  public function getAllProducts(GetAllProductsRequest $request, SortRequest $sortRequest)
  {
    $products = Apiato::call('Product@GetAllProductsAction', [new DataTransporter($request)]);
    $product_description = [];

    $num = 6;
    if ($sortRequest->sort != null) {
      $num = $sortRequest->sort;
    }

    $product_description = self::sortFunc($num, $products);

    return view('product::home', compact('products', 'product_description', 'num'));
  }


  /**
   * Show one entity
   *
   * @param FindProductByIdRequest $request
   */
  public function findProductById(FindProductByIdRequest $request)
  {
    $product = Apiato::call('Product@FindProductByIdAction', [new DataTransporter($request)]);

    return view('product::product-detail-page', compact('product'));

  }

  /**
   * Add a new entity
   *
   * @param CreateProductRequest $request
   */
  public function createProduct(CreateProductRequest $request)
  {
    $requestData = $request->all();

    $fileName = time() . rand(1, 100) . $request->file('image')->getClientOriginalName();
    $path = storage_path('app/public/images');

    $image = new \Imagick($request->file('image')->getRealPath());
    // resize image
    $image->resizeImage(100, 100, \Imagick::FILTER_LANCZOS, 1);

    // save image
    $image->writeImage($path . '/' . $fileName);

    $requestData['image'] = '/storage/images/' . $fileName;

    $product = Apiato::call('Product@CreateProductAction', [new DataTransporter($requestData)]);

    return view('product::create-product-page', compact('product'));
  }

  /**
   * Update a given entity
   *
   * @param UpdateProductRequest $request
   */
  public function updateProduct(UpdateProductRequest $request)
  {
    $oldProduct = Apiato::call('Product@FindProductByIdAction', [new DataTransporter($request)]);

    $requestData = $request->all();
    if ($request->image) {
      $fileName = time() . $request->file('image')->getClientOriginalName();
      $path = storage_path('app/public/images');

      $image = new \Imagick($request->file('image')->getRealPath());

      // resize image
      $image->resizeImage(100, 100, \Imagick::FILTER_LANCZOS, 1);

      // save image
      $image->writeImage($path . '/' . $fileName);

      $requestData['image'] = '/storage/images/' . $fileName;

      // remove old image
      $oldImage = substr($oldProduct->image, 15);
      try {
        unlink(storage_path('app/public/images') . $oldImage);
      } catch (\Exception $e) {
        return redirect()->back()->withErrors(['error' => $e->getMessage()]);
      }
    }

    $product = Apiato::call('Product@UpdateProductAction', [new DataTransporter($requestData)]);


    return view('product::product-detail-page', compact('product'));
  }

  /**
   * Delete a given entity
   *
   * @param DeleteProductRequest $request
   */
  public function deleteProduct(DeleteProductRequest $request)
  {
    try {

      $result = Apiato::call('Product@FindProductByIdAction', [new DataTransporter($request)]);

      if ($result) {
        Apiato::call('Product@DeleteProductAction', [new DataTransporter($request)]);

        $oldImage = substr($result->image, 15);

        unlink(storage_path('app/public/images') . $oldImage);
      }
    } catch (\Exception $e) {
      return redirect()->back()->withErrors(['error' => $e->getMessage()]);
    }
    return redirect()->route('web_product_get_all_products')->with('message', 'Product (' . $result->name . ') Deleted Successfully!');
  }

  /**
   * Delete many given entity
   *
   * @param DeleteBulkProductRequest $request
   */
  public function bulkDeleteProduct(DeleteBulkProductRequest $request)
  {
    try {
      $result = Apiato::call('Product@FindProductByIdAction', [new DataTransporter($request)]);

      if ($result) {
        Apiato::call('Product@DeleteBulkProductAction', [new DataTransporter($request)]);

        $productName = '';
        foreach ($result as $resultImg) {

          $productName .= $resultImg->name . ", ";

          $oldImage = substr($resultImg->image, 15);
          unlink(storage_path('app/public/images') . $oldImage);
        }
        $productName = substr($productName, 0, -2);
      }
    } catch (\Exception $e) {
      return redirect()->back()->withErrors(['error' => $e->getMessage()]);
    }
    return redirect()->route('web_product_get_all_products')->with('message', 'Product (' . $productName . ') Deleted Successfully!');
  }

  /**
   * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
   */
  public function showCreateProductPage()
  {
    $product = null;
    return view('product::create-product-page', compact('product'));
  }

  /**
   * @param $id
   * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
   */
  public function showDetailProductPage(FindProductByIdRequest $request)
  {
    $product = Apiato::call('Product@FindProductByIdAction', [new DataTransporter($request)]);

    return view('product::product-detail-page', compact('product'));
  }


}