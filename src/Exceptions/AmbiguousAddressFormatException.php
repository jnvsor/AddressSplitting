<?php

namespace VIISON\AddressSplitter\Exceptions;

class AmbiguousAddressFormatException extends \UnexpectedValueException
{
    protected $address;
    protected $matches;

    public function __construct($address, $matches)
    {
        $this->address = $address;
        $this->matches = $matches;

        parent::__construct('The address given was ambiguous. It matched multiple possible patterns.');
    }

    public function getOriginalAddress()
    {
        return $this->address;
    }

    public function getMatchingAddresses()
    {
        return $this->matches;
    }
}
