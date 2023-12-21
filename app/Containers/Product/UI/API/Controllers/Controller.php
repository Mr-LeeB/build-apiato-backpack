<?php

namespace App\Containers\Product\UI\API\Controllers;

use App\Containers\Product\UI\API\Requests\CreateProductRequest;
use App\Containers\Product\UI\API\Requests\DeleteProductRequest;
use App\Containers\Product\UI\API\Requests\GetAllProductsRequest;
use App\Containers\Product\UI\API\Requests\FindProductByIdRequest;
use App\Containers\Product\UI\API\Requests\FindProductByNameRequest;
use App\Containers\Product\UI\API\Requests\UpdateProductRequest;
use App\Containers\Product\UI\API\Transformers\ProductTransformer;
use App\Ship\Parents\Controllers\ApiController;
use Apiato\Core\Foundation\Facades\Apiato;
use App\Ship\Transporters\DataTransporter;

/**
 * Class Controller
 *
 * @package App\Containers\Product\UI\API\Controllers
 */
class Controller extends ApiController
{
  /**
   * @param CreateProductRequest $request
   * @return  mixed
   */
  public function createProduct(CreateProductRequest $request)
  {
    $product = Apiato::call('Product@CreateProductAction', [new DataTransporter($request)]);

    return $this->transform($product, ProductTransformer::class);
  }

  /**
   * @param FindProductByIdRequest $request
   * @return array
   */
  public function findProductById(FindProductByIdRequest $request)
  {
    $product = Apiato::call('Product@FindProductByIdAction', [new DataTransporter($request)]);

    return $this->transform($product, ProductTransformer::class);
  }

  /**
   * @param FindProductByIdRequest $request
   * @return array
   */
  public function findProductByName(FindProductByNameRequest $request)
  {
    $product = Apiato::call('Product@FindProductByNameAction', [new DataTransporter($request)]);

    return $this->transform($product, ProductTransformer::class);
  }

  /**
   * @param GetAllProductsRequest $request
   * @return array
   */
  public function getAllProducts(GetAllProductsRequest $request)
  {
    $products = Apiato::call('Product@GetAllProductsAction', [new DataTransporter($request)]);

    return $this->transform($products, ProductTransformer::class);
  }

  /**
   * @param UpdateProductRequest $request
   * @return array
   */
  public function updateProduct(UpdateProductRequest $request)
  {
    $product = Apiato::call('Product@UpdateProductAction', [new DataTransporter($request)]);

    return $this->transform($product, ProductTransformer::class);
  }

  /**
   * @param DeleteProductRequest $request
   * @return \Illuminate\Http\JsonResponse
   */
  public function deleteProduct(DeleteProductRequest $request)
  {
    Apiato::call('Product@DeleteProductAction', [new DataTransporter($request)]);

    return $this->noContent();
  }
}
