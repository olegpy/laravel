<?php

use Illuminate\Database\Seeder;


class ProposalsTableSeeder extends Seeder
{
    /** @var int */
    protected const COUNT = 10;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement("SET foreign_key_checks=0");
        DB::table("proposals")->truncate();
        DB::statement("SET foreign_key_checks=1");

        $proposals = [];
        $rr = [];

        $users = \App\Models\User::where('is_admin', false)->get();
//dd($users);
        $now = \Carbon\Carbon::now();
        foreach ($users as $user){
            for ($i = 0; $i < self::COUNT; $i++){
                $proposals[] = [
                    'title' => 'test',
                    'message' => 'test tests' . $i,
                    'created_at' => $now,
                    'updated_at' => $now
                ];
            }
//            dd($proposals);
            $user->proposals()->createMany($proposals);
        }


    }
}
