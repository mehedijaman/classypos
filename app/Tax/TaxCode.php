<?php

namespace ClassyPOS\Tax;

use Illuminate\Database\Eloquent\Model;

class TaxCode extends Model
{
	protected $table="tax_code";
	protected $primaryKey="TaxCodeID";    
    protected $fillable=['TaxCode','TaxPercent'];
   
}
