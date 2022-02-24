<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = [
        'firstNames',
        'lastName',
        'emailAddress',
        'email_verified_at',
        'contactNo',
        'contact_no_verified_at',
        'distributorCode',
        'distributor_since',
    ];

    public function hiddenEmail()
    {
        if (filter_var($this->emailAddress, FILTER_VALIDATE_EMAIL)) {
            list($first, $last) = explode('@', $this->emailAddress);
            $first = str_replace(substr($first, '3'), str_repeat('*', strlen($first) - 3), $first);
            $last = explode('.', $last);
            $last_domain = str_replace(substr($last['0'], '1'), str_repeat('*', strlen($last['0']) - 1), $last['0']);
            $hideEmailAddress = $first . '@' . $last_domain . '.' . $last['1'];
            return $hideEmailAddress;

        }
    }

    public function hiddenNumber()
    {
        return substr($this->contactNo, 0, 4) . "****" . substr($this->contactNo, strlen($this->contactNo) - 2, 2);
    }
}
