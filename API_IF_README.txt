
Introduction

一般意志２．０エンジン→Twitter API ラッパー　のAPI仕様です。

Details
search(string word)
@word 検索語。
@return 直近２０ツイートのユーザーの配列（マージ済み）。
get_tweets(int user_id)
@user_id ツイッターユーザーID。
@return 直近２０ツイートの配列。
get_lists(int user_id)
@user_id ツイッターユーザーID。
@return 指定ユーザーが含まれるリストの名前の配列。
get_folows(int user_id)
@user_id ツイッターユーザーID。
@return 指定ユーザーがフォローしているユーザーのIDの配列。
get_folowers(int user_id)
@user_id ツイッターユーザーID。
@return 指定ユーザーをフォローしているユーザーのIDの配列。

### 雑多なメモwritten by ameda
--MAC OS 10.6 apache定義ファイル
--/private/etc/apache2/httpd.conf

--MAC OS 10.6 apache再起動
sudo /usr/sbin/apachctl restart
