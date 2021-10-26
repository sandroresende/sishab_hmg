<?php

namespace App\Exports;

use App\Operacao;
use Maatwebsite\Excel\Concerns\FromCollection;

use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;

use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Sheet;

use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Excel;


class EmpreendimentoAPFExport implements FromCollection,ShouldAutoSize, WithHeadings, WithEvents, WithColumnFormatting
{
    private $operacaoId;

    public function __construct($operacaoId) {
        $this->operacaoId = $operacaoId;
    }

    
    public function collection()
    {
        Sheet::macro('styleCells', function (Sheet $sheet, string $cellRange, array $style) 
                { $sheet->getDelegate()->getStyle($cellRange)->applyFromArray($style); });

                $where = [];
        
                
                $where[] = ['operacao_id', $this->operacaoId];
                

          $operacoes = Operacao::select(
                                                'txt_sigla_uf',
                                                'ds_municipio',                                                     
                                                'operacao_id',
                                                'txt_nome_empreendimento',                    
                                                'txt_modalidade',
                                                'dsc_faixa',
                                                'prc_obra_realizado',
                                                'qtd_uh_financiadas',
                                                'qtd_uh_concluidas',
                                                'qtd_uh_entregues',
                                                'vlr_operacao',
                                                'vlr_contrapartida',
                                                'vlr_investimento',
                                                'vlr_liberado',
                                                'txt_situacao_obra',
                                                'dte_assinatura',
                                                'txt_portaria_selecao'                    
                                                )
                                        ->where($where)                                        
                                        ->get();

                                 
            
            return $operacoes;
    }

    public function headings(): array
    {
        return [
            'UF',
            'Município',
            'Cód Operação',
            'Empreendimento',
            'Modalidade',
            'Faixa',
            '%',
            'Contratadas.',
            'Concluídas',
            'Entregues',
            'Valor Operação',
            'Valor Contrapartida',
            'Valor Investimento',
            'Valor Liberado',
            'Situação',
            'Data Assinatura',
            'Portaria de Seleção'
            
        ];
    }


    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $event->sheet->getStyle('A1:Z1')->applyFromArray([
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
    
    public function columnFormats(): array
    {
        return [
            'G' => NumberFormat::FORMAT_NUMBER_00,
            'H' => NumberFormat::FORMAT_NUMBER_00,
            'I' => NumberFormat::FORMAT_NUMBER,
            'J' => NumberFormat::FORMAT_NUMBER,
            'K' => NumberFormat::FORMAT_NUMBER,
            'L' => NumberFormat::FORMAT_NUMBER_00,
            'N' => NumberFormat::FORMAT_NUMBER_00
        ];
    }
}
