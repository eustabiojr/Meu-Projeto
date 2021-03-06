<?php
/************************************************************************************
 * Sistema
 * 
 * Data: 13/03/2021
 ************************************************************************************/

use Estrutura\Bugigangas\Dialogo\Mensagem;
use Estrutura\Bugigangas\Embrulho\EmbrulhoGradedados;
use Estrutura\Bugigangas\Gradedados\ColunaGradedados;
use Estrutura\Bugigangas\Gradedados\Gradedados;
use Estrutura\Controle\Acao;
use Estrutura\Controle\Pagina;

/**
 * Class ListaAcaoContato
 */
class ListaAcaoContato extends Pagina
{
    private $gradedados;

    /**
     * Método Construtor
     */
    public function __construct()
    {
        parent::__construct();

        # instancia o objeto de grade de dados
        $this->gradedados = new EmbrulhoGradedados(new Gradedados);

        # instancia as colunas da grade de dados
        $codigo  = new ColunaGradedados('id',      'Código',  'center', '10%');
        $nome    = new ColunaGradedados('nome',    'Nome',    'left', '20%');
        $email   = new ColunaGradedados('email',   'Email',   'left', '30%');
        $assunto = new ColunaGradedados('assunto', 'Assunto', 'left', '30%');

        # adiciona as colunas à grade de dados
        $this->gradedados->adicColuna($codigo);
        $this->gradedados->adicColuna($nome);
        $this->gradedados->adicColuna($email);
        $this->gradedados->adicColuna($assunto);

        $nome->defTransformador(function($valor) {
            return strtoupper($valor);
        });

        $this->gradedados->adicAcao('Visualizar', new Acao(array($this, 'aoVisualizar')), 'nome');

        # adiciona a grade de dados à página
        parent::adic($this->gradedados);
    }

    /**
     * Método aoVisualizar
     */
    public function aoVisualizar($param)
    {
        new Mensagem('info', 'Você clicou sobre o registro: ' . $param['nome']);
    }

    /**
     * Método aoRecarregar
     */
    public function aoRecarregar()
    {
        $this->gradedados->limpa();

        $m1 = new stdClass;
        $m1->id      = 1;
        $m1->nome    = 'Maria da Conceição';
        $m1->email   = 'mariacisantos@gmail.com';
        $m1->assunto = 'Dúvida sobre formulários';
        $this->gradedados->adicItem($m1);

        $m2 = new stdClass;
        $m2->id      = 2;
        $m2->nome    = 'Pedro Paulo';
        $m2->email   = 'pedrop@gmail.com';
        $m2->assunto = 'Dúvida sobre listagens';
        $this->gradedados->adicItem($m2);
    }

    /**
     * Método exibe
     */
    public function exibe()
    {
        $this->aoRecarregar();
        parent::exibe();
    }
}