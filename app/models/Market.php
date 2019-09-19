<?php


class Market extends Eloquent{

    protected $table = 'tb_market';

    protected $primaryKey = 'id_market';

    public $timestamps = false;

    public $remember_token = false;

    public function departments()
    {
        return $this->hasMany('Departament','id_market');
    }

    public function indicators()
    {
        return $this->belongsToMany('Indicator','tb_indicator_market','id_market','id_indicator');
    }

    public function evaluations()
    {
        return $this->hasMany('Evaluation','id_market');
    }



    public function department_manager()
    {
        $dept = DB::table('tb_departament')
            ->where('tb_departament.id_market','=',$this->id_market)
            ->where('tb_departament.name','=','Manager')
            ->where('tb_departament.removed','=',0)
            ->first();

        return $dept;;
    }





} 