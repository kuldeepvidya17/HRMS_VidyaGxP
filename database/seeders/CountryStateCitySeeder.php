<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CountryStateCitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Insert Countries
        DB::table('countries')->insert([
            ['name' => 'India'],
            ['name' => 'USA'],
            ['name' => 'Canada'],
            ['name' => 'Australia'],
            ['name' => 'United Kingdom'],
            ['name' => 'Germany'],
            ['name' => 'France'],
            ['name' => 'Japan'],
            ['name' => 'China'],
            ['name' => 'Brazil'],
            ['name' => 'South Africa'],
            ['name' => 'Mexico'],
            ['name' => 'Italy'],
            ['name' => 'Russia'],
            ['name' => 'Spain'],
            ['name' => 'Argentina'],
            ['name' => 'South Korea'],
            ['name' => 'Indonesia'],
            ['name' => 'Saudi Arabia'],
            ['name' => 'Nigeria'],
            ['name' => 'Egypt'],
            ['name' => 'Turkey'],
            ['name' => 'Netherlands'],
            ['name' => 'Sweden'],
            ['name' => 'Switzerland'],
        ]);

        // Insert States
        DB::table('states')->insert([
             // States for India (country_id = 1)
    ['name' => 'Madhya Pradesh', 'country_id' => 1],
    ['name' => 'Maharashtra', 'country_id' => 1],
    ['name' => 'Gujarat', 'country_id' => 1],
    ['name' => 'Karnataka', 'country_id' => 1],
    ['name' => 'Tamil Nadu', 'country_id' => 1],
    ['name' => 'Rajasthan', 'country_id' => 1],
    ['name' => 'Uttar Pradesh', 'country_id' => 1],
    ['name' => 'West Bengal', 'country_id' => 1],

    // States for USA (country_id = 2)
    ['name' => 'California', 'country_id' => 2],
    ['name' => 'Texas', 'country_id' => 2],
    ['name' => 'Florida', 'country_id' => 2],
    ['name' => 'New York', 'country_id' => 2],
    ['name' => 'Illinois', 'country_id' => 2],
    ['name' => 'Pennsylvania', 'country_id' => 2],
    ['name' => 'Ohio', 'country_id' => 2],

    // Provinces/States for Canada (country_id = 3)
    ['name' => 'Ontario', 'country_id' => 3],
    ['name' => 'British Columbia', 'country_id' => 3],
    ['name' => 'Quebec', 'country_id' => 3],
    ['name' => 'Alberta', 'country_id' => 3],
    ['name' => 'Manitoba', 'country_id' => 3],

    // States for Australia (country_id = 4)
    ['name' => 'New South Wales', 'country_id' => 4],
    ['name' => 'Victoria', 'country_id' => 4],
    ['name' => 'Queensland', 'country_id' => 4],
    ['name' => 'Western Australia', 'country_id' => 4],
    ['name' => 'South Australia', 'country_id' => 4],

    // States for United Kingdom (country_id = 5)
    ['name' => 'England', 'country_id' => 5],
    ['name' => 'Scotland', 'country_id' => 5],
    ['name' => 'Wales', 'country_id' => 5],
    ['name' => 'Northern Ireland', 'country_id' => 5],

    // States for Germany (country_id = 6)
    ['name' => 'Bavaria', 'country_id' => 6],
    ['name' => 'Berlin', 'country_id' => 6],
    ['name' => 'Hamburg', 'country_id' => 6],
    ['name' => 'Saxony', 'country_id' => 6],
    ['name' => 'Hesse', 'country_id' => 6],

    // States for France (country_id = 7)
    ['name' => 'Île-de-France', 'country_id' => 7],
    ['name' => 'Provence-Alpes-Côte d\'Azur', 'country_id' => 7],
    ['name' => 'Occitanie', 'country_id' => 7],
    ['name' => 'Nouvelle-Aquitaine', 'country_id' => 7],
    ['name' => 'Brittany', 'country_id' => 7],

    // States for Japan (country_id = 8)
    ['name' => 'Tokyo', 'country_id' => 8],
    ['name' => 'Osaka', 'country_id' => 8],
    ['name' => 'Hokkaido', 'country_id' => 8],
    ['name' => 'Kyoto', 'country_id' => 8],
    ['name' => 'Fukuoka', 'country_id' => 8],

    // States for China (country_id = 9)
    ['name' => 'Beijing', 'country_id' => 9],
    ['name' => 'Shanghai', 'country_id' => 9],
    ['name' => 'Guangdong', 'country_id' => 9],
    ['name' => 'Sichuan', 'country_id' => 9],
    ['name' => 'Zhejiang', 'country_id' => 9],

    // States for Brazil (country_id = 10)
    ['name' => 'São Paulo', 'country_id' => 10],
    ['name' => 'Rio de Janeiro', 'country_id' => 10],
    ['name' => 'Bahia', 'country_id' => 10],
    ['name' => 'Minas Gerais', 'country_id' => 10],
    ['name' => 'Paraná', 'country_id' => 10],
    
    // States for South Africa (country_id = 11)
    ['name' => 'Gauteng', 'country_id' => 11],
    ['name' => 'Western Cape', 'country_id' => 11],
    ['name' => 'KwaZulu-Natal', 'country_id' => 11],
    ['name' => 'Eastern Cape', 'country_id' => 11],
    ['name' => 'Limpopo', 'country_id' => 11],
        ]);

        // Insert Cities
        DB::table('cities')->insert([
            // Cities for Madhya Pradesh (state_id = 1)
    ['name' => 'Indore', 'state_id' => 1 ],
    ['name' => 'Bhopal', 'state_id' => 1],
    ['name' => 'Gwalior', 'state_id' => 1],
    ['name' => 'Jabalpur', 'state_id' => 1],
    ['name' => 'Ujjain', 'state_id' => 1, ],

    // Cities for Maharashtra (state_id = 2)
    ['name' => 'Mumbai', 'state_id' => 2],
    ['name' => 'Pune', 'state_id' => 2],
    ['name' => 'Nagpur', 'state_id' => 2],
    ['name' => 'Nashik', 'state_id' => 2],
    ['name' => 'Aurangabad', 'state_id' => 2],

    // Cities for Gujarat (state_id = 3)
    ['name' => 'Ahmedabad', 'state_id' => 3],
    ['name' => 'Surat', 'state_id' => 3],
    ['name' => 'Vadodara', 'state_id' => 3],
    ['name' => 'Rajkot', 'state_id' => 3],
    ['name' => 'Bhavnagar', 'state_id' => 3],

    // Cities for Karnataka (state_id = 4)
    ['name' => 'Bengaluru', 'state_id' => 4],
    ['name' => 'Mysuru', 'state_id' => 4],
    ['name' => 'Mangalore', 'state_id' => 4],
    ['name' => 'Hubli', 'state_id' => 4],
    ['name' => 'Belgaum', 'state_id' => 4],

    // Cities for Tamil Nadu (state_id = 5)
    ['name' => 'Chennai', 'state_id' => 5],
    ['name' => 'Coimbatore', 'state_id' => 5],
    ['name' => 'Madurai', 'state_id' => 5],
    ['name' => 'Tiruchirappalli', 'state_id' => 5],
    ['name' => 'Salem', 'state_id' => 5],

    // Cities for California (state_id = 9, USA)
    ['name' => 'Los Angeles', 'state_id' => 9],
    ['name' => 'San Francisco', 'state_id' => 9],
    ['name' => 'San Diego', 'state_id' => 9],
    ['name' => 'Sacramento', 'state_id' => 9],
    ['name' => 'San Jose', 'state_id' => 9],

    // Cities for Texas (state_id = 10, USA)
    ['name' => 'Houston', 'state_id' => 10],
    ['name' => 'Dallas', 'state_id' => 10],
    ['name' => 'Austin', 'state_id' => 10],
    ['name' => 'San Antonio', 'state_id' => 10],
    ['name' => 'Fort Worth', 'state_id' => 10],

        ]);
    }
}
