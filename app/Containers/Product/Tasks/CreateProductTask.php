<?php

namespace App\Containers\Product\Tasks;

use App\Containers\Product\Data\Repositories\ProductRepository;
use App\Containers\Product\Models\Product;
use App\Ship\Exceptions\CreateResourceFailedException;
use App\Ship\Parents\Tasks\Task;
use Exception;

class CreateProductTask extends Task
{

    protected $repository;

    public function __construct(ProductRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param string      $name
     * @param string|null $description
     * @param string|null $image
     *
     * @return  mixed
     * @throws  CreateResourceFailedException
     */
    public function run(
        string $name,
        string $description = null,
        string $image = null
    ): Product {

        try {
            // create new product
            $product = $this->repository->create([
                'name'        => $name,
                'description' => $description,
                'image'       => $image,
            ]);

        } catch (Exception $e) {
            throw (new CreateResourceFailedException())->debug($e);
        }
        return $product;
    }
}