<?php
/**
 * Created by PhpStorm.
 * User: haganicolau
 * Date: 07/07/18
 * Time: 00:03
 */

namespace bibliaAPI;


class Usfm extends File {

    private $livros = array();
    private $idioma;

    public function __construct($idIidioma) {
        parent::__construct(getcwd() . '/data/usfm' . $this->idioma . '/');
        $this->idioma = $this->docs[$idIidioma];
        $this->livros = [
            1=>['Gênesis','Gên','Gn'],
            2=>['Êxodo','Êx','Êx'],
            3=>['Levítico','Lev','Lv'],
            4=>['Números','Núm','Nm'],
            5=>['Deuteronômio','Deut','Dt'],
            6=>['Josué','Jos','Js'],
            7=>['Juízes','Juí','Jz'],
            8=>['Rute','Rut','Rt'],
            9=>['I Samuel','1 Sam','1Sm'],
            10=>['II Samuel','2 Sam','2Sm'],
            11=>['I Reis','1 Re','1Rs'],
            12=>['II Reis','2 Re','2Rs'],
            13=>['I Crônicas','1 Crôn','1Cr'],
            14=>['II Crônicas','2 Crôn','2Cr'],
            15=>['Esdras','Esd','Ed'],
            16=>['Neemias','Ne','Ne'],
            17=>['Ester','Est','Et'],
            18=>['Jó','Jó','Jó'],
            19=>['Salmos','Salm','Sl'],
            20=>['Provérbios','Prov','Pv'],
            21=>['Eclesiastes','Ecles','Ec'],
            22=>['Cantares de Salomão','Cant','Ct'],
            23=>['Isaías','Isa','Is'],
            24=>['Jeremias','Jer','Jr'],
            25=>['Lamentações','Lam','Lm'],
            26=>['Ezequiel','Eze','Ez'],
            27=>['Daniel','Dan','Dn'],
            28=>['Oséias','Ose','Os'],
            29=>['Joel','Joel','Jl'],
            30=>['Amós','Amós','Am'],
            31=>['Obadias','Oba','Ob'],
            32=>['Jonas','Jon','Jn'],
            33=>['Miquéias','Miq','Mq'],
            34=>['Naum','Naum','Na'],
            35=>['Habacuque','Hab','Hc'],
            36=>['Sofonias','Sof','Sf'],
            37=>['Ageu','Ageu','Ag'],
            38=>['Zacarias','Zac','Zc'],
            39=>['Malaquias','Mal','Ml'],
            40=>['Mateus','Mat','Mt'],
            41=>['Marcus','Mar','Mc'],
            42=>['Lucas','Luc','Lc'],
            43=>['João','Jo','Jo'],
            44=>['Atos','At','At'],
            45=>['Romanos','Rom','Rm'],
            46=>['I Coríntios','1 Cor','1Co'],
            47=>['II Coríntios','2 Cor','2Co'],
            48=>['Gálatas','Gál','Gl'],
            49=>['Efésios','Ef','Ef'],
            50=>['Filipenses','Filip','Fp'],
            51=>['Colossenses','Col','Cl'],
            52=>['I Tessalonicenses','1 Tess','1Ts'],
            53=>['II Tessalonicenses','2 Tess','2Ts'],
            54=>['I Timóteo','1 Tim','1Tn'],
            55=>['II Timóteo','2 Tim','2Tm'],
            56=>['Tito','Tit','Tt'],
            57=>['Filemom','Fil','Fm'],
            58=>['Hebreus','Heb','Hb'],
            59=>['Tiago','Tg','Tg'],
            60=>['I Pedro','1 Ped','1Pe'],
            61=>['II Pedro','2 Ped','2Pe'],
            62=>['I João','1 Jo','1Jo'],
            63=>['II João','2 Jo','2Jo'],
            64=>['III João','3 Jo','3Jo'],
            65=>['Judas','Jud','Jd'],
            66=>['Apocalipse','Apoc','Ap'],
        ];
    }

    public function createHeader($numero) {
        $aux = $this->livros[$numero][2];

        return [
            '\id' => 'CTI ' .$this->idioma,
            '\ide' =>'usfm',
            '\h' => $this->livros[$numero][0],
            '\toc1' => $this->livros[$numero][0],
            '\toc2' => $this->livros[$numero][0],
            '\toc3' => $this->livros[$numero][1],
            '\\' . $aux => $this->livros[$numero][0]
        ];
    }

    public function getBookByNumer($dados = array(), $numerBook = 0 ) {
        $response = array();
        foreach($dados as $dado) {
            if($dado->Book == $numerBook) {
                array_push($response, $dado);
            }
        }
        return $response;
    }

    public function parseUsfm ($dados = array(), $numberBook = 0) {

        $file = fopen($this->caminho . $numberBook . '-' . $this->livros[$numberBook][2] . '-' . $this->idioma.'.usfm', 'w+');
        foreach ( self::createHeader($numberBook) as $key => $head ) {
            fwrite($file, $key . " " .  $head . "\r\n");
        }

        $IndexChapter = 0;
        foreach ($dados as $item) {
            if($IndexChapter == 0) {
                $IndexChapter = 1;
                fwrite($file,"\r\n");
                fwrite($file,"\r\n");
                fwrite($file,'\\c ' . $IndexChapter . "\r\n");
                fwrite($file,'\\p ' . "\r\n");

                if(isset($item->Scripture->TS1)) {
                    fwrite($file, '\\mt1 ' . $item->Scripture->TS1[0]->font . "\r\n");
                    fwrite($file, '\\mt2 ' . $item->Scripture->TS1[1] . "\r\n");
                }
            }

            if($item->Chapter == $IndexChapter) {
                if(!isset($item->Scripture->TS1)) {
                    fwrite($file,'\\v ' . $item->Verse . " " . $item->Scripture . "\r\n");
                }

            } else {

                $IndexChapter++;
                fwrite($file,"\r\n");
                fwrite($file,"\r\n");
                fwrite($file,'\\c ' . $IndexChapter . "\r\n");
                fwrite($file,'\\p' . "\r\n");

                if(isset($item->Scripture->TS1)) {
                    fwrite($file, '\\mt1 ' . $item->Scripture->TS1[0] . "\r\n");
                    fwrite($file, '\\mt2 ' . $item->Scripture->TS1[1] . "\r\n");
                }
            }

        }

    }

}