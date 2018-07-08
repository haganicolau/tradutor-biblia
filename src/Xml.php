<?php
/**
 * @description responsável por manipular o arquivo XML que contém os livros do .mybible
 * @author : Hagamenon.Oliveira
 * @since: 07/07/18
 */

namespace bibliaAPI;


class Xml extends File {
    private $idioma;

    /**
     * Construtor da classe XML que contém os dados originais
     *
     * @param string $idIidioma número que faz referência ao número do idioma da classe File (pai)
     *
     * @return void
     */
    public function __construct($idIidioma) {
        $this->idioma = $this->docs[$idIidioma];
        parent::__construct(getcwd() . '/data/xml/' . $this->idioma . '/');
    }

    /**
     * Obtém os dados do xml e converte em objeto
     *
     *
     * @return object
     */
    public function getFile() {
        $caminho = $this->caminho . $this->idioma . 'valid.xml';
        return simplexml_load_file($caminho);
    }

    /**
     * O XML extraído do .mybible contém algumas tags que impossibilita do método simplexml_load_file funcione, com isto este método retira tais tags e deixa o xml válido
     *
     *
     * @return object
     */
    public function validarFile() {
        $arquivo = fopen($this->caminho . $this->idioma . '.xml', 'r');
        $arquivoNovo = fopen($this->caminho . $this->idioma . 'valid.xml', 'w+');

        while(!feof($arquivo)) {
            $linha = fgets($arquivo, 1024);
            $linha = str_replace('<CM>', '', $linha);
            $linha = str_replace('<PI>', '', $linha);
            $linha = str_replace('<CI>', '', $linha);
            $linha = str_replace('color=teal', '', $linha);
            $linha = str_replace('Ts', '/TS1', $linha);
            fwrite($arquivoNovo, $linha);
        }

        fclose($arquivo);
        fclose($arquivoNovo);
    }

}