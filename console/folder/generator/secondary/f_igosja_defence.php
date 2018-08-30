<?php

/**
 * Визначаємо силу захисту залежно від хвилини матчу
 * @param $game_result array
 * @return array
 */
function f_igosja_defence($game_result)
{
    for ($i=0; $i<2; $i++)
    {
        if (0 == $i)
        {
            $team = TEAM_HOME;
        }
        else
        {
            $team = TEAM_GUEST;
        }

        if (0 == $game_result['minute'] % 3)
        {
            $defence = $game_result[$team]['team']['power']['defence'][1];
        }
        elseif (1 == $game_result['minute'] % 3)
        {
            $defence = $game_result[$team]['team']['power']['defence'][2];
        }
        else
        {
            $defence = $game_result[$team]['team']['power']['defence'][3];
        }

        $game_result[$team]['team']['power']['defence']['current'] = $defence;
    }

    return $game_result;
}