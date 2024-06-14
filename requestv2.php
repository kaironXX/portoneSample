<?php
?>
<!DOCTYPE html>
<html lang="ko">
<head>
    <title>Home</title>
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.7.1.slim.min.js"></script>
    <script src="https://cdn.portone.io/v2/browser-sdk.js"></script>
    <script type="text/javascript">
        function randomUUID() {
            return 'xxxxxxxx-xxxx-4xxx-yxxx-xxxxxxxxxxxx'.replace(/[xy]/g, function(c) {
                var r = Math.random() * 16 | 0,
                    v = c == 'x' ? r : (r & 0x3 | 0x8);
                return v.toString(16);
            });
        }

        $(document).ready(async function() {
            $('.btnRequest').click(async function(evt) {
                const response = await PortOne.requestPayment({
                    // Store ID 설정
                    storeId: "store-b4c1e5e1-bf0a-466b-96f5-93b8a5467028",
                    // 채널 키 설정
                    channelKey: "channel-key-31f57163-524c-4cb9-8ca5-19f10c5c60a5",
                    paymentId: `payment-${randomUUID()}`,
                    orderName: "나이키 와플 트레이너 2 SD",
                    totalAmount: 1000,
                    currency: "KRW",
                    payMethod: evt.target.dataset.paymethod,
                    auth_mode: "key-in",
                    virtualAccount: {
                        cashReceiptType: "CORPORATE",
                        accountExpiry: {
                            validHours: 24
                        }
                    }
                });

            });
        });
    </script>
</head>
<body>
hello world
<button class="btnRequest" data-paymethod="CARD">카드 결제요청</button>
<button class="btnRequest" data-paymethod="TRANSFER">계좌이체 결제요청</button>
<button class="btnRequest" data-paymethod="VIRTUAL_ACCOUNT">가상계좌 결제요청</button>
</body>
</html>
