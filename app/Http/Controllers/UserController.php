<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Gate;

/**
 * Class UserController
 * @package App\Http\Controllers
 */
class UserController extends Controller
{
    use HasRoles;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Gate::allows('supers')) {
            $users = User::paginate();

            return view('user.index', compact('users'))
                ->with('i', (request()->input('page', 1) - 1) * $users->perPage());
        } elseif (Gate::allows('admins')) {
            abort(403);
        } else {
            abort(403); // Mostrar un error 403 si el usuario no tiene permiso
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $user = new User();
        $user->assignRole('digitador');
        return view('user.create', compact('user'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            // Validar los datos del formulario
            request()->validate(User::$rules);

            // Crear el usuario con los datos del formulario
            $user = User::create($request->all());

            // Obtener el rol seleccionado del formulario
            $role = $request->input('role');

            // Asignar el rol correspondiente al usuario

                $user->assignRole($role);


            // Redirigir a la página de índice de usuarios con un mensaje de éxito
            return redirect()->route('users.index')
                ->with('success', 'Usuario creado exitosamente.');
        } catch (QueryException $e) {
            // Verificar si la excepción es por una clave única duplicada
            if ($e->errorInfo[1] === 1062) {
                // Asignar un mensaje de error a la sesión
                session()->flash('error', 'El correo electrónico ya está en uso.');
                // Redirigir de nuevo al formulario de creación con los datos anteriores
                return redirect()->back()->withInput();
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);

        return view('user.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);

        return view('user.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  User $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        request()->validate(User::$rules);

        $user->update($request->all());

        return redirect()->route('users.index')
            ->with('success', 'User updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $user = User::find($id);

        if (!$user) {
            return redirect()->route('user.index')->with('error', 'Usuario no encontrado.');
        }

        $user->estado = $user->estado == 0 ? 1 : 0;
        $user->save();

        $message = $user->estado == 0 ? 'Usuario marcado como inactivo.' : 'Usuario marcado como activo.';

        return redirect()->route('users.index')->with('success', $message);
    }
}
