<?php

namespace AgendaTests\Document;


use CommonTestClass;
use LogicException;
use Riesenia\Pohoda\Common\NamespacesPaths;
use Riesenia\Pohoda\Document\AbstractItem;
use Riesenia\Pohoda\ValueTransformer\Listing;
use Riesenia\Pohoda\ValueTransformer\SanitizeEncoding;


class AbstractItemTest extends CommonTestClass
{
    public function testNoNamespace(): void
    {
        $lib = new XDocumentItem(new NamespacesPaths(), new SanitizeEncoding(new Listing()), [], 'foo');
        $this->expectException(LogicException::class);
        $lib->getXML();
    }

    public function testNoPrefix(): void
    {
        $lib = new XDocumentItem(new NamespacesPaths(), new SanitizeEncoding(new Listing()), [], 'foo');
        $lib->setNamespace('bar');
        $this->expectException(LogicException::class);
        $lib->getXML();
    }

    public function testInitParamsRun(): void
    {
        $lib = new XDocumentItem(new NamespacesPaths(), new SanitizeEncoding(new Listing()), [
            'homeCurrency' => [
                'unitPrice' => 198
            ],
            'foreignCurrency' => [
                'unitPrice' => 7591,
            ],
            'stockItem' => [
                'stockItem' => [
                    'ids' => 'STM',
                ],
            ],
        ], 'foo');
        $lib->setNamespace('lst');
        $lib->setNodePrefix('test');
        $this->assertEmpty($lib->getXML());
    }
}


class XDocumentItem extends AbstractItem
{
    protected array $elements = ['homeCurrency', 'foreignCurrency', 'stockItem'];
}
