<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Booking;
use App\Models\Member;

class BookingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Get admin member
        $admin = Member::where('role', 'admin')->first();
        
        // Create some sample members if they don't exist
        $members = [];
        for ($i = 1; $i <= 5; $i++) {
            $member = Member::updateOrCreate(
                ['email' => "member{$i}@pawtopia.com"],
                [
                    'name' => "Member {$i}",
                    'phone' => "08123456789{$i}",
                    'address' => "Address {$i}",
                    'role' => 'member',
                ]
            );
            $members[] = $member;
        }

        // Create sample bookings
        $services = ['grooming', 'boarding', 'veterinary', 'training'];
        $pets = ['dog', 'cat', 'bird', 'rabbit'];
        $petNames = ['Buddy', 'Whiskers', 'Charlie', 'Luna', 'Max', 'Bella', 'Rocky', 'Daisy'];
        $statuses = ['pending', 'confirmed', 'completed', 'cancelled'];

        for ($i = 1; $i <= 20; $i++) {
            $member = $members[array_rand($members)];
            $service = $services[array_rand($services)];
            $petType = $pets[array_rand($pets)];
            $petName = $petNames[array_rand($petNames)];
            $status = $statuses[array_rand($statuses)];
            
            // Calculate price based on service
            $prices = [
                'grooming' => 150000,
                'boarding' => 200000,
                'veterinary' => 300000,
                'training' => 250000
            ];
            
            $bookingDate = now()->addDays(rand(1, 30));
            $bookingTime = now()->setTime(rand(8, 17), rand(0, 59));
            
            Booking::create([
                'member_id' => $member->id,
                'service_type' => $service,
                'pet_name' => $petName,
                'pet_type' => $petType,
                'booking_date' => $bookingDate->format('Y-m-d'),
                'booking_time' => $bookingTime->format('H:i:s'),
                'notes' => "Sample booking notes for {$petName}",
                'status' => $status,
                'total_price' => $prices[$service],
            ]);
        }
    }
}