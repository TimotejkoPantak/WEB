<?php
require_once('scripts/connection.php');
include('parts/header.php');
include('scripts/getUsers.php');
 
require_once('articles/connection.php');
 
?>

<head>
    <link rel="stylesheet" href="./styles/index_style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
 
<main class="container">
    <p>
        <?php if (!isset($_GET['category']) && (!isset($_GET['url']))) { ?>
            <form acction="" method="post">
                <div class="input-group">
                    <input type="text" name="search" class="form-control" placeholder="Search" aria-label="Search"
                        aria-describedby="search-addon" />
                    <input class="btn_search" type="submit" name="Submit"></input>
                </div>
                <br>
            </form>
    <?php } ?>
 
    <?php
    if (!isset($_GET['url']) && !isset($_GET['edit'])) {
        if (isset($_GET['category'])) {
            $categ = $_GET['category'];
            $categ = trim($categ, '"');
            $colorSport = $colorPolitika = $colorModa = $colorEkonomika = $colorKultura = $colorZdravie = $colorGaming = trim("white", '"');
 
            if ($categ == "Sport")
                $colorSport = "#b0b1b6";
            if ($categ == "Politika")
                $colorPolitika = "#b0b1b6";
            if ($categ == "Moda")
                $colorModa = "#b0b1b6";
            if ($categ == "Ekonomika")
                $colorEkonomika = "#b0b1b6";
            if ($categ == "Kultura")
                $colorKultura = "#b0b1b6";
            if ($categ == "Zdravie")
                $colorZdravie = "#b0b1b6";
            if ($categ == "Gaming")
                $colorGaming = "#b0b1b6";
 
            function displayDivActive($string, $color){
                echo '<a class="menu_item" href=index.php?category=' . $string . ' style="text-decoration:none; color:black; nargin-top: 20px">';
                echo '<div class="chip" style="width: 150px; background:' . $color . '; border: 2px solid black; border-radius: 10px; text-align:center;">' . $string . '</div>';
                echo '</a>';
            }
 
            echo '<div class="chips">';
            displayDivActive("Sport", $colorSport);
            displayDivActive("Politika", $colorPolitika);
            displayDivActive("Moda", $colorModa);
            displayDivActive("Ekonomika", $colorEkonomika);
            displayDivActive("Kultura", $colorKultura);
            displayDivActive("Zdravie", $colorZdravie);
            displayDivActive("Gaming", $colorGaming);
            echo '</div>';
            echo '<h1 style="text-align: center; font-size: 50px">Články</h1>';
        } else {
            function displayDivInctive($string){
                echo '<a href=index.php?category=' . $string . ' style="text-decoration:none; color:black;">';
                echo '<div class="chip" style="width: 150px; border: 2px solid black; border-radius: 10px; text-align:center;">' . $string . '</div>';
                echo '</a>';
            }
 
            echo '<div class="chips">';
            displayDivInctive("Sport");
            displayDivInctive("Politika");
            displayDivInctive("Moda");
            displayDivInctive("Ekonomika");
            displayDivInctive("Kultura");
            displayDivInctive("Zdravie");
            displayDivInctive("Gaming");
            echo '</div>';
            echo '<h1 style="text-align: center; font-family: Courier New, Courier, monospace; font-weight: 800; margin-top: 30px; font-size: 50px ">Články</h1>';
        }
    }
    ?>
 
    <div class="container">
        <div class="d-flex row align-items-center" ">
            <?php
            if (!isset($_GET['edit'])) {
                if (isset($_GET['url'])) {
                    $url = $_GET['url'];
 
                    if ($url) {
                        $url = trim($url, '"');
                        $sqla = "SELECT * FROM articles WHERE url_ar = '$url'";
                        $resulta = $conn->query($sqla);
 
                        while ($row = $resulta->fetch_row()) {
                            $title = $row[1];
                            $author = $row[4];
                            $text = $row[2];
                            $cover_image = $row[3];
                            $id_author = $row[7];
                        }
 
                        if(!isset($_GET['edit_comm'])) { 
                            echo '<h1 class="title">' . $title . '</h1>';
                            echo '<h2 class="title">' . $author . '</h2>';
                            echo '<p class="clanok_text" >' . $text . '</p>';
                            echo '<img src="articles/' . $cover_image . '" alt=""' . $title . '">'; 
                        }   
 
                    }
                } else {
                    if (isset($_GET['category'])) {
                        $cat = $_GET['category'];
                        $cat = trim($cat, '"');
                        $sql = "SELECT * FROM articles WHERE category = '$cat'";
                        $result = $conn->query($sql);
                        if ($result->num_rows > 0) {
                            foreach ($result as $row) {
                                echo '<div class="p-0 col-md-4 col-sm-5 col-xs-6" style="text-align: center; ">';
                                echo '<a href=index.php?url="' . $row['url_ar'] . '" target="_blank" style="text-decoration:none; color:black;">';
                                if($row["Cover_image"]!=null){
                                   echo '<img src="articles/' . $row["Cover_image"] . '" alt=""' . $row["Title"] . '" style="width: 250px">'; 
                                }
                                echo '<p><span style="font-weight: bold;">Title:</span>' . $row["Title"];
                                echo '<br><span style="font-weight: bold;">Author:</span>' . $row["Autor"];
                                echo '<p>' . $row["Text"];
                                echo '</div></a>';
                            }
                        }
                    } else {
                        $sql = "SELECT * FROM articles";
 
                        $page = isset($_GET["page"]) ? $_GET["page"] : "";
 
                        if ($page < 1) {
                            $page = 1;
                        }
 
                        for ($i = 0; $i < $page; $i++) {
                            $x = 0 + 12 * $i;
                            $y = 11 + 12 * $i;
                        }
 
                        $result = $conn->query($sql);
                        $displayNumOfArticles = 9;
                        $c = 0;
                        $page = isset($_GET["page"]) ? $_GET["page"] : "";
                        $pages = intval($page);
                        $h = $displayNumOfArticles * $pages - 1;
 
                        if (isset($_POST['Submit'])) {
                            $search = mysqli_real_escape_string($conn, $_POST['search']);
                            $sqls = "SELECT * FROM articles WHERE `Title` LIKE '%$search%' OR `Text` LIKE '%$search%' OR `Autor` LIKE '%$search%' OR `category` LIKE '%$search%';";
                            $results = mysqli_query($conn, $sqls);
                            $queryResult = mysqli_num_rows($results);
 
                            if ($queryResult > 0) {
                                while ($article = mysqli_fetch_array($results)) {
                                    $h += 1;
                                    if ($h + $displayNumOfArticles < $pages * $displayNumOfArticles + ($pages * $displayNumOfArticles)) {
                                        continue;
                                    }
            ?>
            <div class="p-0 col-md-4 col-sm-5 col-xs-6" style="text-align: center; ">
                <a href="index.php<?php echo "?url=" . $article["url_ar"]; ?>" target="_blank"
                style="text-decoration:none; color:black;">
                    <?php
                    if ($article["Cover_image"] != null) {
                    ?>
                    <img src="articles/<?php echo $article["Cover_image"] ?> " alt=" <?php echo $article["Title"] ?>"
                        style="width: 250px">
                        <?php }?>
                    <p class="info"><span style="font-weight: bold;" class="title">Title:</span>
                        <?php echo $article["Title"] ?>
                        <br><span style="font-weight: bold;">Author:</span>
                        <?php echo $article["Autor"] ?>
                        <p>
                        <?php echo $article["Text"] ?>
            </div></a>
 
            <?php
                                    $c += 1;
                                    if ($c == $displayNumOfArticles)
                                        break;
 
                                }
                            } else {
                                echo "No results";
                            }
                        } else if (empty($_POST['Submit'])) {
 
                            $sql = "SELECT * FROM articles ORDER BY Id DESC";
                            $results = mysqli_query($conn, $sql);
                            $queryResult = mysqli_num_rows($results);
 
                            if ($queryResult > 0) {
                                while ($article = mysqli_fetch_array($results)) {
 
                                    $h += 1;
                                    if ($h + $displayNumOfArticles < $pages * $displayNumOfArticles + ($pages * $displayNumOfArticles)) {
                                        continue;
                                    }
                        ?>
            <div class="p-0 col-md-4 col-sm-5 col-xs-6" style="text-align: center; ">
                <a href="index.php<?php echo "?url=" . $article["url_ar"]; ?>" target="_blank"
                    style="text-decoration:none; color:black;">
                    <?php
                    if ($article["Cover_image"] != null) {
                    ?>
                    <img src="articles/<?php echo $article["Cover_image"] ?> " alt=" <?php echo $article["Title"] ?>"
                        style="width: 250px" class="main_img">
                        <?php }?>
                    <p><span style="font-weight: bold;">Title:</span>
                        <?php echo $article["Title"] ?>
                        <br><span style="font-weight: bold;">Author:</span>
                        <?php echo $article["Autor"] ?>
                        <p style="overflow:hidden; 
text-overflow: ellipsis;
display: -webkit-box;
-webkit-line-clamp: 2; /* number of lines to show */
-webkit-box-orient: vertical;">
                            <?php echo $article["Text"] ?>
            </div></a>
 
            <?php
                                    $c += 1;
                                    if ($c == $displayNumOfArticles)
                                        break;
 
                                }
                            }
                        }
 
 
                    }
                }
            }
 
 
                        ?>
 
        </div>
    </div>
 
    <?php
    if (!isset($_GET['edit'])) {
        if (!isset($_GET['url'])) {
            $page = isset($_GET["page"]) ? $_GET["page"] : "";
 
            if ($page < 1) {
                $page = 1;
            }
 
            function changePage($currentPage, $argument)
            {
                if ($argument == "-1") {
                    if ($currentPage == 1)
                        return $currentPage;
                    else
                        $newPage = $currentPage - 1;
                } else {
                    $newPage = $currentPage + 1;
                }
                return $newPage;
            }
    ?>
    <nav>
        <ul class="pagination">
            <li class="page-item">
                <a class="page-link" href="index.php<?php $page = changePage($page, "-1");
            echo "?page=" . $page;
            $page = isset($_GET["page"]) ? $_GET["page"] : "";
            if ($page < 1) {
                $page = 1;
            } ?>" aria-label="Predchadzajuca stranka">
                    <span aria-hidden="true">&laquo;</span>
                    <span class="sr-only"></span>
                </a>
            </li>
            <li class="page-item">
                <a class="page-link" href="index.php<?php $page = changePage($page, "+1");
            echo "?page=" . $page;
            $page = isset($_GET["page"]) ? $_GET["page"] : "";
            if ($page < 1) {
                $page = 1;
            } ?>" aria-label="Dalsia stranka">
                    <span aria-hidden="true">&raquo;</span>
                    <span class="sr-only"></span>
                </a>
            </li>
        </ul>
    </nav>
    <?php
        } else {
            include('scripts/connection.php');
            if (isset($_SESSION["username"])) {
                $user = $_SESSION["username"];
                $query = "SELECT avatar,id,administrator FROM users WHERE username='$user'";
                $result = $conn->query($query);
 
                while ($row = $result->fetch_assoc()) {
                    $avatar = $row["avatar"];
                    $id = $row["id"];
                    $admin = $row["administrator"];
                }
 
                    if (!isset($_GET['edit_comm'])) {
                        if ($admin == 1 || $id == $id_author) { 
    ?>              
    <div class="btns" style="text-align:center; margin-top: 50px;">
        <a href="scripts/deleteArticle_script.php?url=<?php echo $url; ?>" class="btn-del"
            style="     border-radius: 15px;
                        background-color: rgb(32,37,41);
                        color: red;
                        border: none;
                        padding: 15px;
                        font-size: 20px;
                        font-family: 'Courier New', Courier, monospace;
                        text-decoration: none"
            > <b>Zmazať</b></a>
        <a href="index.php?edit=<?php echo $url; ?>" class="btn-edit"
            style="     border-radius: 15px;
                        background-color: rgb(32,37,41);
                        color: white;
                        border: none;
                        padding: 15px;
                        font-size: 20px;
                        font-family: 'Courier New', Courier, monospace;
                        text-decoration: none"
           > <b>Upravit</b></a>
        <?php } ?>
        <a href="index.php?edit=<?php echo $url;
                        echo '&comm'; ?>" class="btn-comm" 
            style="     border-radius: 15px;
                        background-color: rgb(32,37,41);
                        color: white;
                        border: none;
                        padding: 15px;
                        font-size: 20px;
                        font-family: 'Courier New', Courier, monospace;
                        text-decoration: none;
                        "
           > <b>Komentovat</b></a>
 
    </div>
    <?php
                        $comm_article_id = $_GET['url'];
                        $query_c = "SELECT text_comm, name_user, id_user, id_comm FROM db.comm WHERE id_article='$comm_article_id'";
                        $result_c = $conn->query($query_c);
 
                        while ($row = $result_c->fetch_assoc()) {
                            $show_text = $row["text_comm"];
                            $show_name_user = $row["name_user"];
                            $get_id_user = $row["id_user"];
                            $get_id_comm = $row["id_comm"];
 
                            $query_u = "SELECT avatar FROM registration.users WHERE id='$get_id_user'";
                            $result_u = $conn->query($query_u);
                            while ($row = $result_u->fetch_assoc()) {
                                $show_avatar = $row["avatar"];
                            }
 




                            echo '<div class="comm_holder" style="border-bottom:2px solid #d6d6d6; min-height:200px; padding:5px;">';
                            echo '<div class="logo-name" style="display:flex; background-color: #d6d6d6">';
                            echo '<img class="avatar" src="images/' . $show_avatar . '" style= "max-width:40px;max-height:40px;">';
                            echo '<div class="name_holder" style="font-weight:bold; font-size:30px">' . $show_name_user . '</div>';
                            echo '</div>';
                            echo '<div class="text_holder" style="">' . $show_text . '</div>';
                            if ($_SESSION['username'] == $show_name_user || $admin == 1) {
    ?>
                <div class="button-wrap" style="position: relative; display: flex; justify-content: right; margin-top: 8%">
                    <a href="index.php?url=<?php echo $url;
                                echo '&delete_comm=' . $get_id_comm . ''; ?>" class="btn btn-del" 
                        style="background:red; color: white; margin-right: 5px;"> <b>Zmazať</b></a>
                    <a href="index.php?url=<?php echo $url;
                                echo '&edit_comm=' . $get_id_comm . ''; ?>" class="btn btn-del"
                        style="background:grey; color: white;"> <b>Upravit</b></a>
                </div>
                <?php
                            }
                            echo '</div>';
                            echo '<br>';
                        }
                    }
        if(isset($_GET['delete_comm'])){
            $del_comm = isset($_GET["delete_comm"]) ? $_GET["delete_comm"] : "";  
 
            $sql = "DELETE FROM db.comm WHERE id_comm ='$del_comm'";
            if($conn->query($sql) === true){
                ?>
                <script type="text/javascript">
                window.location.href = 'index.php?url=<?php echo $url ?>';
                </script>
                <?php      
            } 
            else{
                echo "ERROR: Could not able to execute $sql. " . $conn->error;
            }
        }
        if(isset($_GET['edit_comm'])){
            echo'<h1>Upravit komentar</h1>';
 
            $edit_comm_id = $_GET['edit_comm'];
            $edit_comm_id = trim($edit_comm_id, '"');
            $sqlg = "SELECT * FROM db.comm WHERE id_comm = '$edit_comm_id'";
            $resultg = $conn->query($sqlg);
 
            while ($row = $resultg->fetch_row()) { 
                $text_comm = $row[2];
            }
 
            ?>
            <form  method="post">
                <!-- <p><label for="Text" class="com_p"><b>Komentar</b></label> -->
                <br><textarea rows="15" class="koment" style="width: 700px; border-radius: 20px; border-color: grey;" type="text" name="Text"
                id="Text"><?php echo $text_comm ?></textarea>
 
                <button name="submit" type="submit" class="submit_com">Upload</button>
            </form>
 
            <?php
 
 
            if ($_POST) {
                $newText = $_POST['Text'];
                $sqlg = "UPDATE db.comm SET text_comm = '$newText', text_comm = '$newText' where id_comm='$edit_comm_id'";
                $conn->query($sqlg);
                ?>
                <script type="text/javascript">
                window.location.href = 'index.php?url=<?php echo $url ?>';
                </script>
                <?php  
            }
 
        }
    ?>
    <?php       
            }
        }
    }
    ?>
    <?php
    if (isset($_GET['comm'])) {
        echo'<h1 style="text-align: center;"> Uverejnit komentar</h1>';
        ?>
        <form  method="post">
            <!-- <p><label for="Text"><b>Komentar</b></label> -->
            <br><textarea rows="15" style="width: 700px;" type="text" name="Text"
            id="Text"></textarea>
 
            <p><button name="submit" type="submit" class="btn btn-outline-danger">Upload</button>
        </form>
 
        <?php 
 
        $comm_id_article = $_GET['edit'];
 
        if ($_POST) {
            $comm_name_user = $_SESSION["username"];
            echo $comm_name_user;
            $query = "SELECT id FROM registration.users WHERE username='$comm_name_user'";
            $result = $conn->query($query);
 
            while ($row = $result->fetch_assoc()) {
                $comm_id_user = $row["id"];
            }
 
            $comm_text_comm = $_POST['Text'];
 
            $sql = "INSERT INTO db.comm (id_user, name_user, text_comm, id_article)
                VALUES('$comm_id_user', '$comm_name_user', '$comm_text_comm', '$comm_id_article')";
                if ($conn->query($sql) == true){       
                    header('Location: index.php?url='.$comm_id_article.'');
                }
                else{
                    echo "Error" . $sql . "<br>" . $conn->error;
                }
        }
    }
 
    if (isset($_GET['edit'])&& !isset($_GET['comm'])) {
        $edit = $_GET['edit'];
        $edit = trim($edit, '"');
        $sqlb = "SELECT * FROM articles WHERE url_ar = '$edit'";
        $resultb = $conn->query($sqlb);
 
        while ($row = $resultb->fetch_row()) {
            $title = $row[1];
            $text = $row[2];
            $cover_image = $row[3];
            $category = $row[8];
        }
 
        if ($_POST) {
            $newTitle = $_POST['Title'];
            $newText = $_POST['Text'];
            $newImg = $_POST['Img'];
            $newCat = $_POST['Category'];
 
            $sqlu = "UPDATE articles SET Title = '$newTitle', Text = '$newText', Cover_image = '$newImg', category = '$newCat' where url_ar='$edit'";
            $conn->query($sqlu);
            header('Location: index.php');
        }
 
    ?>
    <form action="" method="post">
 
        <div style="text-align: center">
            <p>
            <h1 class="title">Upravit clanok</h1>
            <p><label for="Title" style="font-size: 20px; margin-top: 10px;"><b>Title</b></label>
                <br><input type="text" name="Title" id="Title" value="<?php echo $title ?>">
 
            <p><label for="Text"><b style="font-size: 20px; margin-top: 10px;">Text</b></label>
                <br><textarea rows="15" style="width: 700px;" type="text" name="Text"
                    id="Text"><?php echo $text ?></textarea>
 
 
 
            <div class="buttonwrapper" style="text-align:center; padding-left: 42%;">
                <p><select id="Img" name="Img"  style="width: 30%;"
                        class="form-select form-select-lg form-select-border-width-0 aria-label.form-select-lg example">
                        <option disabled selected>
                            <?php 
                                if($cover_image != null){
                                    echo $cover_image;
                                }else{
                                    echo "Vyberte obrazok";
                                }
                            ?>
                        </option>
                        <option value="bussiness_man.jpg">Bussinessman</option>
                        <option value="stonks.jpg">Stonks</option>
                        <option value="poznamky.jpg">Poznamky</option>
                        <option value="house.jpg">House</option>
                    </select>
 
                <p><select id="Category" name="Category"
                        class="form-select form-select-lg form-select-border-width-0" aria-label=".form-select-lg example">
                        <option disabled selected>
                                <?php
 
                                if($category != null){
                                    echo $category;
                                }else{
                                    echo "Vyberte kategoriu";
                                }
                                ?>
                        </option>
                        <option class="option"  value="Sport">Sport</option>
                        <option class="option" value="Politika">Politika</option>
                        <option class="option" value="Moda">Moda</option>
                        <option class="option" value="Ekonomika">Ekonomika</option>
                        <option class="option" value="Kultura">Kultura</option>
                        <option class="option" value="Zdravie">Zdravie</option>
                        <option class="option" value="Gaming">Gaming</option>
                    </select>
            </div>
 
            <p><button type="submit" class="btn btn-outline-danger">Edit</button>
        </div>
 
    </form>
    <?php
    }
    ?>
    
    <!-- API -->
    <?php
        if(isset($_SESSION["username"])){
            $user = $_SESSION["username"];
            $query = "SELECT displayed_API FROM registration.users WHERE username='$user'";
            $result = $conn->query($query);

            while ($row = $result->fetch_assoc()) {
                $display_API = $row["displayed_API"];
            }    
    ?>
    <div class = "scriptosmgn">
    <script>
        <?php
            $word = "obrazok";
            if(strpos($display_API, $word)!=false){     
        ?>
        
        fetch('https://go-apod.herokuapp.com/apod')
            .then(res => {
               return res.json();
            })
            .then(data =>{
                // console.log(data);

                 markup = `<img src=${data["url"]}>`;
                document.querySelector('main').insertAdjacentHTML('beforeend', markup);
            })
            .catch(err => console.log(err));
        <?php
            }
            $word = "coin";
            if(strpos($display_API, $word)!=false){  
        ?>    

        fetch('https://api.coindesk.com/v1/bpi/currentprice.json')
            .then(res => {
               return res.json();
            })
            .then(data =>{
                // console.log(data);

                markup = `<li class="firstcryptomsg">${(data["time"]["updateduk"])}</li><li class="cryptomsg"><strong style="color: #FFC833">${(data["chartName"])}</strong></li><li class="cryptomsg"><strong>${(data["bpi"]["EUR"]["code"])} | ${(data["bpi"]["EUR"]["rate"])} ${(data["bpi"]["EUR"]["symbol"])}<strong></li>`;
                document.querySelector('main').insertAdjacentHTML('beforeend', markup);
            })
            .catch(err => console.log(err));

        <?php
            }
            $word = "vtip";
            if(strpos($display_API, $word)!=false){  
        ?>  

        fetch('https://v2.jokeapi.dev/joke/Any?type=single')
            .then(res => {
               return res.json();
            })
            .then(data =>{
                // console.log(data);

                markup = `<li class="vtip">${(data["joke"])}</li>`;
                document.querySelector('main').insertAdjacentHTML('beforeend', markup);
            })
            .catch(err => console.log(err));
        <?php
            } 
        ?>  

    </script>
    </div>
    <?php } ?>
    <!-- API -->
        

</main>
<?php include('parts/footer.php'); ?>