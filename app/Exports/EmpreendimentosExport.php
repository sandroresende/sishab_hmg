<?php

namespace App\Exports;

use App\ResumoOperacoes;
use Maatwebsite\Excel\Concerns\FromCollection;

use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;

use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Sheet;

use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Excel;


class EmpreendimentosExport implements FromCollection,ShouldAutoSize, WithHeadings, WithEvents, WithColumnFormatting
{
    private $regiao;
    private $municipio;
    private $estado;
    private $modalidade;
    private $empreendimento;
    private $faixa;

    public function __construct($regiao, $estado,$municipio,$modalidade, $empreendimento,$faixa) {
        $this->regiao = $regiao;
        $this->estado = $estado;
        $this->municipio = $municipio;
        $this->modalidade = $modalidade;
        $this->empreendimento = $empreendimento;
        $this->faixa = $faixa;
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
            $where[] = ['view_resumo_operacoes.municipio_id', $this->municipio];
            
        }
        if($this->modalidade != "tudo") {
            $where[] = ['view_resumo_operacoes.modalidade_id', $this->modalidade];
        }
        if($this->empreendimento != "tudo") {
            $where[] = ['cod_operacao', $this->empreendimento];
        }
        if($this->faixa != "tudo") {
            $where[] = ['view_resumo_operacoes.faixa_id', $this->faixa];
        }

          $operacoes = ResumoOperacoes::join('tab_municipios','view_resumo_operacoes.municipio_id','=','tab_municipios.id')
                                        ->join('tab_uf','tab_municipios.uf_id','=','tab_uf.id')                                        
                                        ->leftjoin('view_id_ultima_proposta_apresentada','view_resumo_operacoes.cod_operacao','=','view_id_ultima_proposta_apresentada.num_apf')
                                        ->leftjoin('tab_propostas','view_id_ultima_proposta_apresentada.proposta_id','=','tab_propostas.id')
                                        ->leftjoin('tab_selecao','tab_propostas.selecao_id','=','tab_selecao.id')
                                        ->select(
                                                'tab_uf.txt_sigla_uf',
                                                'tab_municipios.ds_municipio',                                                     
                                                'view_resumo_operacoes.cod_operacao',
                                                'view_resumo_operacoes.txt_nome_empreendimento',                    
                                                'view_resumo_operacoes.txt_modalidade',
                                                'view_resumo_operacoes.dsc_faixa',
                                                'view_resumo_operacoes.num_pmcmv',
                                                'view_resumo_operacoes.num_percentual',
                                                'view_resumo_operacoes.num_uh',
                                                'view_resumo_operacoes.num_concluidas',
                                                'view_resumo_operacoes.num_entregues',
                                                'view_resumo_operacoes.num_vlr_total',
                                                'view_resumo_operacoes.txt_situacao_obras',
                                                'view_resumo_operacoes.num_total_liberado',
                                                'view_resumo_operacoes.txt_tipologia_unidade',
                                                'view_resumo_operacoes.txt_forma_parcelamento',
                                                'view_resumo_operacoes.num_gestao_condominial',
                                                'view_resumo_operacoes.num_valor_tts',
                                                'view_resumo_operacoes.dte_contratacao',
                                                'view_resumo_operacoes.dte_termino_obras',
                                                'view_resumo_operacoes.dte_prevista_termino_obras',
                                                'view_resumo_operacoes.txt_ano_mes_conclusao',
                                                'view_resumo_operacoes.dte_vistoria',
                                                'view_resumo_operacoes.num_latitude',
                                                'view_resumo_operacoes.num_longitude',
                                                'tab_selecao.txt_portaria_resultado'                    
                                                )
                                        ->where($where)
                                        ->orderBy('num_ordenacao','asc')
                                        ->orderBy('tab_uf','asc')
                                        ->orderBy('num_pmcmv','asc')
                                        ->orderBy('txt_nome_empreendimento','asc')
                                    ->get();

                $count = 0;                      
                                     
                foreach($operacoes as $operacao){
                    $operacoes[$count]['num_vlr_total'] = $operacao->num_vlr_total;
                    $operacoes[$count]['num_percentual'] = $operacao->num_percentual;
                    $operacoes[$count]['num_total_liberado'] = $operacao->num_total_liberado;
                    $operacoes[$count]['num_gestao_condominial'] = $operacao->num_gestao_condominial;
                    $operacoes[$count]['num_valor_tts'] = $operacao->num_valor_tts;
                    
                    if($operacao->txt_situacao_obras){
                        if($operacao->num_uh == $operacao->num_entregues){
                            $operacoes[$count]['txt_situacao_obras'] = 'Entregue';
                        }                   
                    }else{    
                        if($operacao->num_uh == $operacao->num_entregues){
                            $operacoes[$count]['txt_situacao_obras'] = 'Entregue';
                        }else if($operacao->num_uh == $operacao->num_concluidas){
                            $operacoes[$count]['txt_situacao_obras'] = 'Concluída';
                        }else{
                            if($operacao->num_percentual == 0){
                                $operacoes[$count]['txt_situacao_obras'] = 'Não Iniciada';
                            }elseif(($operacao->num_percentual >0) && ($operacao->num_percentual < 100)){
                                $operacoes[$count]['txt_situacao_obras'] = 'Em Andamento'; 
                            }else{
                                $operacoes[$count]['txt_situacao_obras'] = 'Em Andamento'; 
                            }
                        } 
                    }        
                    $count++;              
                }                                      
            
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
            'PMCMV',
            '%',
            'Contratadas.',
            'Concluídas',
            'Entregues',
            'Valor',
            'Situação',
            'Total Liberado',
            'Tipologia',
            'Forma Parcelamento',
            'Valor Gestão Condominial',
            'Valor TTS',
            'Data Contratação',
            'Data Término Obras',
            'Data Previsão Término',
            'Mês/Ano Conclusão',
            'Data Vistoria',
            'Latitude',
            'Longitude',
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
            
            'H' => NumberFormat::FORMAT_NUMBER_00,
            'I' => NumberFormat::FORMAT_NUMBER,
            'J' => NumberFormat::FORMAT_NUMBER,
            'K' => NumberFormat::FORMAT_NUMBER,
            'L' => NumberFormat::FORMAT_NUMBER_00,
            'N' => NumberFormat::FORMAT_NUMBER_00,
            'Q' => NumberFormat::FORMAT_NUMBER_00,
            'R' => NumberFormat::FORMAT_NUMBER_00,
        ];
    }
}
