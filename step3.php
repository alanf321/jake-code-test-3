<?php
/*
 * Plugin Name: Step 3
 * Description: Step 3. WordPress Shortcode [stepthree]
 * Version: 1.0
 * Author: Alan French
 */

function step_three() {
    global $post;
    ob_start();
    $url = plugin_dir_url(__FILE__) . 'people.json';
    $data = file_get_contents($url);
    $array = json_decode($data, true);
    for ($i=0; $i<count($array); $i++) {
        $array[$i]['age'] += 5;
    }
    ?>
    <div class="container">
        <?php
        foreach ($array as $i=>$el) {
            ?>
            <div class="user-profile user-profile-<?php echo $i; ?>">
                <div class="user-photo"></div>
                <div class="user-meta">
                    <h2 class="user-name"><?php echo $el['name']; ?></h2>
                    <h3 class="user-age"><label>age: </label><?php echo $el['age']; ?></h3>
                    <h3 class="user-location"><label>location: </label><?php echo $el['location']; ?>, <?php echo $el['country']; ?></h3>
                    <h3 class="user-email"><label>email: </label><?php echo $el['email_address']; ?></h3>
                </div>
            </div>
            <?php
}
        ?>
    </div>
    <?php
    wp_reset_postdata();
    return ob_get_clean();
}

function step_three_init() {
//    add_filter('the_content', 'do_shortcode');
    add_shortcode('stepthree', 'step_three');
}

add_action('init', 'step_three_init');

function step_three_styles() {
    wp_enqueue_style('step-three-style', (plugin_dir_url(__FILE__) . 'step-three.css'), array(), wp_get_theme()->get('Version'));
}

add_action('wp_enqueue_scripts', 'step_three_styles');
?>
