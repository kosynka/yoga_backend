<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\TypeRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;

/**
 * Class TypeCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class TypeCrudController extends CrudController
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
        $this->crud->setModel(\App\Models\Type::class);
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/type');
        $this->crud->setEntityNameStrings('Тип урока', 'Типы уроков');
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
        $this->crud->addColumn(['name' => 'description', 'label' => 'Описание']);
        $this->crud->addColumn(['name' => 'created_at', 'label' => 'Создан']);
    }

    /**
     * Define what happens when the Create operation is loaded.
     * 
     * @see https://backpackforlaravel.com/docs/crud-operation-create
     * @return void
     */
    protected function setupCreateOperation()
    {
        $this->crud->setValidation(TypeRequest::class);

        $this->crud->addField(['name' => 'name', 'label' => 'Название']);
        $this->crud->addField(['name' => 'description', 'label' => 'Описание']);
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
