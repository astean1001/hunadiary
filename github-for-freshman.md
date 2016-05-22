후배를 위한 Github - 저장소 만들기
============
2016.05.23 한양대학교 ERICA 캠퍼스에서 작성
<br>
<br>
Github의 개념에 대해서 "Github란 저장소에 나의 컴퓨터에 있던 코드를 전송하여 타인과 공유할 수 있게 하는 시스템"이냐고 물었지. Github의 개념에 대해서는 잘 이해한 것 같구나. Github는 컴퓨터 프로그램 소스코드를 공유하고, 그 프로그램의 작동에 관련된 여러가지 이슈를 공유하며, 더 나은 프로젝트를 만들고자하는 사람들이 사용하는 [버전 관리 시스템](https://opentutorials.org/course/488/2605)이다. (링크는 생활코딩의 버전관리에 관련된 강좌다. 한번 들어보는 것도 나쁘지 않지.)<br>
<br>
그럼 지금부터 Github에 저장소를 만들고 거기에 파일을 저장하는 것을 해 보자.<br>
내가 [Trello에 준 링크](http://webcache.googleusercontent.com/search?q=cache:DZuZaS_ed_kJ:https://nolboo.github.io/blog/2013/10/06/github-for-beginner/&num=1&client=safari&hl=ko&gl=kr&strip=0&vwsrc=0)와 같은 방법인데 대체 무엇하러 이걸 다시 하는 가에 대해 묻는다면 할말이 없다. 저 글보다는 조금 더 자세히 친절하게 설명해 줄테니 잘 읽고 이해가 되지 않거나 궁금한 점이 있다면 사양 말고 Trello를 통해 질문해.<br>
<br>
Github 홈페이지에서 우선 Repository를 생성하겠지. 이미 모든 과정을 한번씩 따라해 보았다고 하니 스크린샷은 그냥 첨가하지 않을거야. 만약 생성중에 Readme.md를 자동 생성해주는 옵션같은 것들을 체크하지 않았다면, 정말 그냥 빈 저장소가 생겼을 거야. 그리고 Github는 너에게 저장소에 최소한 README.md 정도의 파일이라도 채워두라고 할거야. 아래 스크린샷처럼 말이지. 
<br><br>
<img src="/imgs/github-for-freshman/a.png" width="700"></img><br>
<br>그럼 우리는 컴퓨터로 가서 일단 저장소 이름과 같은 폴더를 하나 만들거야. 위의 스크린샷의 경우에는 hunadiary라는 폴더를 어딘가에 만들겠지. 그리고는 거기 안에 README.md든 무엇이든 우리가 넣고 싶은 파일을 집어넣을 거야. 그리고 이제는 업로드를 할 건데, 여기가 네가 질문한 부분이었지. <br><br>
```
myaccount@macbook ~/hunadiary> git status
On branch master

Initial commit

nothing to commit (create/copy files and use "git add" to track)
```
<br>
git status 명령을 이용하는 이유는 우리가 어느 branch에 있으며, 지금 내 저장소에 어떠한 변경점이 있는지를 파악하기 위해서야. branch에 대해서 일단 먼저 설명해 줄게. git의 장점 중 하나가 마치 포토샵이 history를 저장하듯이 프로그램의 변천사를 저장한다는 점이잖아. git은 그 기능 뿐만 아니라 서로 다른 버전을 저장할 수 있게 하는 기능이 있어. 
<br>
<br>말이 조금 이상한데, 예를 들어서 설명을 해보자. 우리가 파일 관리 프로그램을 만들고 있는데, 서버용과 일반 PC용은 조금 다른 점이 있잖아. 그래서 A라는 토대 위에다가 PC버전은 B라는 기능을 붙이고 서버 버전은 C라는 기능을 붙이고 싶어. A라는 기능은 공통이니까 거기까지는 공통으로 개발하고, 그 이후부터는 가지를 치듯 PC와 서버 부문으로 나누어 개발하면 편리하잖아? 그것을 가능하게 해주는 기능이 Branch(나뭇가지)야. Branch master라는 것은 지금 우리가 나무의 기둥(?)인 최상위 branch에 있음을 의미해. 
<br><br>
그리고 지금 나의 경우 아직 파일 생성을 하지 않아서 nothing to commit이라고 나오지만, 내가 준 링크에서는 Untracked files: 의 목록이 있는게 보여. 영어 그대로 해석하면, 추적되지 않고 있는 파일들이잖아. 말 그대로야. Git이 하는 일은 파일의 생성과, 변경을 추적하고 기록해서 코드 버전을 되돌리거나 변경 사항을 알기 쉽게 해주는 것이잖아. 그런데 아직 저 파일들은 생성만 되고, 추적 대상에는 들어가 있지 않은 것이지. 그래서 다음과 같은 명령어로 추적 대상으로 추가를 해 주는 거야.
<br>
```
git add <filename> or git add *
```
<br>
git add <파일이름>은 하나씩 파일을 추가하거나 할 때 쓰고, 나는 주로 git add *를 써. 무시되고 있는 모든 파일을 추가하거든. *는 [와일드카드 문자](https://ko.wikipedia.org/wiki/와일드카드_문자)라고 하고, 여러 파일을 한꺼번에 작업 할 때 자주 사용해. <br><br>

그 다음은 추적 내역을 저장해 주어야 해. add는 추적 목록에 아직 추적되지 않고 있던 파일을 추가(add)하는 과정이고, commit은 이제 실제로 변경사항(파일의 변경이라던가, 추가라던가...)을 저장소(우리의 컴퓨터)에 저장하는 과정이야.
<br>
```
git commit -m “Add Readme.txt”
```
<br>
commit 뒤에 붙은 -m 옵션은 나중에 github에 저장되었을 때 보면 
<br><br>
<img src="/imgs/github-for-freshman/b.png" width="700"></img>
<br><br>
위처럼 메시지가 추가되서 전송돼. (나는 initial commit이라고 보냈어.)
<br><br>
마지막으로, push를 써서 제일 처음 생성해 두었던 github의 저장소로 보내주는 과정을 하면 돼.
<br><br>
```
myaccount@MacBook-Air ~/hunadiary> git remote add origin https://github.com/huna3869/hunadiary.git

myaccount@MacBook-Air ~/hunadiary> git push -u origin master
Username for 'https://github.com': huna3869
Password for 'https://huna3869@github.com': ************
Counting objects: 3, done.
Delta compression using up to 4 threads.
Compressing objects: 100% (2/2), done.
Writing objects: 100% (3/3), 449 bytes | 0 bytes/s, done.
Total 3 (delta 0), reused 0 (delta 0)
To https://github.com/huna3869/hunadiary.git
 * [new branch]      master -> master
Branch master set up to track remote branch master from origin.
```
<br>
git remote add 명령어는 어딘가에 있는 원격 서버(remote), 우리의 경우에는 github의 위치를 알려주는 역할을 해. 맨 처음 저장소 생성할 때 보면, origin이라는 이름으로 추가한 원격 저장소의 주소가 그 서버의 주소임을 알 수 있지.
<br><br>
저장소 위치를 알려주는 것이 끝나면, 원격 저장소로 변경사항들과 파일을 전송하는 일을 push 명령어를 써서 해. git push <저장소 이름> <브랜치 이름>의 형태로 사용을 해. (-u 옵션은 지금은 무엇을 의미하는지 알 필요가 없는데, 정 궁금하다면, [이 기사](http://stackoverflow.com/questions/5561295/what-does-git-push-u-mean)를 읽어봐.) push를 시작하면, 네가 그 저장소에 대한 권한(ID/PW)이 있는지 묻고, 업로드를 시작해. 그러면 Github에 업로드를 완료한 거야.
<br><br>
이로써 github에 저장소를 만들고 첫 commit을 하는 과정까지를 끝냈어. 처음 사용할 때에는 힘들고 복잡 할 수도 있지만, 그런 어려움들은 익숙해지면 사라지리라고 생각해. 내 미숙한 설명으로 이해가 잘 되었는지 모르겠네. 궁금한게 조금 해소되었길 바랄게.
