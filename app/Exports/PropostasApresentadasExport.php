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

class PropostasApresentadasExport implements FromCollection,ShouldAutoSize, WithHeadings, WithEvents, WithColumnFormatting
{
    /**
    * @return \Illuminate\Support\Collection
    */

    private $estado;
    private $municipio;
    private $modalidade;
    private $selecao;

    public function __construct( $estado, $municipio, $modalidade, $selecao) {
        $this->estado = $estado;
        $this->municipio = $municipio;
        $this->modalidade = $modalidade;
        $this->selecao = $selecao;
    }

    public function collection()
    {
        $where = [];
        if($this->selecao != "tudo") {
            $where[] = ['selecao_id', intval($this->selecao)];
        }
        if($this->estado != "tudo") {
            $where[] = ['uf_id', $this->estado];
        }
        if($this->municipio != "tudo") {
            $where[] = ['municipio_id', $this->municipio];
        }
        if($this->modalidade != "tudo") {
            $where[] = ['modalidade_id', $this->modalidade];
        }

        return ResumoPropostas::selectRaw('txt_sigla_uf, ds_municipio, num_selecao, num_ano_selecao, txt_modalidade, 
                                         txt_nome_empreendimento, num_uh, vlr_investimento, bln_enquadrada, bln_selecionada, bln_contratada')
                                            ->where($where)
                                            ->orderBy('txt_uf', 'asc')
                                            ->orderBy('ds_municipio', 'asc')
                                            ->orderBy('txt_nome_empreendimento', 'asc')
                                            ->orderBy('proposta_id', 'asc')
                                            ->get();
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
            'Seleção',
            'Ano de Seleção',
            'Modalidade',           
            'Empreendimento',
            'Número de Unidades',
            'Valor Previsto',
            'Equadradas',
            'Selecionadas',            
            'Contratadas',

        ];
    }

    public function columnFormats(): array
    {
        return [
            'H' => NumberFormat::FORMAT_NUMBER_00,
            'K' => NumberFormat::FORMAT_,
        ];
    }

   
}
