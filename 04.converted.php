<script src="https://d2ur3inljr7jwd.cloudfront.net/individeo/prod/edge/js/smartEmbed.js" data-bp-on-ready="onIndivideoReady" data-bp-attachment-code="bWDsAjJ2TMyskB4GEWbC-752" data-bp-lang="en-CA"></script>
<?php
require_once '/var/piv/services/api/setting.php';

$sqlPurl = "SELECT * FROM $DB_TABLE WHERE STATUS_FLAG='PARSED' LIMIT $LIMIT";//limit 3000
$spurl = $pdo->prepare($sqlPurl);
$spurl->execute();
$resultPurl = $spurl->fetchALL();
$num_of_rows_purl = count($resultPurl);
$countPurl = 0;
$noPurl=0;
?>

<script type="text/javascript">
function onIndivideoReady(smartPlayer){
     
        var personalizedData = {
            "CLIENT_TYPE" : 'P',
            "POLICY_HOLDER_NAME" : 'Muhamad Maulana',
            "POLICY_HOLDER_NAME_ROW_2" : 'Rachman',
            "LIFE_ASSURED" : 'Rizky Nur',
            "LIFE_ASSURED_ROW_2" : 'Oktaviani',
            "POLICY_HOLDER_DATE_OF_BIRTH" : '30/12/1992',
            "POLICY_HOLDER_DATE_OF_BIRTH_LIFE_ASSURED" : '10/10/1997',
            "POLICY_NUMBER" : '019876767',
            "CURRENCY_1" : 'Rp.',
            "SUM_ASSURED" : '1.000.000.000',
            "CURRENCY_2" : 'Rp.',
            "PREMIUM_AMOUNT" : '1.000.000.000',
            "CODE_FREQUENCY" : 'K'
            "PAYMENT_FREQUENCY" : 'Quarterly'
            "CODE_PAYMENT_METHOD" : 'D'
            "PAYMENT_METHOD" : 'Auto Debit Rekening Bank'
            "AGENT_NAME" : 'Yopi Anwar'
            "POLICY_HOLDER_PHONE_NUMBER" : '081317903118'
            "EMAIL_POLICY_HOLDER_NAME" : 'm.rachman@quadrant-si.id'
            "CODE_COMPONENT_DESCRIPTION" : 'ZP8'
            "COMPONENT_DESCRIPTION" : 'Zurich Proteksi 8'
            "ISSUED_DATE" : '22/02/2021'
            "CYCLE_DATE" : '20210218'
            "PARSED_AT" : '22/02/2021'
            "CREATED_AT" : '22/02/2021'
            "STATUS_FLAG" : 'CONVERTED'
        };
     
     BEM.bind(BluePlayer.ONMEDIACTA,function(e,p){
      var ctaName = p&&p.ctaName;
      var ctaValue = p&&p.ctaValue;
      
      var smartPlayer = BluePlayer.current;
      
      if(ctaName === "contact"){
       // code that react on the "contact" event...
      }
     });
     
     smartPlayer.initIndivideo(personalizedData);
    }
</script>
