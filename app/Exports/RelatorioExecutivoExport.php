<?php

namespace App\Exports;

use App\RelatorioExecutivoInt;
use Maatwebsite\Excel\Concerns\FromCollection;

use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;

use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Sheet;

use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Excel;

class RelatorioExecutivoExport implements FromCollection,ShouldAutoSize, WithHeadings, WithEvents, WithColumnFormatting
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
    //private $situacao;

    public function __construct($regiao, $estado, $municipio, $rm_ride,$ano_de, $ano_ate, $situacao) {
        $this->regiao = $regiao;
        $this->estado = $estado;
        $this->municipio = $municipio;
        $this->rm_ride = $rm_ride;
        $this->ano_de = $ano_de;
        $this->ano_ate = $ano_ate;
        $this->situacao = $situacao;

    }

    public function collection()
    {


        Sheet::macro('styleCells', function (Sheet $sheet, string $cellRange, array $style) 
                { $sheet->getDelegate()->getStyle($cellRange)->applyFromArray($style); });

        $where = [];
        $whereDe = [];
        $whereAte = [];

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
                $whereDe[] = ['num_ano_assinatura', $this->ano_de];
            }
            if($this->ano_ate != "tudo") {
                $whereAte[] = ['num_ano_assinatura', $this->ano_ate];
            }
            
            if($this->situacao) {

                $relatorioExecutivo = RelatorioExecutivoInt::selectRaw('txt_modalidade,
                                                                                dsc_faixa, 
                                                                                sum(vlr_operacao) as num_vlr_total,
                                                                                sum(vlr_liberado) as num_vlr_liberado,
                                                                                sum(num_uh) as num_uh, 
                                                                                sum(num_uh_andamento) as num_uh_andamento, 
                                                                                sum(qtd_uh_concluida) as num_concluidas, 
                                                                                sum(qtd_uh_obra_fisica_concluida) as num_obra_fisica_concluidas, 
                                                                                sum(qtd_uh_entregues) as num_entregues, 
                                                                                sum(qtd_uh_distratadas) as num_distratadas')
                                                ->where($whereDe)                                                            
                                                ->where($whereAte)   
                                                ->where($where)   
                                                ->whereIn('situacao_obras_ifs_id', $this->situacao)                                            
                                                ->groupBy('modalidade_id','txt_modalidade', 'dsc_faixa','faixa_renda_id')
                                                ->orderBy('dsc_faixa', 'asc')
                                                ->orderBy('txt_modalidade', 'asc')
                                                ->get();   
            
            }else{

            
                $relatorioExecutivo = RelatorioExecutivoInt::selectRaw('txt_modalidade,
                                                                            dsc_faixa, 
                                                                        sum(vlr_operacao) as num_vlr_total,
                                                                        sum(vlr_liberado) as num_vlr_liberado,
                                                                        sum(num_uh) as num_uh, 
                                                                        sum(num_uh_andamento) as num_uh_andamento, 
                                                                        sum(qtd_uh_concluida) as num_concluidas, 
                                                                        sum(qtd_uh_obra_fisica_concluida) as num_obra_fisica_concluidas, 
                                                                        sum(qtd_uh_entregues) as num_entregues, 
                                                                        sum(qtd_uh_distratadas) as num_distratadas') 
                                                                ->where($whereDe)                                                            
                                                                ->where($whereAte)   
                                                                ->where($where)                                                               
                                                                ->groupBy('txt_modalidade', 'dsc_faixa','faixa_renda_id')
                                                                ->orderBy('dsc_faixa', 'asc')
                                                                ->orderBy('txt_modalidade', 'asc')
                                                                ->get(); 
            
            }
            
            return $relatorioExecutivo;
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $event->sheet->getStyle('A1:J1')->applyFromArray([
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
            'Valor Liberado',
            'Contratadas',
            'Andamento',
            'Obras Físicas Concluidas',
            'Concluidas',
            'Entregues',
            'Distratadas',
            

        ];
    }

    public function columnFormats(): array
    {
        return [
            'C' => NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1,
            'D' => NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1,
            'E' => NumberFormat::FORMAT_NUMBER,
            'F' => NumberFormat::FORMAT_NUMBER,
            'H' => NumberFormat::FORMAT_NUMBER,
            'I' => NumberFormat::FORMAT_NUMBER,
            'J' => NumberFormat::FORMAT_NUMBER,
        ];
    }

}
