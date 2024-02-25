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

    const ROLES_MANAGERS = [
        self::ROLE_SUPERADMIN => 'superadmin',
        self::ROLE_ADMIN => 'admin',
        self::ROLE_MANAGER => 'manager',
    ];

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

    public static function getUserInfo()
    {
        return session('user');
    }

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

    public static function getClasses()
    {
        $client = new ApiService();
        $response = $client->get('admin/classes');
        $items = [];
        if ($response->success) {
            $items = $response->data['classes'];
        }

        return $items;
    }

    public static function getTeachers($school = null)
    {
        $client = new ApiService();
        $response = $client->get('admin/users', ['role' => User::ROLE_TEACHER, 'school_id' => $school, 'order' => 'name']);
        $items = [];
        if ($response->success) {
            $items = $response->data['users'];
        }

        return $items;
    }

    public static function getParents($school = null)
    {
        $client = new ApiService();
        $response = $client->get('admin/users', ['role' => User::ROLE_PARENT, 'school_id' => $school, 'minimal' => 1, 'order' => 'name']);
        $items = [];
        if ($response->success) {
            $items = $response->data['users'];
        }

        return $items;
    }

    public static function getUser($id)
    {
        $client = new ApiService();
        $response = $client->get("admin/users/{$id}");
        $item = null;
        if ($response->success) {
            $item = $response->data['users'];
        }

        return $item;
    }

    public static function getStudents()
    {
        $client = new ApiService();
        $response = $client->get("admin/students", ['order' => 'id', 'sort' => 'desc']);
        $item = null;
        if ($response->success) {
            $item = $response->data['students'];
        }

        return $item;
    }

    public static function getBuses($status = null)
    {
        $client = new ApiService();
        $response = $client->get("admin/buses", $status ? ['status' => $status] : null);
        $item = null;
        if ($response->success) {
            $item = $response->data;
        }

        return $item;
    }

    public static function getFoodMenu($school = null)
    {
        $client = new ApiService();
        $response = $client->get("admin/food-menu", $school ? ['school' => $school] : null);
        $item = null;
        if ($response->success) {
            $item = $response->data;
        }

        return $item;
    }
}
