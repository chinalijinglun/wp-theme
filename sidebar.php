<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<body>
<div class="col-sm-3 sidebar-offcanvas">
    <section class="widget">
        <?php if (!function_exists('dynamic_sidebar')
            || !dynamic_sidebar('First_sidebar')
        ) : ?>
            <h4 class="widgettitle">分类目录</h4>
            <ul>
                <?php wp_list_categories('depth=1&title_li=&orderby=id&show_count=0&hide_empty=1&child_of=0'); ?>
            </ul>
        <?php endif; ?>
    </section>
    <section class="widget">
        <?php if (!function_exists('dynamic_sidebar')
            || !dynamic_sidebar('Second_sidebar')
        ) : ?>
            <h4 class="widgettitle">最新文章</h4>
            <ul>
                <?php
                $posts = get_posts('numberposts=6&orderby=post_date');
                foreach ($posts as $post) {
                    setup_postdata($post);
                    echo '<li><a href="' . get_permalink() . '">' . get_the_title() . '</a></li>';
                }
                $post = $posts[0];
                ?>
            </ul>
        <?php endif; ?>
    </section>
    <section class="widget">
        <?php if (!function_exists('dynamic_sidebar')
            || !dynamic_sidebar('Third_sidebar')
        ) : ?>
            <h4 class="widgettitle">标签云</h4>
            <ul><?php wp_tag_cloud('smallest=8&largest=22'); ?></ul>

        <?php endif; ?>
    </section>
    <section class="widget">
        <?php if (!function_exists('dynamic_sidebar')
        || !dynamic_sidebar('Fourth_sidebar')) : ?>
        <h4 class="widgettitle">文章存档</h4>
        <ul>

            <?php wp_get_archives('limit=10'); ?>
        </ul>
    </section>
    <?php endif; ?>

    <!--        <div class="list-group">-->
    <!--            <div class="list-group">-->
    <!--                <strong><a href="#" class="list-group-item">新闻中心</a></strong>-->
    <!--                <a href="#" class="list-group-item active">媒体聚焦<span class="glyphicon glyphicon-triangle-right pull-right" aria-hidden="true"></span></a>-->
    <!---->
    <!--                <a href="" class="list-group-item">集团动态</a>-->
    <!---->
    <!--                <a href="" class="list-group-item">下属公司动态</a>-->
    <!---->
    <!--                <a href="" class="list-group-item">职业教育观察</a>-->
    <!---->
    <!--                <a href="" class="list-group-item">高校就创业教育</a>-->
    <!--            </div>-->
    <!--        </div>-->
</div>

</body>
</html>
