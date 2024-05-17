データベースのユーザー設定に関しては下記ユーザを想定しています。<br>

使用データベース:mysql<br>
データベース名:cafe<br>
ユーザー名:test_user<br>
パスワード:test

-----------------------------------------------------------
/mapで下記コマンドを実行するとマップの機能が有効化する<br>
サーバーを起動する<br>
uvicorn map:app --reload<br>

※上記はFast APIを利用した機能です。<br>
 もし、Fast APIをインストールしていない場合は、下記コマンドを実行してください。
 
 pip install fastapi<br>
 pip install "uvicorn[standard]"<br>

 https://fastapi.tiangolo.com/ja/#_6より
 -----------------------------------------------------------
下記PDFファイルにアプリケーションの概要を記載しています。<br>
不明点等あれば参照してくだだい。<br>

 説明資料_2024portfolio.pdf
