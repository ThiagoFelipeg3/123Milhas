<?php

namespace App\Entities\PopoModel;

use Exception;

/**
 *
 * Classe base para implementar models POPO (Plain Old PHP Object) que não
 * descendem de models especializados, como `Eloquent` - por exemplo.
 *
 * Sempre que um dado precisar ser representado por um objeto,
 * descender deste model para melhor re-uso e padronização.
 *
 */
abstract class PopoModel
{
    public function __construct(array $dados = [])
    {
        if (!empty($dados)) {
            $this->fromArray($dados);
        }
    }

    /**
     *
     * Usando PHP property overloading para interceptar o "setter" e não permitir atribuição
     * dinâmica de propriedades a um modelo.
     * Mais detalhes no manual do PHP em:
     * http://php.net/manual/en/language.oop5.overloading.php#object.set
     *
     */
    public function __set($name, $value)
    {
        throw new Exception(sprintf('Classe "%s" não possui propriedade "%s"', get_class($this), $name));
    }

    /**
     *
     * fromArray deve ser implementado pelas classes derivadas para carregar dados
     * de um array e popular os atributos da instância desta classe.
     */
    abstract protected function fromArray(array $dados);

    public function toArray()
    {
        return json_decode($this->toJson(), true);
    }

    public function toJson()
    {
        return json_encode($this);
    }
}