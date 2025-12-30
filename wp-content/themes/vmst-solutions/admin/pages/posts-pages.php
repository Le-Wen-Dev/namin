<?php
/**
 * Quản lý Bài viết & Trang
 */

if (!current_user_can('manage_options')) {
    wp_die(__('Bạn không có quyền truy cập trang này.'));
}

$posts = get_posts(array('post_type' => 'post', 'numberposts' => -1));
$pages = get_posts(array('post_type' => 'page', 'numberposts' => -1));
?>

<div class="wrap namin-posts-pages">
    <h1>Quản lý Bài viết & Trang</h1>
    
    <div class="namin-tabs">
        <a href="#posts" class="nav-tab nav-tab-active">Bài viết</a>
        <a href="#pages" class="nav-tab">Trang</a>
    </div>
    
    <div id="posts" class="namin-tab-content active">
        <div class="namin-section-header">
            <h2>Bài viết (<?php echo count($posts); ?>)</h2>
            <a href="<?php echo admin_url('post-new.php'); ?>" class="button button-primary">Thêm bài viết mới</a>
        </div>
        
        <table class="wp-list-table widefat fixed striped">
            <thead>
                <tr>
                    <th>Tiêu đề</th>
                    <th>Tác giả</th>
                    <th>Danh mục</th>
                    <th>Ngày đăng</th>
                    <th>Thao tác</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($posts)) : ?>
                    <?php foreach ($posts as $post) : ?>
                        <tr>
                            <td><strong><a href="<?php echo get_edit_post_link($post->ID); ?>"><?php echo esc_html($post->post_title); ?></a></strong></td>
                            <td><?php echo get_the_author_meta('display_name', $post->post_author); ?></td>
                            <td><?php echo get_the_category_list(', ', '', $post->ID); ?></td>
                            <td><?php echo get_the_date('d/m/Y H:i', $post->ID); ?></td>
                            <td>
                                <a href="<?php echo get_edit_post_link($post->ID); ?>">Sửa</a> |
                                <a href="<?php echo get_permalink($post->ID); ?>" target="_blank">Xem</a> |
                                <a href="<?php echo get_delete_post_link($post->ID); ?>" onclick="return confirm('Bạn có chắc muốn xóa?');">Xóa</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else : ?>
                    <tr>
                        <td colspan="5">Chưa có bài viết nào</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
    
    <div id="pages" class="namin-tab-content">
        <div class="namin-section-header">
            <h2>Trang (<?php echo count($pages); ?>)</h2>
            <a href="<?php echo admin_url('post-new.php?post_type=page'); ?>" class="button button-primary">Thêm trang mới</a>
        </div>
        
        <table class="wp-list-table widefat fixed striped">
            <thead>
                <tr>
                    <th>Tiêu đề</th>
                    <th>Tác giả</th>
                    <th>Template</th>
                    <th>Ngày đăng</th>
                    <th>Thao tác</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($pages)) : ?>
                    <?php foreach ($pages as $page) : 
                        $template = get_page_template_slug($page->ID);
                    ?>
                        <tr>
                            <td><strong><a href="<?php echo get_edit_post_link($page->ID); ?>"><?php echo esc_html($page->post_title); ?></a></strong></td>
                            <td><?php echo get_the_author_meta('display_name', $page->post_author); ?></td>
                            <td><?php echo $template ? esc_html($template) : 'Mặc định'; ?></td>
                            <td><?php echo get_the_date('d/m/Y H:i', $page->ID); ?></td>
                            <td>
                                <a href="<?php echo get_edit_post_link($page->ID); ?>">Sửa</a> |
                                <a href="<?php echo get_permalink($page->ID); ?>" target="_blank">Xem</a> |
                                <a href="<?php echo get_delete_post_link($page->ID); ?>" onclick="return confirm('Bạn có chắc muốn xóa?');">Xóa</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else : ?>
                    <tr>
                        <td colspan="5">Chưa có trang nào</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<script>
jQuery(document).ready(function($) {
    $('.namin-tabs .nav-tab').on('click', function(e) {
        e.preventDefault();
        var target = $(this).attr('href');
        $('.nav-tab').removeClass('nav-tab-active');
        $(this).addClass('nav-tab-active');
        $('.namin-tab-content').removeClass('active');
        $(target).addClass('active');
    });
});
</script>

