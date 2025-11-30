<?php

require_once 'vendor/autoload.php';

$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use App\Models\User;

$user = User::where('email', 'mahasiswa@example.com')->first();

if ($user) {
    echo "User found: " . $user->name . " (" . $user->role . ")\n";
    if ($user->member) {
        echo " - Has member record\n";
        if ($user->member->isProfileComplete()) {
            echo " - Profile complete\n";
        } else {
            echo " - Profile incomplete\n";
        }
    } else {
        echo " - No member record\n";
    }
} else {
    echo "User not found\n";
}
