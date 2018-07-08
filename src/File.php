<?php
/**
 * @Description classe pai que vai ser herdada pela XML e USFM
 * User: hagamenon Oliveira
 * Date: 06/07/18
 * Time: 23:59
 */

namespace bibliaAPI;


abstract class File {

    protected $tags = [];
    protected $file;
    protected $caminho = '';
    protected $docs = [];

    public function __construct($caminho = '') {
        $this->tags = array();
        $this->caminho = $caminho;
        $this->docs = [
            0 => 'Akawaio',
            1 => 'Apalaí',
            2=> 'Apinayé',
            3 => 'Apurinã',
            4 => 'Ashéninka',
            5 => 'Bakairí',
            6 => 'Carib',
            7 => 'Desano',
            8 => 'Guajajára',
            9 => 'Guarani',
            10 => 'Hixkaryána',
            11 => 'Huni-Kui',
            12 => 'Jamamadí',
            13 => 'Kadiwéu',
            14 => 'Kagwahiva',
            15 => 'Kaingáng',
            16 => 'Kaiwá',
            17 => 'Karajá',
            18 => 'Kayabí',
            19 => 'Kayapó',
            20 => 'Kulina',
            21 => 'Macuna',
            22 => 'Macushi',
            23 => 'Manchineri',
            24 => 'Maxakalí',
            25 => 'Mundurukú',
            26 => 'Nadëb',
            27 => 'Nambikuára',
            28 => 'Palikúr',
            29 => 'Parecis',
            30 => 'Paumarí',
            31 => 'Piratapuyo',
            32 => 'Rikbaktsa',
            33 => 'Sateré-Mawé',
            34 => 'Terêna',
            35 => 'Ticuna',
            36 => 'Tukano',
            37 => 'Tuyuca',
            38 => 'Urubú-Kaapor',
            39 => 'Waimaja',
            40 => 'Waiwai',
            41 => 'Wajãpi',
            42 => 'Wapishana',
            43 => 'Xavánte',
            44 => 'Xerente',
            45 => 'Xiriâna'
        ];
    }

}