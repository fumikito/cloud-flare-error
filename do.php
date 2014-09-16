<?php

$src_dir = rtrim($argv[1], '/');
$target_dir = rtrim($argv[2], '/');

$template_file = $src_dir.'/template.php';
$assetdir = $src_dir.'/assets';

$messages = array(
    'captcha.html' => '::CAPTCHA_BOX::', //Displays a styleable CAPTCHA on pages questioning the human-ness of a visitor.
    'online.html' => '::ALWAYS_ONLINE_NO_COPY_BOX::', //Message explaining that Always Online has no cached copy of the requested page.
    'under-attack.html' => '::IM_UNDER_ATTACK_BOX::', //Message explaining that the site is under attack.
    'error-1000.html' => '::CLOUDFLARE_ERROR_1000S_BOX::', //Message explaining that a CloudFlare 10XX error has occurred.
    'error-500.html' => '::CLOUDFLARE_ERROR_500S_BOX::', //Message explaining that a 5XX error was received from the origin.
    'default.html' => '<p>現在、このサイトはダウン中です。がんばって復旧します。ごめんなさい。</p>',
);

// ファイルを生成
foreach( $messages as $file => $message ){
    ob_start();
    include $template_file;
    $content = ob_get_contents();
    ob_end_clean();
    file_put_contents($target_dir.'/'.$file, $content);
}

// アセットディレクトリをコピー

/**
 * ディレクトリを再帰的に削除
 *
 * @param string $path
 * @return int
 */
function rmdir_recursive ( $path ) {
    if ( is_dir( $path ) ) {
        if ( $handle = opendir( $path ) ) {
            while ( false !== ( $file = readdir( $handle ) ) ) {
                if ( $file != '.' && $file != '..' )
                    unlink( $path."/".$file );
            }
            closedir( $handle );
            rmdir( $path );
            return 1;
        }
    }
    return 0;
}

/**
 * ディレクトリを再帰的にコピー
 *
 * @param string $src
 * @param string $dst
 */
function copy_recursive($src, $dst) {

    // In case you'd like to delete exsiting files, you should call rmdir_recursive..
    if (file_exists($dst)) {
        rmdir_recursive($dst);
    }


    if (is_dir($src)) {
        mkdir($dst);

        $files = scandir($src);
        foreach ($files as $file) {
            if (($file != ".") && ($file != "..")) {
                copy_recursive("$src/$file", "$dst/$file");
            }
        }
    }
    else if (file_exists($src)) {
        copy($src, $dst);
    }
}

copy_recursive($src_dir.'/assets', $target_dir.'/assets');
