<?php

namespace App\Exports;


use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ProductExport implements FromCollection,Responsable,ShouldQueue,WithHeadings
{


    use Exportable;
    private $fileName = 'comercial.xlsx';


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
         return $index = \DB::table('products')
                ->join('years', 'years.id', '=', 'products.year_id')
                ->join('months', 'months.id', '=', 'products.month_id')
                ->join('clients', 'clients.id', '=', 'products.client_id')
                ->leftjoin('parameterizations', 'parameterizations.client_id', '=', 'products.client_id')
                ->leftJoin('regions', 'regions.id', '=', 'parameterizations.region_id')
                ->leftJoin('channels', 'channels.id', '=', 'parameterizations.channel_id')
                ->leftJoin('sellers', 'sellers.id', '=', 'parameterizations.seller_id')
                ->leftJoin('chiefs', 'chiefs.id', '=', 'sellers.chief_id')
                ->join('lines', 'lines.id', '=', 'products.line_id')
                ->join('makers', 'makers.id', '=', 'products.marker_id')
                ->join('brands', 'brands.id', '=', 'products.brand_id')
                ->join('presentations', 'presentations.id', '=', 'products.presentation_id')
                ->join('users', 'users.id', '=', 'products.user_id')
                ->select( 'years.anio', 'months.mes', 'clients.cliente', 'lines.linea','makers.fabricante','brands.marca','presentations.presentacion','products.precio_iva','products.observaciones','products.created_at as fecha de creacion','products.updated_at as fecha de Actualizacion','users.name','users.email','regions.region','channels.canal','sellers.vendedores','chiefs.jefes',\DB::raw('week(products.created_at) as Semana'))
                ->whereBetween('products.created_at',[$this->fecha." 00:00:00", $this->fechafinal." 23:59:59"])
                ->get();


          

        
    }

       public function headings(): array
    {
        return [
				'anio',
				'mes',
				'cliente',
				'linea',
				'fabricante',
				'marca',
				'presentacion',
				'precio_iva',
				'observaciones',
				'fecha de creacion',
				'fecha de Actualizacion',
				'name',
				'email',
				'region',
				'canal',
				'vendedores',
				'jefes',
				'Semana'


            
        ];
    }
}
