<?php

namespace Modules\Posts\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Posts\Entities\Branch;
use Modules\Posts\Entities\Comment;
use Modules\Posts\Entities\InfoStatus;
use Modules\Posts\Entities\Post;
use Faker\Factory as Faker;
use Modules\Posts\Entities\PostAttachment;
use Modules\Posts\Entities\PostQuestion;
use Modules\Posts\Entities\PostQuestionOption;
use Modules\Posts\Entities\PostQuestionVote;
use Modules\Posts\Entities\Tag;
use Modules\Users\Entities\Notification;
use Modules\Users\Entities\User;

class PostTableSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        \DB::statement('SET FOREIGN_KEY_CHECKS = 0');

        Post::truncate();
        PostAttachment::truncate();
        PostQuestion::truncate();
        PostQuestionOption::truncate();
        PostQuestionVote::truncate();
        \DB::table('post_tags')->truncate();
        Comment::truncate();

        $faker = Faker::create();

        \Storage::put('fake.jpg', file_get_contents($faker->imageUrl()));

        $attachment = 'fake.jpg';

        $info_statuses = InfoStatus::get()->pluck('id');

        foreach (User::all() as $user) {
            $access_branch_ids = $user->access_branch_ids;
            $access_branch_ids = Branch::whereIn('id', $access_branch_ids)->where('type',
                Branch::TYPE_POST)->get()->pluck('id');
            for ($i = 0; $i <= 15; $i++) {

                $type = $faker->randomElement(Post::types());

                $post = Post::create([
                    'type'           => $type,
                    'branch_id'      => $access_branch_ids->random(),
                    'user_id'        => $user->id,
                    'info_status_id' => random_int(0, 1) ? $info_statuses->random() : null,
                    'body'           => $type != Post::TYPE_QUESTION ? $faker->realText() : '',
                    'title'          => $faker->sentence,
                    'status'         => $type == Post::TYPE_QUESTION ? Post::STATUS_PUBLISHED : $faker->randomElement(Post::statuses()),
                    'is_commented'   => $type == Post::TYPE_QUESTION ? 0 : random_int(0, 1),
                    'importance'     => random_int(0, 1),
                    'in_top'         => random_int(0, 1),
                ]);

                if ($type == Post::TYPE_QUESTION) {
                    $question = $post->question()->create([
                        'expiration_at' => $faker->dateTimeBetween('+1 days', '+10 days'),
                        'closed'        => random_int(0, 1)
                    ]);

                    for ($k = 0; $k <= random_int(3, 6); $k++) {
                        $question->options()->create([
                            'name' => $faker->sentence
                        ]);
                    }

                    $question->update([
                        'default_option_id' => $question->options->random()->id
                    ]);
                }

                for ($d = 0; $d <= random_int(1, 4); $d++) {
                    $post->attachments()->create([
                        'name' => $faker->jobTitle.'.'.$faker->fileExtension,
                        'file' => $attachment
                    ]);
                }

                $post->tags()->attach(Tag::inRandomOrder()->limit(rand(1, Tag::count()))->get()->pluck('id'));
            }
        }

        $users = User::all();

        foreach (Post::inRandomOrder()->limit(10)->get() as $post) {
            foreach (range(1, random_int(1, 3)) as $i) {
                $post->comments()->create([
                    'post_id' => $post->id,
                    'user_id' => $users->random()->id,
                    'text'    => $faker->realText()
                ]);
            }
        }

        \DB::statement('SET FOREIGN_KEY_CHECKS = 1');

    }
}
