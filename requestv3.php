<?php
?>
<!DOCTYPE html>
<html lang="ko">
<head>
    <title>Home</title>
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.7.1.slim.min.js"></script>
    <script type="text/javascript" src="https://tbezauth.settlebank.co.kr/js/SettlePay.js" charset="UTF-8"></script>
    <script type="text/javascript">
        function randomUUID() {
            return 'xxxxxxxx-xxxx-4xxx-yxxx-xxxxxxxxxxxx'.replace(/[xy]/g, function(c) {
                var r = Math.random() * 16 | 0,
                    v = c === 'x' ? r : (r & 0x3 | 0x8);
                return v.toString(16);
            });
        }

        $(document).ready(async function() {
            $('.btnRequest').click(async function() {
                //console.log(SettlePay.popup);
                //console.log(SettlePay.getUrl(sampleFm));
                $(".samplefm .ordNo").val("OID" + randomUUID());
                SettlePay.execute($(".sampleFm")[0]);

            });
        });
    </script>
</head>
<body>
헥토 내통장
<form name="sampleFm" class="sampleFm">
    <input type="hidden" name="hdrInfo" value="IA_AUTHPAGE_1.0_1.0"/>
    <input type="hidden" name="apiVer" value="1.0"/>
    <input type="hidden" name="processType" value="D"/>
    <input type="hidden" name="merchantId" value="OID201902210001"/>
    <input type="hidden" name="ordNo" class="ordNo" value=""/>
    <input type="hidden" name="trDay" value="20240516"/>
    <input type="hidden" name="trTime" value="153000"/>
    <input type="hidden" name="regularpayYn" value="Y"/>
    <input type="hidden" name="trPrice" value="1000"/>
    <input type="hidden" name="productNm" value="배추"/>
</form>
<button class="btnRequest" >내통장 결제요청</button>
</body>
</html>
