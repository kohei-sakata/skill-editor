<?php

if (array_depth($data_list) == 2) {
    echo '<table class="data-table">'.PHP_EOL;
    $column_names = array();
    foreach ($data_list as $key => $row) {
        $column_names += array_keys($row);
    }
    echo '<tr>'.PHP_EOL;
    echo '<th></th>';
    foreach ($column_names as $key) {
        echo '<th>'.htmlentities($key).'</th>';
    }
    echo PHP_EOL.'<tr>';
    foreach ($data_list as $key => $row) {
        echo '<tr>'.PHP_EOL;
        echo '<th>'.htmlentities($key).'</th>';
        foreach ($column_names as $column_name) {
            echo '<td>';
            if (isset($row[$column_name])) {
                echo htmlentities($row[$column_name]);
            }
            echo '</td>';
        }
        echo PHP_EOL.'<tr>';
    }
    echo PHP_EOL.'</table>'.PHP_EOL;
} else {
    pre_dump($data_list);
}
?>