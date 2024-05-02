<?php

declare(strict_types=1);

namespace App\Services\Post;

require_once dirname(__DIR__, 2) . '/NonComposerLibs/simple_html_dom.php';

final class KufarScrapper
{
    /**
     * @return array
     */
    public function parse(): array
    {
        $kufarPosts = [];

        $html = file_get_html('https://re.kufar.by/l/minsk/snyat/kvartiru-dolgosrochno?cur=USD');

        if (!$html) {
            return $kufarPosts;
        }

        $posts = $html->find('.styles_wrapper__Q06m9');

        foreach ($posts as $key => $post) {
            $kufarPosts[$key]['link'] = $post->href; // Post link extracting
            $kufarPosts[$key]['image_src'] = $post->find('img', 0)?->src; // Image src extracting

            $plaintext = $post->plaintext; // Content text receiving

            // BYN price extracting
            $priceBynSubstr = mb_strstr($plaintext, 'р. ', true) ?: '-';
            if (strlen($priceBynSubstr) > 8 || !preg_match('~[0-9]+~', $priceBynSubstr)) {
                continue;
            }

            $kufarPosts[$key]['price_byn'] = str_replace(' ', '', $priceBynSubstr) . ' р.';
            $plaintext = str_replace($priceBynSubstr . 'р.', '', $plaintext);

            // USD price extracting
            $priceUsdSubstr = mb_strstr($plaintext, '*', true) ?: '-';
            $kufarPosts[$key]['price_usd'] = trim($priceUsdSubstr);
            $plaintext = str_replace($priceUsdSubstr . '* в месяц', '', $plaintext);

            // Rooms number extracting
            $kufarPosts[$key]['rooms_num'] = mb_substr($plaintext, 1, 1);
            $plaintext = str_replace($kufarPosts[$key]['rooms_num'] . ' комн., ', '', $plaintext);

            // Size extracting
            $sizeSubstr = mb_strstr($plaintext, ' м', true) ?: '-';
            if (strlen($sizeSubstr) > 6) {
                $sizeSubstr = '-';
            }

            $kufarPosts[$key]['size'] = trim($sizeSubstr);
            $plaintext = str_replace($sizeSubstr . ' м², этаж ', '', $plaintext);

            // Floor extracting
            $floorSubstr = mb_strstr($plaintext, ' из', true) ?: '-';
            if (strlen($floorSubstr) > 4) {
                $floorSubstr = '-';
            }

            $kufarPosts[$key]['floor'] = trim($floorSubstr);
            $plaintext = str_replace($floorSubstr . ' из ', '', $plaintext);

            // Description extracting
            $description = '';
            $plaintextSplitted = mb_str_split($plaintext);

            foreach ($plaintextSplitted as $index => $char) {
                if (ctype_digit($char) && $index < 3) {
                    continue;
                }

                $description .= $char;
            }

            $description = str_replace('Позвонить', '', $description);
            $description = str_replace('Сравнить', '', $description);

            if (!preg_match('~^\p{Lu}~u', $description)) {
                $description = '-';
            }

            $kufarPosts[$key]['description'] = $description . '...';
        }

        return $kufarPosts;
    }
}
