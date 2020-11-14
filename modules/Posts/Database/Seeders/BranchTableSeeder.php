<?php

namespace Modules\Posts\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Posts\Entities\Branch;
use Modules\Users\Entities\Group;
use Modules\Users\Entities\Permission;
use Modules\Users\Entities\User;

class BranchTableSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $branches = [
            'Основная инфолента' => [
                'group_id'    => 1,
                'permissions' => [
                    'readonly',
                    'store',
                    'store_comment',
                    'notification'
                ],
                'type'        => Branch::TYPE_POST,
                'children'    => [
                    'Заявки на финпомощь' => Branch::TYPE_FINN_HELP
                ]
            ],
            'Библиотека'         => [
                'group_id'    => 1,
                'permissions' => [
                    'readonly',
                    'store',
                    'store_comment',
                    'notification'
                ],
                'type'        => Branch::TYPE_DOCUMENT
            ]
        ];

        foreach (Group::all() as $group) {
            if ($group->id == 1) {
                continue;
            }
            $permission_names = Permission::inRandomOrder()->limit(2)->get()->pluck('name');

            $branches[$group->name.' '.implode(', ', $permission_names->toArray())] = [
                'group_id'    => $group->id,
                'permissions' => $permission_names,
                'type'        => Branch::TYPE_POST
            ];
        }

        Branch::truncate();

        $this->makeBranches($branches);
    }

    private function makeBranches($branches, $parent_id = 0)
    {
        foreach ($branches as $branch_name => $data) {

            if (! Branch::where('name', $branch_name)->first()) {

                $branch = Branch::create([
                    'name'      => $branch_name,
                    'parent_id' => $parent_id,
                    'type'      => $data['type']
                ]);

                $group = Group::find($data['group_id']);

                foreach ($data['permissions'] as $permission_name) {
                    $permission = Permission::where('name', $permission_name)->first();
                    $group->attachBranchPermission($branch, $permission);
                }

                if (isset($data['children']) && $data['children']) {
                    foreach ($data['children'] as $child => $type) {
                        $branch->children()->create([
                            'name'       => $child,
                            'type'       => $type,
                            'is_inherit' => true
                        ]);
                    }
                }

            }
        }
    }
}
