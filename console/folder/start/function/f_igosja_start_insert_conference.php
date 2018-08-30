<?php

/**
 * Формуємо таблицю та матчі конференції
 */
function f_igosja_start_insert_conference()
{
    $game_array = array();

    $sql = "INSERT INTO `conference` (`conference_season_id`, `conference_team_id`)
            SELECT 1, `team_id`
            FROM `team`
            WHERE `team_id`!=0
            AND `team_id` NOT IN
            (
                SELECT `championship_team_id`
                FROM `championship`
                WHERE `championship_season_id`=1
            )
            ORDER BY `team_id` ASC";
    f_igosja_mysqli_query($sql);

    $sql = "UPDATE `conference`
            SET `conference_place`=`conference_id`
            WHERE `conference_place`=0";
    f_igosja_mysqli_query($sql);

    $sql = "SELECT `schedule_id`
            FROM `schedule`
            WHERE `schedule_tournamenttype_id`=" . TOURNAMENTTYPE_CONFERENCE . "
            AND `schedule_stage_id`=" . STAGE_1_TOUR . "
            AND `schedule_season_id`=1
            LIMIT 1";
    $schedule_sql = f_igosja_mysqli_query($sql);

    $schedule_array = $schedule_sql->fetch_all(MYSQLI_ASSOC);

    $schedule_id = $schedule_array[0]['schedule_id'];

    $sql = "SELECT `conference_team_id`,
                   `stadium_id`
            FROM `conference`
            LEFT JOIN `team`
            ON `conference_team_id`=`team_id`
            LEFT JOIN `stadium`
            ON `team_stadium_id`=`stadium_id`
            WHERE `conference_season_id`=1
            ORDER BY RAND()";
    $team_sql = f_igosja_mysqli_query($sql);

    $count_team = $team_sql->num_rows;
    $team_array = $team_sql->fetch_all(MYSQLI_ASSOC);

    for ($i=0; $i<$count_team; $i=$i+2)
    {
        $team_1_id      = $team_array[$i]['conference_team_id'];
        $team_2_id      = $team_array[$i+1]['conference_team_id'];
        $stadium_id     = $team_array[$i+1]['stadium_id'];
        $game_array[]   = '(' . $team_1_id . ',' . $team_2_id . ',' . $schedule_id . ',' . $stadium_id . ')';
    }

    $game_array = implode(', ', $game_array);

    $sql = "INSERT INTO `game` (`game_guest_team_id`, `game_home_team_id`, `game_schedule_id`, `game_stadium_id`)
            VALUES $game_array;";
    f_igosja_mysqli_query($sql);
}