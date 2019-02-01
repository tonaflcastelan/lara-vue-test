<?php

namespace App\Http\Controllers;

use App\Role;
use App\Http\Requests\StoreRole;
use Illuminate\Http\Request;
use App\Http\Requests\StoreRole as SR;

class RolesController extends Controller
{

    public function index()
    {
        return Role::all()->toArray();
    }

	/**
     * @method store
     * @description Método para guardar un nuevo rol
     * @param (array) $request
     * @return (json)
     **/
    public function store(SR $request)
    {
    	$role = Role::create(array_merge($request->all(), ['status' => '1']));
        return response()->json('Rol agregado correctmente', 200);
    }

    /**
     * @method destroy
     * @description Método para eliminar un rol
     * @param (int) $id
     * @return (json)
     **/
    public function destroy($id)
    {
    	$role = Role::find($id);

    	if (!$role) {
    		return response()->json(['error' => true, 'message' => 'Usuario con ' . $id . ' no se encontró'], 400);
    	}

    	$role->delete();
        return response()->json('Rol elimiando correctamente', 200);
    }

    /**
     * @method edit
     * @description Método para obtener el rol
     * @param (int) $id
     * @return (json)
     **/
    public function edit($id)
    {
        $role = Role::find($id);

        if (!$role) {
            return response()->json(['error' => true, 'message' => 'Usuario con ' . $id . ' no se encontró'], 400);
        }
        return response()->json($role);
    }

    /**
     * @method update
     * @description Nétodo para actualizar un rol
     * @param (array) $request
     * @param (int) $id
     * @return (json)
     **/
    public function update(SR $request, $id)
    {
        $role = Role::find($id);

        if (!$role) {
    		return response()->json(['error' => true, 'message' => 'Usuario con ' . $id . ' no se encontró'], 400);
    	}

        $role->update($request->all());
        return response()->json('Rol editado correctamente', 200);
    }
}
