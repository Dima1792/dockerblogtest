<?php
/**
 * @property integer $id
 * @property string $nameCity
 * @property json $current_units
 * @property json $current
 * @property json $hourly_units
 * @property json $hourly
 * @property json $daily_units
 * @property json $daily
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property string date
 * @property string nameCity
 * @property string current_units
 * @property string current
 * @property string hourly_units
 * @property string hourly
 * @property string daily_units
 * @property string daily
 */
class Weather extends Model
{
    protected $table = 'weathers';
    const f_ID = 'id';
    const f_DATE = 'date';
    const f_CITY = 'nameCity';
    const f_CURRENT_UNITS = 'current_units';
    const f_CURRENT = 'current';
    const f_HOURLY_UNITS = 'hourly_units';
    const f_HOURLY = 'hourly';
    const f_DAILY_UNITS = 'daily_units';
    const f_DAILY = 'daily';
    use HasFactory;
}
