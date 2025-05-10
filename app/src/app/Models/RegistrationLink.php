<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

/**
 * Class RegistrationLink
 *
 * @property int $id
 * @property string $user_name
 * @property string $phone_number
 * @property string $uuid
 * @property bool $is_active
 * @property Carbon $created_at
 *
 * @method create(array $data)
 * @method where(string $column, mixed $value)
 */
class RegistrationLink extends Model
{
	protected $table = 'registration_links';
	public $timestamps = false;

	protected $casts = [
		'is_active' => 'bool'
	];

	protected $fillable = [
        'user_name',
        'phone_number',
		'uuid',
		'is_active'
	];
}
