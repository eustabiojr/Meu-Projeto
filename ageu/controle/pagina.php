<?php
/**
 * Classe Pagina
 * 
 * Data: 01/03/2021
 */

# Espaço de nomes

namespace ageu\controle;

/**
 * Classe Pagina 
 * 
 * Esta classe futuramente deverá extender a classe Elemento.
 */
class Pagina {

    public function __construct()
    {
        /**
         * O código comentado abaixo é antigo. foi escrito durante as primeiras fases de 
         * desenvolvimento.
         */
        #echo "<p> Construtor da classe Pagina</p>" . PHP_EOL;
        #$classe = ucfirst($_GET['classe'] ?? 'Inicio');
        #$nomeClasse = "\\ageu\bib\\" . $classe;
        #$ob = new $nomeClasse; # Teste # Inicio;
    }

    public function operar() {

        # Só entra no IF caso exista dados GET
        if ($_GET) {
            $classe = $_GET['classe'] ?? NULL;
            $metodo = $_GET['metodo'] ?? NULL;

            # caso a variável $classe esteja definida, entra no IF
            if ($classe) {
                /**
                 * testa se o nome da classe fornecido pelo URI é igual ao nome da classe
                 * do objeto atual. Se for igual retorna para na variável $objeto, o objeto 
                 * atual. Caso contrário retorna uma nova instancia da classe requisitada.
                 */
                echo "</p>" . "O nome do parametro classe é: " . $classe . "</p>" . PHP_EOL;

                echo "</p>" . "O nome da classe é: " . get_class($this) . "</p>" . PHP_EOL;
                $objeto = $classe == get_class($this) ? $this : new $classe; # 'Sim' : 'Não';
                
                echo "</p>" . "YYYYYY: " . $objeto ."</p>" . PHP_EOL;

                if (method_exists($objeto, $metodo)) {
                    call_user_func(array($objeto, $metodo), $_GET);
                }
            }
        }
    }
}

