<?php

use App\Models\Influencer;
use Ramsey\Uuid\Uuid;

const USER = "user";
function validateProvider($provider_name)
{
    if (!in_array($provider_name, ['google', 'facebook', 'apple', 'phoneNumber', 'manual'])) {
        throw new \Exception("Please login using these sources -> 'google', 'facebook','apple','phoneNumber','manual'");
    }
}
function validateDevices($provider_name)
{
    if (!in_array($provider_name, ['web', 'app'])) {
        throw new \Exception("Please login using valid device type -> 'web', 'app'");
    }
}

function getUID()
{
    $uuid = Uuid::uuid4();
    return $uuid->toString();
}

function formatBytes($size, $precision = 2)
{
    $base = log($size, 1024);
    $suffixes = array('B', 'KB', 'MB', 'GB', 'TB');

    return round(pow(1024, $base - floor($base)), $precision) . ' ' . $suffixes[floor($base)];
}

function isUserRole($user)
{
    if (!in_array(USER, $user->roles->pluck('name')->toArray())) {
        throw new \Exception("Unable to process request.");
    }
}

function generateUniqueCode($Model, $column)
{

    $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersNumber = strlen($characters);
    $codeLength = 6;

    $code = '';

    while (strlen($code) < 6) {
        $position = rand(0, $charactersNumber - 1);
        $character = $characters[$position];
        $code = $code . $character;
    }

    if ($Model::where($column, $code)->exists()) {
        generateUniqueCode($Model, $column);
    }

    return $code;
}
