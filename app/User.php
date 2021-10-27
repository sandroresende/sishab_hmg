<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

use App\Mod_selecao_demanda\EntePublico;
use App\Mod_selecao_demanda\VisualizacaoLegislacao;

use App\Mod_prototipo\EntePublicoProponente;
use App\Mod_prototipo\Permissoes;

use Illuminate\Support\Facades\Auth;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'tipo_usuario_id','modulo_sistema_id','txt_cpf_usuario'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];



    public function tipoUsuario(){
        return $this->belongsTo(TipoUsuario::class);
    }

    public function statusUsuario(){
        return $this->belongsTo(StatusUsuario::class);
    }

    public function entePublico()
    {
       return $this->belongsTo(EntePublico::class,'ente_publico_id'); //possui muitos
    }

    public function entePublicoProponente()
    {
       return $this->belongsTo(EntePublicoProponente::class,'ente_publico_id'); //possui muitos
    }

    public function permissao()
    {
       return $this->belongsTo(Permissoes::class); //possui muitos
    }

    public function isEntePublico() {
        
            if(($this->tipo_usuario_id == 8) || ($this->tipo_usuario_id == 9) )
            {
                return true;
            }else{
                return false;
            }
      
        
    }

    public function isModuloSelecao() {
        return $this->modulo_sistema_id == 2;
    }

    public function isUserAtivo() {
        return $this->status_usuario_id == 1;
    }

    public function isAceiteTermo() {
        return $this->bln_aceite_termo == true;
    }

    public function isAceiteDocumentos() {
        return $this->bln_visualizar_documentos == true;
    }

    public function getNumUsuarios($usuario){
            
            $whereAtivos = [];
            $whereAtivos[] = ['ente_publico_id',$usuario->ente_publico_id];    
            $whereAtivos[] = ['tipo_usuario_id',9];   
            $whereAtivos[] = ['status_usuario_id','!=',3];  
            $numAtivos = 0; 
            return  Auth::user()->where($whereAtivos)->count();

            

    }

    public function visualizacoes(){
        return $this->hasMany(VisualizacaoLegislacao::class);
    }

    public function dadosArquivoEntePublico()
    {
       return $this->belongsTo(DadosArquivoEntePublico::class); //possui muitos
    }
}
