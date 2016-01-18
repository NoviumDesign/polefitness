<?php
class WCF_XML_Document {

    /** @public String XML */
    var $xml;

    /** @public String version */
    var $ver;

    /** @public String Charset */
    var $charset;

    /** @public String Charset */
    var $exceptions;

    /** @public String Charset */
    var $countries;

    /**
     *
     */
    function __construct() {
        $this->ver = '1.0';
        $this->charset = 'UTF-8';
        $this->exceptions = array(
            'Address1',
            'Address2',
            'DeliveryAddress1',
            'DeliveryAddress2',
            'Phone1',
            'Phone2',
            'ExternalInvoiceReference1',
        );

        $this->countries = array(
            'AE' => 'Förenade Arabemiraten',
            'AF' => 'Afghanistan',
            'AG' => 'Antigua och Barbuda',
            'AI' => 'Anguilla',
            'AL' => 'Albanien',
            'AM' => 'Armenien',
            'AN' => 'Nederländska Antillerna',
            'AO' => 'Angola',
            'AQ' => 'Antarktis',
            'AR' => 'Argentina',
            'AS' => 'Amerikanska Samoa',
            'AT' => 'Österrike',
            'AU' => 'Australien',
            'AW' => 'Aruba',
            'AX' => 'Åland',
            'AZ' => 'Azerbajdzjan',
            'BA' => 'Bosnien och Hercegovina',
            'BB' => 'Barbados',
            'BD' => 'Bangladesh',
            'BE' => 'Belgien',
            'BF' => 'Burkina Faso',
            'BG' => 'Bulgarien',
            'BH' => 'Bahrain',
            'BI' => 'Burundi',
            'BJ' => 'Benin',
            'BL' => 'Saint-Barthélemy',
            'BM' => 'Bermuda',
            'BN' => 'Brunei',
            'BO' => 'Bolivia',
            'BR' => 'Brasilien',
            'BS' => 'Bahamas',
            'BT' => 'Bhutan',
            'BV' => 'Bouvetön',
            'BW' => 'Botswana',
            'BY' => 'Vitryssland',
            'BZ' => 'Belize',
            'CA' => 'Kanada',
            'CC' => 'Kokosöarna',
            'CD' => 'Demokratiska republiken Kongo',
            'CF' => 'Centralafrikanska republiken',
            'CG' => 'Kongo-Brazzaville',
            'CH' => 'Schweiz',
            'CI' => 'Elfenbenskusten',
            'CK' => 'Cooköarna',
            'CL' => 'Chile',
            'CM' => 'Kamerun',
            'CN' => 'Kina',
            'CO' => 'Colombia',
            'CR' => 'Costa Rica',
            'CU' => 'Kuba',
            'CV' => 'Kap Verde',
            'CX' => 'Julön',
            'CY' => 'Cypern',
            'CZ' => 'Tjeckien',
            'DE' => 'Tyskland',
            'DJ' => 'Djibouti',
            'DK' => 'Danmark',
            'DM' => 'Dominica',
            'DO' => 'Dominikanska republiken',
            'DZ' => 'Algeriet',
            'EC' => 'Ecuador',
            'EE' => 'Estland',
            'EG' => 'Egypten',
            'EH' => 'Västsahara',
            'ER' => 'Eritrea',
            'ES' => 'Spanien',
            'ET' => 'Etiopien',
            'FI' => 'Finland',
            'FJ' => 'Fiji',
            'FK' => 'Falklandsöarna',
            'FM' => 'Mikronesiska federationen',
            'FO' => 'Färöarna',
            'FR' => 'Frankrike',
            'FX' => 'France métropolitaine (Frankrike, europeiska delen)',
            'GA' => 'Gabon',
            'GB' => 'Storbritannien',
            'GD' => 'Grenada',
            'GE' => 'Georgien',
            'GF' => 'Franska Guyana',
            'GG' => 'Guernsey',
            'GH' => 'Ghana',
            'GI' => 'Gibraltar',
            'GL' => 'Grönland',
            'GM' => 'Gambia',
            'GN' => 'Guinea',
            'GP' => 'Guadeloupe',
            'GQ' => 'Ekvatorialguinea',
            'GR' => 'Grekland',
            'GT' => 'Guatemala',
            'GU' => 'Guam',
            'GW' => 'Guinea Bissau',
            'GY' => 'Guyana',
            'HK' => 'Hongkong',
            'HM' => 'Heard- och McDonaldsöarna',
            'HN' => 'Honduras',
            'HR' => 'Kroatien',
            'HT' => 'Haiti',
            'HU' => 'Ungern',
            'ID' => 'Indonesien',
            'IE' => 'Irland',
            'IL' => 'Israel',
            'IM' => 'Isle of Man',
            'IN' => 'Indien',
            'IO' => 'Brittiska territoriet i Indiska Oceanen',
            'IQ' => 'Irak',
            'IR' => 'Iran',
            'IS' => 'Island',
            'IT' => 'Italien',
            'JE' => 'Jersey',
            'JM' => 'Jamaica',
            'JO' => 'Jordanien',
            'JP' => 'Japan',
            'KE' => 'Kenya',
            'KG' => 'Kirgizistan',
            'KH' => 'Kambodja',
            'KI' => 'Kiribati',
            'KM' => 'Komorerna',
            'KN' => 'Saint Kitts och Nevis',
            'KP' => 'Nordkorea',
            'KR' => 'Sydkorea',
            'KW' => 'Kuwait',
            'KY' => 'Caymanöarna',
            'KZ' => 'Kazakstan',
            'LA' => 'Laos',
            'LB' => 'Libanon',
            'LC' => 'Saint Lucia',
            'LI' => 'Liechtenstein',
            'LK' => 'Sri Lanka',
            'LR' => 'Liberia',
            'LS' => 'Lesotho',
            'LT' => 'Litauen',
            'LU' => 'Luxemburg',
            'LV' => 'Lettland',
            'LY' => 'Libyen',
            'MA' => 'Marocko',
            'MC' => 'Monaco',
            'MD' => 'Moldavien',
            'ME' => 'Montenegro',
            'MG' => 'Madagaskar',
            'MH' => 'Marshallöarna',
            'MK' => 'Makedonien',
            'ML' => 'Mali',
            'MM' => 'Burma',
            'MN' => 'Mongoliet',
            'MO' => 'Macau',
            'MP' => 'Nordmarianerna',
            'MQ' => 'Martinique',
            'MR' => 'Mauretanien',
            'MS' => 'Montserrat',
            'MT' => 'Malta',
            'MU' => 'Mauritius',
            'MV' => 'Maldiverna',
            'MW' => 'Malawi',
            'MX' => 'Mexiko',
            'MY' => 'Malaysia',
            'MZ' => 'Moçambique',
            'NA' => 'Namibia',
            'NC' => 'Nya Kaledonien',
            'NE' => 'Niger',
            'NF' => 'Norfolkön',
            'NG' => 'Nigeria',
            'NI' => 'Nicaragua',
            'NL' => 'Nederländerna',
            'NO' => 'Norge',
            'NP' => 'Nepal',
            'NR' => 'Nauru',
            'NU' => 'Niue',
            'NZ' => 'Nya Zeeland',
            'OM' => 'Oman',
            'PA' => 'Panama',
            'PE' => 'Peru',
            'PF' => 'Franska Polynesien',
            'PG' => 'Papua Nya Guinea',
            'PH' => 'Filippinerna',
            'PK' => 'Pakistan',
            'PL' => 'Polen',
            'PM' => 'Saint-Pierre och Miquelon',
            'PN' => 'Pitcairnöarna',
            'PR' => 'Puerto Rico',
            'PT' => 'Portugal',
            'PW' => 'Palau',
            'PY' => 'Paraguay',
            'QA' => 'Qatar',
            'RE' => 'Réunion',
            'RO' => 'Rumänien',
            'RS' => 'Serbien',
            'RU' => 'Ryssland',
            'RW' => 'Rwanda',
            'SA' => 'Saudiarabien',
            'SB' => 'Salomonöarna',
            'SC' => 'Seychellerna',
            'SD' => 'Sudan',
            'SE' => 'Sverige',
            'SG' => 'Singapore',
            'SH' => 'Sankta Helena',
            'SI' => 'Slovenien',
            'SJ' => 'Svalbard och Jan Mayen',
            'SK' => 'Slovakien',
            'SL' => 'Sierra Leone',
            'SM' => 'San Marino',
            'SN' => 'Senegal',
            'SO' => 'Somalia',
            'SR' => 'Surinam',
            'ST' => 'São Tomé och Príncipe',
            'SV' => 'El Salvador',
            'SY' => 'Syrien',
            'SZ' => 'Swaziland',
            'TC' => 'Turks- och Caicosöarna',
            'TD' => 'Tchad',
            'TF' => 'Franska södra territorierna',
            'TG' => 'Togo',
            'TH' => 'Thailand',
            'TJ' => 'Tadzjikistan',
            'TK' => 'Tokelauöarna',
            'TM' => 'Turkmenistan',
            'TN' => 'Tunisien',
            'TO' => 'Tonga',
            'TP' => 'Östtimor',
            'TR' => 'Turkiet',
            'TT' => 'Trinidad och Tobago',
            'TV' => 'Tuvalu',
            'TW' => 'Taiwan',
            'TZ' => 'Tanzania',
            'UA' => 'Ukraina',
            'UG' => 'Uganda',
            'UM' => 'USA:s yttre öar',
            'US' => 'USA',
            'UY' => 'Uruguay',
            'UZ' => 'Uzbekistan',
            'VA' => 'Vatikanstaten',
            'VC' => 'Saint Vincent och Grenadinerna',
            'VE' => 'Venezuela',
            'VG' => 'Brittiska Jungfruöarna',
            'VI' => 'Amerikanska Jungfruöarna',
            'VN' => 'Vietnam',
            'VU' => 'Vanuatu',
            'WF' => 'Wallis- och Futunaöarna',
            'WS' => 'Samoa',
            'YE' => 'Jemen',
            'YT' => 'Mayotte',
            'ZA' => 'Sydafrika',
            'ZM' => 'Zambia',
            'ZW' => 'Zimbabwe',
        );
    }

    /**
     *
     * generates XML Document
     *
     * @access public
     * @param $root
     * @param array $data
     * @internal param mixed $arr
     * @return String
     */
    function generate($root, $data=array()) {
        $this->xml = new XmlWriter();
        $this->xml->openMemory();
        $this->xml->startDocument($this->ver,$this->charset);
        $this->xml->startElement($root);
        $this->write($this->xml, $data);
        $this->xml->endElement();
        $this->xml->endDocument();
        $xml = $this->xml->outputMemory(true);
        $this->xml->flush();
        return $xml;
    }

    /**
     * writes Element
     *
     * @access public
     * @param mixed $xml , mixed $data
     * @param $data
     * @return void
     */
    private function write(XMLWriter $xml, $data){
        foreach($data as $key => $value){
            if (!in_array($key, $this->exceptions)) {
                $key = preg_replace("/[^A-Za-z?!]/",'',$key);
            }
            if(is_array($value)){

                $xml->startElement($key);
                $this->write($xml,$value);
                $xml->endElement();
                continue;
            }
            else{
                if(isset($value)){
                    $xml->writeElement($key,$value);
                }
            }

        }
    }
}