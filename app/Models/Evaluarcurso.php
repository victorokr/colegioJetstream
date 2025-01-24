<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Periodo;
use Carbon\Carbon;

class Evaluarcurso extends Model
{
    protected $table = 'matricula';
    protected $primaryKey = 'id_matricula';
    protected $fillable = ['nota1','nota2','nota3','nota4','nota5','nota6'];

    public function alumno()
    {
        return $this->belongsTo('App\Models\Alumno','id_alumno');
    }

    public function curso()
    {
        return $this->belongsTo('App\Models\Curso','id_curso');
    }



    // public function scopeCurso($query, $curso)
    // {
    //     if($curso)
    //     return $query->whereHas("curso", function ($query) use ($curso){
    //         $query->where('salon','LIKE', "%$curso%");
    //     });
    // }

    // public function scopeCurso($query, $curso)
    // {
    //     if($curso)
    //     return $query->whereHas("curso", function ($query) use ($curso){
    //         $query->where('id_curso','LIKE', "%$curso%");
    //     });
    // }

    public function scopeCurso($query, $curso)
    {
        if($curso)
        return $query->where('id_curso','LIKE',"%$curso%");
    }


    public static function compararAlumnoCursoPeriodo()
    {
        $consulAlumno = App\Models\Calificacion::where('id_periodo','LIKE', $this->calcularPeriodoModel()->get() );
    }


    public static function calcularPeriodoModel(){
        //toArray convierte un objeto elocuent en un array plano
        $fechainicioo  = Periodo::pluck('fechainicio')->toArray();
        $fechafinn     = Periodo::pluck('fechafin')->toArray();

        

        $fechahoy = Carbon::now();
        

        foreach($fechainicioo as $fechainicio){

                if($fechahoy >= ($fechainicio[0]) && $fechahoy <= ($fechafinn[0]) )
                return '1';

                
       
                if($fechahoy >= ($fechainicio[1]) && $fechahoy <= ($fechafinn[1]) )
                return '2';

                
                    
                if($fechahoy >= ($fechainicio[2]) && $fechahoy <= ($fechafinn[2]) )
                return '3';

               
                    
                if($fechahoy >= ($fechainicio[3]) && $fechahoy <= ($fechafinn[3]) )
                return '4';

                

        }
    }
    






}
