<?php
require_once('../articles/connection.php');
include('../articles/header.php');
?>
<main class="container">
    <p>
    <h1 style="text-align: center">Články</h1>
    <?php
    $page = isset($_GET["page"]) ? $_GET["page"] : "";
    if ($page < 1) {
        $page = 1;
    }

    for ($i = 0; $i < $page; $i++) {
        $x = 0 + 12 * $i;
        $y = 11 + 12 * $i;
    }
    ?>
    <div class="container">
        <div class="d-flex row align-items-center">
            <?php
            $last = $conn->query("SELECT MAX(ID) AS n FROM articles");
            while ($n = $last->fetch_assoc()) {
                $max = $n["n"] - $x;
                $min = $n["n"] - $y;
                $articles = $conn->query("SELECT * FROM articles WHERE ID BETWEEN '$min' AND '$max' ORDER BY Create_time DESC");
            }
            while ($article = $articles->fetch_assoc()) {
            ?>
                <div class="p-0 col-md-4 col-sm-5 col-xs-6" style="text-align: center">
                    

                    <img src="articles/<?php echo $article["Cover_image"] ?>" alt="<?php echo $article["Title"] ?>" style="width: 250px">

                    <p><span style="font-weight: bold;">Title:</span> <?php echo $article["Title"] ?>
                    <br><span style="font-weight: bold;">Author:</span> <?php echo $article["Autor"] ?>
                    <p><?php echo $article["Text"] ?>
                </div>

            <?php
            }
            ?>
        </div>
    </div>
    <nav>
        <ul style="margin-left: 550px;" class="pagination">
            <li class="page-item">
                <a class="page-link" href="../articles/index.php<?php echo "?page=" . $page - 1; ?>" aria-label="Predchadzajuca stranka">
                    <span aria-hidden="true">&laquo;</span>
                    <span class="sr-only">Predchadzajuca</span>
                </a>
            </li>
            <li class="page-item">
                <a class="page-link" href="../articles/index.php<?php echo "?page=" . $page + 1; ?>" aria-label="Dalsia stranka">
                    <span aria-hidden="true">&raquo;</span>
                    <span class="sr-only">Dalsia</span>
                </a>
            </li>
        </ul>
    </nav>
</main>