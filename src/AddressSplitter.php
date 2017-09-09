<?php
namespace VIISON\AddressSplitter;

use VIISON\AddressSplitter\Exceptions\SplittingException;
use VIISON\AddressSplitter\Exceptions\AmbiguousAddressFormatException;

/**
 * @copyright Copyright (c) 2017 VIISON GmbH
 */
class AddressSplitter
{
    const FORMAT_NUMBER_STREET = 1;
    const FORMAT_STREET_NUMBER = 2;

    // Hong Kong needs a special exception
    // English address is NUMBER_STREET
    // Chinese address is STREET_NUMBER
    const FORMAT_HONG_KONG = 3;

    // Japan has up to 5 numbers
    // Qatar has no street names (Just PO boxes)
    // Malaysia shoves the postal code in between the number and street
    //
    // Rest I wasn't able to ascertain the format at all.
    // Additions/corrections welcome
    static public $formatMap = array(
        'AR' => self::FORMAT_STREET_NUMBER,
        'ARG' => self::FORMAT_STREET_NUMBER,
        '032' => self::FORMAT_STREET_NUMBER,
        'AU' => self::FORMAT_NUMBER_STREET,
        'AUS' => self::FORMAT_NUMBER_STREET,
        '036' => self::FORMAT_NUMBER_STREET,
        'AT' => self::FORMAT_STREET_NUMBER,
        'AUT' => self::FORMAT_STREET_NUMBER,
        '040' => self::FORMAT_STREET_NUMBER,
        'BD' => self::FORMAT_STREET_NUMBER,
        'BGD' => self::FORMAT_STREET_NUMBER,
        '050' => self::FORMAT_STREET_NUMBER,
        'BE' => self::FORMAT_STREET_NUMBER,
        'BEL' => self::FORMAT_STREET_NUMBER,
        '056' => self::FORMAT_STREET_NUMBER,
        'BR' => self::FORMAT_STREET_NUMBER,
        'BRA' => self::FORMAT_STREET_NUMBER,
        '076' => self::FORMAT_STREET_NUMBER,
        'BY' => self::FORMAT_STREET_NUMBER,
        'BLR' => self::FORMAT_STREET_NUMBER,
        '112' => self::FORMAT_STREET_NUMBER,
        'CA' => self::FORMAT_NUMBER_STREET,
        'CAN' => self::FORMAT_NUMBER_STREET,
        '124' => self::FORMAT_NUMBER_STREET,
        'CL' => self::FORMAT_STREET_NUMBER,
        'CHL' => self::FORMAT_STREET_NUMBER,
        '152' => self::FORMAT_STREET_NUMBER,
        'CN' => self::FORMAT_STREET_NUMBER,
        'CHN' => self::FORMAT_STREET_NUMBER,
        '156' => self::FORMAT_STREET_NUMBER,
        'HR' => self::FORMAT_STREET_NUMBER,
        'HRV' => self::FORMAT_STREET_NUMBER,
        '191' => self::FORMAT_STREET_NUMBER,
        'CZ' => self::FORMAT_STREET_NUMBER,
        'CZE' => self::FORMAT_STREET_NUMBER,
        '203' => self::FORMAT_STREET_NUMBER,
        'DK' => self::FORMAT_STREET_NUMBER,
        'DNK' => self::FORMAT_STREET_NUMBER,
        '208' => self::FORMAT_STREET_NUMBER,
        'EE' => self::FORMAT_STREET_NUMBER,
        'EST' => self::FORMAT_STREET_NUMBER,
        '233' => self::FORMAT_STREET_NUMBER,
        'FJ' => self::FORMAT_NUMBER_STREET,
        'FJI' => self::FORMAT_NUMBER_STREET,
        '242' => self::FORMAT_NUMBER_STREET,
        'FI' => self::FORMAT_STREET_NUMBER,
        'FIN' => self::FORMAT_STREET_NUMBER,
        '246' => self::FORMAT_STREET_NUMBER,
        'FR' => self::FORMAT_NUMBER_STREET,
        'FRA' => self::FORMAT_NUMBER_STREET,
        '250' => self::FORMAT_NUMBER_STREET,
        'DE' => self::FORMAT_STREET_NUMBER,
        'DEU' => self::FORMAT_STREET_NUMBER,
        '276' => self::FORMAT_STREET_NUMBER,
        'GR' => self::FORMAT_STREET_NUMBER,
        'GRC' => self::FORMAT_STREET_NUMBER,
        '300' => self::FORMAT_STREET_NUMBER,
        'GL' => self::FORMAT_STREET_NUMBER,
        'GRL' => self::FORMAT_STREET_NUMBER,
        '304' => self::FORMAT_STREET_NUMBER,
        'HK' => self::FORMAT_HONG_KONG,
        'HKG' => self::FORMAT_HONG_KONG,
        '344' => self::FORMAT_HONG_KONG,
        'HU' => self::FORMAT_NUMBER_STREET,
        'HUN' => self::FORMAT_NUMBER_STREET,
        '348' => self::FORMAT_NUMBER_STREET,
        'IS' => self::FORMAT_STREET_NUMBER,
        'ISL' => self::FORMAT_STREET_NUMBER,
        '352' => self::FORMAT_STREET_NUMBER,
        'IN' => self::FORMAT_NUMBER_STREET,
        'IND' => self::FORMAT_NUMBER_STREET,
        '356' => self::FORMAT_NUMBER_STREET,
        'ID' => self::FORMAT_STREET_NUMBER,
        'IDN' => self::FORMAT_STREET_NUMBER,
        '360' => self::FORMAT_STREET_NUMBER,
        'IR' => self::FORMAT_STREET_NUMBER,
        'IRN' => self::FORMAT_STREET_NUMBER,
        '364' => self::FORMAT_STREET_NUMBER,
        'IQ' => self::FORMAT_STREET_NUMBER,
        'IRQ' => self::FORMAT_STREET_NUMBER,
        '368' => self::FORMAT_STREET_NUMBER,
        'IE' => self::FORMAT_NUMBER_STREET,
        'IRL' => self::FORMAT_NUMBER_STREET,
        '372' => self::FORMAT_NUMBER_STREET,
        'IL' => self::FORMAT_STREET_NUMBER,
        'ISR' => self::FORMAT_STREET_NUMBER,
        '376' => self::FORMAT_STREET_NUMBER,
        'IT' => self::FORMAT_STREET_NUMBER,
        'ITA' => self::FORMAT_STREET_NUMBER,
        '380' => self::FORMAT_STREET_NUMBER,
        'KR' => self::FORMAT_STREET_NUMBER,
        'KOR' => self::FORMAT_STREET_NUMBER,
        '410' => self::FORMAT_STREET_NUMBER,
        'LV' => self::FORMAT_STREET_NUMBER,
        'LVA' => self::FORMAT_STREET_NUMBER,
        '428' => self::FORMAT_STREET_NUMBER,
        'LU' => self::FORMAT_NUMBER_STREET,
        'LUX' => self::FORMAT_NUMBER_STREET,
        '442' => self::FORMAT_NUMBER_STREET,
        'MO' => self::FORMAT_STREET_NUMBER,
        'MAC' => self::FORMAT_STREET_NUMBER,
        '446' => self::FORMAT_STREET_NUMBER,
        'MY' => self::FORMAT_NUMBER_STREET,
        'MYS' => self::FORMAT_NUMBER_STREET,
        '458' => self::FORMAT_NUMBER_STREET,
        'MX' => self::FORMAT_STREET_NUMBER,
        'MEX' => self::FORMAT_STREET_NUMBER,
        '484' => self::FORMAT_STREET_NUMBER,
        'NL' => self::FORMAT_STREET_NUMBER,
        'NLD' => self::FORMAT_STREET_NUMBER,
        '528' => self::FORMAT_STREET_NUMBER,
        'NZ' => self::FORMAT_NUMBER_STREET,
        'NZL' => self::FORMAT_NUMBER_STREET,
        '554' => self::FORMAT_NUMBER_STREET,
        'NO' => self::FORMAT_STREET_NUMBER,
        'NOR' => self::FORMAT_STREET_NUMBER,
        '578' => self::FORMAT_STREET_NUMBER,
        'OM' => self::FORMAT_STREET_NUMBER,
        'OMN' => self::FORMAT_STREET_NUMBER,
        '512' => self::FORMAT_STREET_NUMBER,
        'PK' => self::FORMAT_NUMBER_STREET,
        'PAK' => self::FORMAT_NUMBER_STREET,
        '586' => self::FORMAT_NUMBER_STREET,
        'PE' => self::FORMAT_STREET_NUMBER,
        'PER' => self::FORMAT_STREET_NUMBER,
        '604' => self::FORMAT_STREET_NUMBER,
        'PH' => self::FORMAT_NUMBER_STREET,
        'PHL' => self::FORMAT_NUMBER_STREET,
        '608' => self::FORMAT_NUMBER_STREET,
        'PL' => self::FORMAT_STREET_NUMBER,
        'POL' => self::FORMAT_STREET_NUMBER,
        '616' => self::FORMAT_STREET_NUMBER,
        'PT' => self::FORMAT_STREET_NUMBER,
        'PRT' => self::FORMAT_STREET_NUMBER,
        '620' => self::FORMAT_STREET_NUMBER,
        'RO' => self::FORMAT_STREET_NUMBER,
        'ROU' => self::FORMAT_STREET_NUMBER,
        '642' => self::FORMAT_STREET_NUMBER,
        'RU' => self::FORMAT_STREET_NUMBER,
        'RUS' => self::FORMAT_STREET_NUMBER,
        '643' => self::FORMAT_STREET_NUMBER,
        'SA' => self::FORMAT_NUMBER_STREET,
        'SAU' => self::FORMAT_NUMBER_STREET,
        '682' => self::FORMAT_NUMBER_STREET,
        'RS' => self::FORMAT_STREET_NUMBER,
        'SRB' => self::FORMAT_STREET_NUMBER,
        '688' => self::FORMAT_STREET_NUMBER,
        'SG' => self::FORMAT_NUMBER_STREET,
        'SGP' => self::FORMAT_NUMBER_STREET,
        '702' => self::FORMAT_NUMBER_STREET,
        'SK' => self::FORMAT_STREET_NUMBER,
        'SVK' => self::FORMAT_STREET_NUMBER,
        '703' => self::FORMAT_STREET_NUMBER,
        'ZA' => self::FORMAT_NUMBER_STREET,
        'ZAF' => self::FORMAT_NUMBER_STREET,
        '710' => self::FORMAT_NUMBER_STREET,
        'SI' => self::FORMAT_STREET_NUMBER,
        'SVN' => self::FORMAT_STREET_NUMBER,
        '705' => self::FORMAT_STREET_NUMBER,
        'ES' => self::FORMAT_STREET_NUMBER,
        'ESP' => self::FORMAT_STREET_NUMBER,
        '724' => self::FORMAT_STREET_NUMBER,
        'LK' => self::FORMAT_NUMBER_STREET,
        'LKA' => self::FORMAT_NUMBER_STREET,
        '144' => self::FORMAT_NUMBER_STREET,
        'SE' => self::FORMAT_STREET_NUMBER,
        'SWE' => self::FORMAT_STREET_NUMBER,
        '748' => self::FORMAT_STREET_NUMBER,
        'CH' => self::FORMAT_STREET_NUMBER,
        'CHE' => self::FORMAT_STREET_NUMBER,
        '756' => self::FORMAT_STREET_NUMBER,
        'TW' => self::FORMAT_HONG_KONG,
        'TWN' => self::FORMAT_HONG_KONG,
        '158' => self::FORMAT_HONG_KONG,
        'TH' => self::FORMAT_NUMBER_STREET,
        'THA' => self::FORMAT_NUMBER_STREET,
        '764' => self::FORMAT_NUMBER_STREET,
        'TR' => self::FORMAT_STREET_NUMBER,
        'TUR' => self::FORMAT_STREET_NUMBER,
        '792' => self::FORMAT_STREET_NUMBER,
        'UA' => self::FORMAT_STREET_NUMBER,
        'UKR' => self::FORMAT_STREET_NUMBER,
        '804' => self::FORMAT_STREET_NUMBER,
        'GB' => self::FORMAT_NUMBER_STREET,
        'GBR' => self::FORMAT_NUMBER_STREET,
        '826' => self::FORMAT_NUMBER_STREET,
        'US' => self::FORMAT_NUMBER_STREET,
        'USA' => self::FORMAT_NUMBER_STREET,
        '840' => self::FORMAT_NUMBER_STREET,
        'UY' => self::FORMAT_STREET_NUMBER,
        'URY' => self::FORMAT_STREET_NUMBER,
        '858' => self::FORMAT_STREET_NUMBER,
        'VN' => self::FORMAT_NUMBER_STREET,
        'VNM' => self::FORMAT_NUMBER_STREET,
        '704' => self::FORMAT_NUMBER_STREET,
    );

    /**
     * This function splits an address line like for example "Pallaswiesenstr. 45 App 231" into its individual parts.
     * Supported parts are additionToAddress1, streetName, houseNumber and additionToAddress2. AdditionToAddress1
     * and additionToAddress2 contain additional information that is given at the start and the end of the string, respectively.
     * Unit tests for testing the regular expression that this function uses exist over at https://regex101.com/r/vO5fY7/1.
     * More information on this functionality can be found at http://blog.viison.com/post/115849166487/shopware-5-from-a-technical-point-of-view#address-splitting.
     *
     * @param string $address
     * @param string|int $formatHint
     * @return array
     * @throws SplittingException
     */
    public static function splitAddress($address, $formatHint = false)
    {
        if (!is_integer($formatHint) && isset(self::$formatMap[$formatHint])) {
            $formatHint = self::$formatMap[$formatHint];
        }

        $regex_NS = '
            /\A\s*
            #########################################################################
            # Option A: [<Addition to address 1>] <House number> <Street name>      #
            # [<Addition to address 2>]                                             #
            #########################################################################
                (?:(?P<Addition_to_address_1>.*?),\s*)? # Addition to address 1
            (?:No\.\s*)?
                (?P<House_number_match>
                     (?P<House_number_base>
                        \pN+
                     )
                     (?:
                        \s*[\-\/\.]?\s*
                        (?P<House_number_extension>(?:[a-zA-Z\pN]){1,2})
                        \s+
                     )?
                )
            \s*,?\s*
                (?P<Street_name>(?:[a-zA-Z]\s*|\pN\pL{2,}\s\pL)\S[^,#]*?(?<!\s)) # Street name
            \s*(?:(?:[,\/]|(?=\#))\s*(?!\s*No\.)
                (?P<Addition_to_address_2>(?!\s).*?))? # Addition to address 2
            \s*\Z/xu';
        $regex_SN = '
            /\A\s*
            #########################################################################
            # Option B: [<Addition to address 1>] <Street name> <House number>      #
            # [<Addition to address 2>]                                             #
            #########################################################################
                (?:(?P<Addition_to_address_1>.*?),\s*(?=.*[,\/]))? # Addition to address 1
                (?!\s*No\.)(?P<Street_name>[^0-9# ]\s*\S(?:[^,#](?!\b\pN+\s))*?(?<!\s)) # Street name
            \s*[\/,]?\s*(?:\sNo[.:])?\s*
                (?P<House_number_match>
                     (?P<House_number_base>
                        \pN+
                     )
                     (?:
                        (?:
                            \s*[\-\/\.]?\s*
                            (?P<House_number_extension>(?:[a-zA-Z\pN]){1,2})
                            \s*
                        )?
                        |
                        (?<!\s)
                     )
                ) # House number
                (?:
                    (?:\s*[-,\/]|(?=\#)|\s)\s*(?!\s*No\.)\s*
                    (?P<Addition_to_address_2>(?!\s).*?)
                )?
            \s*\Z/xu';

        $matches_NS = preg_match($regex_NS, $address, $address_NS);
        $matches_SN = preg_match($regex_SN, $address, $address_SN);

        if ($matches_NS === false || $matches_SN === false) {
            throw new \RuntimeException(sprintf('Error occurred while trying to split address \'%s\'', $address));
        }

        if ($matches_NS) {
            $address_NS = array(
                'additionToAddress1' => $address_NS['Addition_to_address_1'],
                'streetName' => $address_NS['Street_name'],
                'houseNumber' => $address_NS['House_number_match'],
                'houseNumberParts' => array(
                    'base' => $address_NS['House_number_base'],
                    'extension' => isset($address_NS['House_number_extension']) ? $address_NS['House_number_extension'] : ''
                ),
                'additionToAddress2' => (isset($address_NS['Addition_to_address_2'])) ? $address_NS['Addition_to_address_2'] : ''
            );
        }

        if ($matches_SN) {
            $address_SN = array(
                'additionToAddress1' => $address_SN['Addition_to_address_1'],
                'streetName' => $address_SN['Street_name'],
                'houseNumber' => $address_SN['House_number_match'],
                'houseNumberParts' => array(
                    'base' => $address_SN['House_number_base'],
                    'extension' => isset($address_SN['House_number_extension']) ? $address_SN['House_number_extension'] : ''
                ),
                'additionToAddress2' => (isset($address_SN['Addition_to_address_2'])) ? $address_SN['Addition_to_address_2'] : ''
            );
        }

        if ($matches_NS && $matches_SN) {
            if ($formatHint === self::FORMAT_HONG_KONG) {
                if (preg_match('/\p{Han}/u', $address)) {
                    $formatHint = self::FORMAT_STREET_NUMBER;
                } else {
                    $formatHint = self::FORMAT_NUMBER_STREET;
                }
            }

            switch ($formatHint) {
                case self::FORMAT_NUMBER_STREET:
                    return $address_NS;
                case self::FORMAT_STREET_NUMBER:
                    return $address_SN;
                default:
                    throw new AmbiguousAddressFormatException($address, array($address_NS, $address_SN));
            }
        }

        if ($matches_NS) {
            return $address_NS;
        } elseif ($matches_SN) {
            return $address_SN;
        } else {
            throw new SplittingException(SplittingException::CODE_ADDRESS_SPLITTING_ERROR, $address);
        }
    }

    /**
     * @param string $houseNumber A house number string to split in base and extension
     * @return array
     * @throws SplittingException
     */
    public static function splitHouseNumber($houseNumber)
    {
        $regex =
            '/
            \A\s* # Trim white spaces at the beginning
            (?:[nN][oO][\.:]?\s*)? # Trim sth. like No.
            (?:\#\s*)? # Trim #
            (?<House_number_base>
                [\pN]+ # House Number base (only the number)
            )
            \s*[\/\-\.]?\s* # Separator (optional)
            (?<House_number_extension> # House number extension (optional)
                [a-zA-Z\pN]* # Here we allow more than only 2 characters als house number extension
            ) 
            \s*\Z # Trim white spaces at the end
            /xu'; // Option (u)nicode and e(x)tended syntax

        $result = preg_match($regex, $houseNumber, $matches);

        if ($result === 0) {
            throw new SplittingException(SplittingException::CODE_HOUSE_NUMBER_SPLITTING_ERROR, $houseNumber);
        } elseif ($result === false) {
            throw new \RuntimeException(sprintf('Error occurred while trying to house number \'%s\'', $houseNumber));
        }

        return array(
            'base' => $matches['House_number_base'],
            'extension' => $matches['House_number_extension']
        );
    }
}
