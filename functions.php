<?php
/** widgets */
if (function_exists('register_sidebar')) {
    register_sidebar(array(
        'name' => 'First_sidebar',
        'before_widget' => '',
        'after_widget' => '',
        'before_title' => '<h4>',
        'after_title' => '</h4>'
    ));
    register_sidebar(array(
        'name' => 'Second_sidebar',
        'before_widget' => '',
        'after_widget' => '',
        'before_title' => '<h4>',
        'after_title' => '</h4>'
    ));
    register_sidebar(array(
        'name' => 'Third_sidebar',
        'before_widget' => '',
        'after_widget' => '',
        'before_title' => '<h4>',
        'after_title' => '</h4>'
    ));
    register_sidebar(array(
        'name' => 'Fourth_sidebar',
        'before_widget' => '',
        'after_widget' => '',
        'before_title' => '<h4>',
        'after_title' => '</h4>'
    ));
}
//页码/分页/翻页效果

function wp_pagenavi()
{

//先申明两个全局变量

    global $wp_query, $wp_rewrite;

//判断当前页面

    $wp_query->query_vars['paged'] > 1 ? $current = $wp_query->query_vars['paged'] : $current = 1;

    $pagination = array(

        'base' => @add_query_arg('paged', '%#%'),

        'format' => '',

        'total' => $wp_query->max_num_pages,

        'current' => $current,

        'show_all' => false,

        'type' => 'plain',

        'end_size' => '1',//在最后和最前至少显示多少个页码数，这里最后最前至少显示“1” 页的意思

        'mid_size' => '4',//在最后和最前之间至少显示多少个页码数

        'prev_text' => '上一页',

        'next_text' => '下一页'

    );

    if ($wp_rewrite->using_permalinks())

        $pagination['base'] = user_trailingslashit(trailingslashit(remove_query_arg('s', get_pagenum_link(1))) . 'page/%#%/', 'paged');

    if (!empty($wp_query->query_vars['s']))

        $pagination['add_args'] = array('s' => get_query_var('s'));

    echo paginate_links($pagination);

}

function aurelius_comment($comment, $args, $depth)
{
$GLOBALS['comment'] = $comment; ?>
<li class="comment" id="li-comment-<?php comment_ID(); ?>">
    <div class="gravatar"> <?php if (function_exists('get_avatar') && get_option('show_avatars')) {
            echo get_avatar($comment, 48);
        } ?>
        <?php comment_reply_link(array_merge($args, array('reply_text' => '回复', 'depth' => $depth, 'max_depth' => $args['max_depth']))) ?> </div>
    <div class="comment_content" id="comment-<?php comment_ID(); ?>">
        <div class="clearfix">
            <?php printf(__('<cite class="author_name">%s</cite>'), get_comment_author_link()); ?>
            <div class="comment-meta commentmetadata">发表于：<?php echo get_comment_time('Y-m-d H:i'); ?></div>
            &nbsp;&nbsp;&nbsp;<?php edit_comment_link('修改'); ?>
        </div>

        <div class="comment_text">
            <?php if ($comment->comment_approved == '0') : ?>
                <em>你的评论正在审核，稍后会显示出来！</em><br/>
            <?php endif; ?>
            <?php comment_text(); ?>
        </div>
    </div>
    <?php } ?>
