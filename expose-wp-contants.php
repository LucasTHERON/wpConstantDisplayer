<?php
/*
Plugin Name: Const Displayer
Description: Faire aparaitre les CONST définies
Author: Thor
Version: 9999999
*/


function wp_constants_board_function($timestamp = null, $custom_consts = null){

    /* BLOCK IF NO USER LOGGED IN */
    if(!function_exists('wp_get_current_user')){
        // It's too soon to check anything so we return
        return;
    }else{
        if(!wp_get_current_user() -> roles){
            // NO USER LOGGED IN
            return;
        }
        /* BLOCK IF NO ADMINISTRATOR */
        if(wp_get_current_user()->roles[0] !== 'administrator'){
            return;
        }
    }

    /* UNIQUE ID TO MANAGE CALLS */
    $call_id = rand();

    include 'const_list.php';
    if(!defined('WP_CONST_LIST')){
        return;
    }

    /* IF FUNCTION IS CALLED WITH A WP HOOK, IT IS USED AS A TIMESTAMP */
    if(!$timestamp && current_action() !== 'call_wp_constants_board'){
        $timestamp = current_action();
    }
    ?>

    <div class="constant_board_container id_<?php echo $call_id; ?>" style="padding: 10px; width: 90%; max-width: 800px; margin: 20px auto; background: #dfdce4; border: 1px solid #4F4F4F; position: relative;">
    <span style="text-align: right"><?php echo $timestamp; ?></span>
    <div class="board_buttons" style="position: absolute; top: 0; right: 2px;">
        <button class="toggle_undefined">Show / Hide undefined</button>
        <button class="toggle_board" style="background: #4a90a7; color: white; border-color: #4a90a7;">Show / Hide board</button>
        <button class="close_board" style="background: red; color: white; border-color: red;">Close board</button>
    </div>
    <h3 style="">CHECK WP CONSTS</h3>
    <div style="display: grid; grid-template-columns:min-content; overflow-x: auto">
    <?php

    foreach(WP_CONST_LIST as $i => $const_name){
        $i = $i+1;
        if(defined($const_name)){
            echo '<div class="is_defined" style="padding: 5px 10px; grid-column:1; grid-row:'.  $i  .'">' . $const_name . '</div>';
            echo '<div class="is_defined" style="padding: 5px 10px; grid-column:2; grid-row:'. $i .'">' . constant($const_name) . ' <span style="opacity: 0.7">('.gettype(constant($const_name)).')</span></div>';
        }else{
            echo '<div class="is_not_defined" style="padding: 5px 10px; grid-column:1; grid-row:'. $i .'">' . $const_name . '</div>';
            echo '<div class="is_not_defined" style="padding: 5px 10px; grid-column:2; grid-row:'. $i .'"><i>Undefined constant</i></div>';
        }
    }
    ?>
    </div>
    </div>

    <style>
    .constant_board_container .is_not_defined.hidden{display:none;}
    .constant_board_container .collapsed{display:none;}
    </style>

    <script>
        const BOARD_<?php echo $call_id; ?> = document.querySelector(".constant_board_container.id_<?php echo $call_id; ?>");
        const CLOSE_BOARD_<?php echo $call_id; ?> = document.querySelector(".constant_board_container.id_<?php echo $call_id; ?> .close_board");
        const TOGGLE_BOARD_<?php echo $call_id; ?> = document.querySelector(".constant_board_container.id_<?php echo $call_id; ?> .toggle_board");
        const CONSTANTS_<?php echo $call_id; ?> = document.querySelectorAll(".constant_board_container.id_<?php echo $call_id; ?> div:not(.board_buttons)");
        const TOGGLE_UNDEFINED_CONSTANTS_<?php echo $call_id; ?> = document.querySelector(".constant_board_container.id_<?php echo $call_id; ?> .toggle_undefined");
        const UNDEFINED_CONSTANTS_<?php echo $call_id; ?> = document.querySelectorAll(".constant_board_container.id_<?php echo $call_id; ?> .is_not_defined");
        
        CLOSE_BOARD_<?php echo $call_id; ?>.addEventListener("click", () => {
            BOARD_<?php echo $call_id; ?>.remove();
        })

        TOGGLE_BOARD_<?php echo $call_id; ?>.addEventListener("click", () => {
            CONSTANTS_<?php echo $call_id; ?>.forEach(el => {
                el.classList.toggle("collapsed");
            });
        });
        
        TOGGLE_UNDEFINED_CONSTANTS_<?php echo $call_id; ?>.addEventListener("click", () => {
            UNDEFINED_CONSTANTS_<?php echo $call_id; ?>.forEach(el => {
                el.classList.toggle("hidden");
            })
        });
    </script>

    <?php

} // End function

add_action('call_wp_constants_board', 'wp_constants_board_function', 10, 2);

if(is_admin()){
    add_action('admin_notices', 'wp_constants_board_function');
}else{
    add_action('wp_head', 'wp_constants_board_function');
}


/* SOMETIMES YOU HAVE ENOUGH OF WP ADMIN BARS */
// echo '<style>#wpwrap#wpwrap{display: none !important}</style>';

/**********************************************************************************/
/**********************************  HOW TO USE  **********************************/
/**********************************************************************************/

/* CALL WITHOUT CONTEXT */
// do_action('call_wp_constants_board');
/**********************************************************************************/

/* CALL WITH CUSTOM TIMESTAMP */
// do_action('call_wp_constants_board', 'I called it at that point');
/**********************************************************************************/

/* ADD CUSTOM CONSTS TO CHECK */
// $my_custom_const_list = ['MY_CUSTOM_CONST1', 'MY_CUSTOM_CONST2'];
// do_action('call_wp_constants_board', 'My custom const call', $my_custom_const_list);
/**********************************************************************************/

/* CALL AT A SPECIFIC WORDPRESS ACTION */
// add_action('init', 'wp_constants_board_function');
/**********************************************************************************/

/**********************************************************************************/
/**********************************************************************************/
/**********************************************************************************/