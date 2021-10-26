<?php

namespace App\Exports;

use App\RelatorioExecutivoResumo;
use Maatwebsite\Excel\Concerns\FromCollection;

use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;

use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Sheet;

use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Excel;

class ResumoMilagrosoExport implements FromCollection,ShouldAutoSize, WithHeadings, WithEvents, WithColumnFormatting
{
    /**
    * @return \Illuminate\Support\Collection
    */

    private $regiao;
    private $estado;
    private $municipio;
    private $rm_ride;
    private $ano_de;
    private $ano_ate;

    public function __construct($regiao, $estado, $municipio, $rm_ride,$ano_de, $ano_ate) {
        $this->regiao = $regiao;
        $this->estado = $estado;
        $this->municipio = $municipio;
        $this->rm_ride = $rm_ride;
        $this->ano_de = $ano_de;
        $this->ano_ate = $ano_ate;

    }

    public function collection()
    {


        Sheet::macro('styleCells', function (Sheet $sheet, string $cellRange, array $style) 
                { $sheet->getDelegate()->getStyle($cellRange)->applyFromArray($style); });

        $where = [];

        if($this->regiao != "tudo") {
            $where[] = ['regiao_id', $this->regiao];
        }
        if($this->estado != "tudo") {
            $where[] = ['uf_id', $this->estado];
        }
        if($this->municipio != "tudo") {
            $where[] = ['municipio_id', $this->municipio];
        }
        if($this->rm_ride != "tudo") {
            $where[] = ['txt_rm_ride', $this->rm_ride];
        }
        if($this->ano_de != "tudo") {
            $where[] = ['num_ano_assinatura', $this->ano_de];
        }
        if($this->ano_ate != "tudo") {
            $where[] = ['num_ano_assinatura', $this->ano_ate];
        }

        return  RelatorioExecutivoResumo::selectRaw('txt_modalidade,dsc_faixa,sum(num_vlr_total) as num_vlr_total, sum(num_uh) as num_uh, sum(num_concluidas) as num_concluidas, 
                                                    sum(num_entregues) as num_entregues')  
                                                    ->where($where)
                                            ->groupBy('txt_modalidade', 'dsc_faixa','faixa_renda_id')
                                            ->orderBy('dsc_faixa', 'asc')
                                            ->orderBy('txt_modalidade', 'asc')
                                            ->get();

                                           

        
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $event->sheet->getStyle('A1:F1')->applyFromArray([
                    'font' => [
                        'bold' => true,
                        'size' =>12,
                        'name' => 'Arial',
                        'color' => array('rgb' => 'FFFFFF'),
                    ],

                    'borders' => [
                        'outline' => [
                            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK,
                            'color' => ['argb' => '000000'],
                        ],
                    ],  
                    'fill' => [
                        'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_GRADIENT_LINEAR,
                        'rotation' => 90,
                        'startColor' => [
                            'argb' => '000000',
                        ],
                        'endColor' => [
                            'argb' => '000000',
                        ],
                    ],  

                ]);
               
            },
            
        ];
    }

    public function headings(): array
    {
        return [
            'Modalidade',
            'Faixa',
            'Valor Contratado',
            'Un. Contratadas',
            'Concluidas',
            'Entregues',
            'Total Valor Contratado Faixa 1' => "",
            

        ];
    }

    public function columnFormats(): array
    {
        return [
            'C' => NumberFormat::FORMAT_NUMBER_00,
        ];
    }

}
