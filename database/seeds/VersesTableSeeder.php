<?php

use App\Song;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class VersesTableSeeder extends Seeder
{
    public function run(): void
    {
        $song = Song::where('name', 'Peace with You')->first();

        if (!$song) {
            return;
        }

        DB::table('verses')->insert([
            'words' => 'Deep in the heart of my soul
I know You’ll never forsake me
As long as this stormy wind blows
I’ll cling to the truth of Your Word',
            'song_id' => $song->id,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('verses')->insert([
            'words' => 'The suff’ring of those that I love
The burden’s just too much to bear
The chaos screams loud around me
But I know there’s peace here with You',
            'song_id' => $song->id,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('verses')->insert([
            'words' => 'Draw me close to You
There’s no one else for me, but You
The sorrow is too much, I can’t see the way out
I know that You’ll carry me through',
            'song_id' => $song->id,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('verses')->insert([
            'words' => 'There is peace, there is peace, here with You
Draw me close, and I’ll cling to You
There is no one else that can do what You do
There is peace, there is peace, here with You',
            'song_id' => $song->id,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
    }
}
