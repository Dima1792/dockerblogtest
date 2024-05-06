<?php
/**
 * @property integer id
 * @property string city
 * @property string latitude
 * @property string longitude
 * @property string timeZone
 */
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GuideCity extends Model
{
    const f_ID = 'id';
    const f_CITY = 'city';
    const f_LATITUDE = 'latitude';
    const f_LONGITUDE = 'longitude';
    const f_TIMEZONE = 'timeZone';
    use HasFactory;
}
