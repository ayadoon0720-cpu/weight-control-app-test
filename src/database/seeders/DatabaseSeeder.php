<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\WeightTarget;
use App\Models\WeightLog;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // ① user 1名
        $user = User::factory()->create();

        // ② weight_targets 1件（このuserに紐づけ）
        WeightTarget::factory()->create([
            'user_id' => $user->id,
        ]);

        // ③ weight_logs 35件（このuserに紐づけ）
        WeightLog::factory()->count(35)->create([
            'user_id' => $user->id,
        ]);
    }
}
