<?php

namespace App\Exports;

use App\ResumoPropostas;
use Maatwebsite\Excel\Concerns\FromCollection;

use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;

use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Sheet;

use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Excel;

class selecaoResumoExport implements FromCollection,ShouldAutoSize, WithHeadings, WithEvents, WithColumnFormatting
{
    /**
    * @return \Illuminate\Support\Collection
    */

    private $estado;
    private $municipios;

    public function __construct($estado, $municipios) {
        $this->estado = $estado;
        $this->municipios = $municipios;

    }

    public function collection()
    {
        $where = [];
        $whereIn = [];
        if($this->estado != "tudo") {
            $where[] = ['uf_id', $this->estado];
        }
            
        

        return ResumoPropostas::selectRaw('txt_sigla_uf,ds_municipio,txt_modalidade,num_portaria_resultado,
                                        dte_portaria_resultado,bln_enquadrada,bln_selecionada,bln_contratada, count(proposta_id) as qtd_propostas,
                                        sum(num_uh) as num_uh, sum(num_uh_contratadas) as num_uh_contratadas, sum(vlr_contratado) as vlr_contratado')
                                    ->groupBy('municipio_id','txt_sigla_uf','ds_municipio','txt_modalidade','num_portaria_resultado',
                                            'dte_portaria_resultado','bln_enquadrada','bln_selecionada','bln_contratada')
                                    ->where($where)
                                    ->whereIn('municipio_id', $this->municipios)
                                    ->orderBy('txt_sigla_uf', 'asc')
                                    ->orderBy('ds_municipio', 'asc')
                                    ->orderBy('txt_modalidade', 'asc')->get();

    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $event->sheet->getStyle('A1:N1')->applyFromArray([
                    'font' => [
                        'bold' => true,
                        'size' =>12,
                        'name' => 'Arial',
                        'color' => array('rgb' => 'FF0000'),
                    ]
                ]);
            },
        ];
    }

    public function headings(): array
    {
        return [
            'UF',
            'Município',
            'Modalidade',
            'Portaria',
            'Data Seleção',
            'Enquadrada',
            'Selecionada',
            'Contratada',
            'Qnt Propostas',
            'UH Não Enquadradas',
            'UH Contratadas',
            'Valor Contratado'

        ];
    }

    public function columnFormats(): array
    {
        return [
            'L' => NumberFormat::FORMAT_NUMBER_00,
        ];
    }
}
