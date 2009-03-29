<?php

/**
 * This property represents the {DAV:}getlastmodified property.
 * 
 * Although this is normally a simple property, windows requires us to add
 * some new attributes.
 *
 * This class uses unix timestamps internally, and converts them to RFC 1123 times for 
 * serialization
 *
 * @package Sabre
 * @version $Id$
 * @copyright Copyright (C) 2007, 2008 Rooftop Solutions. All rights reserved.
 * @author Evert Pot (http://www.rooftopsolutions.nl/) 
 * @license license http://www.freebsd.org/copyright/license.html  BSD License (4 Clause)
 */
class Sabre_DAV_Property_GetLastModified extends Sabre_DAV_Property {

    /**
     * time 
     * 
     * @var int 
     */
    public $time;

    /**
     * __construct 
     * 
     * @param int $time 
     * @return void
     */
    function __construct($time) {

        if (!(int)$time) $time = strtotime($time);
        $this->time = $time;

    }

    /**
     * serialize 
     * 
     * @param DOMElement $prop 
     * @return void
     */
    public function serialize(DOMElement $prop) {

        $doc = $prop->ownerDocument;
        $prop->setAttribute('xmlns:b','urn:uuid:c2f41010-65b3-11d1-a29f-00aa00c14882/');
        $prop->setAttribute('b:dt','dateTime.rfc1123');
        $prop->nodeValue = date(DATE_RFC1123,$this->time);

    }

    /**
     * getTime 
     * 
     * @return int 
     */
    public function getTime() {

        return $this->time;

    }

}

?>