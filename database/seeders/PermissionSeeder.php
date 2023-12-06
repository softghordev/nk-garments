<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('permissions')->truncate();
        DB::table('model_has_permissions')->truncate();
        DB::table('role_has_permissions')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $permissions_map = ['l' => 'list', 'c' => 'create', 'r' => 'show', 'u' => 'edit', 'd' => 'delete'];
        
        // Bank Account
        $resourece_features['bank_account'] = ['l', 'c','r'];
        $other_permissions['bank_account-history']='bank_account';

        // Item
        $resourece_features['item'] = ['l', 'c', 'u', 'd'];
        $other_permissions['item-stock']='item';
        $resourece_features['brand'] = ['l', 'c', 'u', 'd'];
        $resourece_features['unit'] = ['l', 'c', 'd'];
        
        // Purchase  
        $resourece_features['party_purchase'] = ['l', 'c', 'r', 'u', 'd'];
        $other_permissions['party_purchase_report']='party_purchase';
      
        $resourece_features['petty_purchase'] = ['l', 'c', 'r', 'u', 'd'];
        $other_permissions['petty_purchase_report']='petty_purchase';

        // Sale
        $resourece_features['party_sale'] = ['l', 'c', 'r', 'u', 'd'];
        $other_permissions['party_sale_report']='party_sale';

        $resourece_features['cash_sale'] = ['l', 'c', 'r', 'u', 'd'];
        $other_permissions['cash_sale_report']='cash_sale';

        $resourece_features['wastage_sale'] = ['l', 'c', 'r', 'u', 'd'];
        $other_permissions['wastage_sale_report']='wastage_sale';

        // Challan
        $resourece_features['receive_challan'] = ['l', 'c', 'r', 'u', 'd'];
        $other_permissions['receive_challan_report']='receive_challan';

        $resourece_features['delivery_challan'] = ['l', 'c', 'r', 'u', 'd'];
        $other_permissions['delivery_challan_report']='delivery_challan';

        $resourece_features['moving_challan'] = ['l', 'c', 'r', 'u', 'd'];
        $other_permissions['moving_challan_report']='moving_challan';

        // Employee 
        $resourece_features['employee'] = ['l', 'c', 'u', 'd'];
        $resourece_features['department'] = ['l', 'c', 'u', 'd'];

        // Party 
        $resourece_features['party'] = ['l', 'c', 'u', 'd'];

        // Payments
        $resourece_features['payment'] = ['l', 'c', 'd'];

        // Setting
        $other_permissions['setting']='misc';
        $other_permissions['backup']='misc';
        // $other_permissions['roles']='roles';

        $resourece_features['role'] = ['l', 'c', 'u', 'd'];
        $resourece_features['user'] = ['l', 'c', 'u', 'd'];
        $other_permissions['permissions']='role';



        $other_permissions['profile']='profile';
        $other_permissions['change_password']='profile';


        // Dashboard
        $other_permissions['dashboard']='dashboard';

        
        foreach ($resourece_features as $key => $rf) {
            foreach ($rf as $feature) {
                $access = $permissions_map[$feature];
                Permission::create([
                    'name' => $access . "-" . $key,
                    'feature' => $key
                ]);
            }
        }


        foreach ($other_permissions as $permission => $value) {
            Permission::create([
                'name' => $permission,
                'feature' => $value
            ]);
        }

        $all_permissions = Permission::pluck('name');

        $admin = Role::where('name','admin')->first();
        $test_admin = Role::where('name','test_admin')->first();

        $admin->syncPermissions($all_permissions);
        $test_admin->syncPermissions($all_permissions);

        $operator = Role::where('name','operator')->first();

        $operator_permissions = [
            'profile',
            'change_password'
        ];

        $operator->syncPermissions($operator_permissions);


    }
}
