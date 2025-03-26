<?php

namespace Database\Seeders;
  
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;

class SettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('settings')->insert([
            'option_name' => 'system_name',
            'option_value' => 'Doctorino Doctor Chamber',
        ]);

        DB::table('settings')->insert([
            'option_name' => 'title',
            'option_value' => 'Dr John Doe',
        ]);

         DB::table('settings')->insert([
            'option_name' => 'address',
            'option_value' => '150 Logts : Bloc 16 N° 02 OUED TARFA - Draria',
        ]);

         DB::table('settings')->insert([
            'option_name' => 'phone',
            'option_value' => '+33 65 04 19 93',
        ]);

         DB::table('settings')->insert([
            'option_name' => 'hospital_email',
            'option_value' => 'hospital.email@gmail.com',
        ]);

        DB::table('settings')->insert([
            'option_name' => 'currency',
            'option_value' => 'USD',
        ]);

        DB::table('settings')->insert([
            'option_name' => 'currency_symbol',
            'option_value' => '$',
        ]);

        DB::table('settings')->insert([
            'option_name' => 'currency_position',
            'option_value' => 'left',
        ]);

        DB::table('settings')->insert([
            'option_name' => 'vat',
            'option_value' => '19',
        ]);

        DB::table('settings')->insert([
            'option_name' => 'language',
            'option_value' => 'en',
        ]);

        DB::table('settings')->insert([
            'option_name' => 'appointment_interval',
            'option_value' => '30',
        ]);

        DB::table('settings')->insert([
            'option_name' => 'saturday_from',
            'option_value' => null,
        ]);
        DB::table('settings')->insert([
            'option_name' => 'saturday_to',
            'option_value' => null,
        ]);
        DB::table('settings')->insert([
            'option_name' => 'sunday_from',
            'option_value' => null,
        ]);
        DB::table('settings')->insert([
            'option_name' => 'sunday_to',
            'option_value' => null,
        ]);
        DB::table('settings')->insert([
            'option_name' => 'monday_from',
            'option_value' => '08:00',
        ]);
        DB::table('settings')->insert([
            'option_name' => 'monday_to',
            'option_value' => '17:00',
        ]);
        DB::table('settings')->insert([
            'option_name' => 'tuesday_from',
            'option_value' => '08:00',
        ]);
        DB::table('settings')->insert([
            'option_name' => 'tuesday_to',
            'option_value' => '17:00',
        ]);
        DB::table('settings')->insert([
            'option_name' => 'wednesday_from',
            'option_value' => '08:00',
        ]);
        DB::table('settings')->insert([
            'option_name' => 'wednesday_to',
            'option_value' => '17:00',
        ]);
        DB::table('settings')->insert([
            'option_name' => 'thursday_from',
            'option_value' => '08:00',
        ]);
        DB::table('settings')->insert([
            'option_name' => 'thursday_to',
            'option_value' => '17:00',
        ]);
        DB::table('settings')->insert([
            'option_name' => 'friday_from',
            'option_value' => '08:00',
        ]);
        DB::table('settings')->insert([
            'option_name' => 'friday_to',
            'option_value' => '17:00',
        ]);

        DB::table('settings')->insert([
            'option_name' => 'logo',
            'option_value' => 'logo-dark.svg',
        ]);

        DB::table('settings')->insert([
            'option_name' => 'pagination',
            'option_value' => '25',
        ]);

        

        DB::table('settings')->insert([
            'option_name' => 'active_stripe',
            'option_value' => '0',
        ]);

        DB::table('settings')->insert([
            'option_name' => 'stripe_mode',
            'option_value' => 'test',
        ]);

        DB::table('settings')->insert([
            'option_name' => 'stripe_secret',
            'option_value' => '',
        ]);

        DB::table('settings')->insert([
            'option_name' => 'stripe_key',
            'option_value' => '',
        ]);

        DB::table('settings')->insert([
            'option_name' => 'active_paypal',
            'option_value' => '0',
        ]);

       
        DB::table('settings')->insert([
            'option_name' => 'paypal_mode',
            'option_value' => 'sandbox',
        ]);

        DB::table('settings')->insert([
            'option_name' => 'paypal_client_id',
            'option_value' => '',
        ]);

        DB::table('settings')->insert([
            'option_name' => 'paypal_secret',
            'option_value' => '',
        ]);

        DB::table('settings')->insert([
            'option_name' => 'NEXMO_KEY',
            'option_value' => '',
        ]);

        DB::table('settings')->insert([
            'option_name' => 'NEXMO_SECRET',
            'option_value' => '',
        ]);
        DB::table('settings')->insert([
            'option_name' => 'TWILIO_AUTH_SID',
            'option_value' => '',
        ]);
        DB::table('settings')->insert([
            'option_name' => 'TWILIO_AUTH_TOKEN',
            'option_value' => '',
        ]);
        DB::table('settings')->insert([
            'option_name' => 'TWILIO_WHATSAPP_FROM',
            'option_value' => '',
        ]);

        DB::table('settings')->insert([
            'option_name' => 'itemID',
            'option_value' => '28707541',
        ]);
        DB::table('settings')->insert([
            'option_name' => 'current_version',
            'option_value' => '5.2.0',
        ]);
    }
}
