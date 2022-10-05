<?php
include '../include/init.php';
if (isset($_POST["query"])) {
    $query = $_POST['query'];
    $output = '';
    $sql_qurey = mysqli_real_escape_string($conn, $query);
    $result = POST::search_fun('posts', 'post_title', $sql_qurey);
    $output = '<ul class="list-unstyled se_ul">';
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_array($result)) {
            $output .= '<li>' . $row["post_title"] . '</li>';
        }
    } else {
        $output .= '';
    }
    $output .= '</ul>';
    echo $output;
} else {
    header('location:./');
}
