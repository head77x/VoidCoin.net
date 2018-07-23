# VoidCoin.net
와라페이 포인트 시스템

## 보이드코인 설명 - 와라페이 포인트 시스템
총 세 가지 형태의 리웨드 포인트 시스템을 손쉽게 구축하기 위하여 보이드 코인을 사용합니다.
1. 방문형 리워드 시스템
  ; 여러분의 매장이나, 여러분의 서비스에서 일정 시간마다 바뀌는 QR 코드를 표시해두고, 정해진 시간에 한 번 방문하여 해당 QR 코드를 스캔하는 고객에게 리워드를 주는 형태입니다.

2. 사용 시작과 종료를 직접 고객이 결정 가능한 시간당 리워드 시스템
  ; 여러분의 매장이나, 여러분의 서비스를 시작할 때, QR을 표시해서 스캔하여 시작되고, 매장에서 나갈때나 서비스를 종료할 때 QR을 표시하여 스캔하면, 그 시간동안의 사용으로 판단하여 리워드를 주는 형태입니다.

3. 사용 시작후 특정 조건에 종료될 때, 시간당 리워드 시스템
  ; 여러분의 서비스를 시작할 때, QR을 표시해서 스캔하여 시작되고, 서비스내에서 특정 조건에 의해서 종료될 때, 자동으로 종료를 통지하여 해당 시간동안의 사용으로 계산하여 리워드를 주는 형태로, 2번보다 자동화된 시스템에 쓰입니다.

## API 설명서

### 1. 방문형 리워드 요청

* 요청 메세지 URL

HTTP URL|http://wara-kr.quickget.co/pay/request.html
----|----
HTTP Method|GET

* 요청 메세지 전달 인자설명

인자명|필요여부|기본값|설명
----|----|----|----
appid|필요|없음|상점 appid(와라페이 앱 등에서 확인 가능)
money|옵션|없음|결제 받을 금액 입력. 비워두면, 고객이 직접 결제금액 입력하여 결제가능합니다. 주의 : 입력시 반드시 10원 이상 단위여야 합니다.
callback|필요|html|[json]과[html]중 하나 입력. callback=json 으로 입력하면, 가맹점의 웹사이트를 벗어나지 않고, 전달받은 QR 코드를 표시하고, 결제가 완료될 때 까지 대기하다가, 고객이 결제를 완료하면 결과를 Notify URL( 2-1번의 내용 )로 JSON 형식으로 전달받아 처리하며, callback=html 으로 입력하면, 가맹점의 웹사이트를 벗어나 퀵겟 결제 화면으로 이동하여, 결제가 완료되면 아래에 설정하는 Return URL( 2-2번의 내용)로 웹사이트 이동하면서 결과를 전달받습니다. 둘이 분리된 가장 큰 이유는, json 방식은 귀사의 웹사이트에서 이동없이 모든 처리를 할 수 있는 방식이며, html 방식은 귀사의 웹사이트에서 대기 등의 불편함 없이, 바로 퀵겟의 결제 화면으로 이동하여 결제가 완료된 후, 다시 귀사의 웹사이트로 돌아오는 형태로 처리하기 위함입니다.
forever|옵션|0|해당 QR코드에 결제 제약시간/횟수가 있는지 여부입니다. forever=1 로 설정하시면, 영구적으로 동일한 QR 코드로 결제받아, 새로운 큐알코드를 생성하지 않습니다. 보안을 위해서 forever=0 을 추천드립니다. 
payment|옵션|warapay|사용자가 결제시 사용하기를 희망하는 결제방식을 지정가능합니다. 현재는 비워두시면, 와라페이/알리페이/위챗페이를 이용해서 고객이 결제할 수 있습니다.
custom_trade_sn|옵션|없음|해당 주문을 구분할 수 있는 직접 생성하시는 구분코드입니다. 즉, 많은 판매 제품중에서 어떤 제품을 구매했는지 구분하거나, 정확히 어떤 고객이 주문했는지 구분하기 위해서, 귀사의 시스템에서 스스로 생성한 '주문서 번호' 입니다. 이는 Return URL 에서 결제 결과를 전달 받으신 후, 직접 결제 결과를 확인하실때 스스로 비교하시기 위해서 정하신 코드이며, 중복되지 않는 유일한 코드여야 합니다. 
notify|옵션|없음|결제 결과를 통보받을 귀사의 서버 URL입니다. 귀사의 서버는 이 통보를 받은 후, 전달받은 영수번호를 검사하셔서, 실제 결제가 완료되었는지 체크하시면 됩니다.
return|옵션|없음|callback=html 으로 셋팅한 경우, 결제가 완료된 후 다시 귀사의 웹사이트로 이동하면서 결제 결과를 전달할 귀사 서버의 URL 입니다.
qrsizetype|옵션|mp|생성될 QR코드의 크기타입으로 mp와 pp 중 지정 가능합니다.
qrsize|옵션|10|위의 qrsizetype을 mp로 지정했다면, 1.00 ~ 50.00의 크기 설정 가능하고, pp로 지정했다면 1~1000 로 지정가능 합니다. 참고로 1mp는 45px 입니다.
qrimagetype|옵션|png|이미지 포맷 지정이 가능하며 png 와 jpg 중 선택 가능합니다.
custom|옵션|0|금액|입력 단위로, 만약 0이외의 값을 입력했다면, money 값이 0인것처럼, 고객이 결제금액을 입력하는 방식이 됩니다. 즉, 100, 500, 1000 등으로 결제 금액 단위를 설정 가능하며, 예를들어 500으로 입력했다면, 고객은 500원 단위로 결제금액을 입력해서 결제 가능합니다. 이 기능은 보통 자동판매기 등에서 500원 코인이나, 1000원 지폐를 여러장 결제 받는 등의 용도로 사용됩니다.

<pre>
예> http://wara-kr.quickget.co/pay/request.html?appid=86572812&money=100&callback=html&return=www.yourserverurl.com/yourprocess.php
 * GET방식이므로 웹브라우저에서 테스트 가능
</pre>

* GET 요청에 대한 리턴값(응답 메세지) 설명

callback=html|바로 결제화면이 열리기 때문에, 응답메세지가 따로 존재하지 않음
----|----
callback=json| JSON 리턴 code 값 : 0이면 성공, 1이면 실패
-|JSON 리턴 message 값 : 성공시, QR 코드에 대한 정보. 실패시 실패 관련 메세지 
-|JSON 리턴 qrcode 값 : QR코드용 주소 - 이 주소를 이용하여 직접 QR코드를 생성하여, 자신의 웹사이트에 표시

<pre>
성공시 예: 
	{"code":0,"message":"https://epay.miguyouxi.com/*****","qrcode":"http://wara-kr.netmego.com/*****"}	
	
실패시 예: 
	{"code":1,"message":"appid_error"}
</pre>

### 2-1. 결제 결과 통지 ( callback=json 으로 지정 요청한 경우, QR 결제 완료시까지 가맹점 웹사이트에서 대기함 )
주의 : callback=json 으로 지정한 경우, 1의 요청으로 전달받은 QR을 화면에 표시한 채, 가맹점에서는 결제가 될 때까지 대기합니다. 이 때, 사용자가 결제를 완료하면, 본 API가 실행되어, 가맹점의 서버에 결제 결과를 통지하게 됩니다.

* 가맹점 서버 호출 메세지 URL

HTTP URL|Notify URL로 지정된 주소
----|----
HTTP Method|POST

* POST 전달되는 값 설명

인자명|설명
----|----
code|성공 실패 여부 : 0이면 성공, 1이면 실패
trade_sn|영수증 번호 : 이 코드를 이용해서, 하단의 영수증 검증을 완료하여 실제 결제가 완료되었는지 체크 가능
appid|상점 appid : 결제 받은 상점이 자신이 맞는지 확인시 사용
custom_trade_sn|주문서 번호 : 귀사에서 중복되지 않은 독립된 코드로, 주문을 식별하기 위해, QR생성시 전달한 코드. 이를 통해서 귀사가 요청해서 생성한 QR코드가 맞는지 체크 가능
money|실제 결제 금액 : QR 생성시 금액을 지정한 경우, 해당 금액이 맞는지 체크. 맞는 경우, 또는 유저가 직접 입력한 금액이라면, 자체 조건에 따라 처리. 쇼핑몰 등의 정해진 금액을 결제하는 경우는, 요청 금액과 비교하면 되며, 자동판매기 등의 경우, 사용자가 입력한 금액만큼의 처리를 하면 됨.
status|결제 결과 상태메세지 : SUCCESS 인 경우만 성공한 경우이며, 그 이외에는 관련 에러메세지 등
paytime|결제 완료된 시간 : time 관련 서버측의 결제완료 시간

### 2-2. 결제 결과 통지 ( callback=html 로 지정 요청한 경우, 가맹점 웹사이트는 바로 퀵겟 결제 사이트로 이동 )
주의 : callback=json 으로 지정한 경우, 1의 요청 API를 실행하면, 바로 퀵겟 결제 사이트로 이동하므로, 가맹점 웹사이트에는 포커스가 남아있지 않습니다. 퀵겟 웹사이트에서 사용자가 결제를 완료하게 되면, 본 API가 실행되면서, 다시 가맹점의 웹사이트로 포커스가 이동하게 됩니다.

* 가맹점 서버 호출 메세지 URL

HTTP URL|Return URL로 지정된 주소
----|----
HTTP Method|POST

* POST 전달되는 값 설명

인자명|설명
----|----
trade_sn|영수증 번호 : 이 코드를 이용해서, 하단의 영수증 검증을 완료하여 실제 결제가 완료되었는지 체크 가능
appid|상점 appid : 결제 받은 상점이 자신이 맞는지 확인시 사용
custom_trade_sn|주문서 번호 : 귀사에서 중복되지 않은 독립된 코드로, 주문을 식별하기 위해, QR생성시 전달한 코드. 이를 통해서 귀사가 요청해서 생성한 QR코드가 맞는지 체크 가능
money|실제 결제 금액 : QR 생성시 금액을 지정한 경우, 해당 금액이 맞는지 체크. 맞는 경우, 또는 유저가 직접 입력한 금액이라면, 자체 조건에 따라 처리. 쇼핑몰 등의 정해진 금액을 결제하는 경우는, 요청 금액과 비교하면 되며, 자동판매기 등의 경우, 사용자가 입력한 금액만큼의 처리를 하면 됨.
status|결제 결과 상태메세지 : SUCCESS 인 경우만 성공한 경우이며, 그 이외에는 관련 에러메세지 등
paytime|결제 완료된 시간 : time 관련 서버측의 결제완료 시간

### 3. 전달된 영수증 번호를 이용하여 결제 검증하기(공통)

* 요청 메세지 URL

HTTP URL|http://wara-kr.quickget.co/pay/tradeQuery.html
----|----
HTTP Method|GET

* 요청 메세지 전달 인자설명

인자명|설명
----|----
appid|상점 appid : 주문했던 동일한 상점 appid
trade_sn|전달받은 영수증번호 : 결제 완료후 통보받은 영수증 번호를 전달하여, 최종적으로 결제가 완료된것이 맞는지 확인

* GET 요청에 대한 리턴값(응답 메세지) 설명

JSON 리턴 code 값 | 0이면 성공, 1이면 실패
----|----
JSON 리턴 message 값 | 실패시 실패 관련 메세지

<pre>
요청 예: http://wara-kr.quickget.co/pay/tradeQuery.html?appid=yourid&trade_sn=received_trade_sn
</pre>
