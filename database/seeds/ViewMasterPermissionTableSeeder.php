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

class ViewMasterPermissionTableSeeder extends Seeder
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
            'name' => 'View Customers',
            'slug' => 'view_customers',
        ];

        $this->permission->create($customerPermission, false);
        $godownsPermission = [
            'name' => 'View Godowns',
            'slug' => 'view_godowns',
        ];

        $this->permission->create($godownsPermission, false);
        $weightsPermission = [
            'name' => 'View Weights',
            'slug' => 'view_weights',
        ];

        $this->permission->create($weightsPermission, false);

        $unitsPermission = [
            'name' => 'View Units',
            'slug' => 'view_units',
        ];

        $this->permission->create($unitsPermission, false);
        $technicalsPermission = [
            'name' => 'View Technicals',
            'slug' => 'view_technicals',
        ];

        $this->permission->create($technicalsPermission, false);

        $productsPermission = [
            'name' => 'View Products',
            'slug' => 'view_products',
        ];
        $this->permission->create($productsPermission, false);
        $sectionsPermission = [
            'name' => 'View Sections',
            'slug' => 'view_sections',
        ];

        $this->permission->create($sectionsPermission, false);
        $categoriesPermission = [
            'name' => 'View Categories',
            'slug' => 'view_categories',
        ];

        $this->permission->create($categoriesPermission, false);
    }
}