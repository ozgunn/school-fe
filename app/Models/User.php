<?php

namespace App\Models;

use App\Http\Services\ApiService;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    const ROLE_SUPERADMIN = 101;
    const ROLE_ADMIN = 100;
    const ROLE_MANAGER = 50;
    const ROLE_TEACHER = 20;
    const ROLE_PARENT = 10;
    const STATUS_ACTIVE = 10;
    const STATUS_PENDING = 0;
    const STATUSES = [
        self::STATUS_PENDING => 'Pending',
        self::STATUS_ACTIVE => 'Active',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'phone_number',
        'email',
        'id',
        'role',
        'language',
        'status',
        'image',
        'created_at',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'created_at' => 'datetime',
    ];

    public static function getSchools()
    {
        $client = new ApiService();
        $response = $client->get('admin/schools');
        $schools = [];
        if ($response->success) {
            $schools = $response->data['schools'];
        }

        return $schools;
    }

    public static function getGroups()
    {
        $client = new ApiService();
        $response = $client->get('admin/groups');
        $items = [];
        if ($response->success) {
            $items = $response->data['groups'];
        }

        return $items;
    }

    public static function getTeachers($school = null)
    {
        $client = new ApiService();
        $response = $client->get('admin/users', ['role' => User::ROLE_TEACHER, 'school_id' => $school]);
        $items = [];
        if ($response->success) {
            $items = $response->data['users'];
        }

        return $items;
    }
}
