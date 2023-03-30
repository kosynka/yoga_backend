<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\UserRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;

/**
 * Class UserCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class UserCrudController extends CrudController
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
        $this->crud->setModel(\App\Models\User::class);
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/user');
        $this->crud->setEntityNameStrings('Пользователя', 'Пользователи');
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
            'name' => 'role',
            'label' => 'Роль',
            'type' => 'enum',
            'options' => [
                'ADMIN' => 'Админ',
                'INSTRUCTOR' => 'Инструктор',
                'USER' => 'Пользователь',
            ],
        ]);
        $this->crud->addColumn(['name' => 'name', 'label' => 'Имя']);
        $this->crud->addColumn(['name' => 'description', 'label' => 'Описание', 'limit' => 1000]);
        $this->crud->addColumn(['name' => 'phone', 'label' => 'Телефон']);
        $this->crud->addColumn([
            'name' => 'favoriteAffiliate',
            'label' => 'Любимый филиал',
            'type' => 'select',
            'entity' => 'favoriteAffiliate',
            'model' => '\App\Models\Affiliate::class',
            'attribute' => 'name',
        ]);
        $this->crud->addColumn([
            'name' => 'worksInAffiliate',
            'label' => 'Работает в филиале',
            'type' => 'select',
            'entity' => 'worksInAffiliate',
            'model' => '\App\Models\Affiliate::class',
            'attribute' => 'name',
        ]);
        $this->crud->addColumn([
            'name' => 'masterOfAffiliate',
            'label' => 'Админ в',
            'type' => 'select',
            'entity' => 'masterOfAffiliate',
            'model' => '\App\Models\Affiliate::class',
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
        $this->crud->setValidation(UserRequest::class);

        $this->crud->addField([
            'name' => 'role',
            'label' => 'Роль',
            'type' => 'enum',
            'options' => [
                'ADMIN' => 'Админ',
                'INSTRUCTOR' => 'Инструктор',
                'USER' => 'Пользователь',
            ],
        ]);
        $this->crud->addField(['name' => 'name', 'label' => 'Имя']);
        $this->crud->addField(['name' => 'description', 'label' => 'Описание']);
        $this->crud->addField(['name' => 'phone', 'label' => 'Телефон']);
        $this->crud->addField([
            'name' => 'favoriteAffiliate',
            'label' => 'Любимый филиал',
            'type' => 'select',
            'entity' => 'favoriteAffiliate',
            'attribute' => 'name',
        ]);
        $this->crud->addField([
            'name' => 'worksInAffiliate',
            'label' => 'Работает в филиале',
            'type' => 'select',
            'entity' => 'worksInAffiliate',
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

        $this->crud->addColumn(['name' => 'created_at', 'label' => 'Зарегистрировался']);
    }
}
