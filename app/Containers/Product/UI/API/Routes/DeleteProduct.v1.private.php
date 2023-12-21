<?php

/**
 * @apiGroup           Product
 * @apiName            deleteProduct
 *
 * @api                {DELETE} /vv1/products/:id Endpoint title here..
 * @apiDescription     Endpoint description here..
 *
 * @apiVersion         v1.0.0
 * @apiPermission      none
 *
 * @apiParam           {String}  parameters here..
 *
 * @apiSuccessExample  {json}  Success-Response:
 * HTTP/1.1 204 OK
{
  // Insert the response of the request here...
}
 */

/** @var Route $router */
$router->delete('products/{id}', [
  'as' => 'api_product_delete_product',
  'uses' => 'Controller@deleteProduct',
  'middleware' => [
    'auth:api',
  ],
]);
