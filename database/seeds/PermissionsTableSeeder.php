<?php

use Illuminate\Database\Seeder;
use Caffeinated\Shinobi\Models\Permission;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //MÓDULOS
        Permission::create([
            'name' => 'Módulo Dashboard',
            'slug' => 'dashboard.index',
            'description' => 'Ver Módulo Dashboard',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()            
        ]);
        Permission::create([
            'name' => 'Módulo Sistema',
            'slug' => 'sistema.index',
            'description' => 'Ver Módulo de Sistemas (roles,Usuarios,configuraciones, etc.',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()            
        ]);
        Permission::create([
            'name' => 'Módulo Personal',
            'slug' => 'personal.index',
            'description' => 'Ver Módulo para el Mantenimiento del Personal',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()            
        ]);
        Permission::create([
            'name' => 'Módulo Préstamos',
            'slug' => 'prestamos.index',
            'description' => 'Ver Módulo de Préstamos y Cobros a Clientes ',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()            
        ]);        
        Permission::create([
            'name' => 'Ver Home',
            'slug' => 'home.index',
            'description' => 'Ver Vista Home-Principal ',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()            
        ]);

        //MODELOS, CONTROLLER Y RESOURCES
        //modelo ROLE        
        Permission::create([
            'name' => 'Ver Roles',
            'slug' => 'roles.index',
            'description' => 'Ver Vista Roles ',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()            
        ]);
        Permission::create([
            'name' => 'Nuevo Rol',
            'slug' => 'roles.create',
            'description' => 'Crear un Nuevo Rol ',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()            
        ]);        
        Permission::create([
            'name' => 'Mostar Role',
            'slug' => 'roles.show',
            'description' => 'Mostrar Datos de un Rol Seleccionado ',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()            
        ]);
        Permission::create([
            'name' => 'Editar Roles',
            'slug' => 'roles.edit',
            'description' => 'Editar Datos de un Rol Seleccionado',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()            
        ]);
        Permission::create([
            'name' => 'Eliminar Roles',
            'slug' => 'roles.destroy',
            'description' => 'Eliminar registro de un Rol seleccionado ',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()            
        ]);

        //Modelo USER       
        Permission::create([
            'name' => 'Ver Usuarios',
            'slug' => 'users.index',
            'description' => 'Ver Vista de Usuarios ',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()            
        ]);
        Permission::create([
            'name' => 'Nuevo Usuario',
            'slug' => 'users.create',
            'description' => 'Crear un Nuevo Usuario',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()            
        ]);
        Permission::create([
            'name' => 'Mostrar Usuarios',
            'slug' => 'users.show',
            'description' => 'Mostar Datos de un Usuario seleccionado',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()            
        ]);
        Permission::create([
            'name' => 'Editar Usuarios',
            'slug' => 'users.edit',
            'description' => 'Editar Datos de un Usuario Seleccionado',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()            
        ]);
        Permission::create([
            'name' => 'Eliminar Usuarios',
            'slug' => 'users.destroy',
            'description' => 'Eliminar Registro de un Usuario Seleccionado ',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()            
        ]);

        //Modelo Permisos
        Permission::create([
            'name' => 'Ver Permisos',
            'slug' => 'permissions.index',
            'description' => 'Ver Vista de Permisos ',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()            
        ]);
        Permission::create([
            'name' => 'Nuevo Permisos',
            'slug' => 'permissions.create',
            'description' => 'Crear un Nuevo Permiso ',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()            
        ]);
        Permission::create([
            'name' => 'Mostrar Permisos',
            'slug' => 'permissions.show',
            'description' => 'Mostrar Datos de un Permiso Seleccionado',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()            
        ]);
        Permission::create([
            'name' => 'Editar Permisos',
            'slug' => 'permissions.edit',
            'description' => 'Editar Datos de un Permiso Seleccionado',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()            
        ]);
        Permission::create([
            'name' => 'Eliminar Permisos',
            'slug' => 'permissions.destroy',
            'description' => 'Eliminar registro de un Permiso Eliminado',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()            
        ]);
    
        //MOdelo PermisoRoles
        Permission::create([
            'name' => 'Ver Permisos/Roles',
            'slug' => 'permissionroles.index',
            'description' => 'Ver Vista de Permisos/Roles ',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()            
        ]);
        Permission::create([
            'name' => 'Mostrar Permisos/Roles',
            'slug' => 'permissionroles.show',
            'description' => 'Mostrar listado de Permisos/Rol ',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()            
        ]);
        Permission::create([
            'name' => 'Editar Permisos/Roles',
            'slug' => 'permissionroles.edit',
            'description' => 'Editar listado de Permisos/Rol ',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()            
        ]);

        //Modelo Permisos/Users
        Permission::create([
            'name' => 'Ver Permisos/Ususuarios',
            'slug' => 'permissionusers.index',
            'description' => 'Ver Vista de Permisos/Usuarios ',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()            
        ]);
        Permission::create([
            'name' => 'Mostrar Permisos/Ususuarios',
            'slug' => 'permissionusers.show',
            'description' => 'Mostrar Permisos/Usuarios Asignados ',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()            
        ]);
        Permission::create([
            'name' => 'Editar Permisos/Ususuarios',
            'slug' => 'permissionusers.edit',
            'description' => 'Editar Permisos/Usuarios Asignados ',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()            
        ]);

        //Modelo Personal
        Permission::create([
            'name' => 'Ver Personal',
            'slug' => 'personals.index',
            'description' => 'Ver Vista del Personal ',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()            
        ]);
        Permission::create([
            'name' => 'Nuevo Personal',
            'slug' => 'personals.create',
            'description' => 'Crear un Nuevo Personal',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()            
        ]);
        Permission::create([
            'name' => 'Mostrar Personal',
            'slug' => 'personals.show',
            'description' => 'Mostrar datos de un Personal seleccionado',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()            
        ]);
        Permission::create([
            'name' => 'Editar Personal',
            'slug' => 'personals.edit',
            'description' => 'Editar datos de un Personal seleccionado',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()            
        ]);
        Permission::create([
            'name' => 'Eliminar Personal',
            'slug' => 'personals.destroy',
            'description' => 'Eliminar registro de un Personal seleccionado',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()            
        ]);

        //Módulo de Adelantos / Personal
        Permission::create([
            'name' => 'Ver Adelanto Personal',
            'slug' => 'personaladelantos.index',
            'description' => 'Ver Vista de Adelantos al Personal ',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()            
        ]);
        Permission::create([
            'name' => 'Nuevo Adelanto Personal',
            'slug' => 'personaladelantos.create',
            'description' => 'Crear Nuevo Adelando al Personal seleccionado',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()            
        ]);
        Permission::create([
            'name' => 'Mostrar Adelanto Personal',
            'slug' => 'personaladelantos.show',
            'description' => 'Mostrar Adelantos de Personal Seleccionado',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()            
        ]);
        Permission::create([
            'name' => 'Editar Adelanto Personal',
            'slug' => 'personaladelantos.edit',
            'description' => 'Editar Adelantos de Personal Seleccionado',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()            
        ]);
        Permission::create([
            'name' => 'Eliminar Adelanto Personal',
            'slug' => 'personaladelantos.destroy',
            'description' => 'Ver Vista de Adelantos al Personal ',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()            
        ]);

        //Modelo Pagos Personal
        Permission::create([
            'name' => 'Ver Pagos Personal',
            'slug' => 'personalsalarios.index',
            'description' => 'Ver Vista de Pagos al Personal',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()            
        ]);
        Permission::create([
            'name' => 'Nuevo Pagos Personal',
            'slug' => 'personalsalarios.create',
            'description' => 'Agregar nuevo Pago al Personal',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()            
        ]);
        Permission::create([
            'name' => 'Mostar Pagos Personal',
            'slug' => 'personalsalarios.show',
            'description' => 'Mostar Pagos del Personal seleccionado',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()            
        ]);
        Permission::create([
            'name' => 'Editar Pagos Personal',
            'slug' => 'personalsalarios.edit',
            'description' => 'Editar Pagos del Personal Seleccionado',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()            
        ]);
        Permission::create([
            'name' => 'Eliminar Pagos Personal',
            'slug' => 'personalsalarios.destroy',
            'description' => 'Eliminar Registro de Pago al Personal',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()            
        ]);
        
        //Modulo Clientes
        Permission::create([
            'name' => 'Ver Clientes',
            'slug' => 'clientes.index',
            'description' => 'Ver vista de Clientes',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()            
        ]);
        Permission::create([
            'name' => 'Nuevo Cliente',
            'slug' => 'clientes.create',
            'description' => 'Agregar nuevo Cliente',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()            
        ]);
        Permission::create([
            'name' => 'Mostrar Cliente',
            'slug' => 'clientes.show',
            'description' => 'Mostrar Datos de un Cliente seleccionado',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()            
        ]);
        Permission::create([
            'name' => 'Editar Clientes',
            'slug' => 'clientes.edit',
            'description' => 'Editar Datos de un Cliente seleccionado',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()            
        ]);
        Permission::create([
            'name' => 'Eliminar Clientes',
            'slug' => 'clientes.destroy',
            'description' => 'Eliminar',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()            
        ]);
        
        //MOdulo de Asignar Montos al Personal
        Permission::create([
            'name' => 'Ver Asignación Montos',
            'slug' => 'personalmontos.index',
            'description' => 'Ver Vista de Asignación de Montos al Personal',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()            
        ]);
        Permission::create([
            'name' => 'Nuevo Asignación Monto',
            'slug' => 'personalmontos.create',
            'description' => 'Asignar un nuevo Monto al Personal',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()            
        ]);
        Permission::create([
            'name' => 'Mostrar Asignación Montos',
            'slug' => 'personalmontos.show',
            'description' => 'Mostrar Montos Asignado al personal',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()            
        ]);
        Permission::create([
            'name' => 'Editar Asignación Montos',
            'slug' => 'personalmontos.edit',
            'description' => 'Editar Datos de Montos Asignados al Personal',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()            
        ]);
        Permission::create([
            'name' => 'Eliminar Asignación Montos',
            'slug' => 'personalmontos.destroy',
            'description' => 'Eliminar registro de un Monto Asignado al Personal',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()            
        ]);

        //Modulo Préstamos Clientes
        Permission::create([
            'name' => 'Ver Préstamos Clientes',
            'slug' => 'clienteprestamos.index',
            'description' => 'Ver Vista de Préstamos a Clientes ',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()            
        ]);
        Permission::create([
            'name' => 'Nuevo Préstammo a Cliente',
            'slug' => 'clienteprestamos.create',
            'description' => 'Añadir nuevo Préstamo a Clientes',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()            
        ]);
        Permission::create([
            'name' => 'Mostrar Préstamos Cliente',
            'slug' => 'clienteprestamos.show',
            'description' => 'Mostrar Datos de un Préstamo realizado al Clietne ',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()            
        ]);
        Permission::create([
            'name' => 'Editar Préstamos Cliente',
            'slug' => 'clienteprestamos.edit',
            'description' => 'Edtiar Datos de un Préstamo realizado al Cliente ',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()            
        ]);
        Permission::create([
            'name' => 'Eliminar Préstamos Cliente',
            'slug' => 'clienteprestamos.destroy',
            'description' => 'Eliminar Registro de un pŕestamo a Clientte',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()            
        ]);
        
    }
}
