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

class ResumoPropostasExport implements FromCollection, ShouldAutoSize, WithHeadings, WithEvents, WithColumnFormatting
{
    /**
    * @return \Illuminate\Support\Collection
    */
   private $regiao;
   private $estado;
   private $municipio;
   private $modalidade;
   private $ano;

   public function __construct($regiao, $estado, $municipio, $modalidade, $ano) {
       $this->regiao = $regiao;
       $this->estado = $estado;
       $this->municipio = $municipio;
       $this->modalidade = $modalidade;
       $this->ano = $ano;
   }

    public function collection()
    {
        $where = [];
        $where[] = ['num_uh_contratadas', '>', 0];
        if($this->regiao != "tudo") {
            $where[] = ['regiao_id', intval($this->regiao)];
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
        if($this->ano != "tudo") {
            $where[] = ['num_ano_selecao', $this->ano];
        }
    
        return ResumoPropostas::selectRaw('txt_sigla_uf,ds_municipio,txt_modalidade,num_apf,txt_nome_empreendimento,
                                            num_uh,num_uh_contratadas,vlr_contratado,num_ano_selecao')
                                            ->where($where)
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
            'APF',
            'Empreendimento',
            'UH Selecionadas',
            'UH Contratadas',
            'Valor Contratado',
            'Ano Seleção',
        ];
    }

    public function columnFormats(): array
    {
        return [
            'I' => NumberFormat::FORMAT_NUMBER_00,
        ];
    }
}

                                          