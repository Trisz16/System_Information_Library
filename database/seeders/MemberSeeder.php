<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Member;

class MemberSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $members = [
            [
                'name' => 'Alice Johnson',
                'email' => 'alice.johnson@example.com',
                'phone' => '+1234567890',
                'address' => '123 Main St, City, State 12345',
                'date_of_birth' => '1995-05-15',
                'gender' => 'female',
                'status' => 'active',
                'membership_date' => '2023-01-15',
            ],
            [
                'name' => 'Bob Smith',
                'email' => 'bob.smith@example.com',
                'phone' => '+1234567891',
                'address' => '456 Oak Ave, City, State 12346',
                'date_of_birth' => '1990-08-22',
                'gender' => 'male',
                'status' => 'active',
                'membership_date' => '2023-02-10',
            ],
            [
                'name' => 'Carol Williams',
                'email' => 'carol.williams@example.com',
                'phone' => '+1234567892',
                'address' => '789 Pine Rd, City, State 12347',
                'date_of_birth' => '1988-12-03',
                'gender' => 'female',
                'status' => 'active',
                'membership_date' => '2023-03-05',
            ],
            [
                'name' => 'David Brown',
                'email' => 'david.brown@example.com',
                'phone' => '+1234567893',
                'address' => '321 Elm St, City, State 12348',
                'date_of_birth' => '1992-07-18',
                'gender' => 'male',
                'status' => 'active',
                'membership_date' => '2023-04-20',
            ],
            [
                'name' => 'Eva Davis',
                'email' => 'eva.davis@example.com',
                'phone' => '+1234567894',
                'address' => '654 Maple Ln, City, State 12349',
                'date_of_birth' => '1997-03-30',
                'gender' => 'female',
                'status' => 'inactive',
                'membership_date' => '2023-05-12',
            ],
        ];

        foreach ($members as $member) {
            Member::create($member);
        }
    }
}
