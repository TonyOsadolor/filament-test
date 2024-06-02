<?php

namespace App\Traits;

use Sqids\Sqids;

trait ModelMasksRecordId
{
    public static function getSqids(): Sqids {
		return new Sqids(
			alphabet: defined('self::SQID_ALPHABET') ? self::SQID_ALPHABET : Sqids::DEFAULT_ALPHABET,
			minLength: defined('self::SQID_MIN_LENGTH') ? self::SQID_MIN_LENGTH : 6,
		);
	}

	protected function getSqidAttribute(): string {
		return self::getSqids()->encode([$this->getKey()]);
	}

	public function getRouteKey(): string {
		return $this->sqid;
	}
}
