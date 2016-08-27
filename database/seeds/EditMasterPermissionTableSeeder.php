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

class EditMasterPermissionTableSeeder extends Seeder
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
            'name' => 'Edit Customers',
            'slug' => 'edit_customers',
        ];

        $this->permission->create($customerPermission, false);
        $godownsPermission = [
            'name' => 'Edit Godowns',
            'slug' => 'edit_godowns',
        ];

        $this->permission->create($godownsPermission, false);
        $weightsPermission = [
            'name' => 'Edit Weights',
            'slug' => 'edit_weights',
        ];

        $this->permission->create($weightsPermission, false);

        $unitsPermission = [
            'name' => 'Edit Units',
            'slug' => 'edit_units',
        ];

        $this->permission->create($unitsPermission, false);
        $technicalsPermission = [
            'name' => 'Edit Technicals',
            'slug' => 'edit_technicals',
        ];

        $this->permission->create($technicalsPermission, false);

        $productsPermission = [
            'name' => 'Edit Products',
            'slug' => 'edit_products',
        ];
        $this->permission->create($productsPermission, false);
        $sectionsPermission = [
            'name' => 'Edit Sections',
            'slug' => 'edit_sections',
        ];

        $this->permission->create($sectionsPermission, false);
        $categoriesPermission = [
            'name' => 'Edit Categories',
            'slug' => 'edit_categories',
        ];

        $this->permission->create($categoriesPermission, false);
    }
}