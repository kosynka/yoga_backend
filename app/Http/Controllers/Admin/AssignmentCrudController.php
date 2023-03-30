<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\AssignmentRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;

/**
 * Class AssignmentCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class AssignmentCrudController extends CrudController
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
        $this->crud->setModel(\App\Models\Assignment::class);
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/assignment');
        $this->crud->setEntityNameStrings('Запись', 'Записи');
    }

    /**
     * Define what happens when the List operation is loaded.
     * 
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        if (backpack_user()->id != 1) {
            $this->crud->denyAccess(['create', 'update', 'delete']);
        }
        $this->crud->setDefaultPageLength(50);
        $this->crud->orderBy('id');

        $this->crud->addColumn('id');
        $this->crud->addColumn([
            'name' => 'user',
            'label' => 'Пользователь',
            'type' => 'select',
            'attribute' => 'name',
        ]);
        if (backpack_user()->role == 'INSTRUCTOR') {
            $this->crud->addColumn([
                'name' => 'lesson',
                'label' => 'Урок',
                'type' => 'select',
                'attribute' => 'instrutorAttributes',
                'limit' => 1000,
            ]);
        } else {
            $this->crud->addColumn([
                'name' => 'lesson',
                'label' => 'Урок',
                'type' => 'select',
                'attribute' => 'attributes',
                'limit' => 1000,
            ]);
        }
    }

    /**
     * Define what happens when the Create operation is loaded.
     * 
     * @see https://backpackforlaravel.com/docs/crud-operation-create
     * @return void
     */
    protected function setupCreateOperation()
    {
        $this->crud->setValidation(AssignmentRequest::class);

        $this->crud->addField([
            'name' => 'user',
            'label' => 'Пользователь',
            'type' => 'select',
            'attribute' => 'onlyUsers',
        ]);
        $this->crud->addField([
            'name' => 'lesson',
            'label' => 'Урок',
            'type' => 'select',
            'attribute' => 'attributes',
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
