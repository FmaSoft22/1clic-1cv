<?php

namespace App\Domains\FmaDomUtils;

class Emailing
{
    public const  EmailAddressFormat = "^(?:([\w\s]+?)\s*<(\w+)([\-+.][\w]+)*@(\w[\-\w]*\.){1,5}([A-Za-z]{2,6})>|(\w+)([\-+.][\w]+)*@(\w[\-\w]*\.){1,5}([A-Za-z]{2,6}))$";
    public const  SMSNumberFormat = "(0|\\+33|0033)[1-9][0-9]{8}";
    public const  EmailAddressFormatWithDisplayName = "^((?<displayname>[\w\s'-]+)(?<address><(\w+)([\-+.][\w]+)*@(\w[\-\w]*\.){1,5}([A-Za-z]{2,6})>)(\;|$))+$";
}

class HTTPStatusCode{
    public const S201 ='201';
    public const S200 ='200';
    public const S500 ='500';
    public const S401 ='404';
}

class CurrencySymbol
{
    public const  Euro = "EUR";
    public const  FrancCFA = "XOF";
    public const  Dollars = "USD";
}

class OrderStatus{
    public const PENDING = "PENDING";
    public const CANCELED= "CANCELED";
    public const DELIVERED = "DELIVERED";
}

class IdentifierType{
    public const Email = "EMAIL";
    public const NKey = "NKEY";
    public const MobilePhone = "PHONE";
}

