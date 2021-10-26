<?php

namespace App\Exports;

use App\oferta\NotasPagamentosRemessaDevolucao;
use Maatwebsite\Excel\Concerns\FromCollection;

use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;

use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Sheet;

use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Excel;

class RemessaDevolucaoExport implements FromCollection,ShouldAutoSize, WithHeadings, WithEvents, WithColumnFormatting
{
    /**
    * @return \Illuminate\Support\Collection
    */

    private $remessaDevolucao;

    public function __construct($remessaDevolucaoId) {
        $this->remessaDevolucao = $remessaDevolucaoId;
     

    }

    public function collection()
    {


        Sheet::macro('styleCells', function (Sheet $sheet, string $cellRange, array $style) 
                { $sheet->getDelegate()->getStyle($cellRange)->applyFromArray($style); });

        //$where = [];

      
           // $where[] = ['num_ano_assinatura', $this->remessaDevolucao];
      

            return NotasPagamentosRemessaDevolucao::join('tab_beneficiarios','tab_beneficiarios.id','=','view_notas_pagamento_remessa_devolucao.beneficiario_id')                                            
            ->select('sg_uf','ds_municipio','txt_protocolo', 'tab_beneficiarios.txt_nis_beneficiario',
                    'tab_beneficiarios.txt_cpf_beneficiario','tab_beneficiarios.txt_nome_beneficiario',
                    'txt_num_nota_tecnica','num_parcelas','total_subvencao','total_remuneracao','dte_pagamento')
            ->where('remessa_devolucao_id',$this->remessaDevolucao)   
            ->orderBy('sg_uf')
            ->orderBy('ds_municipio')
            ->orderBy('txt_nome_beneficiario')                                      
            ->orderBy('dte_geracao_nota')
            ->get();

                                           

        
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $event->sheet->getStyle('A1:k1')->applyFromArray([
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
            'UF',
            'Município',
            'Protocolo',            
            'NIS Titular',
            'CPF Titular',
            'Nome Beneficiário',
            'N° Nota',
            'Qtde Parcelas',
            'Valor Subvencao (a)',
            'Valor Remuneração (b)',
            'Data do pagamento',
            

        ];
    }

    public function columnFormats(): array
    {
        return [
            'I' => NumberFormat::FORMAT_NUMBER_00,
            'J' => NumberFormat::FORMAT_NUMBER_00,            
            'K' => NumberFormat::FORMAT_DATE_DDMMYYYY,
        ];
    }

}
