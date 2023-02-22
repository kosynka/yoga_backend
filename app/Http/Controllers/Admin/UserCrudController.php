<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\UserRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

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
        CRUD::setModel(\App\Models\User::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/user');
        CRUD::setEntityNameStrings('Пользователя', 'Пользователи');
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

        CRUD::column('id');
        CRUD::column('role')->label('Роль')->type('enum')->options(
            [
                'ADMIN' => 'Админ',
                'INSTRUCTOR' => 'Инструктор',
                'USER' => 'Пользователь',
            ]
        );
        CRUD::column('name')->label('Имя');
        CRUD::column('phone')->label('Телефон');
        CRUD::column('photo')->label('Фото')->type('image')->prefix('storage/')->height('60px')->width('60px');
        CRUD::column('favoriteAffiliate')->label('Любимый филиал');
        CRUD::column('assignments')->label('Записи');
        CRUD::column('worksInAffiliate')->label('Работат в филиале');
        CRUD::column('lessons')->label('Созданные уроки');
    }

    /**
     * Define what happens when the Create operation is loaded.
     * 
     * @see https://backpackforlaravel.com/docs/crud-operation-create
     * @return void
     */
    protected function setupCreateOperation()
    {
        CRUD::setValidation(UserRequest::class);

        CRUD::field('role')->label('Роль')->type('enum')->options(
            [
                'ADMIN' => 'Админ',
                'INSTRUCTOR' => 'Инструктор',
                'USER' => 'Пользователь',
            ]
        );
        CRUD::field('name')->label('Имя');
        CRUD::field('phone')->label('Телефон');
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
}
