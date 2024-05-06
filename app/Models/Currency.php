<?php
/**
 * @property integer $id
 * @property string $code
 * @property string $value
 * @property string $name
 */
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{
    const f_ID = 'id';
    const f_CODE = 'code';
    const f_VALUE = 'value';
    const f_NAME = 'name';
    protected $table = 'currencies';
    public $timestamps = false;
}
