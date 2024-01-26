<?php

namespace App\Containers\Vessel\Tasks;

use App\Containers\Vessel\Data\Repositories\VesselImagesRepository;
use App\Ship\Exceptions\CreateResourceFailedException;
use App\Ship\Exceptions\UpdateResourceFailedException;
use App\Ship\Parents\Tasks\Task;
use Exception;

class UploadVesselImagesTask extends Task
{

	protected $repository;

	public function __construct(VesselImagesRepository $repository)
	{
		$this->repository = $repository;
	}

	public function run($id, $data): void
	{
		try {
			// dd($data);
			foreach ($data as $image) {
				$this->repository->create([
					'name' => $image,
					'vessel_id' => $id,
				]);
			}

		} catch (Exception $exception) {
			throw new CreateResourceFailedException();
		}
	}
}
