<?php

use Illuminate\Database\Seeder;
use Laraflock\Dashboard\Repositories\Permission\PermissionRepositoryInterface as Permission;

class DeleteMasterPermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    /**
     * Permission interface.
     *
     * @var Permission
     */
    protected $permission;

    /**
     * The constructor.
     *
     * @param Permission $permission
     */
    public function __construct(Permission $permission)
    {
        $this->permission = $permission;
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $customerPermission = [
            'name' => 'Delete Customers',
            'slug' => 'delete_customers',
        ];

        $this->permission->create($customerPermission, false);
        $godownsPermission = [
            'name' => 'Delete Godowns',
            'slug' => 'delete_godowns',
        ];

        $this->permission->create($godownsPermission, false);
        $weightsPermission = [
            'name' => 'Delete Weights',
            'slug' => 'delete_weights',
        ];

        $this->permission->create($weightsPermission, false);

        $unitsPermission = [
            'name' => 'Delete Units',
            'slug' => 'delete_units',
        ];

        $this->permission->create($unitsPermission, false);
        $technicalsPermission = [
            'name' => 'Delete Technicals',
            'slug' => 'delete_technicals',
        ];

        $this->permission->create($technicalsPermission, false);

        $productsPermission = [
            'name' => 'Delete Products',
            'slug' => 'delete_products',
        ];
        $this->permission->create($productsPermission, false);
        $sectionsPermission = [
            'name' => 'Delete Sections',
            'slug' => 'delete_sections',
        ];

        $this->permission->create($sectionsPermission, false);
        $categoriesPermission = [
            'name' => 'Delete Categories',
            'slug' => 'delete_categories',
        ];

        $this->permission->create($categoriesPermission, false);
    }

}
