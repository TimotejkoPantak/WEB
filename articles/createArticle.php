<!DOCTYPE html>
<html>
<title>Create Article</title>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/create_article_style.css">
</head>


<body>
    <?php include('header.php'); ?>
    <?php $message = isset($_GET["message"]) ? $_GET["message"] : ""; ?>
    <main>

        <form action="../articles/createArticle_script.php" method="post">

            <div style="text-align: center">
                <p>
                <h1 class="heading">Vytvoriť článok</h1>
                <p><label for="Title"><b>Title</b></label>
                    <br><input type="text" name="Title" id="Title">

                <p><label for="Author"><b>Author</b></label>
                    <br><input type="text" name="Author" id="Author">

                <p><label for="Text"><b>Text</b></label>
                    <br><textarea rows="15" style="width: 700px;" type="text" name="Text" id="Text"></textarea>
                <div class="select_container">
                    <p><select id="Img" name="Img" style="width: 200px;" class="form-select form-select-lg form-select-border-width-0" aria-label=".form-select-lg example">
                            <option disabled selected>Vyberte obrazok</option>
                            <option value="bussiness_man.jpg">Bussinessman</option>
                            <option value="stonks.jpg">Stonks</option>
                            <option value="poznamky.jpg">Poznamky</option>
                            <option value="house.jpg">House</option>
                        </select>

                    <p><select id="Category" name="Category" style="width: 200px;"  class="form-select">
                            <option disabled selected>Vyberte kategoriu</option>
                            <option value="Sport">Sport</option>
                            <option value="Politika">Politika</option>
                            <option value="Moda">Moda</option>
                            <option value="Ekonomika">Ekonomika</option>
                            <option value="Kultura">Kultura</option>
                            <option value="Zdravie">Zdravie</option>
                            <option value="Gaming">Gaming</option>
                        </select>
                </div>
                <p><button type="submit" class="btn btn-outline-danger">Create</button>

                <p class="text-danger"><?php echo $message ?></p>

        </form>
        </div>
    </main>
</body>

</html>