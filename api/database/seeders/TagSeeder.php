<?php

namespace Database\Seeders;

use App\Commands\Tag\Create\Command;
use App\Commands\Tag\Create\Handler;

class TagSeeder extends BaseSeeder
{
    public function run(): void
    {
        \DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        \DB::table('tags')->truncate();
        \DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $tags = array_map('str_getcsv', file(__DIR__.'/_tags.csv'));

        try {
            \DB::transaction(function () use ($tags) {

                collect($tags)->each(function($tag){
                    $tag['name'] = $tag[1];
                    $tag['type'] = $tag[2];
                    $tag['parent_id'] = $tag[3] ?: null;
                    $tag['is_base'] = true;

                    (new Handler())->handler(new Command($tag));
                });
            });
        } catch (\Throwable $e) {
            dd($e->getMessage());
        }
    }
}
