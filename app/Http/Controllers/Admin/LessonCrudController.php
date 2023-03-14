<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\LessonRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;

/**
 * Class LessonCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class LessonCrudController extends CrudController
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
        $this->crud->setModel(\App\Models\Lesson::class);
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/lesson');
        $this->crud->setEntityNameStrings('Урок', 'Уроки');
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
        $this->crud->addColumn([
            'name' => 'type',
            'label' => 'Тип урока',
            'type' => 'select',
            'attribute' => 'name',
        ]);
        $this->crud->addColumn([
            'name' => 'instructor',
            'label' => 'Инструктор',
            'type' => 'select',
            'attribute' => 'name',
        ]);
        $this->crud->addColumn(['name' => 'starts_at', 'label' => 'Начало занятия']);
        $this->crud->addColumn(['name' => 'continuance', 'label' => 'Минут']);
        $this->crud->addColumn(['name' => 'participants_limitation', 'label' => 'Ограничение кол-ва людей']);
        $this->crud->addColumn(['name' => 'comment', 'label' => 'Комментарий']);
    }

    /**
     * Define what happens when the Create operation is loaded.
     * 
     * @see https://backpackforlaravel.com/docs/crud-operation-create
     * @return void
     */
    protected function setupCreateOperation()
    {
        $this->crud->setValidation(LessonRequest::class);

        $this->crud->addField([
            'name' => 'type',
            'label' => 'Тип урока',
            'type' => 'select',
            'attribute' => 'name',
        ]);
        $this->crud->addField([
            'name' => 'instructor',
            'label' => 'Инструктор',
            'type' => 'select',
            'attribute' => 'onlyUsers',
        ]);
        $this->crud->addField(['name' => 'starts_at', 'label' => 'Начало занятия']);
        $this->crud->addField(['name' => 'continuance', 'label' => 'Минут']);
        $this->crud->addField(['name' => 'participants_limitation', 'label' => 'Ограничение кол-ва людей']);
        $this->crud->addField(['name' => 'comment', 'label' => 'Комментарий']);
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
