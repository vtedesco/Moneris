Moneris eSELECTplus API Replacement
========================

An attempt to rewrite some basics parts of Moneris API in well written PHP5

Exemple of a simple vault purchase included

1) Usage
--------------
```php
$moneris = new Moneris('store5','yesguy','esqa.moneris.com');
$moneris->vaultPayment('sgc8ulfVT3iRk5L4Kk5ZHZj12',1.OO);
```