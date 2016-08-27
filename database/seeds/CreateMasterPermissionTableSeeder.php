<?php

/**
 * @package     Dashboard
 * @author      Ian Olson <me@ianolson.io>
 * @license     MIT
 * @copyright   2015, Laraflock
 * @link        https://github.com/laraflock
 */

use Illuminate\Database\Seeder;
use Laraflock\Dashboard\Repositories\Permission\PermissionRepositoryInterface as Permission;

class CreateMasterPermissionTableSeeder extends Seeder
{
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
            'name' => 'Create Customers',
            'slug' => 'create_customers',
        ];

        $this->permission->create($customerPermission, false);
        $godownsPermission = [
            'name' => 'Create Godowns',
            'slug' => 'create_godowns',
        ];

        $this->permission->create($godownsPermission, false);
        $weightsPermission = [
            'name' => 'Create Weights',
            'slug' => 'create_weights',
        ];

        $this->permission->create($weightsPermission, false);

        $unitsPermission = [
            'name' => 'Create Units',
            'slug' => 'create_units',
        ];

        $this->permission->create($unitsPermission, false);
        $technicalsPermission = [
            'name' => 'Create Technicals',
            'slug' => 'create_technicals',
        ];

        $this->permission->create($technicalsPermission, false);

        $productsPermission = [
            'name' => 'Create Products',
            'slug' => 'create_products',
        ];
        $this->permission->create($productsPermission, false);
        $sectionsPermission = [
            'name' => 'Create Sections',
            'slug' => 'create_sections',
        ];

        $this->permission->create($sectionsPermission, false);
        $categoriesPermission = [
            'name' => 'Create Categories',
            'slug' => 'create_categories',
        ];

        $this->permission->create($categoriesPermission, false);
    }
}