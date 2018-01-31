<?php
namespace PhpTwinfield\Mappers;

use PhpTwinfield\BankTransaction;
use PhpTwinfield\Util;

class BankTransactionMapper extends BaseMapper
{
    public static function map(\DOMDocument $document): BankTransaction
    {
        $banktransaction = new BankTransaction();

        $element = $document->documentElement;

        if (!empty($element->getAttribute("autobalancevat"))) {
            $banktransaction->setAutoBalanceVat(Util::parseBoolean($element->getAttribute("autobalancevat")));
        }

        if (!empty($element->getAttribute("raisewarning"))) {
            $banktransaction->setRaiseWarning(Util::parseBoolean($element->getAttribute("raisewarning")));
        }

        self::setFromTagValue($document, "code", [$banktransaction, "setCode"]);
        self::setFromTagValue($document, "office", [$banktransaction, "setOffice"]);
        self::setFromTagValue($document, "period", [$banktransaction, "setPeriod"]);
        self::setFromTagValue($document, "startvalue", [$banktransaction, "setStartValue"]);

        self::setFromTagValue($document, "statementnumber", [$banktransaction, "setStatementNumber"]);
        self::setFromTagValue($document, "number", [$banktransaction, "setNumber"]);

        return $banktransaction;
    }
}