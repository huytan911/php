<section class="wrapper">
    <header><?php include "views/layout/header.php" ?></header>
    <section class="body">
        <div class="container">
            <div class="row">
                <?php 
                if (isset($_GET['option'])):
                    switch ($_GET['option']):
                        case 'productdetail':
                            break;
                        case 'cart':
                            break;
                        case 'checkout':
                            break;
                        case 'wishlist':
                            break;
                        default: include "views/layout/sidebar.php"; break;
                    endswitch;
                else:
                    include "views/layout/sidebar.php";
                endif;
                ?>
                <?php include "views/layout/body.php"?>
            </div>
        </div>
    </section>
    <footer><?php include "views/layout/footer.php" ?></footer>
</section>