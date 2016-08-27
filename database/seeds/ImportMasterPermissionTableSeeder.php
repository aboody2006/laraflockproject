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

class ImportMasterPermissionTableSeeder extends Seeder
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
            'name' => 'Import Customers',
            'slug' => 'import_customers',
        ];

        $this->permission->create($customerPermission, false);
        $godownsPermission = [
            'name' => 'Import Godowns',
            'slug' => 'import_godowns',
        ];

        $this->permission->create($godownsPermission, false);
        $weightsPermission = [
            'name' => 'Import Weights',
            'slug' => 'import_weights',
        ];

        $this->permission->create($weightsPermission, false);

        $unitsPermission = [
            'name' => 'Import Units',
            'slug' => 'import_units',
        ];

        $this->permission->create($unitsPermission, false);
        $technicalsPermission = [
            'name' => 'Import Technicals',
            'slug' => 'import_technicals',
        ];

        $this->permission->create($technicalsPermission, false);

        $productsPermission = [
            'name' => 'Import Products',
            'slug' => 'import_products',
        ];
        $this->permission->create($productsPermission, false);
        $sectionsPermission = [
            'name' => 'Import Sections',
            'slug' => 'import_sections',
        ];

        $this->permission->create($sectionsPermission, false);
        $categoriesPermission = [
            'name' => 'Import Categories',
            'slug' => 'import_categories',
        ];

        $this->permission->create($categoriesPermission, false);
    }
}