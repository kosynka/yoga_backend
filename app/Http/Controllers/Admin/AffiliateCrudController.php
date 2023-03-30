<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\AffiliateRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;

/**
 * Class AffiliateCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class AffiliateCrudController extends CrudController
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
        $this->crud->setModel(\App\Models\Affiliate::class);
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/affiliate');
        $this->crud->setEntityNameStrings('Филиал', 'Филиалы');
    }

    protected function checkPermission()
    {
        return backpack_user()->id != 1 && backpack_user()->role == 'ADMIN';
    }

    /**
     * Define what happens when the List operation is loaded.
     * 
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        if ($this->checkPermission()) {
            $this->crud->addClause('where', 'master_id', '=', backpack_user()->id);
        }

        $this->crud->setDefaultPageLength(50);
        $this->crud->orderBy('id');

        $this->crud->addColumn('id');
        $this->crud->addColumn(['name' => 'name', 'label' => 'Название']);
        $this->crud->addColumn(['name' => 'phone', 'label' => 'Телефон']);
        if (backpack_user()->id == 1) {
            $this->crud->addColumn([
                'name' => 'master',
                'label' => 'Админ',
                'type' => 'select',
                'attribute' => 'name',
            ]);
        }
        $this->crud->addColumn(['name' => 'description', 'label' => 'Описание']);
        $this->crud->addColumn(['name' => 'link', 'label' => 'Ссылка']);
        $this->crud->addColumn(['name' => 'city', 'label' => 'Город']);
        $this->crud->addColumn([
            'label' => 'Изображение',
            'name' => 'image',
            'type' => 'view',
            'view' => 'partials/image',
            'upload' => true,
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
        $this->crud->setValidation(AffiliateRequest::class);

        $this->crud->addField(['name' => 'name', 'label' => 'Название']);
        $this->crud->addField(['name' => 'phone', 'label' => 'Телефон']);
        if (backpack_user()->id == 1) {
            $this->crud->addField([
                'name' => 'master',
                'label' => 'Админ',
                'type' => 'select',
                'attribute' => 'adminsFirst',
                'options' => (function ($query) {
                    return $query->orderBy('role')->get();
                })
            ]);
        }
        $this->crud->addField(['name' => 'description', 'label' => 'Описание']);
        $this->crud->addField(['name' => 'link', 'label' => 'Ссылка']);
        $this->crud->addField(['name' => 'city', 'label' => 'Город']);
        $this->crud->addField([
            'name' => 'image',
            'label' => 'Изображение',
            'type' => 'upload',
            'upload' => true,
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

        $this->crud->addColumn(['name' => 'created_at', 'label' => 'Создан']);
    }
}
