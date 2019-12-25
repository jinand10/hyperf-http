<?php

declare(strict_types=1);

namespace App\Model;


/**
 * @property int $sid
 */
class ServerModel extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'server';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['sid', 'game_id', 'srv_type', 'srv_id', 'srv_name'];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'sid' => 'integer',
        'game_id' => 'integer',
        'srv_type' => 'integer',
        'srv_id' => 'integer',
        'srv_name' => 'string',
    ];
}
