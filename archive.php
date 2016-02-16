<?php
/*
Template Name: archives
*/
?>
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
            <script type="text/javascript">
                jQuery(document).ready(function () {
                    $('#expand_collapse,.archives-yearmonth').css({cursor: "pointer"});
                    //  $('#archives ul li ul.archives-monthlisting').hide();
                    $('#archives ul li ul.archives-monthlisting:first').show();
                    $('#archives ul li span.archives-yearmonth').click(function () {
                        $(this).next().slideToggle('fast');
                        return false;
                    });
                    $('#expand_collapse').toggle(
                        function () {
                            $('#archives ul li ul.archives-monthlisting').slideDown('fast');
                        },
                        function () {
                            $('#archives ul li ul.archives-monthlisting').slideUp('fast');
                        });
                });
            </script>
            <div class="jumbotron bg-color">
                <a id="expand_collapse" href="#" style="display: block">全部展开/收缩</a>

                <div id="archives"><?php archives_list_SHe(); ?></div>
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
</body>
</html>