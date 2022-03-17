<?php

namespace App\Exports;


use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\WithHeadings;

class GeolocalizacionExport implements FromCollection,Responsable,ShouldQueue,WithHeadings
{


    use Exportable;
    private $fileName = 'Geolocalizacion.xlsx';


      public function __construct($fecha,$fechafinal) 
    {
        $this->fecha = $fecha;
        $this->fechafinal = $fechafinal;
      
    }

    /**
    * @return \Illuminate\Support\Collection
    */
 public function collection()
    {
         return $index = \DB::table('exercises')
                ->join('years', 'years.id', '=', 'exercises.year_id')
                ->join('months', 'months.id', '=', 'exercises.month_id')
                ->join('clients', 'clients.id', '=', 'exercises.client_id')
                ->join('users', 'users.id', '=', 'exercises.user_id')
                ->select( 'years.anio', 'months.mes', 'clients.cliente', 'exercises.direccion', 'exercises.ciudad', 'exercises.latitude', 'exercises.longitude', 'exercises.map','exercises.observaciones','exercises.created_at as fecha de creacion','exercises.updated_at as fecha de Actualizacion','users.name','users.email',\DB::raw('week(exercises.created_at) as Semana'))
                ->whereBetween('exercises.created_at',[$this->fecha." 00:00:00", $this->fechafinal." 23:59:59"])
                ->get();


          

        
    }

       public function headings(): array
    {
        return [
				'anio',
				'mes',
				'cliente',
				'Dirección',
				'Ciudad',
				'Latitud',
				'Longitud',
				'Mapa',
				'observaciones',
				'fecha de creacion',
				'fecha de Actualizacion',
				'name',
				'email',
				'Semana'


            
        ];
    }
}
