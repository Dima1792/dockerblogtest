<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property integer id
 * @property string date
 * @property string valute
 * @property string name
 * @property string value
 * @property string previous
 */
class cbCurrency extends Model
{
    const f_ID = 'id';
    const f_DATE = 'date';
    const f_VALUTE = 'valute';
    const f_NAME = 'name';
    const f_VALUE = 'value';
    const f_PREVIOUS = 'previous';
    public $timestamps = false;
}
