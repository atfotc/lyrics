<?php

use App\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class SongsTableSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::where('email', 'cgpitt@gmail.com')->first();

        if (!$user) {
            return;
        }

        DB::table('songs')->insert([
            'name' => 'Peace with You',
            'creators' => 'Carlien Stevenson',
            'user_id' => $user->id,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
    }
}
