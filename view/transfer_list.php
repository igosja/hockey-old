<?php
/**
 * @var $count_transfer integer
 * @var $country_array array
 * @var $playerposition_array array
 * @var $playerspecial_array array
 * @var $position_array array
 * @var $total integer
 * @var $transfer_array array
 * @var $transferapplication_array array
 */
?>
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <h1>
            Список хоккеистов, выставленных на трансфер
        </h1>
    </div>
</div>
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center">
        <?php include(__DIR__ . '/include/transfer_link.php'); ?>
    </div>
</div>
<form method="GET">
    <div class="row">
        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-6">
            Условия поиска:
        </div>
        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-6">
            <label class="hidden" for="country_id">Национальность</label>
            <select class="form-control" id="country_id" name="data[country_id]">
                <option value="">Национальность</option>
                <?php foreach ($country_array as $item) { ?>
                    <option
                        value="<?= $item['country_id']; ?>"
                        <?php if (isset($data['country_id']) && $data['country_id'] == $item['country_id']) { ?>
                            selected
                        <?php } ?>
                    >
                        <?= $item['country_name']; ?>
                    </option>
                <?php } ?>
            </select>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-5">
            <input
                class="form-control"
                name="data[name_name]"
                placeholder="Имя"
                <?php if (isset($data['name_name'])) { ?>
                    value="<?= $data['name_name']; ?>"
                <?php } ?>
            />
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-7">
            <input
                class="form-control"
                name="data[surname_name]"
                placeholder="Фамилия"
                <?php if (isset($data['surname_name'])) { ?>
                    value="<?= $data['surname_name']; ?>"
                <?php } ?>
            />
        </div>
        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-4">
            <label class="hidden" for="position_id">Национальность</label>
            <select class="form-control" id="position_id" name="data[position_id]">
                <option value="">Позиция</option>
                <?php foreach ($position_array as $item) { ?>
                    <option
                        value="<?= $item['position_id']; ?>"
                        <?php if (isset($data['position_id']) && $data['position_id'] == $item['position_id']) { ?>
                            selected
                        <?php } ?>
                    >
                        <?= $item['position_short']; ?>
                    </option>
                <?php } ?>
            </select>
        </div>
        <div class="col-lg-1 col-md-1 col-sm-1 col-xs-2">
            <input
                class="form-control"
                name="data[age_min]"
                placeholder="Возраст, от"
                <?php if (isset($data['age_min'])) { ?>
                    value="<?= $data['age_min']; ?>"
                <?php } ?>
            />
        </div>
        <div class="col-lg-1 col-md-1 col-sm-1 col-xs-2">
            <input
                class="form-control"
                name="data[age_max]"
                placeholder="Возраст, до"
                <?php if (isset($data['age_max'])) { ?>
                    value="<?= $data['age_max']; ?>"
                <?php } ?>
            />
        </div>
        <div class="col-lg-1 col-md-1 col-sm-1 col-xs-2">
            <input
                class="form-control"
                name="data[power_min]"
                placeholder="Сила, от"
                <?php if (isset($data['power_min'])) { ?>
                    value="<?= $data['power_min']; ?>"
                <?php } ?>
            />
        </div>
        <div class="col-lg-1 col-md-1 col-sm-1 col-xs-2">
            <input
                class="form-control"
                name="data[power_max]"
                placeholder="Сила, до"
                <?php if (isset($data['power_max'])) { ?>
                    value="<?= $data['power_max']; ?>"
                <?php } ?>
            />
        </div>
        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-4">
            <input
                class="form-control"
                name="data[price_min]"
                placeholder="Цена, от"
                <?php if (isset($data['price_min'])) { ?>
                    value="<?= $data['price_min']; ?>"
                <?php } ?>
            />
        </div>
        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-4">
            <input
                class="form-control"
                name="data[price_max]"
                placeholder="Цена, до"
                <?php if (isset($data['price_max'])) { ?>
                    value="<?= $data['price_max']; ?>"
                <?php } ?>
            />
        </div>
        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-4">
            <input class="form-control submit-blue" type="submit" value="Поиск" />
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            Всего игроков: <?= $total; ?>
        </div>
    </div>
</form>
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <table class="table table-bordered table-hover">
            <?php if ($transferapplication_array) { ?>
                <tr>
                    <th class="text-center" colspan="10">Ваши заявки</th>
                </tr>
                <tr>
                    <th>№</th>
                    <th>Игрок</th>
                    <th class="col-1 hidden-xs">Нац</th>
                    <th>Поз</th>
                    <th>В</th>
                    <th>С</th>
                    <th class="hidden-xs">Спец</th>
                    <th class="hidden-xs">Команда</th>
                    <th title="Минимальная запрашиваемая цена">Цена</th>
                    <th title="Дата проведения торгов">Торги</th>
                </tr>
                <?php foreach ($transferapplication_array as $item) { ?>
                    <tr>
                        <td class="text-center"></td>
                        <td>
                            <a href="/player_transfer.php?num=<?= $item['player_id']; ?>">
                                <?= $item['name_name']; ?> <?= $item['surname_name']; ?>
                            </a>
                        </td>
                        <td class="hidden-xs text-center">
                            <a href="/country_news.php?num=<?= $item['pl_country_id']; ?>">
                                <img
                                    alt="<?= $item['pl_country_name']; ?>"
                                    src="/img/country/12/<?= $item['pl_country_id']; ?>.png"
                                    title="<?= $item['pl_country_name']; ?>"
                                />
                            </a>
                        </td>
                        <td class="text-center">
                            <?= f_igosja_player_position($item['player_id'], $playerposition_array); ?>
                        </td>
                        <td class="text-center">
                            <?= $item['player_age']; ?>
                        </td>
                        <td class="text-center">
                            <?= $item['player_power_nominal']; ?>
                        </td>
                        <td class="hidden-xs text-center">
                            <?= f_igosja_player_special($item['player_id'], $playerspecial_array); ?>
                        </td>
                        <td class="hidden-xs">
                            <a href="/team_view.php?num=<?= $item['team_id']; ?>">
                                <?= $item['team_name']; ?>
                                (<?= $item['city_name']; ?>, <?= $item['t_country_name']; ?>)
                            </a>
                        </td>
                        <td class="text-right">
                            <?= f_igosja_money_format($item['transfer_price_seller']); ?>
                        </td>
                        <td class="text-center">
                            <?= f_igosja_deal_date($item['transfer_date']); ?>
                        </td>
                    </tr>
                <?php } ?>
            <?php } ?>
            <tr>
                <th>№</th>
                <th>Игрок</th>
                <th class="col-1 hidden-xs">Нац</th>
                <th>Поз</th>
                <th>В</th>
                <th>С</th>
                <th class="hidden-xs">Спец</th>
                <th class="hidden-xs">Команда</th>
                <th title="Минимальная запрашиваемая цена">Цена</th>
                <th title="Дата проведения торгов">Торги</th>
            </tr>
            <?php for ($i=0; $i<$count_transfer; $i++) { ?>
                <tr>
                    <td class="text-center"><?= $offset + $i + 1; ?></td>
                    <td>
                        <a href="/player_transfer.php?num=<?= $transfer_array[$i]['player_id']; ?>">
                            <?= $transfer_array[$i]['name_name']; ?> <?= $transfer_array[$i]['surname_name']; ?>
                        </a>
                    </td>
                    <td class="hidden-xs text-center">
                        <a href="/country_news.php?num=<?= $transfer_array[$i]['pl_country_id']; ?>">
                            <img
                                alt="<?= $transfer_array[$i]['pl_country_name']; ?>"
                                src="/img/country/12/<?= $transfer_array[$i]['pl_country_id']; ?>.png"
                                title="<?= $transfer_array[$i]['pl_country_name']; ?>"
                            />
                        </a>
                    </td>
                    <td class="text-center">
                        <?= f_igosja_player_position($transfer_array[$i]['player_id'], $playerposition_array); ?>
                    </td>
                    <td class="text-center">
                        <?= $transfer_array[$i]['player_age']; ?>
                    </td>
                    <td class="text-center">
                        <?= $transfer_array[$i]['player_power_nominal']; ?>
                    </td>
                    <td class="hidden-xs text-center">
                        <?= f_igosja_player_special($transfer_array[$i]['player_id'], $playerspecial_array); ?>
                    </td>
                    <td class="hidden-xs">
                        <a href="/team_view.php?num=<?= $transfer_array[$i]['team_id']; ?>">
                            <?= $transfer_array[$i]['team_name']; ?>
                            (<?= $transfer_array[$i]['city_name']; ?>, <?= $transfer_array[$i]['t_country_name']; ?>)
                        </a>
                    </td>
                    <td class="text-right">
                        <?= f_igosja_money_format($transfer_array[$i]['transfer_price_seller']); ?>
                    </td>
                    <td class="text-center">
                        <?= f_igosja_deal_date($transfer_array[$i]['transfer_date']); ?>
                    </td>
                </tr>
            <?php } ?>
            <tr>
                <th>№</th>
                <th>Игрок</th>
                <th class="hidden-xs">Нац</th>
                <th>Поз</th>
                <th>В</th>
                <th>С</th>
                <th class="hidden-xs">Спец</th>
                <th class="hidden-xs">Команда</th>
                <th title="Минимальная запрашиваемая цена">Цена</th>
                <th title="Дата проведения торгов">Торги</th>
            </tr>
        </table>
    </div>
</div>
<div class="row hidden-lg hidden-md hidden-sm">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <a class="btn show-full-table" href="javascript:">
            Показать полную таблицу
        </a>
    </div>
</div>
<?php include(__DIR__ . '/include/pagination.php'); ?>