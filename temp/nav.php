<nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container">
    <a class="navbar-brand" href="index.php">городской портал «Сделаем лучше вместе!»</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Переключатель навигации">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="navbar-collapse justify-content-end" id="navbarSupportedContent">
      <ul class="navbar-nav">
        <?php
            if(!empty($_SESSION)){
                if($_SESSION["id_role"] == 1){
                    echo '
                        <li class="nav-item">
                            <a class="nav-link" href="lk.php">Личный кабинет</a>
                        </li>
                    ';
                }
                else{
                    echo '
                        <li class="nav-item">
                            <a class="nav-link" href="category.php">Категории</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="zayvki.php">Заявки</a>
                        </li>
                    ';
                }
                echo '
                    <li class="nav-item">
                        <a class="nav-link" href="exit.php">Выйти</a>
                    </li>
                ';
            }
            else{
                echo '
                    <li class="nav-item">
                        <a class="nav-link" href="vizit.php">Вход</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="registr.php">Регистрация</a>
                    </li>
                ';
            }
        ?>
      </ul>
    </div>
  </div>
</nav>