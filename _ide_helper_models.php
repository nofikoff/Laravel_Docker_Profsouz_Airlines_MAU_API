<?php
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace Modules\Users\Entities{
/**
 * Modules\Users\Entities\Permission
 *
 * @property int $id
 * @property string $name
 * @property string $display_name
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\Modules\Posts\Entities\Branch[] $branches
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Users\Entities\Permission whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Users\Entities\Permission whereDisplayName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Users\Entities\Permission whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Users\Entities\Permission whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Users\Entities\Permission whereUpdatedAt($value)
 */
	class Permission extends \Eloquent {}
}

namespace Modules\Users\Entities{
/**
 * Modules\Users\Entities\Log
 *
 * @property int $id
 * @property int $user_id
 * @property string|null $entity_type
 * @property int|null $entity_id
 * @property string $type
 * @property string|null $value
 * @property string $ip
 * @property string|null $comment
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Model|\Eloquent $entity
 * @property-read \Modules\Users\Entities\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Users\Entities\Log whereComment($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Users\Entities\Log whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Users\Entities\Log whereEntityId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Users\Entities\Log whereEntityType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Users\Entities\Log whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Users\Entities\Log whereIp($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Users\Entities\Log whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Users\Entities\Log whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Users\Entities\Log whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Users\Entities\Log whereValue($value)
 */
	class Log extends \Eloquent {}
}

namespace Modules\Users\Entities{
/**
 * Modules\Users\Entities\Group
 *
 * @property int $id
 * @property string $name
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\Modules\Posts\Entities\Branch[] $branches
 * @property-read \Illuminate\Database\Eloquent\Collection|\Modules\Users\Entities\User[] $users
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Query\Builder|\Modules\Users\Entities\Group onlyTrashed()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Users\Entities\Group whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Users\Entities\Group whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Users\Entities\Group whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Users\Entities\Group whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Users\Entities\Group whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\Modules\Users\Entities\Group withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\Modules\Users\Entities\Group withoutTrashed()
 */
	class Group extends \Eloquent {}
}

namespace Modules\Users\Entities{
/**
 * Modules\Users\Entities\Notification
 *
 * @property int $id
 * @property int $user_id
 * @property int $is_urgent
 * @property int $read
 * @property string $event
 * @property int|null $entity_id
 * @property string|null $entity_type
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Model|\Eloquent $entity
 * @property-read mixed $noty
 * @property-read string $system_text
 * @property-read string $text
 * @property-read string $url
 * @property-read \Modules\Users\Entities\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Users\Entities\Notification comments()
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Users\Entities\Notification documents()
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Users\Entities\Notification noneRead()
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Users\Entities\Notification noneUrgent()
 * @method static \Illuminate\Database\Query\Builder|\Modules\Users\Entities\Notification onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Users\Entities\Notification posts()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Users\Entities\Notification whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Users\Entities\Notification whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Users\Entities\Notification whereEntityId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Users\Entities\Notification whereEntityType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Users\Entities\Notification whereEvent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Users\Entities\Notification whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Users\Entities\Notification whereIsUrgent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Users\Entities\Notification whereRead($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Users\Entities\Notification whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Users\Entities\Notification whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\Modules\Users\Entities\Notification withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\Modules\Users\Entities\Notification withoutTrashed()
 */
	class Notification extends \Eloquent {}
}

namespace Modules\Users\Entities{
/**
 * Modules\Users\Entities\Role
 *
 * @property int $id
 * @property string $name
 * @property string $display_name
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\Modules\Users\Entities\User[] $users
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Users\Entities\Role whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Users\Entities\Role whereDisplayName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Users\Entities\Role whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Users\Entities\Role whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Users\Entities\Role whereUpdatedAt($value)
 */
	class Role extends \Eloquent {}
}

namespace Modules\Users\Entities{
/**
 * Class User
 *
 * @package Modules\Users\Entities
 * @property int $id
 * @property string $phone
 * @property string $first_name
 * @property string $last_name
 * @property string $password
 * @property string|null $img
 * @property string|null $position
 * @property string|null $birthday
 * @property int $is_confirmed
 * @property string $locale
 * @property string|null $remember_token
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\Modules\Posts\Entities\Branch[] $branch_settings
 * @property-read \Illuminate\Database\Eloquent\Collection|\Laravel\Passport\Client[] $clients
 * @property-read \Illuminate\Database\Eloquent\Collection|\Modules\Posts\Entities\Comment[] $comments
 * @property-read \Illuminate\Database\Eloquent\Collection|\Modules\Documents\Entities\Document[] $documents
 * @property-read \Illuminate\Support\Collection $access_branch_ids
 * @property-read \Collection $available_branch_ids
 * @property-read string $avatar
 * @property-read \Collection|\User $full_access_branch_ids
 * @property-read string $full_name
 * @property-read mixed $not_read_notifications_count
 * @property-read \Collection|static $notify_branch_ids
 * @property-read \Collection|\User $read_branch_ids
 * @property-read \Illuminate\Database\Eloquent\Collection|\Modules\Users\Entities\Group[] $groups
 * @property-read \Illuminate\Database\Eloquent\Collection|\Modules\Users\Entities\Log[] $logs
 * @property-read \Illuminate\Database\Eloquent\Collection|\Modules\Users\Entities\Notification[] $morph_notifications
 * @property-read \Illuminate\Database\Eloquent\Collection|\Modules\Users\Entities\Notification[] $notifications
 * @property-read \Illuminate\Database\Eloquent\Collection|\Modules\Posts\Entities\Post[] $posts
 * @property-read \Illuminate\Database\Eloquent\Collection|\Modules\Users\Entities\Role[] $roles
 * @property-read \Illuminate\Database\Eloquent\Collection|\Modules\Posts\Entities\SystemPost[] $system_posts
 * @property-read \Illuminate\Database\Eloquent\Collection|\Laravel\Passport\Token[] $tokens
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Users\Entities\User isConfirmed()
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Users\Entities\User isNotConfirmed()
 * @method static \Illuminate\Database\Query\Builder|\Modules\Users\Entities\User onlyTrashed()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Users\Entities\User search($search)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Users\Entities\User whereBirthday($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Users\Entities\User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Users\Entities\User whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Users\Entities\User whereFirstName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Users\Entities\User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Users\Entities\User whereImg($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Users\Entities\User whereIsConfirmed($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Users\Entities\User whereLastName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Users\Entities\User whereLocale($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Users\Entities\User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Users\Entities\User wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Users\Entities\User wherePosition($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Users\Entities\User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Users\Entities\User whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\Modules\Users\Entities\User withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\Modules\Users\Entities\User withoutTrashed()
 */
	class User extends \Eloquent {}
}

namespace Modules\Documents\Entities{
/**
 * Modules\Documents\Entities\Document
 *
 * @property int $id
 * @property int $branch_id
 * @property int $user_id
 * @property string $file
 * @property string $url
 * @property string $size
 * @property string|null $description
 * @property string $status
 * @property int $importance
 * @property int $is_notify
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property-read \Modules\Posts\Entities\Branch $branch
 * @property-read string $download_url
 * @property-read \Illuminate\Database\Eloquent\Collection|\Modules\Users\Entities\Log[] $logs
 * @property-read \Illuminate\Database\Eloquent\Collection|\Modules\Users\Entities\Notification[] $notifications
 * @property-read \Illuminate\Database\Eloquent\Collection|\Modules\Posts\Entities\Tag[] $tags
 * @property-read \Modules\Users\Entities\User $user
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Documents\Entities\Document list()
 * @method static \Illuminate\Database\Query\Builder|\Modules\Documents\Entities\Document onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Documents\Entities\Document premoderation()
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Documents\Entities\Document published()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Documents\Entities\Document search($search)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Documents\Entities\Document userAccessBranches($user = null)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Documents\Entities\Document userReadBranches($user = null)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Documents\Entities\Document whereBranchId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Documents\Entities\Document whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Documents\Entities\Document whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Documents\Entities\Document whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Documents\Entities\Document whereFile($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Documents\Entities\Document whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Documents\Entities\Document whereImportance($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Documents\Entities\Document whereIsNotify($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Documents\Entities\Document whereSize($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Documents\Entities\Document whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Documents\Entities\Document whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Documents\Entities\Document whereUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Documents\Entities\Document whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\Modules\Documents\Entities\Document withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\Modules\Documents\Entities\Document withoutTrashed()
 */
	class Document extends \Eloquent {}
}

namespace Modules\Posts\Entities{
/**
 * Modules\Posts\Entities\PostQuestionVote
 *
 * @property int $id
 * @property int $user_id
 * @property int $post_question_id
 * @property int $post_question_option_id
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property-read \Modules\Posts\Entities\PostQuestionOption $option
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Posts\Entities\PostQuestionVote whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Posts\Entities\PostQuestionVote whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Posts\Entities\PostQuestionVote wherePostQuestionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Posts\Entities\PostQuestionVote wherePostQuestionOptionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Posts\Entities\PostQuestionVote whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Posts\Entities\PostQuestionVote whereUserId($value)
 */
	class PostQuestionVote extends \Eloquent {}
}

namespace Modules\Posts\Entities{
/**
 * Modules\Posts\Entities\SystemPost
 *
 * @property int $id
 * @property int $user_id
 * @property string $body
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property-read \Modules\Users\Entities\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Posts\Entities\SystemPost whereBody($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Posts\Entities\SystemPost whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Posts\Entities\SystemPost whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Posts\Entities\SystemPost whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Posts\Entities\SystemPost whereUserId($value)
 */
	class SystemPost extends \Eloquent {}
}

namespace Modules\Posts\Entities{
/**
 * Modules\Posts\Entities\Tag
 *
 * @property int $id
 * @property string $name
 * @property string $alias
 * @property string $class
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\Modules\Documents\Entities\Document[] $documents
 * @property-read \Illuminate\Database\Eloquent\Collection|\Modules\Posts\Entities\Post[] $posts
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Query\Builder|\Modules\Posts\Entities\Tag onlyTrashed()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Posts\Entities\Tag whereAlias($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Posts\Entities\Tag whereClass($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Posts\Entities\Tag whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Posts\Entities\Tag whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Posts\Entities\Tag whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Posts\Entities\Tag whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Posts\Entities\Tag whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\Modules\Posts\Entities\Tag withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\Modules\Posts\Entities\Tag withoutTrashed()
 */
	class Tag extends \Eloquent {}
}

namespace Modules\Posts\Entities{
/**
 * Modules\Posts\Entities\Branch
 *
 * @property int $id
 * @property string $name
 * @property string|null $alias
 * @property string|null $description
 * @property int $parent_id
 * @property int $is_inherit
 * @property string $type
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\Modules\Posts\Entities\Branch[] $children
 * @property-read \Illuminate\Database\Eloquent\Collection|\Modules\Documents\Entities\Document[] $documents
 * @property-read mixed $available_types
 * @property-read bool $is_finn_help
 * @property-read \Illuminate\Support\Collection $user_ids
 * @property-read \Illuminate\Database\Eloquent\Collection|\Illuminate\Support\Collection|\User[] $users
 * @property-read \Illuminate\Database\Eloquent\Collection|\Modules\Users\Entities\Group[] $groups
 * @property-read \Modules\Posts\Entities\Branch $parent
 * @property-read \Illuminate\Database\Eloquent\Collection|\Modules\Users\Entities\Permission[] $permissions
 * @property-read \Illuminate\Database\Eloquent\Collection|\Modules\Posts\Entities\Post[] $posts
 * @property-read \Illuminate\Database\Eloquent\Collection|\Modules\Users\Entities\User[] $user_settings
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Posts\Entities\Branch documentable()
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Query\Builder|\Modules\Posts\Entities\Branch onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Posts\Entities\Branch postable()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Posts\Entities\Branch root()
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Posts\Entities\Branch userAccess($user = null)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Posts\Entities\Branch userRead($user = null)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Posts\Entities\Branch whereAlias($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Posts\Entities\Branch whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Posts\Entities\Branch whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Posts\Entities\Branch whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Posts\Entities\Branch whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Posts\Entities\Branch whereIsInherit($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Posts\Entities\Branch whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Posts\Entities\Branch whereParentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Posts\Entities\Branch whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Posts\Entities\Branch whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\Modules\Posts\Entities\Branch withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\Modules\Posts\Entities\Branch withoutTrashed()
 */
	class Branch extends \Eloquent {}
}

namespace Modules\Posts\Entities{
/**
 * Modules\Posts\Entities\PostAttachment
 *
 * @property int $id
 * @property int $post_id
 * @property string $name
 * @property string $file
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property-read string $download_url
 * @property-read \Modules\Posts\Entities\Post $post
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Posts\Entities\PostAttachment whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Posts\Entities\PostAttachment whereFile($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Posts\Entities\PostAttachment whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Posts\Entities\PostAttachment whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Posts\Entities\PostAttachment wherePostId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Posts\Entities\PostAttachment whereUpdatedAt($value)
 */
	class PostAttachment extends \Eloquent {}
}

namespace Modules\Posts\Entities{
/**
 * Modules\Posts\Entities\Comment
 *
 * @property int $id
 * @property int $post_id
 * @property int $user_id
 * @property int $parent_id
 * @property string $text
 * @property string|null $image
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\Modules\Posts\Entities\Comment[] $children
 * @property-read string $image_url
 * @property-read mixed $url
 * @property-read \Illuminate\Database\Eloquent\Collection|\Modules\Users\Entities\Notification[] $notifications
 * @property-read \Modules\Posts\Entities\Comment $parent
 * @property-read \Modules\Posts\Entities\Post $post
 * @property-read \Modules\Users\Entities\User $user
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Query\Builder|\Modules\Posts\Entities\Comment onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Posts\Entities\Comment parents()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Posts\Entities\Comment whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Posts\Entities\Comment whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Posts\Entities\Comment whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Posts\Entities\Comment whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Posts\Entities\Comment whereParentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Posts\Entities\Comment wherePostId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Posts\Entities\Comment whereText($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Posts\Entities\Comment whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Posts\Entities\Comment whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\Modules\Posts\Entities\Comment withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\Modules\Posts\Entities\Comment withoutTrashed()
 */
	class Comment extends \Eloquent {}
}

namespace Modules\Posts\Entities{
/**
 * Modules\Posts\Entities\Post
 *
 * @property int $id
 * @property int $user_id
 * @property int $branch_id
 * @property string $title
 * @property string $type
 * @property string|null $body
 * @property string|null $status
 * @property int|null $info_status_id
 * @property int $importance
 * @property int $is_commented
 * @property int $sms_notify
 * @property int $in_top
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\Modules\Posts\Entities\PostAttachment[] $attachments
 * @property-read \Modules\Posts\Entities\Branch $branch
 * @property-read \Illuminate\Database\Eloquent\Collection|\Modules\Posts\Entities\Comment[] $comments
 * @property-read \Modules\Posts\Entities\FinancialInfo $financial_info
 * @property-read bool $is_published
 * @property-read bool|string $p_d_f
 * @property-read string $url
 * @property-read \Modules\Posts\Entities\InfoStatus|null $info_status
 * @property-read \Illuminate\Database\Eloquent\Collection|\Modules\Users\Entities\Log[] $logs
 * @property-read \Illuminate\Database\Eloquent\Collection|\Modules\Users\Entities\Notification[] $notifications
 * @property-read \Modules\Posts\Entities\PostQuestion $question
 * @property-read \Illuminate\Database\Eloquent\Collection|\Modules\Posts\Entities\Tag[] $tags
 * @property-read \Modules\Users\Entities\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Posts\Entities\Post commentsCount()
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Posts\Entities\Post inTop()
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Posts\Entities\Post list()
 * @method static \Illuminate\Database\Query\Builder|\Modules\Posts\Entities\Post onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Posts\Entities\Post premoderation()
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Posts\Entities\Post published()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Posts\Entities\Post search($search)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Posts\Entities\Post statused($status = false)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Posts\Entities\Post type()
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Posts\Entities\Post userAccessBranches($user = null)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Posts\Entities\Post userReadBranches($user = null)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Posts\Entities\Post whereBody($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Posts\Entities\Post whereBranchId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Posts\Entities\Post whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Posts\Entities\Post whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Posts\Entities\Post whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Posts\Entities\Post whereImportance($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Posts\Entities\Post whereInTop($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Posts\Entities\Post whereInfoStatusId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Posts\Entities\Post whereIsCommented($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Posts\Entities\Post whereSmsNotify($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Posts\Entities\Post whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Posts\Entities\Post whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Posts\Entities\Post whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Posts\Entities\Post whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Posts\Entities\Post whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\Modules\Posts\Entities\Post withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\Modules\Posts\Entities\Post withoutTrashed()
 */
	class Post extends \Eloquent {}
}

namespace Modules\Posts\Entities{
/**
 * Modules\Posts\Entities\FinnType
 *
 * @property int $id
 * @property string $ru
 * @property string $en
 * @property string $uk
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property-read string $name
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Posts\Entities\FinnType whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Posts\Entities\FinnType whereEn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Posts\Entities\FinnType whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Posts\Entities\FinnType whereRu($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Posts\Entities\FinnType whereUk($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Posts\Entities\FinnType whereUpdatedAt($value)
 */
	class FinnType extends \Eloquent {}
}

namespace Modules\Posts\Entities{
/**
 * Modules\Posts\Entities\InfoStatus
 *
 * @property int $id
 * @property string $en
 * @property string $ru
 * @property string $uk
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property-read string $name
 * @property-read \Illuminate\Database\Eloquent\Collection|\Modules\Posts\Entities\Post[] $posts
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Posts\Entities\InfoStatus whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Posts\Entities\InfoStatus whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Posts\Entities\InfoStatus whereEn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Posts\Entities\InfoStatus whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Posts\Entities\InfoStatus whereRu($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Posts\Entities\InfoStatus whereUk($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Posts\Entities\InfoStatus whereUpdatedAt($value)
 */
	class InfoStatus extends \Eloquent {}
}

namespace Modules\Posts\Entities{
/**
 * Modules\Posts\Entities\PostQuestionOption
 *
 * @property int $id
 * @property int $post_question_id
 * @property string $name
 * @property-read \Modules\Posts\Entities\PostQuestion $question
 * @property-read \Illuminate\Database\Eloquent\Collection|\Modules\Posts\Entities\PostQuestionVote[] $votes
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Posts\Entities\PostQuestionOption whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Posts\Entities\PostQuestionOption whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Posts\Entities\PostQuestionOption wherePostQuestionId($value)
 */
	class PostQuestionOption extends \Eloquent {}
}

namespace Modules\Posts\Entities{
/**
 * Modules\Posts\Entities\PostQuestion
 *
 * @property int $id
 * @property int $post_id
 * @property int|null $winner_id
 * @property \Carbon\Carbon|null $expiration_at
 * @property int $closed
 * @property int|null $default_option_id
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property-read \Modules\Posts\Entities\PostQuestionOption|null $default_option
 * @property-read bool $is_expired
 * @property-read mixed $not_vote_user_ids
 * @property-read mixed $url
 * @property-read mixed $votes_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\Modules\Users\Entities\Notification[] $notifications
 * @property-read \Illuminate\Database\Eloquent\Collection|\Modules\Posts\Entities\PostQuestionOption[] $options
 * @property-read \Modules\Posts\Entities\Post $post
 * @property-read \Illuminate\Database\Eloquent\Collection|\Modules\Posts\Entities\PostQuestionVote[] $votes
 * @property-read \Modules\Posts\Entities\PostQuestionOption|null $winner
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Query\Builder|\Modules\Posts\Entities\PostQuestion onlyTrashed()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Posts\Entities\PostQuestion whereClosed($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Posts\Entities\PostQuestion whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Posts\Entities\PostQuestion whereDefaultOptionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Posts\Entities\PostQuestion whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Posts\Entities\PostQuestion whereExpirationAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Posts\Entities\PostQuestion whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Posts\Entities\PostQuestion wherePostId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Posts\Entities\PostQuestion whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Posts\Entities\PostQuestion whereWinnerId($value)
 * @method static \Illuminate\Database\Query\Builder|\Modules\Posts\Entities\PostQuestion withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\Modules\Posts\Entities\PostQuestion withoutTrashed()
 */
	class PostQuestion extends \Eloquent {}
}

namespace Modules\Posts\Entities{
/**
 * Modules\Posts\Entities\FinancialInfo
 *
 * @property int $id
 * @property int $post_id
 * @property string|null $pdf_rr
 * @property string|null $pdf_mfo
 * @property string|null $pdf_card
 * @property string|null $pdf_bank
 * @property string|null $pdf_edrpoy
 * @property string|null $pdf_extradited
 * @property string|null $pdf_passport_code
 * @property string|null $pdf_passport_seria
 * @property string|null $pdf_identification
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property-read string $pdf_fio
 * @property-read string $pdf_phone
 * @property-read \Modules\Posts\Entities\Post $post
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Posts\Entities\FinancialInfo whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Posts\Entities\FinancialInfo whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Posts\Entities\FinancialInfo wherePdfBank($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Posts\Entities\FinancialInfo wherePdfCard($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Posts\Entities\FinancialInfo wherePdfEdrpoy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Posts\Entities\FinancialInfo wherePdfExtradited($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Posts\Entities\FinancialInfo wherePdfIdentification($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Posts\Entities\FinancialInfo wherePdfMfo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Posts\Entities\FinancialInfo wherePdfPassportCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Posts\Entities\FinancialInfo wherePdfPassportSeria($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Posts\Entities\FinancialInfo wherePdfRr($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Posts\Entities\FinancialInfo wherePostId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Posts\Entities\FinancialInfo whereUpdatedAt($value)
 */
	class FinancialInfo extends \Eloquent {}
}

namespace Modules\Main\Entities{
/**
 * Modules\Main\Entities\Page
 *
 * @property int $id
 * @property string $title
 * @property string|null $alias
 * @property string $text
 * @property int|null $order
 * @property int $hide
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Main\Entities\Page ordered()
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Main\Entities\Page published()
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Main\Entities\Page whereAlias($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Main\Entities\Page whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Main\Entities\Page whereHide($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Main\Entities\Page whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Main\Entities\Page whereOrder($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Main\Entities\Page whereText($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Main\Entities\Page whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Main\Entities\Page whereUpdatedAt($value)
 */
	class Page extends \Eloquent {}
}

