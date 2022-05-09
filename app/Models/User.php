<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'role',
        'email',
        'firstNames',
        'lastName',
        'emailAddress',
        'password',
        'email_verified_at',
        'contactNo',
        'contact_no_verified_at',
        'distributorCode',
        'distributor_since',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function isAdmin()
    {
        return $this->role == 'admin' ? true : false;
    }

    /**
     * Get the phone number formatted as either E164, RFC3966 or National standard
     * READ THE F***N MANUAL: https://github.com/giggsey/libphonenumber-for-php/blob/master/docs/PhoneNumberUtil.md
     * @param string $defaultFormat E164|RFC3966|NATIONAL
     * @param string $defaultCountryCode ZA| ISO 3166-1 two letter country code
     * @return string $number|$error_message
     */
    public function getFormattedPhoneNumber($defaultFormat = 'E164', $countryCode = null)
    {

        // Country code may be incorrect because input validation is crappy at the moment
        // If the country code is not ISO 3166-1, then fallback to ZA
        $countryCode = 'ZA';

        $number = false;

        if (!isset($this->contactNo)) {
            return false;
        }

        //if is USSD
        if (preg_match('/^\*[0-9\*#]*[0-9]+[0-9\*#]*#$/', $this->contactNo)) {
            $number = $this->contactNo;
        } else {
            $phoneUtil = \libphonenumber\PhoneNumberUtil::getInstance();

            try {
                $numberProto = $phoneUtil->parse($this->contactNo, $countryCode);

                $isPossible = $phoneUtil->isPossibleNumber($numberProto);
                $isValid = $phoneUtil->isValidNumber($numberProto);
                $isValidForRegion = $phoneUtil->isValidNumberForRegion($numberProto, $countryCode);

                //if( ! $isValidForRegion ){
                //    Log::warning('Brand Location Phone is not valid for the region ' . $countryCode);
                //}

                if ($isPossible && $isValid) {
                    //format
                    if ($defaultFormat == 'RFC3966') {
                        $number = $phoneUtil->format($numberProto, \libphonenumber\PhoneNumberFormat::RFC3966); //RFC3966    tel:+27-11-805-6789
                    } elseif ($defaultFormat == 'NATIONAL') {
                        $number = str_replace(' ', '', $phoneUtil->format($numberProto, \libphonenumber\PhoneNumberFormat::NATIONAL)); // tel:0118056789
                    } elseif ($defaultFormat == 'INTERNATIONAL') {
                        $number = str_replace(' ', '', $phoneUtil->format($numberProto, \libphonenumber\PhoneNumberFormat::INTERNATIONAL)); // tel:+27 72 007 784
                    } else {
                        $number = $phoneUtil->format($numberProto, \libphonenumber\PhoneNumberFormat::E164); //E164    +27118056789
                    }
                } else {
                    //throw new Exception('Phone number is not a possible number or valid number');
                }
            } catch (\libphonenumber\NumberParseException$e) {
                // throw $e;
                return false;
            }
        }
        return $number;
    }
}
