<?php
   
return [
  
    'pagination_records' => 10,
  
    'user_type' => ['User', 'Admin'],
    'cashfreeutl' => 'https://payout-api.cashfree.com',
    'header' => array(
        "X-Client-Id: CF127611C8GBE22F3KT4N5J3K1OG",
        "X-Client-Secret: 057ec5c0ef50c927e54106e9a42e35538849bfef", 
        "Content-Type: application/json",
    ),
    'auth' => '/payout/v1/authorize',
    'getBene' => '/payout/v1/getBeneficiary/',
    'addBene' => '/payout/v1/addBeneficiary',
    'getBenedata' => '/payout/v1/getBeneId',
    'removeBene' => '/payout/v1/removeBeneficiary',
    'requestTransfer' => '/payout/v1/requestTransfer',
    'getTransferStatus' => '/payout/v1/getTransferStatus?transferId=',
    'bankValidation' => '/payout/v1/validation/bankDetails',
    'beneficiary' => array(
        'beneId' => 'JOHN18019',
        'name' => 'jhon doe',
        'email' => 'johndoe@cashfree.com',
        'phone' => '9876543210',
        'bankAccount' => '026291800001191',
        'ifsc' => 'YESB0000262',
        'address1' => 'address1',
        'city' => 'bangalore',
        'state' => 'karnataka',
        'pincode' => '560001',
    ),
]
  
?>