<?php
namespace VIISON\AddressSplitter\Test;

use VIISON\AddressSplitter\AddressSplitter;

/**
 * @copyright Copyright (c) 2017 VIISON GmbH
 */
class AddressSplitterTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider validAddressesProvider
     *
     * @param string $address
     * @param array  $expected
     */
    public function testValidAddresses($address, $expected)
    {
        $this->assertSame($expected, AddressSplitter::splitAddress($address));
    }

    /**
     * @return array
     */
    public function validAddressesProvider()
    {
        return array(
            array(
                '56, route de Genève',
                array(
                    'additionToAddress1' => '',
                    'streetName'         => 'route de Genève',
                    'houseNumber'        => '56',
                    'houseNumberParts'   => array(
                        'base' => '56',
                        'extension' => ''
                    ),
                    'additionToAddress2' => ''
                )
            ),
            array(
                'Piazza dell\'Indipendenza 14',
                array(
                    'additionToAddress1' => '',
                    'streetName'         => 'Piazza dell\'Indipendenza',
                    'houseNumber'        => '14',
                    'houseNumberParts'   => array(
                        'base' => '14',
                        'extension' => ''
                    ),
                    'additionToAddress2' => ''
                )
            ),
            array(
                'Neuhof 13/15',
                array(
                    'additionToAddress1' => '',
                    'streetName'         => 'Neuhof',
                    'houseNumber'        => '13/15',
                    'houseNumberParts'   => array(
                        'base' => '13',
                        'extension' => '15'
                    ),
                    'additionToAddress2' => ''

                )
            ),
            array(
                '574 E 10th Street',
                array(
                    'additionToAddress1' => '',
                    'streetName'         => 'E 10th Street',
                    'houseNumber'        => '574',
                    'houseNumberParts'   => array(
                        'base' => '574',
                        'extension' => ''
                    ),
                    'additionToAddress2' => ''
                )
            ),
            array(
                '1101 Madison St # 600',
                array(
                    'additionToAddress1' => '',
                    'streetName'         => 'Madison St',
                    'houseNumber'        => '1101',
                    'houseNumberParts'   => array(
                        'base' => '1101',
                        'extension' => ''
                    ),
                    'additionToAddress2' => '# 600'
                )
            ),
            array(
                '3940 Radio Road, Unit 110',
                array(
                    'additionToAddress1' => '',
                    'streetName'         => 'Radio Road',
                    'houseNumber'        => '3940',
                    'houseNumberParts'   => array(
                        'base' => '3940',
                        'extension' => ''
                    ),
                    'additionToAddress2' => 'Unit 110'
                )
            ),
            array(
                'D 6, 2',
                array(
                    'additionToAddress1' => '',
                    'streetName'         => 'D 6',
                    'houseNumber'        => '2',
                    'houseNumberParts'   => array(
                        'base' => '2',
                        'extension' => ''
                    ),
                    'additionToAddress2' => ''
                )
            ),
            array(
                '13 2ème Avenue',
                array(
                    'additionToAddress1' => '',
                    'streetName'         => '2ème Avenue',
                    'houseNumber'        => '13',
                    'houseNumberParts'   => array(
                        'base' => '13',
                        'extension' => ''
                    ),
                    'additionToAddress2' => ''
                )
            ),
            array(
                '13 2ème Avenue, App 3',
                array(
                    'additionToAddress1' => '',
                    'streetName'         => '2ème Avenue',
                    'houseNumber'        => '13',
                    'houseNumberParts'   => array(
                        'base' => '13',
                        'extension' => ''
                    ),
                    'additionToAddress2' => 'App 3'
                )
            ),
            array(
                'Apenrader Str. 16 / Whg. 3',
                array(
                    'additionToAddress1' => '',
                    'streetName'         => 'Apenrader Str.',
                    'houseNumber'        => '16',
                    'houseNumberParts'   => array(
                        'base' => '16',
                        'extension' => ''
                    ),
                    'additionToAddress2' => 'Whg. 3'
                )
            ),
            array(
                'Pallaswiesenstr. 57 App. 235',
                array(
                    'additionToAddress1' => '',
                    'streetName'         => 'Pallaswiesenstr.',
                    'houseNumber'        => '57',
                    'houseNumberParts'   => array(
                        'base' => '57',
                        'extension' => ''
                    ),
                    'additionToAddress2' => 'App. 235'
                )
            ),
            array(
                'Kirchengasse 7, 1. Stock Zi.Nr. 4',
                array(
                    'additionToAddress1' => '',
                    'streetName'         => 'Kirchengasse',
                    'houseNumber'        => '7',
                    'houseNumberParts'   => array(
                        'base' => '7',
                        'extension' => ''
                    ),
                    'additionToAddress2' => '1. Stock Zi.Nr. 4'
                )
            ),
            array(
                'Wiesentcenter, Bayreuther Str. 108, 2. Stock',
                array(
                    'additionToAddress1' => 'Wiesentcenter',
                    'streetName'         => 'Bayreuther Str.',
                    'houseNumber'        => '108',
                    'houseNumberParts'   => array(
                        'base' => '108',
                        'extension' => ''
                    ),
                    'additionToAddress2' => '2. Stock'
                )
            ),
            array(
                '244W 300N #101',
                array(
                    'additionToAddress1' => '',
                    'streetName'         => 'W 300N',
                    'houseNumber'        => '244',
                    'houseNumberParts'   => array(
                        'base' => '244',
                        'extension' => ''
                    ),
                    'additionToAddress2' => '#101'
                )
            ),
            array(
                'Corso XXII Marzo 69',
                array(
                    'additionToAddress1' => '',
                    'streetName'         => 'Corso XXII Marzo',
                    'houseNumber'        => '69',
                    'houseNumberParts'   => array(
                        'base' => '69',
                        'extension' => ''
                    ),
                    'additionToAddress2' => ''
                )
            ),
            array(
                'Frauenplatz 14 A',
                array(
                    'additionToAddress1' => '',
                    'streetName'         => 'Frauenplatz',
                    'houseNumber'        => '14 A',
                    'houseNumberParts'   => array(
                        'base' => '14',
                        'extension' => 'A'
                    ),
                    'additionToAddress2' => ''
                )
            ),
            array(
                'Mannerheimintie 13A2',
                array(
                    'additionToAddress1' => '',
                    'streetName'         => 'Mannerheimintie',
                    'houseNumber'        => '13A2',
                    'houseNumberParts'   => array(
                        'base' => '13',
                        'extension' => 'A2'
                    ),
                    'additionToAddress2' => ''
                )
            ),
            array(
                'Heinestr.13',
                array(
                    'additionToAddress1' => '',
                    'streetName'         => 'Heinestr.',
                    'houseNumber'        => '13',
                    'houseNumberParts'   => array(
                        'base' => '13',
                        'extension' => ''
                    ),
                    'additionToAddress2' => ''
                )
            ),
            array(
                'Am Aubach11',
                array(
                    'additionToAddress1' => '',
                    'streetName'         => 'Am Aubach',
                    'houseNumber'        => '11',
                    'houseNumberParts'   => array(
                        'base' => '11',
                        'extension' => ''
                    ),
                    'additionToAddress2' => ''
                )
            ),
            array(
                'Tür 18',
                array(
                    'additionToAddress1' => '',
                    'streetName'         => 'Tür',
                    'houseNumber'        => '18',
                    'houseNumberParts'   => array(
                        'base' => '18',
                        'extension' => ''
                    ),
                    'additionToAddress2' => ''
                )
            ),
            array(
                'Çevreyolu Cd. No:19',
                array(
                    'additionToAddress1' => '',
                    'streetName'         => 'Çevreyolu Cd.',
                    'houseNumber'        => '19',
                    'houseNumberParts'   => array(
                        'base' => '19',
                        'extension' => ''
                    ),
                    'additionToAddress2' => ''
                )
            ),
            array(
                'Kerkstraat 3HS',
                array(
                    'additionToAddress1' => '',
                    'streetName'         => 'Kerkstraat',
                    'houseNumber'        => '3HS',
                    'houseNumberParts'   => array(
                        'base' => '3',
                        'extension' => 'HS'
                    ),
                    'additionToAddress2' => ''
                )
            ),
            array(
                'Kerkstraat 3-HS',
                array(
                    'additionToAddress1' => '',
                    'streetName'         => 'Kerkstraat',
                    'houseNumber'        => '3-HS',
                    'houseNumberParts'   => array(
                        'base' => '3',
                        'extension' => 'HS'
                    ),
                    'additionToAddress2' => ''
                )
            ),
            array(
                'Hollandweg1A',
                array(
                    'additionToAddress1' => '',
                    'streetName'         => 'Hollandweg',
                    'houseNumber'        => '1A',
                    'houseNumberParts'   => array(
                        'base' => '1',
                        'extension' => 'A'
                    ),
                    'additionToAddress2' => ''
                )
            ),
            array(
                'Niederer Weg 20 B',
                array(
                    'additionToAddress1' => '',
                    'streetName'         => 'Niederer Weg',
                    'houseNumber'        => '20 B',
                    'houseNumberParts'   => array(
                        'base' => '20',
                        'extension' => 'B'
                    ),
                    'additionToAddress2' => ''
                )
            ),
            array(
                'Kerkstraat 3 HS App. 13',
                array(
                    'additionToAddress1' => '',
                    'streetName'         => 'Kerkstraat',
                    'houseNumber'        => '3 HS',
                    'houseNumberParts'   => array(
                        'base' => '3',
                        'extension' => 'HS'
                    ),
                    'additionToAddress2' => 'App. 13'
                )
            ),
            array(
                'Postbus 3099',
                array(
                    'additionToAddress1' => '',
                    'streetName'         => 'Postbus',
                    'houseNumber'        => '3099',
                    'houseNumberParts'   => array(
                        'base' => '3099',
                        'extension' => ''
                    ),
                    'additionToAddress2' => ''
                )
            ),
            array(
                'Nieder-Ramstädter Str. 181A WG B15',
                array(
                    'additionToAddress1' => '',
                    'streetName'         => 'Nieder-Ramstädter Str.',
                    'houseNumber'        => '181A',
                    'houseNumberParts'   => array(
                        'base' => '181',
                        'extension' => 'A'
                    ),
                    'additionToAddress2' => 'WG B15'
                )
            ),
            array(
                'Poststr. 15-WG2',
                array(
                    'additionToAddress1' => '',
                    'streetName'         => 'Poststr.',
                    'houseNumber'        => '15',
                    'houseNumberParts'   => array(
                        'base' => '15',
                        'extension' => ''
                    ),
                    'additionToAddress2' => 'WG2'
                )
            ),
        );
    }

    /**
     * @dataProvider ambiguousAddressesProvider
     */
    public function testAmbiguousAddress($address, $formatHint, $expected, $expectNS, $expectSN)
    {
        // var_dump($address, $formatHint, AddressSplitter::splitAddress($address, $formatHint));

        $this->assertSame($expected, AddressSplitter::splitAddress($address, $formatHint));

        $thrown = false;

        try {
            AddressSplitter::splitAddress($address, false);
        } catch (E $e) {
            $thrown = true;

            $this->assertSame($address, $e->getAddress());
            $this->assertSame($expectNS, $e->getNumberStreet());
            $this->assertSame($expectSN, $e->getStreetNumber());
        }

        $this->assertTrue($thrown);
    }

    /**
     * @return array
     */
    public function ambiguousAddressesProvider()
    {
        $number_street = array(
            'additionToAddress1' => '',
            'streetName'         => 'Loosterweg',
            'houseNumber'        => '1e',
            'houseNumberParts'   => array(
                'base' => '1',
                'extension' => 'e'
            ),
            'additionToAddress2' => '14'
        );

        $street_number = array(
            'additionToAddress1' => '',
            'streetName'         => '1e Loosterweg',
            'houseNumber'        => '14',
            'houseNumberParts'   => array(
                'base' => '14',
                'extension' => ''
            ),
            'additionToAddress2' => ''
        );

        return array(
            array(
                '1e Loosterweg 14',
                'NL',
                $street_number,
                $number_street,
                $street_number,
            ),
            array(
                '1e Loosterweg 14',
                'US',
                $number_street,
                $number_street,
                $street_number,
            ),
            array(
                '1e Loosterweg 14',
                AddressSplitter::FORMAT_STREET_NUMBER,
                $street_number,
                $number_street,
                $street_number,
            ),
            array(
                '1e Loosterweg 14',
                AddressSplitter::FORMAT_NUMBER_STREET,
                $number_street,
                $number_street,
                $street_number,
            ),
            array(
                '1e Loosterweg 14',
                '528',
                $street_number,
                $number_street,
                $street_number,
            ),
            array(
                '1e Loosterweg 14',
                'NLD',
                $street_number,
                $number_street,
                $street_number,
            ),
        );
    }

    /**
     * @dataProvider invalidAddressesProvider
     * @expectedException \InvalidArgumentException
     *
     * @param string $address
     */
    public function testInvalidAddress($address)
    {
        AddressSplitter::splitAddress($address);
    }

    /**
     * @return array
     */
    public function invalidAddressesProvider()
    {
        return array(
            array('House number missing'),
            array('123'),
            array('#101')
        );
    }
}
