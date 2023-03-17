<?php
$style = "style1";

if(isset ($_COOKIE['style'])){
    $style=$_COOKIE['style'];
}

if (isset($_GET['css'])) {
    $style = $_GET['css'];
    setcookie('style', $style, time() + 3600);
    header("Location: index.php");
    //exit;
}
?>

<form id="style_form" action="index.php" method="GET">
    <select name="css">
        <option value="style1" <?php if($style == 'style1') { echo 'selected'; } ?>>style1</option>
        <option value="style2" <?php if($style == 'style2') { echo 'selected'; } ?>>style2</option>
    </select>
    <input type="submit" value="Appliquer" />
</form>
<?php
echo $_COOKIE['style'];
?>
