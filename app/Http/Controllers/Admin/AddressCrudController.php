<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\AddressRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;

/**
 * Class AddressCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class AddressCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     * 
     * @return void
     */
    public function setup()
    {
        $this->crud->setModel(\App\Models\Address::class);
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/address');
        $this->crud->setEntityNameStrings('Адрес', 'Адреса');
    }

    /**
     * Define what happens when the List operation is loaded.
     * 
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        $this->crud->setDefaultPageLength(50);
        $this->crud->orderBy('id');

        $this->crud->addColumn('id');
        $this->crud->addColumn(['name' => 'name', 'label' => 'Название']);
        $this->crud->addColumn([
            'name' => 'affiliate',
            'label' => 'Филиал',
            'type' => 'select',
            'attribute' => 'name',
        ]);
    }

    /**
     * Define what happens when the Create operation is loaded.
     * 
     * @see https://backpackforlaravel.com/docs/crud-operation-create
     * @return void
     */
    protected function setupCreateOperation()
    {
        $this->crud->setValidation(AddressRequest::class);

        $this->crud->addField(['name' => 'name', 'label' => 'Название']);
        $this->crud->addField([
            'name' => 'affiliate',
            'label' => 'Филиал',
            'type' => 'select',
            'attribute' => 'name',
        ]);
    }

    /**
     * Define what happens when the Update operation is loaded.
     * 
     * @see https://backpackforlaravel.com/docs/crud-operation-update
     * @return void
     */
    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }

    protected function setupShowOperation()
    {
        $this->setupListOperation();
    }
}
