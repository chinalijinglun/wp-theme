<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" >
    <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?php if ( is_home() ) {
        bloginfo('name'); echo " - "; bloginfo('description');
    } elseif ( is_category() ) {
        single_cat_title(); echo " - "; bloginfo('name');
    } elseif (is_single() || is_page() ) {
        single_post_title();
    } elseif (is_search() ) {
        echo "搜索结果"; echo " - "; bloginfo('name');
    } elseif (is_404() ) {
        echo '页面未找到!';
    } else {
        wp_title('',true);
    } ?></title>

    <!-- 新 Bootstrap 核心 CSS 文件 -->
	<link href="http://apps.bdimg.com/libs/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet">

    <!-- css1 -->
    <link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>">

    <!--pingback -->
    <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />

    <!--feed链接    -->
    <link rel="alternate" type="application/rss+xml" title="RSS 2.0 - 所有文章" href="<?php echo get_bloginfo('rss2_url'); ?>" />
    <link rel="alternate" type="application/rss+xml" title="RSS 2.0 - 所有评论" href="<?php bloginfo('comments_rss2_url'); ?>" />

    <!-- jQuery文件。务必在bootstrap.min.js 之前引入 -->
	<script src="http://apps.bdimg.com/libs/jquery/2.0.0/jquery.min.js"></script>

	<!-- 最新的 Bootstrap 核心 JavaScript 文件 -->
	<script src="http://apps.bdimg.com/libs/bootstrap/3.3.0/js/bootstrap.min.js"></script>

    <!--  添加wp_head  -->
    <?php wp_head(); ?>

    <!--添加自定义的des和keywords    -->
    <?php
    $description = '';
    $keywords = '';

    if (is_home() || is_page()) {
        // 将以下引号中的内容改成你的主页description
        $description = "李经纶个人博客";

        // 将以下引号中的内容改成你的主页keywords
        $keywords = "李经纶, 博客, 前端 , javascript , angular , node , html5 , css3 , animation ,js";
    }
    elseif (is_single()) {
        $description1 = get_post_meta($post->ID, "description", true);
        $description2 = str_replace("\n","",mb_strimwidth(strip_tags($post->post_content), 0, 200, "…", 'utf-8'));

        // 填写自定义字段description时显示自定义字段的内容，否则使用文章内容前200字作为描述
        $description = $description1 ? $description1 : $description2;

        // 填写自定义字段keywords时显示自定义字段的内容，否则使用文章tags作为关键词
        $keywords = get_post_meta($post->ID, "keywords", true);
        if($keywords == '') {
            $tags = wp_get_post_tags($post->ID);
            foreach ($tags as $tag ) {
                $keywords = $keywords . $tag->name . ", ";
            }
            $keywords = rtrim($keywords, ', ');
        }
    }
    elseif (is_category()) {
        // 分类的description可以到后台 - 文章 -分类目录，修改分类的描述
        $description = category_description();
        $keywords = single_cat_title('', false);
    }
    elseif (is_tag()){
        // 标签的description可以到后台 - 文章 - 标签，修改标签的描述
        $description = tag_description();
        $keywords = single_tag_title('', false);
    }
    $description = trim(strip_tags($description));
    $keywords = trim(strip_tags($keywords));
    ?>
    <meta name="description" content="<?php echo $description; ?>" />
    <meta name="keywords" content="<?php echo $keywords; ?>" />
</head>
<!--刷新缓存-->
<?php flush(); ?>
<body>
<div class="container">
    <div class="row">
        <div class="col-md-6">
            <h1><a href="<?php echo get_option('home'); ?>"><?php bloginfo('name'); ?></a> <small>
                    你好，欢迎来到我的博客！
                </small> </h1>
        </div>
        <div class="col-md-6">
            <h6 class="description text-right">
                <?php bloginfo('description'); ?>
            </h6>
        </div>
    </div>
</div>
<nav class="navbar navbar-default nav-header  navbar-inverse">
 <div class="container">
     <div class="row">
         <div class="col-md-12">
             <!--             <ul class="nav navbar-nav ">-->
             <!--                 <li class="active btn-infoo"><a href="#" class="">首页</a></li>-->
             <!--             </ul>-->
             <div class="daohang">
                 <?php
                 // 列出顶部导航菜单，菜单名称为mymenu，只列出一级菜单
                 wp_nav_menu(array('menu' => 'mymenu', 'depth' => 1));
                 ?>
             </div>
         </div>
     </div>
 </div>
    </nav>
</body>
</html>
