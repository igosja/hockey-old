<?php

/**
 * @var $auth_user_id integer
 * @var $auth_userrole_id integer
 */

include(__DIR__ . '/include/include.php');

if (!isset($auth_user_id))
{
    redirect('/wrong_page.php');
}

if (USERROLE_USER == $auth_userrole_id)
{
    redirect('/wrong_page.php');
}

if (!$num_get = (int) f_igosja_request_get('num'))
{
    redirect('/wrong_page.php');
}

if (!$rent_id = (int) f_igosja_request_get('rent_id'))
{
    redirect('/wrong_page.php');
}

$sql = "DELETE FROM `rentcomment`
        WHERE `rentcomment_id`=$num_get
        LIMIT 1";
f_igosja_mysqli_query($sql);

f_igosja_session_front_flash_set('success', 'Комментарий успешно удалён.');

redirect('/rent_view.php?num=' . $rent_id);