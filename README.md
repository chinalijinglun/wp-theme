# wp-theme
this is my blog theme,努力建设中，一点点尝试写一个blog的主题。记录我的点点滴滴

#学到的内容  
1、主题在后台显示的图片名称为：screenshot.png, 宽高不定。  

2、引入header.php 需要用<?php get_header(); ?>  

3、想要在后台显示自己主题的信息，请添加以下内容：  
/*
Theme Name: lijinglun
Theme URI: www.lijinglun.com
Description: 这里填主题的简短介绍
Version: 版本号
Author: 李经纶
Author URI: 作者的网址
Tags: 标签，多个用半角逗号隔开
*/  

4、在header中引入css需要加上<?php bloginfo('stylesheet_url'); ?>，找到根目录才行  

5、以下是在head和/header之前加的内容：  
    <!--pingback -->
    <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />

    <!--feed链接    -->
    <link rel="alternate" type="application/rss+xml" title="RSS 2.0 - 所有文章" href="<?php echo get_bloginfo('rss2_url'); ?>" />
    <link rel="alternate" type="application/rss+xml" title="RSS 2.0 - 所有评论" href="<?php bloginfo('comments_rss2_url'); ?>" />
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
    
6、title的设置：  
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
7、刷新缓存在/header和body之间即可
<?php flush(); ?>  
8、导航栏里面  
这个是获取的页面：  
 <?php wp_list_pages('depth=1&title_li=0&sort_column=menu_order'); ?>
    <li <?php if (is_home()) { echo 'class="current"';} ?>><a title="<?php bloginfo('name'); ?>"  href="<?php echo get_option('home'); ?>/">主页</a></li>
</ul>
  
  这个是获取的分类目录：  
  <?php
   // 获取分类
   $terms = get_terms('category', 'orderby=name&hide_empty=0' );

   // 获取到的分类数量
    $count = count($terms);
   if($count > 0){
    // 循环输出所有分类信息
     foreach ($terms as $term) {
     echo '<li><a href="'.get_term_link($term, $term->slug).'" title="'.$term->name.'">'.$term->name.'</a></li>';
     }
    }
    ?>
