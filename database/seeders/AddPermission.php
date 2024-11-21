<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class AddPermission extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         Permission::create(['name' => 'dashboard' ,'label'=>'داشبورد']);
         Permission::create(['name' => 'products','label'=>'محصولات']);
         Permission::create(['name' => 'competitions','label'=>'مسابقات']);
         Permission::create(['name' => 'roles','label'=>'نقش ها']);
         Permission::create(['name' => 'support','label'=>'پشتیبانی']);
         Permission::create(['name' => 'setting','label'=>'تنظیمات']);

         Permission::create(['name' => 'users','label'=>'کاربران']);
         Permission::create(['name' => 'messages','label'=>'پیامها']);
         Permission::create(['name' => 'Site','label'=>'سایت']);
    }
}
