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


class EmpreendimentoContratadosExp implements FromCollection,ShouldAutoSize, WithHeadings, WithEvents, WithColumnFormatting
{
    private $estado;
    private $municipio;
    private $situacao;
    

    public function __construct($estado, $municipio, $situacao) {
        $this->estado = $estado;
        $this->municipio = $municipio;
        $this->situacao = $situacao;
       
    }

    
    public function collection()
    {
        Sheet::macro('styleCells', function (Sheet $sheet, string $cellRange, array $style) 
                { $sheet->getDelegate()->getStyle($cellRange)->applyFromArray($style); });

                $where = [];
                $where[] = ['origem_id', 2];
                $whereSituacao = [];
        
                if($this->estado != 'tudo')
                    $where[] = ['uf_id', $this->estado];
                
                if($this->municipio != 'tudo')    
                    $where[] = ['municipio_id', $this->municipio];

               
                    if($this->situacao){

                        $empreendimentos = Operacao::leftjoin('tab_municipios','tab_operacoes.municipio_id', '=','tab_municipios.id')
                                                    ->leftjoin('tab_uf', 'tab_municipios.uf_id', '=', 'tab_uf.id')
                                                    ->leftjoin('tab_regiao', 'tab_uf.regiao_id', '=', 'tab_regiao.id') 
                                                    ->leftjoin('opc_status_empreendimento','opc_status_empreendimento.id','=','tab_operacoes.status_empreendimento_id')
                                                ->leftjoin('opc_modalidades','opc_modalidades.id','=','tab_operacoes.modalidade_id')
                                                ->leftjoin('opc_faixa_renda','opc_faixa_renda.id','=','tab_operacoes.faixa_renda_id')
                                                ->select('txt_sigla_uf','ds_municipio', 'tab_operacoes.id as operacao_id', 'txt_nome_empreendimento','txt_modalidade','dsc_faixa',
                                                'prc_obra_realizado', 'qtd_uh_financiadas','qtd_uh_concluidas','qtd_uh_entregues',
                                                'vlr_operacao','vlr_contrapartida','vlr_investimento',
                                                'vlr_liberado','txt_status_empreendimento','dte_assinatura','txt_portaria_selecao',
                                                'bln_vigente')
                                                ->orderBy('txt_sigla_uf', 'asc')
                                                ->orderBy('ds_municipio', 'asc')
                                                ->orderBy('txt_nome_empreendimento', 'asc')
                                                ->where($where)
                                                ->whereIn('status_empreendimento_id', $this->situacao)         
                                                ->get();
                                                    
                    }else{
                        $empreendimentos = Operacao::leftjoin('tab_municipios','tab_operacoes.municipio_id', '=','tab_municipios.id')
                                                    ->leftjoin('tab_uf', 'tab_municipios.uf_id', '=', 'tab_uf.id')
                                                    ->leftjoin('tab_regiao', 'tab_uf.regiao_id', '=', 'tab_regiao.id') 
                                                    ->leftjoin('opc_status_empreendimento','opc_status_empreendimento.id','=','tab_operacoes.status_empreendimento_id')
                                                ->leftjoin('opc_modalidades','opc_modalidades.id','=','tab_operacoes.modalidade_id')
                                                ->leftjoin('opc_faixa_renda','opc_faixa_renda.id','=','tab_operacoes.faixa_renda_id')
                                                ->select('txt_sigla_uf','ds_municipio', 'tab_operacoes.id as operacao_id', 'txt_nome_empreendimento','txt_modalidade','dsc_faixa',
                                                'prc_obra_realizado', 'qtd_uh_financiadas','qtd_uh_concluidas','qtd_uh_entregues',
                                                'vlr_operacao','vlr_contrapartida','vlr_investimento',
                                                'vlr_liberado','txt_status_empreendimento','dte_assinatura','txt_portaria_selecao',
                                                'bln_vigente')
                                                ->orderBy('txt_sigla_uf', 'asc')
                                                ->orderBy('ds_municipio', 'asc')
                                                ->orderBy('txt_nome_empreendimento', 'asc')
                                                ->where($where)
                                                ->whereIn('status_empreendimento_id', $this->situacao)         
                                                ->get();
                    }                                
                    $count = 0;
                    
                    /**
                    foreach($empreendimentos as $empreendimento){
                        
                        if(($empreendimento->qtd_uh_financiadas>0)){                        
                            if($empreendimento->qtd_uh_financiadas == $empreendimento->qtd_uh_entregues){
                                $empreendimentos[$count]['txt_situacao_obra'] = 'Entregue';
                            }else{
                                $empreendimentos[$count]['txt_situacao_obra'] = $empreendimento->txt_situacao_obra;
                            }
                        }else{
                            $empreendimentos[$count]['txt_situacao_obra'] = $empreendimento->txt_situacao_obra;
                        }    
                        $count++;
                    }                                                

                        */      
            
            return $empreendimentos;

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
            'Status',
            'Data Assinatura',
            'Portaria de Seleção',
            'Vigente'
            
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
            'G' => NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1,
            'H' => NumberFormat::FORMAT_NUMBER,
            'I' => NumberFormat::FORMAT_NUMBER,
            'J' => NumberFormat::FORMAT_NUMBER,
            'K' => NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1,
            'L' => NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1,
            'M' => NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1,
            'N' => NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1,
            'P' => NumberFormat::FORMAT_DATE_DDMMYYYY
        ];
    }
}
