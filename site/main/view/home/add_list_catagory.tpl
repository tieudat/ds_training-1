<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="{$arg.stylesheet}css/admin.css" rel="stylesheet">
</head>
<body>
    <div class="wrapper">
        <div class="container">
            <div class="dashboard">
                <div class="left">
                    <span class="left__icon">
                        <span></span>
                        <span></span>
                        <span></span>
                    </span>
                    <div class="left__content">
                        <div class="left__logo">LOGO</div>
                        <div class="left__profile">
                            <div class="left__image"><img src="site/upload/assets/logo-1.png" alt=""></div>
                            <p class="left__name">Nam Việt Tech</p>
                        </div>
                        <ul class="left__menu">
                            <li class="left__menuItem">
                                <a href="?mod=home&site=admin" class="left__title"><img src="site/upload/assets/icon-dashboard.svg" alt="">Dashboard</a>
                            </li>
                            <li class="left__menuItem">
                                <div class="left__title"><img src="site/upload/assets/icon-edit.svg" alt="">Bài Viết<img class="left__iconDown" src="site/upload/assets/arrow-down.svg" alt=""></div>
                                <div class="left__text">
                                    <a class="left__link" href="?mod=home&site=add_news">Thêm Bài Viết</a>
                                    <a class="left__link" href="?mod=home&site=list_news">Tất Cả Bài Viết</a>
                                </div>
                            </li>
                            <li class="left__menuItem">
                                <div class="left__title"><img src="site/upload/assets/icon-tag.svg" alt="">Danh Mục<img class="left__iconDown" src="site/upload/assets/arrow-down.svg" alt=""></div>
                                <div class="left__text">
                                    <a class="left__link" href="?mod=home&site=add_list_catagory">Thêm Danh Mục</a>
                                    <a class="left__link" href="?mod=home&site=list_catagory">Tất Cả Danh Mục</a>
                                </div>
                            </li>
                            <li class="left__menuItem">
                                <div class="left__title"><img src="site/upload/assets/icon-book.svg" alt="">Media<img class="left__iconDown" src="site/upload/assets/arrow-down.svg" alt=""></div>
                                <div class="left__text">
                                    <a class="left__link" href="#">Thêm Ảnh</a>
                                    <a class="left__link" href="#">Tất Cả Hình Ảnh</a>
                                </div>
                            </li>
                            <li class="left__menuItem">
                                <div class="left__title"><img src="site/upload/assets/icon-user.svg" alt="">Admin<img class="left__iconDown" src="site/upload/assets/arrow-down.svg" alt=""></div>
                                <div class="left__text">
                                    <a class="left__link" href="#">Thêm Admin</a>
                                    <a class="left__link" href="#">Danh Sách Admins</a>
                                </div>
                            </li>
                            <li class="left__menuItem">
                                <a href="" class="left__title"><img src="site/upload/assets/icon-logout.svg" alt="">Đăng Xuất</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="right">
                    <div class="right__content">
                        <div class="right__title">Bảng điều khiển</div>
                        <p class="right__desc">Thêm danh mục</p>
                        <div class="right__formWrapper">
                                <form action="?mod=home&site=add_list_catagory" method="GET" enctype="multipart/form-data">
                                    <div class="right__inputWrapper">
                                        <label for="p_category">Tên Danh Mục</label>
                                        <input type="text" name="addten" placeholder="">
                                    </div>
                                    <div class="right__inputWrapper">
                                        <label for="p_category">Alias</label>
                                        <input type="text" name="alias" placeholder="">
                                    </div>
                                    <div class="right__inputWrapper">
                                        <label for="p_category">Danh mục cha</label>
                                        <input type="text" name="" placeholder="">
                                    </div>
                                    <div class="right__inputWrapper">
                                        <label for="p_category">Description</label>
                                        <textarea rows="4"></textarea>
                                    </div>
                                    <button class="btn" type="submit">Thêm</button>
                                </form>
                        </div>
                </div>


                </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    
    window.addEventListener("load", event => {

    // Expand Left Side
    var icon = document.querySelector('.left__icon'),
        left = document.querySelector('.left');

    icon.addEventListener('click', expand);

    function expand() {
        if (left.classList.contains('show')) {
            left.classList.remove('show')
        } else {
            left.classList.add('show')
        }
    }

    var menuItem = document.querySelectorAll('.left__menuItem');

    menuItem.forEach(function (el) {
        el.addEventListener("click", openMenu);
    });

    function openMenu(event) {
        var currentmenuItem = event.currentTarget;

        if (currentmenuItem.classList.contains('open')) {
            currentmenuItem.classList.remove('open');
        } else {
            currentmenuItem.classList.add('open');
        }
    };
})
</script>
</body>
</html>
