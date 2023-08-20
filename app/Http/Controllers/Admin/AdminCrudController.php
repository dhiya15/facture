<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\AdminRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class AdminCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class AdminCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    public function setup()
    {
        $this->crud->setModel('App\Models\Admin');
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/admin');
        $this->crud->setEntityNameStrings('admin', 'admins');
    }

    protected function setupListOperation()
    {
        // TODO: remove setFromDb() and manually define Columns, maybe Filters
        //$this->crud->setFromDb();
        CRUD::addColumn([
            'name' => 'first_name',
            'label' => 'Nom',
            'wrapper' => [
                'class' => 'form-group col-md-4'
            ]
        ]);
        CRUD::addColumn([
            'name' => 'last_name',
            'label' => 'Prénom',
            'wrapper' => [
                'class' => 'form-group col-md-4'
            ]
        ]);
        CRUD::addColumn([
            'name' => 'email',
            'label' => 'Email',
            'wrapper' => [
                'class' => 'form-group col-md-4'
            ]
        ]);
        CRUD::addColumn([
            'name' => 'phone',
            'label' => 'Téléphone',
            'wrapper' => [
                'class' => 'form-group col-md-4'
            ]
        ]);
        CRUD::addColumn([
            'name' => 'username',
            'label' => 'Role',
            'wrapper' => [
                'class' => 'form-group col-md-4'
            ]
        ]);
    }

    protected function setupCreateOperation()
    {
        $this->crud->setValidation(AdminRequest::class);

        // TODO: remove setFromDb() and manually define Fields
        //$this->crud->setFromDb();
        CRUD::addField([
            'name' => 'first_name',
            'label' => 'Nom',
            'wrapper' => [
                'class' => 'form-group col-md-4'
            ]
        ]);
        CRUD::addField([
            'name' => 'last_name',
            'label' => 'Prénom',
            'wrapper' => [
                'class' => 'form-group col-md-4'
            ]
        ]);
        CRUD::addField([
            'name' => 'email',
            'label' => 'Email',
            'wrapper' => [
                'class' => 'form-group col-md-4'
            ]
        ]);
        CRUD::addField([
            'name' => 'phone',
            'label' => 'Téléphone',
            'wrapper' => [
                'class' => 'form-group col-md-4'
            ]
        ]);
        CRUD::addField([
            'name' => 'username',
            'label' => 'Role',
            'wrapper' => [
                'class' => 'form-group col-md-4'
            ]
        ]);
        CRUD::addField([
            'name' => 'password',
            'label' => 'Mot de passe',
            'wrapper' => [
                'class' => 'form-group col-md-4'
            ]
        ]);
    }

    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }
}
