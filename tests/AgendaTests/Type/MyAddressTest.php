<?php

namespace AgendaTests\Type;


use CommonTestClass;
use Riesenia\Pohoda\Common\NamespacesPaths;
use Riesenia\Pohoda\Type\MyAddress;
use Riesenia\Pohoda\ValueTransformer\Listing;
use Riesenia\Pohoda\ValueTransformer\SanitizeEncoding;


class MyAddressTest extends CommonTestClass
{
    public function testUpdateParams(): void
    {
        $lib = new MyAddress(new NamespacesPaths(), new SanitizeEncoding(new Listing()), [
            'establishment' => [
                'company' => 'example',
            ],
            ], 'foo');
        $lib->setNamespace('lst');
        $lib->setNodeName('bar');
        $this->assertEquals('', $lib->getXML());
    }
}
