<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\AffiliateBannerRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;

/**
 * Class AffiliateBannerCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class AffiliateBannerCrudController extends CrudController
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
        $this->crud->setModel(\App\Models\AffiliateBanner::class);
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/affiliate-banner');
        $this->crud->setEntityNameStrings('affiliate banner', 'affiliate banners');
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
        $this->crud->orderBy('affiliate_id');

        $this->crud->addColumn('id');
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
        $this->crud->setValidation(AffiliateBannerRequest::class);

        $this->crud->addField([
            'name' => 'affiliate',
            'label' => 'Филиал',
            'type' => 'select',
            'attribute' => 'name',
        ]);
        $this->crud->addField([
            'name' => 'image',
            'label' => 'Изображение',
            'type' => 'select',
            'attribute' => 'path',
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
