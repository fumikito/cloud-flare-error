cloud-flare-error
=================

## 使い方

* ターミナルでルートフォルダに移動します。
* 特定のディレクトリにtemplate.phpを作成します。
* そのディレクトリ内にassetsというフォルダを作成し、CSSや画像などを入れます。詳しくはこのリポジトリのtakahashifumikiフォルダの構成を見てください。
* template.phpには`$message`という変数が必要です。この変数はCloudFlareが発行するメッセージに書き換えられます。
* 準備ができたら、do.phpをCLIで実行します。引数は下記の例を見てください。
* 発行先のディレクトリにhtmlファイルが生成されます。

```
cd /path/to/this/folder
php do.php source_directory target_directory
```

## TIPS

* CloudFlareの管理画面からプレビューが行えます。
* どのようなCSSを作成すべきかはtakahashifumikiフォルダの例を参考にしてください。
* htmlをCloudFlareに登録する際、URLである必要があります。このプログラムの作者はホスティング先として[Dropboxのpublicディレクトリ機能](https://www.dropbox.com/ja/help/16)を利用しています。

## LICENCE

[MITラインセンス](http://opensource.org/licenses/mit-license.php)です。


