<?php
/**
 * Sistema
 * 
 * Data: 04/0/2021
 */
//--------------------------------------------------------------------------------------------------- 
namespace Estrutura\Nucleo;

/**
 * Classe AutoCarregadorEstrutura
 * 
 * Carregamento automático das classe estruturais do sistema.
 */
class AutoCarregadorAplic {

    protected $diretorios = array();

    /**
     * Método registra
     */
    public function registra()
    {
        spl_autoload_register(array($this, 'carregaClasse'));
    }

    /**
     * Método carregaClasse
     */
    public function carregaClasse($classe)
    {
        $pastas = $this->diretorios;

        $pastas = $this->diretorios;
    
        foreach ($pastas as $pasta) {
            # Caso a pasta exista no diretório
            if (file_exists("{$pasta}/{$classe}.php")) {
                #echo "{$pasta}/{$classe}.php";
                require_once "{$pasta}/{$classe}.php";
                return true;
            } else {
                # Quando não é localizado logo. Vamos ...
				if (file_exists($pasta)) {
                    if (file_exists($pasta)) {
                        $diretorios = new RecursiveDirectoryIterator('bibliotecas', RecursiveIteratorIterator::SELF_FIRST);
                        $iterador   = new RecursiveIteratorIterator($diretorios);
                        foreach ($iterador as $entrada) {
                            if(is_dir($entrada)) {
                                if (file_exists("{$entrada}/{$classe}.php")) {
                                    require_once "{$entrada}/{$classe}.php";
                                    return true;
                                }
                            }
                        }
                    }	
				}
			}
        }
    }

    /**
     * Método adicPasta
     */
    public function adicPasta($diretorios)
    {
        $this->diretorios[] = $diretorios;
    }
}