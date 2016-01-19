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
			<div class="col-sm-9">

				<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
					<div class="jumbotron bg-color">
						<h3 class="title"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a>
						</h3>

						<?php the_excerpt(); ?>
						<div style="text-align: right">
							<?php the_tags('标签：', ', ', ''); ?>
							<?php the_time('Y年n月j日') ?>
							<?php comments_popup_link('0 条评论', '1 条评论', '% 条评论', '', '评论已关闭'); ?>
							<?php comments_popup_link('0 条评论', '1 条评论', '% 条评论', '', '评论已关闭'); ?><?php edit_post_link('编辑', ' &bull; ', ''); ?>
							<a href="<?php the_permalink(); ?>" class="button right">阅读全文</a>
						</div>
					</div>
				<?php endwhile; ?>
				<?php else : ?>
					<h3 class="title"><a href="#" rel="bookmark">未找到</a></h3>
					<p>没有找到任何文章！</p>
				<?php endif; ?>
				<nav class="fright">
					<ul class="pagination">
						<!--						<li>-->
						<!--								--><?php //previous_posts_link('&lt;&lt; 第一页', 0); ?>
						<!--						</li>-->
						<li><?php wp_pagenavi(); ?></li>
						<!--						<li>-->
						<!--								--><?php //next_posts_link('最后一页 &gt;&gt;', 0); ?>
						<!--						</li>-->
					</ul>
				</nav>


			</div>
			<?php get_sidebar(); ?>
		</div>
	</div>
	<!-- footer.php -->
	<?php get_footer(); ?>
	<!-- footer.php -->
</body>
</html>