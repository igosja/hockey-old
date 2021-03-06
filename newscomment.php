<?php

/**
 * @var $auth_date_block_newscomment integer
 * @var $auth_date_block_comment integer
 */

include(__DIR__ . '/include/include.php');

if (!$num_get = (int) f_igosja_request_get('num'))
{
    redirect('/wrong_page.php');
}

$sql = "SELECT `news_date`,
               `news_text`,
               `news_title`,
               `user_id`,
               `user_login`
        FROM `news`
        LEFT JOIN `user`
        ON `news_user_id`=`user_id`
        WHERE `news_id`=$num_get
        LIMIT 1";
$news_sql = f_igosja_mysqli_query($sql);

if (0 == $news_sql->num_rows)
{
    redirect('/wrong_page.php');
}

$news_array = $news_sql->fetch_all(MYSQLI_ASSOC);

if ($data = f_igosja_request_post('data'))
{
    if (isset($auth_user_id) && isset($data['text']) && $auth_date_block_newscomment < time() && $auth_date_block_comment < time())
    {
        $text = htmlspecialchars($data['text']);
        $text = trim($text);

        if (!empty($text))
        {
            $publish = true;

            $sql = "SELECT `newscomment_text`,
                           `newscomment_user_id`
                    FROM `newscomment`
                    WHERE `newscomment_news_id`=$num_get
                    ORDER BY `newscomment_id` DESC
                    LIMIT 1";
            $check_sql = f_igosja_mysqli_query($sql);

            if (0 != $check_sql->num_rows)
            {
                $check_array = $check_sql->fetch_all(MYSQLI_ASSOC);

                if ($auth_user_id == $check_array[0]['newscomment_user_id'] && $text == $check_array[0]['newscomment_text'])
                {
                    $publish = false;
                }
            }

            if ($publish)
            {
                $sql = "INSERT INTO `newscomment`
                        SET `newscomment_date`=UNIX_TIMESTAMP(),
                            `newscomment_news_id`=$num_get,
                            `newscomment_text`=?,
                            `newscomment_user_id`=$auth_user_id";
                $prepare = $mysqli->prepare($sql);
                $prepare->bind_param('s', $text);
                $prepare->execute();
                $prepare->close();

                f_igosja_session_front_flash_set('success', '?????????????????????? ?????????????? ????????????????.');
            }
            else
            {
                f_igosja_session_front_flash_set('error', '???????????? ???????????? ???????????? ?????? ???????????????????? ??????????????????????.');
            }
        }
    }

    refresh();
}

if (!$page = (int) f_igosja_request_get('page'))
{
    $page = 1;
}

$limit  = 20;
$offset = ($page - 1) * $limit;

$sql = "SELECT SQL_CALC_FOUND_ROWS
               `newscomment_date`,
               `newscomment_id`,
               `newscomment_text`,
               `user_id`,
               `user_login`
        FROM `newscomment`
        LEFT JOIN `user`
        ON `newscomment_user_id`=`user_id`
        WHERE `newscomment_news_id`=$num_get
        ORDER BY `newscomment_id` ASC
        LIMIT $offset, $limit";
$newscomment_sql = f_igosja_mysqli_query($sql);

$newscomment_array = $newscomment_sql->fetch_all(MYSQLI_ASSOC);

$sql = "SELECT FOUND_ROWS() AS `count`";
$total = f_igosja_mysqli_query($sql);
$total = $total->fetch_all(MYSQLI_ASSOC);
$total = $total[0]['count'];

$count_page = ceil($total / $limit);

$seo_title          = '?????????????? ??????????. ??????????????????????';
$seo_description    = '?????????????? ?? ?????????????????????? ???? ?????????? ?????????????????????? ?????????????????? ????????.';
$seo_keywords       = '?????????????? ?????????? ??????????????????????';

include(__DIR__ . '/view/layout/main.php');