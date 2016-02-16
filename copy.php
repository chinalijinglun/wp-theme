<?php
// 获取分类
$terms = get_terms('category', 'orderby=name&hide_empty=0');

// 获取到的分类数量
$count = count($terms);
if ($count > 0) {
    // 循环输出所有分类信息
    foreach ($terms as $term) {
        echo '<li><a href="' . get_term_link($term, $term->slug) . '" title="' . $term->name . '">' . $term->name . '</a></li>';
    }
}
?>


<?php
// 列出顶部导航菜单，菜单名称为mymenu，只列出一级菜单
wp_nav_menu(array('menu' => 'mymenu', 'depth' => 1));
?>
