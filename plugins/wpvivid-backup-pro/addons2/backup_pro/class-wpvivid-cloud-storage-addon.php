<?php

if (!defined('WPVIVID_BACKUP_PRO_PLUGIN_DIR'))
{
    die;
}

/**
 * WPvivid addon: yes
 * Addon Name: wpvivid-backup-pro-all-in-one
 * Description: Pro
 * Version: 2.2.11
 * Need_init: yes
 * Interface Name: WPvivid_Multi_Remote_addon
 */

if ( ! class_exists( 'WP_List_Table' ) )
{
    require_once( ABSPATH . 'wp-admin/includes/class-wp-list-table.php' );
}

class WPvivid_Storage_List extends WP_List_Table
{
    public $page_num;
    public $storage_list;

    public function __construct( $args = array() )
    {
        parent::__construct(
            array(
                'plural' => 'storage',
                'screen' => 'storage'
            )
        );
    }

    protected function get_table_classes()
    {
        return array( 'widefat striped' );
    }

    public function print_column_headers( $with_id = true )
    {
        list( $columns, $hidden, $sortable, $primary ) = $this->get_column_info();

        if (!empty($columns['cb'])) {
            static $cb_counter = 1;
            $columns['cb'] = '<label class="screen-reader-text" for="cb-select-all-' . $cb_counter . '">' . __('Select All') . '</label>'
                . '<input id="cb-select-all-' . $cb_counter . '" type="checkbox"/>';
            $cb_counter++;
        }

        foreach ( $columns as $column_key => $column_display_name )
        {
            $class = array( 'manage-column', "column-$column_key" );

            if ( in_array( $column_key, $hidden ) )
            {
                $class[] = 'hidden';
            }

            if ( $column_key === $primary )
            {
                $class[] = 'column-primary';
            }

            if ( $column_key === 'cb' )
            {
                $class[] = 'check-column';
            }

            $tag   = ( 'cb' === $column_key ) ? 'td' : 'th';
            $scope = ( 'th' === $tag ) ? 'scope="col"' : '';
            $id    = $with_id ? "id='$column_key'" : '';

            if ( ! empty( $class ) )
            {
                $class = "class='" . join( ' ', $class ) . "'";
            }

            echo "<$tag $scope $id $class>$column_display_name</$tag>";
        }
    }

    public function get_columns()
    {
        $columns = array();
        $columns['cb'] = __( 'cb', 'wpvivid' );
        $columns['wpvivid_storage_type'] = __( 'Storage Providers	', 'wpvivid' );
        $columns['wpvivid_storage_alias'] = __( 'Remote Storage Alias', 'wpvivid' );
        $columns['wpvivid_storage_actions'] =__( 'Actions', 'wpvivid'  );
        return $columns;
    }

    public function  column_cb( $storage )
    {
        $html='<input type="checkbox" name="remote_storage" value="'.esc_attr($storage['key'], 'wpvivid').'" '.esc_attr($storage['check_status'], 'wpvivid').' />';
        echo $html;
    }

    public function _column_wpvivid_storage_type( $storage )
    {
        $storage_type = $storage['type'];
        $storage_type=apply_filters('wpvivid_storage_provider_tran', $storage_type);
        $html='<td class="plugin-title column-primary"><div>'.__($storage_type, 'wpvivid').'</div></td>';
        echo $html;
    }

    public function _column_wpvivid_storage_alias( $storage )
    {
        $html='<td class="plugin-title column-primary"><label for="tablecell">'.__($storage['name'], 'wpvivid').'</label></td>';
        echo $html;
    }

    public function _column_wpvivid_storage_actions( $storage )
    {
        $html='<td class="tablelistcolumn">
                    <span class="dashicons dashicons-admin-generic wpvivid-dashicons-grey wpvivid-schedule-edit" onclick="click_retrieve_remote_storage(\''.__($storage['key'], 'wpvivid').'\',\''.__($storage['type'], 'wpvivid').'\',\''.__($storage['name'], 'wpvivid').'\');" style="cursor: pointer;"></span>
                    <span class="dashicons dashicons-trash wpvivid-dashicons-grey wpvivid-schedule-delete" onclick="wpvivid_delete_remote_storage(\''.__($storage['key'], 'wpvivid').'\');" style="cursor: pointer;"></span>
                </td>';
        echo $html;
    }

    public function set_storage_list($storage_list,$page_num=1)
    {
        $this->storage_list=$storage_list;
        $this->page_num=$page_num;
    }

    public function get_pagenum()
    {
        if($this->page_num=='first')
        {
            $this->page_num=1;
        }
        else if($this->page_num=='last')
        {
            $this->page_num=$this->_pagination_args['total_pages'];
        }
        $pagenum = $this->page_num ? $this->page_num : 0;

        if ( isset( $this->_pagination_args['total_pages'] ) && $pagenum > $this->_pagination_args['total_pages'] )
        {
            $pagenum = $this->_pagination_args['total_pages'];
        }

        return max( 1, $pagenum );
    }

    public function prepare_items()
    {
        $columns = $this->get_columns();
        $hidden = array();
        $sortable = array();
        $this->_column_headers = array($columns, $hidden, $sortable);

        $tmp_storage_list = $this->storage_list;
        if(isset($tmp_storage_list['remote_selected'])) {
            unset($tmp_storage_list['remote_selected']);
        }

        $total_items =sizeof($tmp_storage_list);

        $this->set_pagination_args(
            array(
                'total_items' => $total_items,
                'per_page'    => 10,
            )
        );
    }

    public function has_items()
    {
        return !empty($this->storage_list);
    }

    public function display_rows()
    {
        $this->_display_rows($this->storage_list);
    }

    private function _display_rows($storage_list)
    {
        if(isset($storage_list['remote_selected'])) {
            $remote_select_tmp = $storage_list['remote_selected'];
            unset($storage_list['remote_selected']);
        }
        else{
            $remote_select_tmp = array();
        }

        $page=$this->get_pagenum();
        $page_storage_list=array();
        $count=0;

        while ( $count<$page )
        {
            $page_storage_list = array_splice( $storage_list, 0, 10);
            $count++;
        }
        $default_remote_storage=array();
        foreach ($remote_select_tmp as $value)
        {
            $default_remote_storage[$value]=$value;
        }

        foreach ( $page_storage_list as $key=>$storage)
        {
            if($key === 'remote_selected')
            {
                continue;
            }
            if (array_key_exists($key,$default_remote_storage))
            {
                $storage['check_status'] = 'checked';
            }
            else
            {
                $storage['check_status']='';
            }
            $storage['key']=$key;
            $this->single_row($storage);
        }
    }

    public function single_row($storage)
    {
        ?>
        <tr>
            <?php $this->single_row_columns( $storage ); ?>
        </tr>
        <?php
    }

    protected function pagination( $which )
    {
        if ( empty( $this->_pagination_args ) )
        {
            return;
        }

        $total_items     = $this->_pagination_args['total_items'];
        $total_pages     = $this->_pagination_args['total_pages'];
        $infinite_scroll = false;
        if ( isset( $this->_pagination_args['infinite_scroll'] ) )
        {
            $infinite_scroll = $this->_pagination_args['infinite_scroll'];
        }

        if ( 'top' === $which && $total_pages > 1 )
        {
            $this->screen->render_screen_reader_content( 'heading_pagination' );
        }

        $output = '<span class="displaying-num">' . sprintf( _n( '%s item', '%s items', $total_items ), number_format_i18n( $total_items ) ) . '</span>';

        $current              = $this->get_pagenum();

        $page_links = array();

        $total_pages_before = '<span class="paging-input">';
        $total_pages_after  = '</span></span>';

        $disable_first = $disable_last = $disable_prev = $disable_next = false;

        if ( $current == 1 ) {
            $disable_first = true;
            $disable_prev  = true;
        }
        if ( $current == 2 ) {
            $disable_first = true;
        }
        if ( $current == $total_pages ) {
            $disable_last = true;
            $disable_next = true;
        }
        if ( $current == $total_pages - 1 ) {
            $disable_last = true;
        }

        if ( $disable_first ) {
            $page_links[] = '<span class="tablenav-pages-navspan button disabled" aria-hidden="true">&laquo;</span>';
        } else {
            $page_links[] = sprintf(
                "<div class='first-page button'><span class='screen-reader-text'>%s</span><span aria-hidden='true'>%s</span></div>",
                __( 'First page' ),
                '&laquo;'
            );
        }

        if ( $disable_prev ) {
            $page_links[] = '<span class="tablenav-pages-navspan button disabled" aria-hidden="true">&lsaquo;</span>';
        } else {
            $page_links[] = sprintf(
                "<div class='prev-page button' value='%s'><span class='screen-reader-text'>%s</span><span aria-hidden='true'>%s</span></div>",
                $current,
                __( 'Previous page' ),
                '&lsaquo;'
            );
        }

        if ( 'bottom' === $which ) {
            $html_current_page  = $current;
            $total_pages_before = '<span class="screen-reader-text">' . __( 'Current Page' ) . '</span><span id="table-paging" class="paging-input"><span class="tablenav-paging-text">';
        } else {
            $html_current_page = sprintf(
                "%s<input class='current-page' id='current-page-selector-remote' type='text' name='paged' value='%s' size='%d' aria-describedby='table-paging' /><span class='tablenav-paging-text'>",
                '<label for="current-page-selector-remote" class="screen-reader-text">' . __( 'Current Page' ) . '</label>',
                $current,
                strlen( $total_pages )
            );
        }
        $html_total_pages = sprintf( "<span class='total-pages'>%s</span>", number_format_i18n( $total_pages ) );
        $page_links[]     = $total_pages_before . sprintf( _x( '%1$s of %2$s', 'paging' ), $html_current_page, $html_total_pages ) . $total_pages_after;

        if ( $disable_next ) {
            $page_links[] = '<span class="tablenav-pages-navspan button disabled" aria-hidden="true">&rsaquo;</span>';
        } else {
            $page_links[] = sprintf(
                "<div class='next-page button' value='%s'><span class='screen-reader-text'>%s</span><span aria-hidden='true'>%s</span></div>",
                $current,
                __( 'Next page' ),
                '&rsaquo;'
            );
        }

        if ( $disable_last ) {
            $page_links[] = '<span class="tablenav-pages-navspan button disabled" aria-hidden="true">&raquo;</span>';
        } else {
            $page_links[] = sprintf(
                "<div class='last-page button'><span class='screen-reader-text'>%s</span><span aria-hidden='true'>%s</span></div>",
                __( 'Last page' ),
                '&raquo;'
            );
        }

        $pagination_links_class = 'pagination-links';
        if ( ! empty( $infinite_scroll ) ) {
            $pagination_links_class .= ' hide-if-js';
        }
        $output .= "\n<span class='$pagination_links_class'>" . join( "\n", $page_links ) . '</span>';

        if ( $total_pages ) {
            $page_class = $total_pages < 2 ? ' one-page' : '';
        } else {
            $page_class = ' no-pages';
        }
        $this->_pagination = "<div class='tablenav-pages{$page_class}'>$output</div>";

        echo $this->_pagination;
    }

    protected function display_tablenav( $which ) {
        $css_type = '';
        if ( 'top' === $which ) {
            wp_nonce_field( 'bulk-' . $this->_args['plural'] );
            $css_type = 'margin: 0 0 10px 0';
        }
        else if( 'bottom' === $which ) {
            $css_type = 'margin: 10px 0 0 0';
        }

        $total_pages     = $this->_pagination_args['total_pages'];

        if ( $total_pages >1)
        {
            ?>
            <div class="tablenav <?php echo esc_attr( $which ); ?>" style="<?php esc_attr_e($css_type); ?>">
                <?php
                $this->extra_tablenav( $which );
                $this->pagination( $which );
                ?>

                <br class="clear" />
            </div>
            <?php
        }
    }

    /*public function display()
    {
        $singular = $this->_args['singular'];

        $this->display_tablenav( 'top' );

        $this->screen->render_screen_reader_content( 'heading_list' );
        ?>
        <table class="wp-list-table <?php echo implode( ' ', $this->get_table_classes() ); ?>">
            <thead>
            <tr>
                <?php $this->print_column_headers(); ?>
            </tr>
            </thead>

            <tbody id="the-list"
                <?php
                if ( $singular ) {
                    echo " data-wp-lists='list:$singular'";
                }
                ?>
            >
            <?php $this->display_rows_or_placeholder(); ?>
            </tbody>

            <tfoot>
            <tr>
                <th colspan="5" class="row-title">
                    <input class="button-primary" id="wpvivid_set_default_remote_storage" type="submit" name="choose-remote-storage" value="<?php echo esc_attr__( 'Save Changes', 'wpvivid' )?>"/>
                </th>
            </tr>
            </tfoot>

        </table>
        <?php
        $this->display_tablenav( 'bottom' );
    }*/
}

class WPvivid_Multi_Remote_addon
{
    public $main_tab;
    public $storage_tab;

    public function __construct()
    {
        //dashboard
        add_filter('wpvivid_get_dashboard_menu', array($this, 'get_dashboard_menu'), 10, 2);
        add_filter('wpvivid_get_dashboard_screens', array($this, 'get_dashboard_screens'), 10);
        add_filter('wpvivid_get_toolbar_menus', array($this, 'get_toolbar_menus'),11);
        //ajax
        add_action('wp_ajax_wpvivid_get_remote_storage_list', array($this, 'get_remote_storage_list'));
        add_action('wp_ajax_wpvivid_edit_remote_ex',array( $this,'edit_remote'));
        add_action('wp_ajax_wpvivid_delete_remote_addon',array( $this,'delete_remote'));
        add_action('wp_ajax_wpvivid_set_default_remote_storage_ex', array($this, 'set_default_remote_storage_ex'));

        //filters
        add_filter('wpvivid_upload_files_to_multi_remote', array( $this, 'upload' ), 10,2);
        add_filter('wpvivid_set_backup_remote_options',array($this,'set_backup_remote_options'),10,2);
        add_filter('wpvivid_before_add_user_history',array($this, 'before_add_user_history'),10);
        add_filter('wpvivid_encrypt_remote_password', array($this, 'encrypt_remote_password'));
        add_filter('wpvivid_trim_import_info', array($this, 'trim_import_info'));

        //actions
        add_action('wpvivid_clean_remote_schedule_event',array( $this,'clean_remote_schedule_event'));
        add_action('wpvivid_clean_remote_schedule_single_event', array($this, 'clean_remote_schedule_event'));
        add_action('wpvivid_check_need_clean_remote_backup', array($this, 'check_need_clean_remote_backup'));
        add_action('wpvivid_clean_oldest_backup',array( $this,'check_remote_backups'),10,2);
        add_action('wpvivid_remote_storage_backup_retention', array($this, 'remote_storage_backup_retention'), 10, 2);

        if(!defined( 'DOING_CRON' ))
        {
            if(wp_get_schedule('wpvivid_clean_remote_schedule_event')===false)
            {
                wp_schedule_event(time()+3600, 'daily', 'wpvivid_clean_remote_schedule_event');
            }
        }

        add_filter('wpvivid_get_role_cap_list',array($this, 'get_caps'));
    }

    public function get_caps($cap_list)
    {
        $cap['slug']='wpvivid-can-mange-remote';
        $cap['display']='Manage remote storage';
        $cap['menu_slug']=strtolower(sprintf('%s-remote', apply_filters('wpvivid_white_label_slug', 'wpvivid')));
        $cap_list[$cap['slug']]=$cap;

        return $cap_list;
    }

    public function get_dashboard_screens($screens)
    {
        $screen['menu_slug']='wpvivid-remote';
        $screen['screen_id']='wpvivid-plugin_page_wpvivid-remote';
        $screen['is_top']=false;
        $screens[]=$screen;
        return $screens;
    }

    public function get_dashboard_menu($submenus,$parent_slug)
    {
        $display = apply_filters('wpvivid_get_menu_capability_addon', 'menu_cloud_storage');
        if($display)
        {
            $submenu['parent_slug'] = $parent_slug;
            $submenu['page_title'] = apply_filters('wpvivid_white_label_display', 'Cloud Storage');
            $submenu['menu_title'] = 'Cloud Storage';
            if (current_user_can('administrator')) {
                $submenu['capability'] = 'administrator';
            } else {
                $submenu['capability'] = 'wpvivid-can-mange-remote';
            }
            $submenu['menu_slug'] = strtolower(sprintf('%s-remote', apply_filters('wpvivid_white_label_slug', 'wpvivid')));
            $submenu['index'] = 8;
            $submenu['function'] = array($this, 'init_page');
            $submenus[$submenu['menu_slug']] = $submenu;
        }
        return $submenus;
    }

    public function get_toolbar_menus($toolbar_menus)
    {
        $admin_url = apply_filters('wpvivid_get_admin_url', '');
        $display = apply_filters('wpvivid_get_menu_capability_addon', 'menu_cloud_storage');
        if($display) {
            $menu['id'] = 'wpvivid_admin_menu_storage';
            $menu['parent'] = 'wpvivid_admin_menu';
            $menu['title'] = 'Cloud Storage';
            $menu['tab'] = 'admin.php?page=' . apply_filters('wpvivid_white_label_plugin_name', 'wpvivid-remote');
            $menu['href'] = $admin_url . 'admin.php?page=' . apply_filters('wpvivid_white_label_plugin_name', 'wpvivid-remote');
            if (current_user_can('administrator')) {
                $menu['capability'] = 'administrator';
            } else {
                $menu['capability'] = 'wpvivid-can-mange-remote';
            }
            $menu['index'] = 8;
            $toolbar_menus[$menu['parent']]['child'][$menu['id']] = $menu;
        }
        return $toolbar_menus;
    }

    /***** cloud storage ajax begin *****/
    public function get_remote_storage_list(){
        global $wpvivid_backup_pro;
        $wpvivid_backup_pro->ajax_check_security('wpvivid-can-mange-remote');
        try{
            $remoteslist=WPvivid_Setting::get_all_remote_options();
            $table=new WPvivid_Storage_List();
            if(isset($_POST['page'])) {
                $table->set_storage_list($remoteslist,$_POST['page']);
            }
            else {
                $table->set_storage_list($remoteslist);
            }
            $table->prepare_items();
            ob_start();
            $table->display();
            $html = ob_get_clean();
            $ret['html'] = $html;
            $ret['result'] = 'success';
            echo json_encode($ret);
        }
        catch (Exception $error)
        {
            $message = 'An exception has occurred. class: '.get_class($error).';msg: '.$error->getMessage().';code: '.$error->getCode().';line: '.$error->getLine().';in_file: '.$error->getFile().';';
            error_log($message);
            echo json_encode(array('result'=>'failed','error'=>$message));
        }
        die();
    }

    public function edit_remote(){
        global $wpvivid_backup_pro;
        $wpvivid_backup_pro->ajax_check_security('wpvivid-can-mange-remote');
        try
        {
            if (empty($_POST) || !isset($_POST['remote']) || !is_string($_POST['remote']) || !isset($_POST['id']) || !is_string($_POST['id']) || !isset($_POST['type']) || !is_string($_POST['type']))
            {
                die();
            }
            $json = $_POST['remote'];
            $json = stripslashes($json);
            $remote_options = json_decode($json, true);
            if (is_null($remote_options))
            {
                die();
            }
            $remote_options['type'] = $_POST['type'];
            if ($remote_options['type'] == 'amazons3')
            {
                if(isset($remote_options['s3Path']))
                    $remote_options['s3Path'] = rtrim($remote_options['s3Path'], "/");
            }

            $old_remote=WPvivid_Setting::get_remote_option($_POST['id']);
            foreach ($old_remote as $key=>$value)
            {
                if(isset($remote_options[$key])) {
                    $old_remote[$key] = $remote_options[$key];
                }
            }
            if(!isset($old_remote['backup_retain']) && isset($remote_options['backup_retain'])){
                $old_remote['backup_retain'] = $remote_options['backup_retain'];
            }
            if(!isset($old_remote['backup_db_retain']) && isset($remote_options['backup_db_retain'])){
                $old_remote['backup_db_retain'] = $remote_options['backup_db_retain'];
            }
            if(!isset($old_remote['backup_incremental_retain']) && isset($remote_options['backup_incremental_retain'])){
                $old_remote['backup_incremental_retain'] = $remote_options['backup_incremental_retain'];
            }
            if(!isset($old_remote['backup_rollback_retain']) && isset($remote_options['backup_rollback_retain'])){
                $old_remote['backup_rollback_retain'] = $remote_options['backup_rollback_retain'];
            }
            if(isset($remote_options['root_path']) && !isset($old_remote['root_path'])){
                $old_remote['root_path'] = $remote_options['root_path'];
            }
            if($remote_options['type'] == 'pCloud')
            {
                if(isset($remote_options['chunk_size']) && !isset($old_remote['chunk_size']))
                {
                    $old_remote['chunk_size'] = $remote_options['chunk_size'];
                }
            }

            $schedules = get_option('wpvivid_schedule_addon_setting', array());
            if(!empty($schedules))
            {
                foreach ($schedules as $schedule_id=>$schedule_data)
                {
                    if($schedule_data['backup']['remote'] === 1 && isset($schedule_data['backup']['remote_options']))
                    {
                        foreach ($schedule_data['backup']['remote_options'] as $remote_id=>$remote_data)
                        {
                            if($remote_id === $_POST['id'])
                            {
                                $tmp_remote = $old_remote;
                                if(isset($tmp_remote['is_encrypt']) && $tmp_remote['is_encrypt'] == 1){
                                    $tmp_remote['password'] = base64_encode($tmp_remote['password']);
                                }
                                if(isset($tmp_remote['type']) && $tmp_remote['type'] === 'pCloud'){
                                    $tmp_remote['chunk_size'] = $tmp_remote['chunk_size'] * 1024 * 1024;
                                }
                                $schedules[$schedule_id]['backup']['remote_options'][$remote_id] = $tmp_remote;
                                update_option('wpvivid_schedule_addon_setting', $schedules);
                            }
                        }
                    }
                }
            }


            global $wpvivid_plugin;
            $ret = $wpvivid_plugin->remote_collection->update_remote($_POST['id'], $old_remote);

            if ($ret['result'] == 'success')
            {
                $ret['result'] = WPVIVID_PRO_SUCCESS;
                $remoteslist=WPvivid_Setting::get_all_remote_options();
                $table=new WPvivid_Storage_List();
                $table->set_storage_list($remoteslist);
                $table->prepare_items();
                ob_start();
                $table->display();
                $html = ob_get_clean();
                $ret['html'] = $html;
            }
            else{
                $ret['notice'] = apply_filters('wpvivid_add_remote_notice', false, $ret['error']);
            }
            echo json_encode($ret);
        }
        catch (Exception $error)
        {
            $message = 'An exception has occurred. class: '.get_class($error).';msg: '.$error->getMessage().';code: '.$error->getCode().';line: '.$error->getLine().';in_file: '.$error->getFile().';';
            error_log($message);
            echo json_encode(array('result'=>'failed','error'=>$message));
        }
        die();
    }

    public function delete_remote(){
        global $wpvivid_backup_pro;
        $wpvivid_backup_pro->ajax_check_security('wpvivid-can-mange-remote');
        try
        {
            if (empty($_POST) || !isset($_POST['remote_id']) || !is_string($_POST['remote_id']))
            {
                die();
            }
            $id = sanitize_key($_POST['remote_id']);
            if (WPvivid_Setting::delete_remote_option($id))
            {
                $remote_selected = WPvivid_Setting::get_user_history('remote_selected');

                if (($key = array_search($id, $remote_selected)) !== false)
                {
                    unset($remote_selected[$key]);
                    WPvivid_Setting::update_user_history('remote_selected',$remote_selected);
                }

                $ret['result'] = 'success';

                $remoteslist=WPvivid_Setting::get_all_remote_options();
                $table=new WPvivid_Storage_List();
                $table->set_storage_list($remoteslist);
                $table->prepare_items();
                ob_start();
                $table->display();
                $html = ob_get_clean();
                $ret['html'] = $html;
            } else {
                $ret['result'] = 'failed';
                $ret['error'] = __('Fail to delete the remote storage, can not retrieve the storage infomation. Please try again.', 'wpvivid');
            }
            echo json_encode($ret);
        }
        catch (Exception $error)
        {
            $message = 'An exception has occurred. class: '.get_class($error).';msg: '.$error->getMessage().';code: '.$error->getCode().';line: '.$error->getLine().';in_file: '.$error->getFile().';';
            error_log($message);
            echo json_encode(array('result'=>'failed','error'=>$message));
        }
        die();
    }

    public function set_default_remote_storage_ex(){
        global $wpvivid_backup_pro;
        $wpvivid_backup_pro->ajax_check_security('wpvivid-can-mange-remote');
        try {
            if (!isset($_POST['remote_storage']) || empty($_POST['remote_storage']) || !is_array($_POST['remote_storage'])) {
                $ret['result'] = WPVIVID_PRO_FAILED;
                $ret['error'] = __('Choose one storage from the list to be the default storage.', 'wpvivid');
                echo json_encode($ret);
                die();
            }
            $remote_storage = $_POST['remote_storage'];
            WPvivid_Setting::update_user_history('remote_selected', $remote_storage);
            $ret['result'] = 'success';
            $remoteslist=WPvivid_Setting::get_all_remote_options();
            $table=new WPvivid_Storage_List();
            $table->set_storage_list($remoteslist);
            $table->prepare_items();
            ob_start();
            $table->display();
            $html = ob_get_clean();
            $ret['html'] = $html;
            echo json_encode($ret);
        }
        catch (Exception $error) {
            $message = 'An exception has occurred. class: '.get_class($error).';msg: '.$error->getMessage().';code: '.$error->getCode().';line: '.$error->getLine().';in_file: '.$error->getFile().';';
            error_log($message);
            echo json_encode(array('result'=>'failed','error'=>$message));
        }
        die();
    }
    /***** cloud storage ajax end *****/

    /***** cloud storage useful function begin *****/
    public function upload_callback($offset,$current_name,$current_size,$last_time,$last_size){
        $job_data=array();
        $upload_data=array();
        $upload_data['offset']=$offset;
        $upload_data['current_name']=$current_name;
        $upload_data['current_size']=$current_size;
        $upload_data['last_time']=$last_time;
        $upload_data['last_size']=$last_size;
        $upload_data['descript']='Uploading '.$current_name;
        $v =( $offset - $last_size ) / (time() - $last_time);
        $v /= 1000;
        $v=round($v,2);

        global $wpvivid_plugin;
        $wpvivid_plugin->check_cancel_backup($this->task_id);

        $message='Uploading '.$current_name.' Total size: '.size_format($current_size,2).' Uploaded: '.size_format($offset,2).' speed:'.$v.'kb/s';
        $wpvivid_plugin->wpvivid_log->WriteLog($message,'notice');
        $progress=intval(($offset/$current_size)*100);
        WPvivid_taskmanager::update_backup_main_task_progress($this->task_id,'upload',$progress,0);
        WPvivid_taskmanager::update_backup_sub_task_progress($this->task_id,'upload','',WPVIVID_UPLOAD_UNDO,$message, $job_data, $upload_data);
    }
    /***** cloud storage useful function end *****/

    /***** cloud storage filters begin *****/
    public function upload($result,$task_id){
        global $wpvivid_plugin;
        $this->task_id=$task_id;
        $task=new WPvivid_Backup_Task($task_id);
        $files=$task->get_backup_files();

        $remote_options=WPvivid_taskmanager::get_task_options($task_id,'remote_options');
        $last_error='';
        //$error=false;
        $success=false;

        foreach ($remote_options as $key => $remote_option)
        {
            if(!isset($remote_option['id']))
            {
                $remote_option['id'] = $key;
            }
            $remote=$wpvivid_plugin->remote_collection->get_remote($remote_option);

            $upload_job=WPvivid_taskmanager::get_backup_sub_task_progress($task_id,'upload',$remote_option['id']);
            if(!empty($upload_job))
            {
                if($upload_job['finished']==WPVIVID_UPLOAD_SUCCESS||$upload_job['finished']==WPVIVID_UPLOAD_FAILED)
                {
                    $wpvivid_plugin->wpvivid_log->WriteLog($remote_option['type'].' already finished so skip it.','notice');
                    continue;
                }
            }
            try
            {
                $result=$remote->upload($task_id,$files,array($this,'upload_callback'));
                if($result['result']==WPVIVID_PRO_SUCCESS)
                {
                    $success=true;
                    WPvivid_taskmanager::update_backup_task_status($task_id,false,'running',false,0);
                    $wpvivid_plugin->wpvivid_log->WriteLog('Finish upload to '.$remote_option['type'],'notice');
                    WPvivid_taskmanager::update_backup_sub_task_progress($task_id,'upload',$remote_option['id'],WPVIVID_UPLOAD_SUCCESS,'Finish upload to'.$remote_option['type']);
                    continue;
                }
                else
                {
                    $wpvivid_plugin->wpvivid_log->WriteLog('Finish upload to '.$remote_option['type'].' error:'.$result['error'],'notice');
                    WPvivid_taskmanager::update_backup_sub_task_progress($task_id,'upload',$remote_option['id'],WPVIVID_UPLOAD_FAILED,'Finish upload to'.$remote_option['type']);
                    $remote ->cleanup($files);
                    //$error=true;
                    $last_error=$result['error'];
                    continue;

                }
            }
            catch (Exception $e)
            {
                //catch error and stop task recording history
                $wpvivid_plugin->wpvivid_log->WriteLog('Finish upload to '.$remote_option['type'].' error:'.$e->getMessage(),'notice');
                WPvivid_taskmanager::update_backup_sub_task_progress($task_id,'upload',$remote_option['id'],WPVIVID_UPLOAD_FAILED,'Finish upload to'.$remote_option['type']);
                $last_error=$e->getMessage();
                continue;
            }
        }

        if(!$success)
        {
            WPvivid_taskmanager::update_backup_task_status($this->task_id,false,'error',false,false,$last_error);
            return array('result' => WPVIVID_PRO_FAILED , 'error' => $last_error);
        }
        else
        {
            WPvivid_taskmanager::update_backup_main_task_progress($this->task_id,'upload',100,1);
            WPvivid_taskmanager::update_backup_task_status($task_id,false,'completed');
            return array('result' => WPVIVID_PRO_SUCCESS);
        }
    }

    public function set_backup_remote_options($remote_options,$task_id){
        $temp_remote_options=array();
        foreach ($remote_options as $remote_option)
        {
            $upload_job = WPvivid_taskmanager::get_backup_sub_task_progress($task_id, 'upload', $remote_option['id']);
            if (!empty($upload_job))
            {
                if ($upload_job['finished'] == 1)
                {
                    $temp_remote_options[]=$remote_option;
                }
            }
        }
        return $temp_remote_options;
    }

    public function before_add_user_history($remote_ids){
        $id=array_shift($remote_ids);

        $remote_selected = WPvivid_Setting::get_user_history('remote_selected');

        if (($key = array_search($id, $remote_selected)) === false)
        {
            $remote_selected[]=$id;
        }

        return $remote_selected;
    }

    public function encrypt_remote_password($data){
        if(isset($data['is_encrypt']) && $data['is_encrypt'] == 1){
            if($data['type'] === 'ftp' || $data['type'] === 'sftp'){
                $data['password'] = base64_decode($data['password']);
            }
            else if($data['type'] === 'amazons3' || $data['type'] === 's3compat' || $data['type'] === 'wasabi'){
                $data['secret'] = base64_decode($data['secret']);
            }
        }
        return $data;
    }

    public function trim_import_info($json)
    {
        global $wpvivid_backup_pro;
        if(isset($json['data']['wpvivid_upload_setting']) && !empty($json['data']['wpvivid_upload_setting']))
        {
            foreach ($json['data']['wpvivid_upload_setting'] as $key=>$value)
            {
                if($key !== 'remote_selected')
                {
                    if(isset($value['custom_path']))
                    {
                        $json['data']['wpvivid_upload_setting'][$key]['custom_path'] = $wpvivid_backup_pro->func->swtich_domain_to_folder_name(home_url());
                    }
                    else if(isset($value['path']))
                    {
                        $json['data']['wpvivid_upload_setting'][$key]['path'] = $wpvivid_backup_pro->func->swtich_domain_to_folder_name(home_url());
                    }
                }
            }
        }
        return $json;
    }
    /***** cloud storage filters end *****/

    /***** cloud storage actions begin *****/
    public function clean_remote_schedule_event($backup_count=0,$db_count=0)
    {
        $remoteslist=WPvivid_Setting::get_all_remote_options();
        foreach ($remoteslist as $key=>$remote_option)
        {
            if($key=='remote_selected')
            {
                continue;
            }
            set_time_limit(300);
            global $wpvivid_plugin;
            $remote = $wpvivid_plugin->remote_collection->get_remote($remote_option);
            try
            {
                if (method_exists($remote, 'delete_old_backup_ex'))
                {
                    $backup_count=$this->get_backup_retain_count('Common',$remote_option);
                    $db_count=$this->get_backup_db_retain_count('Common',$remote_option);
                    $remote->delete_old_backup_ex('Manual',$backup_count,$db_count);

                    $backup_count=$this->get_backup_retain_count('Rollback',$remote_option);
                    $db_count=$this->get_backup_db_retain_count('Rollback',$remote_option);
                    $remote->delete_old_backup_ex('Rollback',$backup_count,$db_count);

                    $backup_count=$this->get_backup_retain_count('Incremental',$remote_option);
                    $db_count=$this->get_backup_db_retain_count('Incremental',$remote_option);
                    $remote->delete_old_backup_ex('Incremental',$backup_count,$db_count);
                }
                else if(method_exists($remote, 'delete_old_backup'))
                {
                    $option=WPvivid_Setting::get_option('wpvivid_common_setting');
                    if(isset($remote_option['backup_retain']))
                        $backup_count = $remote_option['backup_retain'];
                    else if (isset($option['max_remote_backup_count']))
                        $backup_count = $option['max_remote_backup_count'];
                    else
                        $backup_count = WPVIVID_DEFAULT_REMOTE_BACKUP_COUNT;

                    if(isset($remote_option['backup_db_retain']))
                        $db_count = $remote_option['backup_db_retain'];
                    else if(isset($option['max_remote_backup_db_count']))
                        $db_count = $option['max_remote_backup_db_count'];
                    else
                        $db_count = 30;

                    $backup_count = intval($backup_count);
                    $db_count = intval($db_count);
                    $remote->delete_old_backup($backup_count,$db_count);
                }
            }
            catch (Exception $e)
            {
                continue;
            }

        }
        die();
    }

    public function check_need_clean_remote_backup()
    {
        $remoteslist = WPvivid_Setting::get_remote_options();
        foreach ($remoteslist as $key => $remote_option)
        {
            if ($key == 'remote_selected')
            {
                continue;
            }

            global $wpvivid_plugin;
            $remote = $wpvivid_plugin->remote_collection->get_remote($remote_option);
            set_time_limit(300);
            try
            {
                if (method_exists($remote, 'check_old_backups_ex'))
                {
                    $backup_count=$this->get_backup_retain_count('Common',$remote_option,true);
                    $db_count=$this->get_backup_db_retain_count('Common',$remote_option,true);

                    if ($remote->check_old_backups_ex('Common',$backup_count,$db_count))
                    {
                        wp_schedule_single_event(time() + 300, 'wpvivid_clean_remote_schedule_single_event');
                        break;
                    }

                    $backup_count=$this->get_backup_retain_count('Rollback',$remote_option,true);
                    $db_count=$this->get_backup_db_retain_count('Rollback',$remote_option,true);

                    if ($remote->check_old_backups_ex('Rollback',$backup_count,$db_count))
                    {
                        wp_schedule_single_event(time() + 300, 'wpvivid_clean_remote_schedule_single_event');
                        break;
                    }

                    $backup_count=$this->get_backup_retain_count('Incremental',$remote_option,true);
                    $db_count=$this->get_backup_db_retain_count('Incremental',$remote_option,true);

                    if ($remote->check_old_backups_ex('Incremental',$backup_count,$db_count))
                    {
                        wp_schedule_single_event(time() + 300, 'wpvivid_clean_remote_schedule_single_event');
                        break;
                    }
                }
                else if (method_exists($remote, 'check_old_backups'))
                {
                    $option = WPvivid_Setting::get_option('wpvivid_common_setting');
                    if (isset($option['max_remote_backup_count']))
                        $backup_count = $option['max_remote_backup_count'];
                    else
                        $backup_count = WPVIVID_DEFAULT_REMOTE_BACKUP_COUNT;

                    if($backup_count==0)
                    {
                        $backup_count = WPVIVID_DEFAULT_REMOTE_BACKUP_COUNT;
                    }

                    if(isset($option['max_remote_backup_db_count']))
                        $db_count = $option['max_remote_backup_db_count'];
                    else
                        $db_count = 30;

                    if ($backup_count - 1 > 0)
                    {
                        $backup_count = $backup_count - 1;
                    }

                    if ($db_count - 1 > 0)
                    {
                        $db_count = $db_count - 1;
                    }

                    if ($remote->check_old_backups($backup_count,$db_count))
                    {
                        wp_schedule_single_event(time() + 300, 'wpvivid_clean_remote_schedule_single_event');
                        break;
                    }

                    if ($remote->check_old_backups($backup_count,$db_count,'Rollback'))
                    {
                        wp_schedule_single_event(time() + 300, 'wpvivid_clean_remote_schedule_single_event');
                        break;
                    }
                }
            } catch (Exception $e)
            {
                continue;
            }
        }
    }

    public function check_remote_backups($backup_options)
    {
        if(isset($backup_options['remote'])&&$backup_options['remote']==1)
        {
            $general_setting=WPvivid_Setting::get_setting(true, "");
            if(isset($general_setting['options']['wpvivid_common_setting']['clean_old_remote_before_backup']))
            {
                if($general_setting['options']['wpvivid_common_setting']['clean_old_remote_before_backup'])
                {
                    $clean_old_remote_before_backup = true;
                }
                else{
                    $clean_old_remote_before_backup = false;
                }
            }
            else{
                $clean_old_remote_before_backup = true;
            }
            if($clean_old_remote_before_backup)
            {
                wp_schedule_single_event(time() + 60, 'wpvivid_check_need_clean_remote_backup');
            }
        }
    }

    public function remote_storage_backup_retention($type, $action)
    {
        if($action == 'add')
        {
            $option = $type;
        }
        else if($action == 'edit')
        {
            $option = 'edit-'.$type;
        }
        else
        {
            $option = $type;
        }
        $checkbox_classname = $type;
        $tr_classname = 'wpvivid-retention-tr-'.$type;
        ?>
        <tr>
            <td colspan=2>
                <label><input class="<?php _e($checkbox_classname); ?>" type="checkbox" option="<?php _e($option); ?>" name="use_remote_retention" onclick="wpvivid_check_special_retention(this);">Enable a special rule of backup retention for the storage
            </td>
        </tr>

        <tr class="<?php _e($tr_classname); ?>" style="display: none;">
            <td class="plugin-title column-primary">
                <div class="wpvivid-storage-form">
                    <input type="text" class="regular-text wpvivid-remote-backup-retain" autocomplete="off" option="<?php _e($option); ?>" name="backup_retain" value="30" />
                </div>
            </td>
            <td class="column-description desc">
                <div class="wpvivid-storage-form-desc">
                    <i>(Manual Backup + General Schedule) File Backups retained.</i>
                </div>
            </td>
        </tr>

        <tr class="<?php _e($tr_classname); ?>" style="display: none;">
            <td class="plugin-title column-primary">
                <div class="wpvivid-storage-form">
                    <input type="text" class="regular-text wpvivid-remote-backup-db-retain" autocomplete="off" option="<?php _e($option); ?>" name="backup_db_retain" value="30" />
                </div>
            </td>
            <td class="column-description desc">
                <div class="wpvivid-storage-form-desc">
                    <i>(Manual Backup + General Schedule) Database Backups retained.</i>
                </div>
            </td>
        </tr>

        <tr class="<?php _e($tr_classname); ?>" style="display: none;">
            <td class="plugin-title column-primary">
                <div class="wpvivid-storage-form">
                    <input type="text" class="regular-text wpvivid-remote-backup-incremental-retain" autocomplete="off" option="<?php _e($option); ?>" name="backup_incremental_retain" value="3" />
                </div>
            </td>
            <td class="column-description desc">
                <div class="wpvivid-storage-form-desc">
                    <i>(Incremental Backups) Cycles of incremental backups retained.</i>
                </div>
            </td>
        </tr>

        <tr class="<?php _e($tr_classname); ?>" style="display: none;">
            <td class="plugin-title column-primary">
                <div class="wpvivid-storage-form">
                    <input type="text" class="regular-text wpvivid-remote-backup-rollback-retain" autocomplete="off" option="<?php _e($option); ?>" name="backup_rollback_retain" value="30" />
                </div>
            </td>
            <td class="column-description desc">
                <div class="wpvivid-storage-form-desc">
                    <i>(Rollback) Rollback Backups retained.</i>
                </div>
            </td>
        </tr>

        <script>
            function wpvivid_check_special_retention(obj)
            {
                var class_name = jQuery(obj).attr('class');
                if(jQuery(obj).prop('checked'))
                {
                    jQuery('.wpvivid-retention-tr-'+class_name).show();
                }
                else
                {
                    jQuery('.wpvivid-retention-tr-'+class_name).hide();
                }
            }
        </script>
        <?php
    }

    public function get_backup_retain_count($type,$remote_option,$check=false)
    {
        $option=get_option('wpvivid_common_setting');

        if($type=='Common')
        {
            if(isset($remote_option['use_remote_retention']) && $remote_option['use_remote_retention'] == '1')
            {
                if(isset($remote_option['backup_retain']))
                {
                    $backup_count = $remote_option['backup_retain'];
                }
                else
                {
                    $backup_count = 30;
                }
            }
            else if(isset($option['max_remote_backup_count']))
            {
                $backup_count = $option['max_remote_backup_count'];
            }
            else
            {
                $backup_count = 30;
            }
            if($backup_count==0)
            {
                $backup_count = WPVIVID_DEFAULT_REMOTE_BACKUP_COUNT;
            }
        }
        else if($type=='Rollback')
        {
            if(isset($remote_option['use_remote_retention']) && $remote_option['use_remote_retention'] == '1')
            {
                if(isset($remote_option['backup_rollback_retain']))
                {
                    $backup_count = $remote_option['backup_rollback_retain'];
                }
                else
                {
                    $backup_count = 30;
                }
            }
            else if(isset($option['rollback_max_remote_backup_count']))
            {
                $backup_count = $option['rollback_max_remote_backup_count'];
            }
            else
            {
                $backup_count = 30;
            }
            if($backup_count==0)
            {
                $backup_count = WPVIVID_DEFAULT_REMOTE_BACKUP_COUNT;
            }
        }
        else if($type=='Incremental')
        {
            $incremental_remote_backup_count = WPvivid_Setting::get_option('wpvivid_incremental_remote_backup_count_addon', 3);

            if(isset($remote_option['use_remote_retention']) && $remote_option['use_remote_retention'] == '1')
            {
                if(isset($remote_option['backup_incremental_retain']))
                {
                    $backup_count = $remote_option['backup_incremental_retain'];
                }
                else
                {
                    $backup_count = $incremental_remote_backup_count;
                }
            }
            else if(isset($option['incremental_max_remote_backup_count']))
            {
                $backup_count = $option['incremental_max_remote_backup_count'];
            }
            else
            {
                $backup_count = $incremental_remote_backup_count;
            }
        }
        else
        {
            $backup_count=0;
        }

        if($check)
        {
            if ($backup_count - 1 > 0)
            {
                $backup_count = $backup_count - 1;
            }
        }

        return $backup_count;
    }

    public function get_backup_db_retain_count($type,$remote_option,$check=false)
    {
        $option=get_option('wpvivid_common_setting');

        if($type=='Common')
        {
            if(isset($remote_option['use_remote_retention']) && $remote_option['use_remote_retention'] == '1')
            {
                if(isset($remote_option['backup_db_retain']))
                {
                    $db_count = $remote_option['backup_db_retain'];
                }
                else
                {
                    $db_count = 30;
                }
            }
            else if(isset($option['max_remote_backup_db_count']))
            {
                $db_count = $option['max_remote_backup_db_count'];
            }
            else
            {
                $db_count = 30;
            }
            if($db_count==0)
            {
                $db_count = WPVIVID_DEFAULT_REMOTE_BACKUP_COUNT;
            }
        }
        else if($type=='Rollback')
        {
            $db_count=0;
        }
        else if($type=='Incremental')
        {
            $db_count=0;
        }
        else
        {
            $db_count=0;
        }

        if($check)
        {
            if ($db_count - 1 > 0)
            {
                $db_count = $db_count - 1;
            }
        }

        return $db_count;
    }
    /***** cloud storage actions end *****/

    public function init_page()
    {
        $remoteslist=WPvivid_Setting::get_all_remote_options();
        $has_remote = false;
        foreach ($remoteslist as $key => $value){
            if($key === 'remote_selected'){
                continue;
            }
            if(in_array($key, $remoteslist['remote_selected'])){
                $has_remote = true;
            }
        }
        ?>
        <div class="wrap wpvivid-canvas">
            <div id="icon-options-general" class="icon32"></div>
            <h1><?php esc_attr_e( apply_filters('wpvivid_white_label_display', 'WPvivid').' Plugins - Cloud Storage', 'wpvivid' ); ?></h1>
            <div id="wpvivid_remote_notice">
                <?php
                $notice='';
                if(isset($_REQUEST['edit_remote']))
                {
                    $success_msg = 'You have successfully updated the account information of your remote storage.';
                    $notice = apply_filters('wpvivid_add_remote_notice', true, $success_msg);
                }
                if(isset($_REQUEST['delete_remote']))
                {
                    $success_msg = 'You have successfully remove your remote storage.';
                    $notice = apply_filters('wpvivid_add_remote_notice', true, $success_msg);
                }

                if(isset($_REQUEST['add_remote']))
                {
                    $success_msg = 'You have successfully added a remote storage.';
                    $notice = apply_filters('wpvivid_add_remote_notice', true, $success_msg);
                }
                if(isset($_REQUEST['change_default']))
                {
                    $success_msg = 'You have successfully changed your default remote storage.';
                    $notice = apply_filters('wpvivid_add_remote_notice', true, $success_msg);
                }

                if(!empty($notice))
                {
                    echo $notice;
                }
                ?>
            </div>
            <div id="poststuff">
                <div id="post-body" class="metabox-holder columns-2">
                    <!-- main content -->
                    <div id="post-body-content">
                        <div class="meta-box-sortables ui-sortable">
                            <div class="wpvivid-backup">
                                <div class="wpvivid-welcome-bar wpvivid-clear-float">
                                    <div class="wpvivid-welcome-bar-left">
                                        <p><span class="dashicons dashicons-admin-site-alt3 wpvivid-dashicons-large wpvivid-dashicons-green"></span><span class="wpvivid-page-title">Cloud Storage</span></p>
                                        <p><span class="about-description">Connect to your cloud storage accounts and set a custom backup folder in each remote storage.</span></p>
                                    </div>
                                    <div class="wpvivid-welcome-bar-right">
                                        <p></p>
                                        <div style="float:right;">
                                            <span>Local Time:</span>
                                            <span>
                                                <a href="<?php esc_attr_e(apply_filters('wpvivid_get_admin_url', '').'options-general.php'); ?>">
                                                    <?php
                                                    $offset=get_option('gmt_offset');
                                                    echo date("l, F-d-Y H:i",time()+$offset*60*60);
                                                    ?>
                                                </a>
                                            </span>
                                            <span class="dashicons dashicons-editor-help wpvivid-dashicons-editor-help wpvivid-tooltip">
                                                <div class="wpvivid-left">
                                                    <!-- The content you need -->
                                                    <p>Clicking the date and time will redirect you to the WordPress General Settings page where you can change your timezone settings.</p>
                                                    <i></i> <!-- do not delete this line -->
                                                </div>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="wpvivid-nav-bar wpvivid-clear-float">
                                        <span class="dashicons dashicons-lightbulb wpvivid-dashicons-orange"></span>
                                        <span>Please read this <a target="_blank" href="https://wpvivid.com/privacy-policy">privacy policy</a> for use of our storage authorization app (none of your backup data is sent to us).</span>
                                    </div>
                                </div>

                                <div class="wpvivid-canvas wpvivid-clear-float wpvivid-remote-storage-tab">
                                    <?php
                                    if(!class_exists('WPvivid_Tab_Page_Container_Ex'))
                                        include_once WPVIVID_BACKUP_PRO_PLUGIN_DIR . 'includes/class-wpvivid-tab-page-container-ex.php';
                                    $this->main_tab=new WPvivid_Tab_Page_Container_Ex();

                                    $args['span_class']='googledrive';
                                    $args['span_style']='';
                                    $args['div_style']='display:block;';
                                    $args['is_parent_tab']=0;
                                    $tabs['cloud_storage_google_drive']['title']='Google Drive';
                                    $tabs['cloud_storage_google_drive']['slug']='cloud_storage_google_drive';
                                    $tabs['cloud_storage_google_drive']['callback']=array($this, 'output_cloud_storage_google_drive');
                                    $tabs['cloud_storage_google_drive']['args']=$args;

                                    $args['span_class']='dropbox';
                                    $args['div_style']='';
                                    $tabs['cloud_storage_dropbox']['title']='Dropbox';
                                    $tabs['cloud_storage_dropbox']['slug']='cloud_storage_dropbox';
                                    $tabs['cloud_storage_dropbox']['callback']=array($this, 'output_cloud_storage_dropbox');
                                    $tabs['cloud_storage_dropbox']['args']=$args;

                                    $args['span_class']='pcloud';
                                    $tabs['cloud_storage_pcloud']['title']='pCloud';
                                    $tabs['cloud_storage_pcloud']['slug']='cloud_storage_pcloud';
                                    $tabs['cloud_storage_pcloud']['callback']=array($this, 'output_cloud_storage_pcloud');
                                    $tabs['cloud_storage_pcloud']['args']=$args;

                                    $args['span_class']='one_drive';
                                    $tabs['cloud_storage_onedrive']['title']='Microsoft OneDrive';
                                    $tabs['cloud_storage_onedrive']['slug']='cloud_storage_onedrive';
                                    $tabs['cloud_storage_onedrive']['callback']=array($this, 'output_cloud_storage_onedrive');
                                    $tabs['cloud_storage_onedrive']['args']=$args;

                                    $args['span_class']='amazons3';
                                    $tabs['cloud_storage_amazons3']['title']='Amazon S3';
                                    $tabs['cloud_storage_amazons3']['slug']='cloud_storage_amazons3';
                                    $tabs['cloud_storage_amazons3']['callback']=array($this, 'output_cloud_storage_amazons3');
                                    $tabs['cloud_storage_amazons3']['args']=$args;

                                    $args['span_class']='s3compat';
                                    $tabs['cloud_storage_digitalocean']['title']='S3 Compatible Storage';
                                    $tabs['cloud_storage_digitalocean']['slug']='cloud_storage_digitalocean';
                                    $tabs['cloud_storage_digitalocean']['callback']=array($this, 'output_cloud_storage_digitalocean');
                                    $tabs['cloud_storage_digitalocean']['args']=$args;

                                    $args['span_class']='ftp';
                                    $tabs['cloud_storage_ftp']['title']='FTP';
                                    $tabs['cloud_storage_ftp']['slug']='cloud_storage_ftp';
                                    $tabs['cloud_storage_ftp']['callback']=array($this, 'output_cloud_storage_ftp');
                                    $tabs['cloud_storage_ftp']['args']=$args;

                                    $args['span_class']='sftp';
                                    $tabs['cloud_storage_sftp']['title']='SFTP';
                                    $tabs['cloud_storage_sftp']['slug']='cloud_storage_sftp';
                                    $tabs['cloud_storage_sftp']['callback']=array($this, 'output_cloud_storage_sftp');
                                    $tabs['cloud_storage_sftp']['args']=$args;

                                    $args['span_class']='wasabi';
                                    $tabs['cloud_storage_wasabi']['title']='Wasabi';
                                    $tabs['cloud_storage_wasabi']['slug']='cloud_storage_wasabi';
                                    $tabs['cloud_storage_wasabi']['callback']=array($this, 'output_cloud_storage_wasabi');
                                    $tabs['cloud_storage_wasabi']['args']=$args;

                                    $args['span_class']='b2';
                                    $tabs['cloud_storage_b2']['title']='Backblaze Storage';
                                    $tabs['cloud_storage_b2']['slug']='cloud_storage_b2';
                                    $tabs['cloud_storage_b2']['callback']=array($this, 'output_cloud_storage_b2');
                                    $tabs['cloud_storage_b2']['args']=$args;

                                    foreach ($tabs as $key=>$tab)
                                    {
                                        $this->main_tab->add_tab($tab['title'],$tab['slug'],$tab['callback'], $tab['args']);
                                    }

                                    $this->main_tab->display();
                                    ?>

                                    <?php
                                    if(!class_exists('WPvivid_Tab_Page_Container_Ex'))
                                        include_once WPVIVID_BACKUP_PRO_PLUGIN_DIR . 'includes/class-wpvivid-tab-page-container-ex.php';
                                    $this->storage_tab=new WPvivid_Tab_Page_Container_Ex();

                                    $args['span_class']='';
                                    $args['span_style']='';
                                    $args['div_style']='display:block;';
                                    $args['is_parent_tab']=0;
                                    $storage_tabs['storages']['title']='Storages';
                                    $storage_tabs['storages']['slug']='storages';
                                    $storage_tabs['storages']['callback']=array($this, 'output_storages_list');
                                    $storage_tabs['storages']['args']=$args;

                                    $args['div_style']='';
                                    $args['is_parent_tab']=0;
                                    $args['can_delete']=1;
                                    $args['hide']=1;
                                    $storage_tabs['storage_edit']['title']='Storage Edit';
                                    $storage_tabs['storage_edit']['slug']='storage_edit';
                                    $storage_tabs['storage_edit']['callback']=array($this, 'output_storage_edit');
                                    $storage_tabs['storage_edit']['args']=$args;

                                    foreach ($storage_tabs as $key=>$tab)
                                    {
                                        $this->storage_tab->add_tab($tab['title'],$tab['slug'],$tab['callback'], $tab['args']);
                                    }

                                    $this->storage_tab->display();
                                    ?>
                                </div>

                            </div>
                        </div>
                    </div>

                    <!-- sidebar -->
                    <?php
                    do_action( 'wpvivid_backup_pro_add_sidebar' );
                    ?>

                </div>
            </div>
        </div>
        <script>
            jQuery('input[option=add-remote]').click(function() {
                var storage_type = jQuery(".wpvivid-nav-tab-active").find('span:eq(0)').attr('class');
                wpvivid_add_remote_storage(storage_type);
            });

            jQuery('input[option=edit-remote]').click(function(){
                wpvivid_edit_remote_storage();
            });

            jQuery('#wpvivid_set_default_remote_storage').click(function(){
                wpvivid_set_default_remote_storage();
            });

            function wpvivid_add_remote_storage(storage_type){
                var remote_from = wpvivid_ajax_data_transfer(storage_type);
                var ajax_data = {
                    'action': 'wpvivid_add_remote',
                    'remote': remote_from,
                    'type': storage_type
                };
                jQuery('input[option=add-remote]').css({'pointer-events': 'none', 'opacity': '0.4'});
                jQuery('#wpvivid_remote_notice').html('');
                wpvivid_post_request_addon(ajax_data, function (data)
                {
                    try
                    {
                        var jsonarray = jQuery.parseJSON(data);
                        if (jsonarray.result === 'success')
                        {
                            wpvivid_settings_changed = false;
                            location.href='<?php echo apply_filters('wpvivid_white_label_page_redirect', 'admin.php?page=wpvivid-remote', 'wpvivid-remote').'&tabs=remote_storage&add_remote'; ?>';
                        }
                        else if (jsonarray.result === 'failed')
                        {
                            jQuery('#wpvivid_remote_notice').html(jsonarray.notice);
                            jQuery('input[option=add-remote]').css({'pointer-events': 'auto', 'opacity': '1'});
                        }
                    }
                    catch (err)
                    {
                        alert(err);
                        jQuery('input[option=add-remote]').css({'pointer-events': 'auto', 'opacity': '1'});
                    }

                }, function (XMLHttpRequest, textStatus, errorThrown)
                {
                    var error_message = wpvivid_output_ajaxerror('adding the remote storage', textStatus, errorThrown);
                    alert(error_message);
                    jQuery('input[option=add-remote]').css({'pointer-events': 'auto', 'opacity': '1'});
                });
            }

            function wpvivid_set_default_remote_storage(){
                var remote_storage = new Array();
                jQuery.each(jQuery("input[name='remote_storage']:checked"), function()
                {
                    remote_storage.push(jQuery(this).val());
                });

                var ajax_data = {
                    'action': 'wpvivid_set_default_remote_storage_ex',
                    'remote_storage': remote_storage
                };
                jQuery('#wpvivid_remote_notice').html('');
                wpvivid_post_request_addon(ajax_data, function(data){
                    try
                    {
                        var jsonarray = jQuery.parseJSON(data);
                        if (jsonarray.result === 'success')
                        {
                            wpvivid_settings_changed = false;
                            location.href='<?php echo apply_filters('wpvivid_white_label_page_redirect', 'admin.php?page=wpvivid-remote', 'wpvivid-remote').'&tabs=remote_storage&change_default'; ?>';
                        }
                        else if (jsonarray.result === 'failed')
                        {
                            jQuery('#wpvivid_remote_notice').html(jsonarray.notice);
                        }
                    }
                    catch(err)
                    {
                        alert(err);
                    }
                }, function(XMLHttpRequest, textStatus, errorThrown) {
                    var error_message = wpvivid_output_ajaxerror('setting up the default remote storage', textStatus, errorThrown);
                    alert(error_message);
                });
            }

            function wpvivid_check_has_default_remote(has_remote){
                if(!has_remote)
                {
                    var descript = 'There is no default remote storage configured. Please set it up first.';
                    var ret = confirm(descript);
                    if(ret === true){
                        switch_main_tab('remote_storage');
                    }
                    jQuery('input:radio[option=backup][name=backup_to][value=local]').prop('checked', true);
                    jQuery('input:radio[option=schedule][name=schedule_save_local_remote][value=local]').prop('checked', true);
                    jQuery('input:radio[option=update_schedule_backup][name=update_schedule_backup_save_local_remote][value=local]').prop('checked', true);
                }
            }

            jQuery(document).ready(function($) {
                var has_remote = '<?php echo $has_remote; ?>';
                jQuery(document).on('wpvivid-has-default-remote', function(event)
                {
                    wpvivid_check_has_default_remote(has_remote);
                });
                <?php
                if(isset($_REQUEST['sub_page']))
                {
                    ?>
                    jQuery( document ).trigger( '<?php echo $this->main_tab->container_id ?>-show',[ '<?php echo $_REQUEST['sub_page']; ?>', '<?php echo $_REQUEST['sub_page'];?>' ]);
                    <?php
                }
                ?>
            });
        </script>
        <?php
    }

    public function output_cloud_storage_google_drive()
    {
        ?>
        <div class="wpvivid-one-coloum wpvivid-workflow wpvivid-clear-float">
            <?php
            do_action('wpvivid_add_storage_page_google_drive');
            ?>
        </div>
        <?php
    }

    public function output_cloud_storage_dropbox()
    {
        ?>
        <div class="wpvivid-one-coloum wpvivid-workflow wpvivid-clear-float">
            <?php
            do_action('wpvivid_add_storage_page_dropbox');
            ?>
        </div>
        <?php
    }

    public function output_cloud_storage_pcloud()
    {
        ?>
        <div style="border:1px solid #eee; padding:0 1em; border-radius:0.5em;">
            <p>
                <span>Note: pCloud has not updated their SDK since 2017 (the latest PHP version supported at that time was PHP 7.1), which may cause some compatibility issues, e.g., upload timeout. <a href="https://docs.wpvivid.com/curl-error-28-operation-timed-out-after-10001-30000-milliseconds-with-0-out-of-0-bytes-received-when-backing-up-to-pcloud.html">Read more</a></span>
            <p>
            <div style="clear:both;"></div>
        </div>
        <p></p>
        <div class="wpvivid-one-coloum wpvivid-workflow wpvivid-clear-float">
            <?php
            do_action('wpvivid_add_storage_page_pcloud');
            ?>
        </div>
        <?php
    }

    public function output_cloud_storage_onedrive()
    {
        ?>
        <div class="wpvivid-one-coloum wpvivid-workflow wpvivid-clear-float">
            <?php
            do_action('wpvivid_add_storage_page_onedrive');
            ?>
        </div>
        <?php
    }

    public function output_cloud_storage_amazons3()
    {
        $cloud_amazons3 = new WPvivid_AMAZONS3Class_addon();
        ?>
        <div class="wpvivid-one-coloum wpvivid-workflow wpvivid-clear-float">
            <?php
            $cloud_amazons3->wpvivid_add_storage_page_amazons3();
            ?>
        </div>
        <?php
    }

    public function output_cloud_storage_digitalocean()
    {
        $cloud_digitalocean = new Wpvivid_S3Compat_addon();
        ?>
        <div class="wpvivid-one-coloum wpvivid-workflow wpvivid-clear-float">
            <?php
            $cloud_digitalocean->wpvivid_add_storage_page_s3compat();
            ?>
        </div>
        <?php
    }

    public function output_cloud_storage_ftp()
    {
        $cloud_ftp = new WPvivid_FTPClass_addon();
        ?>
        <div class="wpvivid-one-coloum wpvivid-workflow wpvivid-clear-float">
            <?php
            $cloud_ftp->wpvivid_add_storage_page_ftp();
            ?>
        </div>
        <?php
    }

    public function output_cloud_storage_sftp()
    {
        $cloud_sftp = new WPvivid_SFTPClass_addon();
        ?>
        <div class="wpvivid-one-coloum wpvivid-workflow wpvivid-clear-float">
            <?php
            $cloud_sftp->wpvivid_add_storage_page_sftp();
            ?>
        </div>
        <?php
    }

    public function output_cloud_storage_wasabi()
    {
        $cloud_wasabi = new Wpvivid_WasabiS3_addon();
        ?>
        <div class="wpvivid-one-coloum wpvivid-workflow wpvivid-clear-float">
            <?php
            $cloud_wasabi->wpvivid_add_storage_page_wasabi();
            ?>
        </div>
        <?php
    }

    public function output_cloud_storage_b2()
    {
        $b2=new WPvivid_B2_addon();
        ?>
        <div class="wpvivid-one-coloum wpvivid-workflow wpvivid-clear-float">
            <?php
            $b2->add_storage_page_b2();
            ?>
        </div>
        <?php
    }

    public function output_storages_list()
    {
        ?>
        <div style="margin-top:10px;">
            <p>
                <strong>
                    <?php _e('Please choose one storage to save your backups (remote storage)', 'wpvivid');?>
                </strong>
            </p>
        </div>
        <div id="wpvivid_remote_storage_list" style="padding-bottom: 1em;">
            <?php
            $remoteslist=WPvivid_Setting::get_all_remote_options();
            $table=new WPvivid_Storage_List();
            $table->set_storage_list($remoteslist);
            $table->prepare_items();
            $table->display();
            ?>
        </div>

        <div>
            <input class="button-primary" id="wpvivid_set_default_remote_storage" type="submit" name="choose-remote-storage" value="<?php echo esc_attr__( 'Save Changes', 'wpvivid' )?>"/>
        </div>

        <script>
            jQuery('#wpvivid_remote_storage_list').on("click",'.first-page',function() {
                wpvivid_get_remote_storage_list('first');
            });

            jQuery('#wpvivid_remote_storage_list').on("click",'.prev-page',function() {
                var page=parseInt(jQuery(this).attr('value'));
                wpvivid_get_remote_storage_list(page-1);
            });

            jQuery('#wpvivid_remote_storage_list').on("click",'.next-page',function() {
                var page=parseInt(jQuery(this).attr('value'));
                wpvivid_get_remote_storage_list(page+1);
            });

            jQuery('#wpvivid_remote_storage_list').on("click",'.last-page',function() {
                wpvivid_get_remote_storage_list('last');
            });

            jQuery('#wpvivid_remote_storage_list').on("keypress", '.current-page', function(){
                if(event.keyCode === 13){
                    var page = jQuery(this).val();
                    wpvivid_get_remote_storage_list(page);
                }
            });

            function wpvivid_get_remote_storage_list(page=0){
                if(page==0)
                {
                    page =jQuery('#wpvivid_remote_storage_list').find('.current-page').val();
                }

                var ajax_data = {
                    'action': 'wpvivid_get_remote_storage_list',
                    'page':page
                };
                wpvivid_post_request_addon(ajax_data, function (data)
                {
                    jQuery('#wpvivid_remote_storage_list').html('');
                    try
                    {
                        var jsonarray = jQuery.parseJSON(data);
                        if (jsonarray.result === 'success')
                        {
                            jQuery('#wpvivid_remote_storage_list').html(jsonarray.html);
                        }
                        else
                        {
                            alert(jsonarray.error);
                        }
                    }
                    catch (err)
                    {
                        alert(err);
                    }
                }, function (XMLHttpRequest, textStatus, errorThrown)
                {
                    var error_message = wpvivid_output_ajaxerror('achieving remote storage list', textStatus, errorThrown);
                    alert(error_message);
                });
            }

            function click_retrieve_remote_storage(id, type, name){
                wpvivid_editing_storage_id = id;
                jQuery('.remote-storage-edit').hide();
                jQuery('#wpvivid_tab_storage_edit_text').html(name);
                wpvivid_editing_storage_type=type;
                jQuery('#remote_storage_edit_'+wpvivid_editing_storage_type).fadeIn();
                jQuery( document ).trigger( '<?php echo $this->storage_tab->container_id ?>-show',[ 'storage_edit', 'storages' ]);

                jQuery('#wpvivid_archieve_remote_info').show();
                jQuery('#wpvivid_archieve_remote_info').find('.spinner').addClass('is-active');
                jQuery('#wpvivid_archieve_remote_retry').hide();
                jQuery('#wpvivid_page_storage_edit').find('#remote_storage_edit_'+wpvivid_editing_storage_type).hide();
                var retry = '<input type="button" class="button button-primary" value="Retry the information retrieval" onclick="click_retrieve_remote_storage(\''+id+'\', \''+type+'\', \''+name+'\');" />';
                var ajax_data = {
                    'action': 'wpvivid_retrieve_remote',
                    'remote_id': id
                };
                wpvivid_post_request_addon(ajax_data, function(data)
                {
                    jQuery('#wpvivid_archieve_remote_info').hide();
                    jQuery('#wpvivid_archieve_remote_info').find('.spinner').removeClass('is-active');
                    try
                    {
                        var jsonarray = jQuery.parseJSON(data);
                        if (jsonarray.result === 'success')
                        {
                            jQuery('#wpvivid_page_storage_edit').find('#remote_storage_edit_'+wpvivid_editing_storage_type).show();
                            jQuery('input:text[option=edit-'+jsonarray.type+']').each(function(){
                                var key = jQuery(this).prop('name');
                                if(key === 'chunk_size'){
                                    jsonarray[key] = jsonarray[key] / 1024 / 1024;
                                }
                                jQuery(this).val(jsonarray[key]);
                            });
                            jQuery('input:password[option=edit-'+jsonarray.type+']').each(function(){
                                var key = jQuery(this).prop('name');
                                jQuery(this).val(jsonarray[key]);
                            });
                            jQuery('input:checkbox[option=edit-'+jsonarray.type+']').each(function() {
                                var key = jQuery(this).prop('name');
                                var value;
                                if(jsonarray[key] == '0'){
                                    value = false;
                                }
                                else{
                                    value = true;
                                }
                                jQuery(this).prop('checked', value);

                                if(key === 'use_remote_retention')
                                {
                                    if(value)
                                    {
                                        jQuery('.wpvivid-retention-tr-'+jsonarray.type).show();
                                    }
                                    else
                                    {
                                        jQuery('.wpvivid-retention-tr-'+jsonarray.type).hide();
                                    }
                                }
                            });
                            if(wpvivid_editing_storage_type === 'wasabi'){
                                if(jsonarray.endpoint === 's3.wasabisys.com'){
                                    jQuery('#wpvivid_wasabi_endpoint_select_edit').val('us_east1');
                                }
                                if(jsonarray.endpoint === 's3.us-east-2.wasabisys.com'){
                                    jQuery('#wpvivid_wasabi_endpoint_select_edit').val('us_east2');
                                }
                                else if(jsonarray.endpoint === 's3.us-west-1.wasabisys.com'){
                                    jQuery('#wpvivid_wasabi_endpoint_select_edit').val('us_west1');
                                }
                                else if(jsonarray.endpoint === 's3.eu-central-1.wasabisys.com'){
                                    jQuery('#wpvivid_wasabi_endpoint_select_edit').val('us_central1');
                                }
                                else{
                                    jQuery('#wpvivid_wasabi_endpoint_select_edit').val('custom');
                                }
                            }
                        }
                        else
                        {
                            jQuery('#wpvivid_archieve_remote_retry').show();
                            jQuery('#wpvivid_archieve_remote_retry').html(retry);
                            alert(jsonarray.error);
                        }
                    }
                    catch(err)
                    {
                        jQuery('#wpvivid_archieve_remote_retry').show();
                        jQuery('#wpvivid_archieve_remote_retry').html(retry);
                        alert(err);
                    }
                },function(XMLHttpRequest, textStatus, errorThrown)
                {
                    jQuery('#wpvivid_archieve_remote_info').hide();
                    jQuery('#wpvivid_archieve_remote_info').find('.spinner').removeClass('is-active');
                    jQuery('#wpvivid_archieve_remote_retry').show();
                    jQuery('#wpvivid_archieve_remote_retry').html(retry);
                    var error_message = wpvivid_output_ajaxerror('retrieving the remote storage', textStatus, errorThrown);
                    alert(error_message);
                });
            }

            function wpvivid_delete_remote_storage(storage_id) {
                var descript = 'Deleting a remote storage will make it unavailable until it is added again. Are you sure to continue?';
                var ret = confirm(descript);
                if(ret === true){
                    var ajax_data = {
                        'action': 'wpvivid_delete_remote_addon',
                        'remote_id': storage_id
                    };
                    wpvivid_post_request_addon(ajax_data, function(data)
                    {
                        wpvivid_settings_changed = false;
                        location.href='<?php echo apply_filters('wpvivid_white_label_page_redirect', 'admin.php?page=wpvivid-remote', 'wpvivid-remote').'&tabs=remote_storage&delete_remote'; ?>';
                    },function(XMLHttpRequest, textStatus, errorThrown)
                    {
                        var error_message = wpvivid_output_ajaxerror('deleting the remote storage', textStatus, errorThrown);
                        alert(error_message);
                    });
                }
            }

            function wpvivid_edit_remote_storage() {
                var data_tran = 'edit-'+wpvivid_editing_storage_type;
                var remote_data = wpvivid_ajax_data_transfer(data_tran);
                var ajax_data = {
                    'action': 'wpvivid_edit_remote_ex',
                    'remote': remote_data,
                    'id': wpvivid_editing_storage_id,
                    'type': wpvivid_editing_storage_type
                };
                jQuery('#wpvivid_remote_notice').html('');
                wpvivid_post_request_addon(ajax_data, function(data)
                {
                    try
                    {
                        var jsonarray = jQuery.parseJSON(data);
                        if (jsonarray.result === 'success')
                        {
                            wpvivid_settings_changed = false;
                            location.href='<?php echo apply_filters('wpvivid_white_label_page_redirect', 'admin.php?page=wpvivid-remote', 'wpvivid-remote').'&tabs=remote_storage&edit_remote'; ?>';
                        }
                        else if (jsonarray.result === 'failed')
                        {
                            jQuery('#wpvivid_remote_notice').html(jsonarray.notice);
                        }
                    }
                    catch(err)
                    {
                        alert(err);
                    }
                },function(XMLHttpRequest, textStatus, errorThrown)
                {
                    var error_message = wpvivid_output_ajaxerror('editing the remote storage', textStatus, errorThrown);
                    alert(error_message);
                });
            }

            jQuery('.wpvivid-remote-backup-retain').on("keyup", function(){
                var regExp = /^[1-9][0-9]{0,2}$/g;
                var input_value = jQuery(this).val();
                if(!regExp.test(input_value)){
                    alert('Only enter numbers from 1-999');
                    jQuery(this).val('');
                }
            });

            jQuery('.wpvivid-remote-backup-db-retain').on("keyup", function(){
                var regExp = /^[1-9][0-9]{0,2}$/g;
                var input_value = jQuery(this).val();
                if(!regExp.test(input_value)){
                    alert('Only enter numbers from 1-999');
                    jQuery(this).val('');
                }
            });
        </script>
        <?php
    }

    public function output_storage_edit()
    {
        ?>
        <div id="wpvivid_archieve_remote_info" style="margin-top: 10px;">
            <div style="float: left; height: 20px; line-height: 20px; margin-top: 4px;">Retrieving the information of remote storage</div>
            <div class="spinner" style="float: left;"></div>
            <div style="clear: both;"></div>
        </div>
        <div id="wpvivid_archieve_remote_retry" style="margin-top: 10px; display: none;"></div>
        <div><?php do_action('wpvivid_edit_remote_page'); ?></div>
        <?php
    }
}