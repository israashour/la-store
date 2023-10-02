<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Role extends Model
{
    use HasFactory;

    protected $fillable = [
        'name'
    ];

    public static function createWithAbilities(Request $request)
    {
        DB::beginTransaction();
        try{
            $role = Role::create([
            'name' => $request->post('name'),
        ]);

        foreach ($request->post('permissions') as $permission => $value) {
            RolePermission::create([
                'role_id' => $role->id,
                'permission' => $permission,
                'type' => $value,
            ]);
        }
        } catch(\Exception $e) {
            DB::rollBack();
            throw $e;
        }

        return $role;
    }

    public function permissions()
    {
        return $this->hasMany(RolePermission::class);
    }

    public function updateWithAbilities(Request $request)
    {
        DB::beginTransaction();
        try{
            $this->update([
            'name' => $request->post('name'),
        ]);

        foreach ($request->post('permissions') as $permission => $value) {
            RolePermission::updateOrCreate([
                'role_id' => $this->id,
                'permission_id' => $permission,
            ],[
                'type' => $value,
            ]);
        }
        } catch(\Exception $e) {
            DB::rollBack();
            throw $e;
        }

        return $this;
    }
}
