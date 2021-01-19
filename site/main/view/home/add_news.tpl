<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm Bài Viết</title>
    <link href="{$arg.stylesheet}css/add_news.css" rel="stylesheet">
    <script type="text/javascript" src="library/ckeditor/ckeditor.js"></script>
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
                        <p class="right__desc">Thêm Bài Viết</p>
                        <form action="" method="post">
                            <div class="right__formWrapper">
    	                 		<div class="right__formWrapperBig">
                                        <div class="right__formTitle">
                                                <div class="right__formTitle-content">
                                                    <div class="right__inputWrapper">
                                                        <label>Tiêu Đề Bài Viết</label>
                                                        <input type="text" name="title" value="" placeholder="Thêm tiêu đề">
                                                    </div>
                                                    <div class="right__inputWrapper">
                                                        <label>Alias</label>
                                                        <input type="text" name="alias" value="" placeholder="">
                                                    </div>
                                                    <div class="right__inputWrapper">
                                                        <label>Description</label>
                                                        <textarea rows="4" name="description"></textarea>
                                                    </div>              
                                                </div>
                                        </div>      
                                        <div class="right__formCata" id="taxonomy">
                                                <div class="right__formCata-content">
                                                    <div class="right__inputWrapper ">
                                                        <label>Chọn Danh Mục</label>
                                                    </div>       
                                                    <div class="right__inputWrapper-abc">
                                                        {foreach from=$taxonomy_name item=i }
                                                            <label for="checkbox"><input type="checkbox" value="{$i.id}" name="checkbox" id="checkbox">{$i.name}
                                                                <input type="hidden" value="{$i.id}" name="taxonomy">
                                                            </label>
                                                        {/foreach}
                                                    </div>         
                                                </div>
                                        </div>        
                                </div>	
                                <div class="right__formBigTag">
                                        <div class="right__formTag">
                                            <div class="right__formTag-content">
                                                <div class="right__inputWrapper">
                                                    <label>Từ Khóa</label>
                                                    <input type="text" name="keyword" value="" placeholder="">
                                                </div>
                                                <div class="right__inputWrapper">
                                                    <label>Chọn Tag</label>
                                                    <select>
                                                        <option>gạch ốp lát</option>
                                                        <option>gạch mosaic</option>
                                                        <option>gạch thẻ</option>
                                                    </select>
                                                </div>
                                            </div>
                                    </div>
                                    <div class="right__formImage">
                                        <div class="right__formImage-content">
                                                <div class="right__inputWrapper">
                                                    <label>Ảnh Đại Diện</label>
                                                </div>  
                                        </div>
                                        <div class="right__formTag-image">
                                            <div class="right__formTag-img"><img style="width: 160px;height: 160px; border: 1px solid #d9d9d9;" src="site/upload/assets/noimg.jpg"></div>
                                            <div class="right__formTag-btn"><button type="button" onclick="LoadMedia('SetPostAvatar');"><i class="fa fa-picture-o fa-fw"></i>Chọn ảnh</button></div>
                                        </div>
                                    </div>
                                </div>

                                <div class="right__formEditor">
                                    <div class="right__formEditor-content">
                                        <div class="right__inputWrapper">
                                            <textarea class="ckeditor" name="content"></textarea>
                                        </div>   
                                    </div>
                                </div>

                                <div class="right__formSubmit">
                                    <button type="submit" class="btn-success" name="sub_bai" onclick="notify()" onchange="changeLink(this.value)" ><i class="fa fa-check fa-fw"></i>Đăng bài</button>
                                    <button type="button" class="btn-cancel">Hủy</button>
                                </div>

                        	</div>

                        </form>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
<script type="text/javascript">
	function changeLink(id){
        location.href = '?mod=home&site=edit_news&id='+id;
    }
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

    function notify(){

        location.assign('list_news.tpl');

        alert(' Thêm thành công');
    }
</script>
</body>
</html>