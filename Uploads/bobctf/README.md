BoB Web Hacking CTF 강남백반 팀 문제
============
2016.08.27 강남 미림타워 BoB 센터에서 작성<br>
2016.08.31 한양대학교 ERICA 캠퍼스에서 업로드
<br>
<br>
절대 이메일 보낼 때 파일 첨부 에러가 나는게 귀찮아서 이런 페이지를 만든게 아닙니다. 절대 이메일 보낼 때 파일 첨부 에러가 나는게 귀찮아서 이런 페이지를 만든게 아닙니다. 중요하니까 두번 말합니다.
<br>
#1. 설치
www 디렉토리 안의 모든 파일을 /var/www/html/ 안에 넣어주시면 됩니다.
#2. DB Setting
##2.1. boarddb 데이터베이스
###2.1.1. member 테이블
<pre><code>+-------------+-------------+------+-----+---------+-------+
| Field       | Type        | Null | Key | Default | Extra |
+-------------+-------------+------+-----+---------+-------+
| id          | varchar(16) | NO   | PRI | NULL    |       |
| pass        | varchar(30) | NO   |     | NULL    |       |
| name        | varchar(30) | NO   |     | NULL    |       |
| mail        | varchar(25) | NO   |     | NULL    |       |
| phonenumber | varchar(15) | NO   |     | NULL    |       |
| role        | varchar(20) | NO   |     | user    |       |
| checker     | varchar(50) | NO   |     | TRUE    |       |
+-------------+-------------+------+-----+---------+-------+
</code></pre>
###2.1.2. access 테이블
<pre><code>+-------+-------------+------+-----+---------+-------+
| Field | Type        | Null | Key | Default | Extra |
+-------+-------------+------+-----+---------+-------+
| id    | varchar(16) | YES  |     | NULL    |       |
| Auth  | varchar(10) | YES  |     | NULL    |       |
+-------+-------------+------+-----+---------+-------+</code></pre>
##2.2. myfirst_db 데이터베이스
###2.2.1. member 테이블
<pre><code>+--------------+--------------+------+-----+---------+-------+
| Field        | Type         | Null | Key | Default | Extra |
+--------------+--------------+------+-----+---------+-------+
| user_id      | varchar(16)  | NO   | PRI | NULL    |       |
| passwd       | varchar(255) | NO   |     | NULL    |       |
| name         | varchar(10)  | NO   |     | NULL    |       |
| email        | varchar(25)  | NO   |     | NULL    |       |
| phone_number | varchar(12)  | NO   |     | NULL    |       |
| gender       | tinyint(1)   | NO   |     | NULL    |       |
+--------------+--------------+------+-----+---------+-------+</code></pre>