<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;
use App\Models\DeskeraModel;
use GuzzleHttp\Client;

class DSK_Customer extends Model
{
    use HasFactory;

    protected $deskera;
    protected $cdomain;

    public function __construct(DeskeraModel $deskera) {
        $this->deskera = $deskera;
    }

    public function postCustomer(){
        $client = new Client([
            'base_uri' => $this->deskera->account_url
        ]);
        
        $response = $client->request('POST', '/rest/v1/master/customer?token='.$this->deskera->token.'&request={
            "username": "admin",
            "customername": "3P Enterprises",
            "isdefaultHeaderMap": true,
            "userfullname": "admin",
            "cdomain": "rahulerptest47",
            "customercode": "C1",
            "accountcode": "Trade Debtors",
            "termvalue": "NET10",
            "creationDate": "Aug 01, 2017 12:00:00 AM",
            "currencycode": "SGD",
            "isVendor": false,
            "addressDetail": [
            {
            "aliasNameID": "Billing Address1",
            "aliasName": "Billing Address1",
            "address": "KUDALWADI, CHIKHALI,",
            "county": "myanmar",
            "city": "Pune City",
            "state": "Maharashtra",
            "stateCode": "",
            "country": "India",}
            ]
            "postalCode": "412114",
            "phone": "09441887154",
            "mobileNumber": "9822070458 MR.NAIK",
            "fax": "0988565",
            "emailID": "admin@g.com",
            "recipientName": "mgmg",
            "contactPerson": "ag ag",
            "contactPersonNumber": "095541258",
            "contactPersonDesignation": "abc",
            "website": "www.djid.com",
            "isBillingAddress": true,
            "isDefaultAddress": true
            },
            {
            "aliasNameID": "Shipping Address1",
            "aliasName": "Shipping Address1",
            "address": "KUDALWADI, CHIKHALI,",
            "county": "yangon",
            "city": "yangon",
            "state": "yangon",
            "stateCode": "0212",
            "country": "myanmar",
            "postalCode": "01101",
            "phone": "0966562510",
            "mobileNumber": "0955447412",
            "fax": "09652451",
            "emailID": "admin@g.com",
            "recipientName": "mono",
            "contactPerson": "mono",
            "contactPersonNumber": "admin",
            "contactPersonDesignation": "sdaf",
            "website": "jfklasd",
            "shippingRoute": "asdfsd",
            "isBillingAddress": false,
            "isDefaultAddress": true
            }
            ]
            }');
                $json = $response->getBody()->getContents();
                return Log::channel('deskera')->info($json);

    }
}
