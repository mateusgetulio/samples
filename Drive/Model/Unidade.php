<?php

namespace Drive;

use Illuminate\Database\Eloquent\Model;

class Unidade extends Model
{
    protected $table = 'unidade';
    
    protected $fillable=['nome','logradouro','numero','bairro',
    					'cidade','estado','cep','lat','lng',
    					'telefones','email','gerente','inauguracao', 'foto'];
}