<?php

namespace Modules\Documents\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Documents\Entities\Document;
use Faker\Factory as Faker;
use Modules\Users\Entities\User;
use Modules\Posts\Entities\Tag;
use Modules\Posts\Entities\Branch;

class DocumentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        Document::truncate();
        \DB::table('document_tags')->truncate();

        $faker              = Faker::create();
        $users              = User::get();
        $users_count        = count($users);
        $tags               = Tag::get();

        $document_file = 'document_fake.jpg';
        \Storage::put('public/upload/'.$document_file, file_get_contents($faker->imageUrl()));

        for ($i = 0; $i < 50; $i++)
        {
            $document = Document::create([
                'branch_id'     => Branch::inRandomOrder()->documentable()->first()->id,
                'user_id'       => $users[rand(0, $users_count-1)]->id,
                'description'   => $faker->text(),
                'file'          => 'fake_' . str_random(3) . '.docx',
                'url'           => $document_file,
                'size'          => (rand(100,10000) / 1000),
                'status'        => Document::STATUS_PUBLISHED,
                'importance'    => rand(0,1),
                'is_notify'     => rand(0,1),
            ]);

            $tags_collect = collect();

            for($k = 0; $k < rand(0, count($tags)); $k++)
            {
                $tag = $tags[rand(0, count($tags)-1)];
                if (!$tags_collect->has($tag->id))
                {
                    $tags_collect->put($tag->id, true);
                    $document->tags()->attach($tag);
                }
            }
        }
    }
}
