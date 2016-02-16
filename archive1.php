<?php
/*
 * Template Name: lijinglun
 */
?>
<style>
    .myArchive {
        line-height: 18px;
        margin: 1.5em 0;
        color: #555555;
        font-size: 14px;
    }

    .myArchive h2 {
        font-size: 16px;
        margin: 0 0 10px;
        font-weight: bold;
    }

    .myArchive ul {
        line-height: 21px;
        padding: 0 0 0 2em;
    }

    .myArchive ul li {
        background: none;
        list-style-type: disc;
        margin: 0;
        padding-left: 10px;
    }

    .myArchive a {
        color: #2970A6;
        outline: medium none;
        text-decoration: none;
    }

    .myArchive a:hover {
        text-decoration: underline;
    }

    .myArchive ul li ul {
        margin: 10px 0;
    }

    .myArchive ul li ul li {
        list-style-type: circle;
    }
</style>
<!-- header.php -->
<?php get_header(); ?>
<!-- header.php -->
<div class="container">
    <div class="row">
        <div class="col-sm-9">
            <?php if (have_posts()) :
            the_post();
            update_post_caches($posts); ?>
            <div class="jumbotron bg-color">
                <h2><?php the_title(); ?></h2>

                <div>
                    <div class="myArchive">
                        <ul>
                            <?php
                            /**
                             * WordPress分类存档页面
                             * 作者：李经纶
                             * 博客：http://www.ludou.org/
                             * 最后修改：2016年2月16日
                             */
                            $categoryPosts = $wpdb->get_results("
    SELECT post_title, ID, post_name, slug, {$wpdb->prefix}terms.term_id AS catID, {$wpdb->prefix}terms.name AS categoryname
    FROM {$wpdb->prefix}posts, {$wpdb->prefix}term_relationships, {$wpdb->prefix}term_taxonomy, {$wpdb->prefix}terms
    WHERE {$wpdb->prefix}posts.ID = {$wpdb->prefix}term_relationships.object_id
    AND {$wpdb->prefix}terms.term_id = {$wpdb->prefix}term_taxonomy.term_id
    AND {$wpdb->prefix}term_taxonomy.term_taxonomy_id = {$wpdb->prefix}term_relationships.term_taxonomy_id
    AND {$wpdb->prefix}term_taxonomy.taxonomy = 'category'
    AND {$wpdb->prefix}posts.post_status = 'publish'
    AND {$wpdb->prefix}posts.post_type = 'post'
    ORDER BY {$wpdb->prefix}terms.term_id, {$wpdb->prefix}posts.post_date DESC");

                            $postID = 0;
                            if ($categoryPosts) :
                                $category = $categoryPosts[0]->catID;
                                foreach ($categoryPosts as $key => $mypost) :
                                    if ($postID == 0) {
                                        echo '<li><strong>分类:</strong> <a title="' . $mypost->categoryname . '" href="' . get_category_link($mypost->catID) . '">' . $mypost->categoryname . "</a>\n";
                                        echo '<ul>';
                                    }

                                    if ($category == $mypost->catID) {
                                        ?>
                                        <li><a title="<?php echo $mypost->post_title; ?>"
                                               href="<?php echo get_permalink($mypost->ID); ?>"><?php echo $mypost->post_title; ?></a>
                                        </li>
                                        <?php
                                        $category = $mypost->catID;
                                        $postID++;
                                    } else {
                                        echo "</ul>\n</li>";
                                        echo '<li><strong>分类:</strong> <a title="' . $mypost->categoryname . '" href="' . get_category_link($mypost->catID) . '">' . $mypost->categoryname . "</a>\n";
                                        echo '<ul>';
                                        ?>
                                        <li><a title="<?php echo $mypost->post_title; ?>"
                                               href="<?php echo get_permalink($mypost->ID); ?>"><?php echo $mypost->post_title; ?></a>
                                        </li>
                                        <?php
                                        $category = $mypost->catID;
                                        $postID = 1;
                                    }
                                endforeach;
                            endif;
                            echo "</ul>\n</li>";
                            ?>

                            <li><strong>页面</strong>
                                <ul>
                                    <?php
                                    // 读取所有页面
                                    $mypages = $wpdb->get_results("
        SELECT post_title, post_name, ID
        FROM {$wpdb->prefix}posts
        WHERE post_status = 'publish'
        AND post_type = 'page'");

                                    if ($mypages) :
                                        foreach ($mypages as $mypage) :
                                            ?>
                                            <li><a title="<?php echo $mypage->post_title; ?>"
                                                   href="<?php echo get_permalink($mypage->ID); ?>"><?php echo $mypage->post_title; ?></a>
                                            </li>
                                        <?php endforeach;
                                        echo "</ul>\n</li>"; endif; ?>
                                </ul>
                               
                    </div>
                    <?php comments_template(); ?>
                </div>
                <?php else : ?>
                    <div>
                        没有找到你想要的页面！
                    </div>
                <?php endif; ?>
            </div>
        </div>

        <!--     <div class="col-sm-12 page bg-color">
            <?php comments_template(); ?>
            </div> -->
        <?php get_sidebar(); ?>

    </div>
</div>
<!-- footer.php -->
<?php get_footer(); ?>
<!-- footer.php -->
