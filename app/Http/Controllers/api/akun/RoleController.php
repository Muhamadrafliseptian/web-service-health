<?php

namespace App\Http\Controllers\api\akun;

use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Resources\GetRoleResource;

class RoleController extends Controller
{
    public function index(Request $request){
        return DB::transaction(function () use($request) {
            $role = Role::orderBy("created_at", "DESC")->paginate($request->per_page);

            return GetRoleResource::collection($role);
        });

    }
}
