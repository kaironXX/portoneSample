<?php
?>
<!DOCTYPE html>
<html lang="ko">
<head>
    <title>Home</title>
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.7.1.slim.min.js"></script>
    <script type="text/javascript" src="https://cdn.iamport.kr/v1/iamport.js"></script>
    <script type="text/javascript">
        function getVbankDue() {
// 오늘 날짜 객체 생성
            const today = new Date();

// 내일 날짜 객체 생성
            const tomorrow = new Date(today);
            tomorrow.setDate(today.getDate() + 1);

// 내일 자정 설정
            tomorrow.setHours(0, 0, 0, 0);

// 년, 월, 일, 시, 분, 초 추출
            const year = tomorrow.getFullYear();
            const month = String(tomorrow.getMonth() + 1).padStart(2, '0'); // 월은 0부터 시작하므로 +1
            const day = String(tomorrow.getDate()).padStart(2, '0');
            const hours = String(tomorrow.getHours()).padStart(2, '0');
            const minutes = String(tomorrow.getMinutes()).padStart(2, '0');
            const seconds = String(tomorrow.getSeconds()).padStart(2, '0');

            // yyyy-mm-dd HH:mm:ss 형식으로 포맷팅
            return `${year}-${month}-${day} ${hours}:${minutes}:${seconds}`;
        }

        function randomUUID() {
            return 'xxxxxxxx-xxxx-4xxx-yxxx-xxxxxxxxxxxx'.replace(/[xy]/g, function(c) {
                var r = Math.random() * 16 | 0,
                    v = c == 'x' ? r : (r & 0x3 | 0x8);
                return v.toString(16);
            });
        }

        $(document).ready(async function() {
            const IMP = window.IMP;
            IMP.init("imp84441258");

            console.log(`payment-${randomUUID()}`);

            const requestParameter = {
                // auth_group_id: `auth_grp-${crypto.randomUUID()}`,
               // customer_uid: `cus_uid-${randomUUID()}`,
                pg: 'kcp.AO09C',
                pay_method: 'trans',
                //merchant_uid: product.productId + '.' + term.termId + ':' + uuidv4(),
                merchant_uid:  `mch_uid-${randomUUID()}`,
                name: "테스트 상품",
                amount: 1000,
                currency: 'KRW',
                language: 'ko',
                auth_mode: "key-in",
                notice_url: "https://qhrph80tgolw.share.zrok.io/notice.php",
                vbank_due: getVbankDue()
            }

            $('.btnRequest').click(function(evt) {
                requestParameter.pay_method = evt.target.dataset.paymethod;

                requestParameter.pg = $('.selPG').val();

                // 나이스는 가상계좌와 카드/계좌 이체가 다름
                console.log(requestParameter.pg === "nice_v2.iamport03m");
                console.log(requestParameter.pay_method === "trans");
                if (requestParameter.pg === "nice_v2.iamport03m" || requestParameter.pg === "nice_v2.iamport00m") {
                    if (requestParameter.pay_method === "card") {
                        equestParameter.pg = "nice_v2.iamport03m";
                    } else if (requestParameter.pay_method === "trans") {
                        requestParameter.pg = "nice_v2.iamport00m";
                    } else if (requestParameter.pay_method === "vbank") {
                        requestParameter.pg = "nice_v2.iamport03m";
                    }
                }
                console.log(requestParameter);
                IMP.request_pay(requestParameter, function (rsp) {
                    console.log(rsp);
                });
            });
        });
    </script>
</head>
<body>
    hello world<br/>
    <select class="selPG">
        <option value="kcp.AO09C">KCP</option>
        <option value="tosspayments.iamporttest_3">TOSS</option>
        <option value="nice_v2.iamport03m">Nice</option>
    </select>
    <button class="btnRequest"  data-paymethod="card">카드</button>
    <button class="btnRequest"  data-paymethod="trans">실시간계좌이체</button>
    <button class="btnRequest"  data-paymethod="vbank">가상계좌</button>
</body>
</html>
