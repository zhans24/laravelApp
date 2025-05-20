<?php

namespace Database\Seeders;

use App\Domain\Models\User;
use App\Infrastructure\Models\EloquentProduct;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Log;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */

    public function run(): void
    {
        $total=300_000;
        $batch=5000;
        for ($i = 0; $i < $total; $i+=$batch) {
            $prodcuts=EloquentProduct::factory()->count($batch)->make()->toArray();
            try {
                EloquentProduct::insert($prodcuts);
            }catch (\Exception $e){
                Log::error($e->getMessage());
            }

            gc_collect_cycles();
        }

    }
}
