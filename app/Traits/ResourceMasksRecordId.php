<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;

trait ResourceMasksRecordId
{
    public static function resolveRecordRouteBinding(int|string $key): ?Model {
		/** @var class-string<ModelMasksRecordId> $model */
		$model = self::$model;
		$key = $model::getSqids()->decode($key)[0] ?? null;

		if (is_null($key)) {
			throw new ModelNotFoundException();
		}

		return parent::resolveRecordRouteBinding($key);
	}
}
