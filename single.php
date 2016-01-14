<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<body>
<!-- header.php -->
<?php get_header(); ?>
<!-- header.php -->
<div class="container">
    <div class="row">
        <div class="col-sm-9 page">

            <?php if (have_posts()) : the_post();
                update_post_caches($posts); ?>


                <h3 class="title-center"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                <div class="title-center">
                    <?php the_tags('标签：', ', ', ''); ?>
                    <?php the_time('Y年n月j日') ?>
                    <?php comments_popup_link('0 条评论', '1 条评论', '% 条评论', '', '评论已关闭'); ?><?php edit_post_link('编辑', ' &bull; ', ''); ?>
                </div>
                <?php the_content(); ?>


                <p class="clearfix"><a href="<?php echo get_option('home'); ?>" class="button float">&lt;&lt; 返回首页</a>
                    <a href="#commentform" class="button float right">发表评论</a></p>
                <!-- Column 1 /Content -->

            <?php else : ?>
                <div class="errorbox">
                    没有文章！
                </div>
            <?php endif; ?>

        </div>
        <?php get_sidebar(); ?>
        <div class="col-sm-9">
            <?php comments_template(); ?>
        </div>
    </div>
</div>
<!-- footer.php -->
<?php get_footer(); ?>
<!-- footer.php -->
</body>
</html>