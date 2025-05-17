<?php

// @formatter:off
// phpcs:ignoreFile
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 *
 *
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Categories newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Categories newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Categories query()
 */
	class Categories extends \Eloquent {}
}

namespace App\Models{
/**
 *
 *
 * @method static \Illuminate\Database\Eloquent\Builder<static>|\App\Domain\Models\Product newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|\App\Domain\Models\Product newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|\App\Domain\Models\Product query()
 */
	class Product extends \Eloquent {}
}

namespace App\Models{
/**
 *
 *
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Reviews newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Reviews newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Reviews query()
 */
	class Reviews extends \Eloquent {}
}

namespace App\Models{
/**
 *
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string $password
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property array<array-key, mixed>|null $permissions
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Orchid\Platform\Models\Role> $roles
 * @property-read int|null $roles_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|\App\Domain\Models\User averageByDays(string $value, $startDate = null, $stopDate = null, ?string $dateColumn = null)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|\App\Domain\Models\User byAccess(string $permitWithoutWildcard)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|\App\Domain\Models\User byAnyAccess($permitsWithoutWildcard)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|\App\Domain\Models\User countByDays($startDate = null, $stopDate = null, ?string $dateColumn = null)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|\App\Domain\Models\User countForGroup(string $groupColumn)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|\App\Domain\Models\User defaultSort(string $column, string $direction = 'asc')
 * @method static \Database\Factories\UserFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|\App\Domain\Models\User filters(?mixed $kit = null, ?\Orchid\Filters\HttpFilter $httpFilter = null)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|\App\Domain\Models\User filtersApply(iterable $filters = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|\App\Domain\Models\User filtersApplySelection($class)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|\App\Domain\Models\User maxByDays(string $value, $startDate = null, $stopDate = null, ?string $dateColumn = null)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|\App\Domain\Models\User minByDays(string $value, $startDate = null, $stopDate = null, ?string $dateColumn = null)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|\App\Domain\Models\User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|\App\Domain\Models\User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|\App\Domain\Models\User query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|\App\Domain\Models\User sumByDays(string $value, $startDate = null, $stopDate = null, ?string $dateColumn = null)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|\App\Domain\Models\User valuesByDays(string $value, $startDate = null, $stopDate = null, string $dateColumn = 'created_at')
 * @method static \Illuminate\Database\Eloquent\Builder<static>|\App\Domain\Models\User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|\App\Domain\Models\User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|\App\Domain\Models\User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|\App\Domain\Models\User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|\App\Domain\Models\User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|\App\Domain\Models\User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|\App\Domain\Models\User wherePermissions($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|\App\Domain\Models\User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|\App\Domain\Models\User whereUpdatedAt($value)
 */
	class User extends \Eloquent {}
}

