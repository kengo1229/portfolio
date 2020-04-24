<?php
    /*
    ナビメニューのaタグに任意のクラスをつける
    */
    add_filter('walker_nav_menu_start_el', 'add_class_on_link', 10, 4);
     function add_class_on_link($item_output, $item){
     return preg_replace('/(<a.*?)/', '$1' . " class='menu-link js-toggle-sp2-menu'", $item_output);
    }

    register_nav_menu('mainmenu2', 'ナビメニュー ');

    // 投稿ページへ表示するカスタムボックスを定義する
    add_action('admin_menu', 'add_custom_inputbox');
    // 追加した表示項目のデータ更新・保存のためのアクションフック
    add_action('save_post','save_custom_postdata');

    // 入力項目がどの投稿タイプのページに表示されるかの設定
    function add_custom_inputbox() {
      // 第一引数：編集画面のhtmlに挿入されるid属性名
      // 第二引数：管理画面に表示されるカスタムフィールド名
      // 第三引数：メタボックスの中に出力される関数名
      // 第四引数：管理画面に表示されるカスタムフィールドの場所
      // 第五引数：配置される順序
      add_meta_box( 'profile_id', 'プロフィール入力欄', 'custom_area',  'page',  'normal');
      add_meta_box( 'profile_img_id', 'プロフィール画像URL入力欄', 'custom_area2',  'page',  'normal');
    }

    function custom_area(){
      global $post;
      echo '入力内容 :<textarea cols="50" rows="5" name="profile_msg">'.get_post_meta($post->ID,'profile',true).'</textarea><br>';
    }

    function custom_area2(){
      global $post;
      echo '画像 :<input type="text" value="'.get_post_meta($post->ID,'img-profile',true).'" name="profile_img"><br>';
    }


    // 投稿ボタンを押した際のデータ更新と保存
    function save_custom_postdata($post_id){
      $profile_msg = '';
      $profile_img = '';

      // カスタムフィールドに入力された情報を取り出す(プロフィール紹介文)
      if(isset($_POST['profile_msg'])){
        $about_msg = $_POST['profile_msg'];
      }

      // カスタムフィールドに入力された情報を取り出す(プロフィール画像)
      if(isset($_POST['profile_img'])){
        $profile_img = $_POST['profile_img'];
      }

      // 内容が変わっていた場合、保存していた情報を更新する
      if( $about_msg != get_post_meta($post_id, 'profile', true)){
        update_post_meta($post_id, 'profile', $about_msg);
      }elseif($about_msg == ''){
        delete_post_meta($post_id, 'profile', get_post_meta($post_id, 'profile', true));
      }

      if( $profile_img != get_post_meta($post_id, 'img-profile', true)){
        update_post_meta($post_id, 'img-profile', $profile_img);
      }elseif($profile_img == ''){
        delete_post_meta($post_id, 'img-profile', get_post_meta($post_id, 'img-profile', true));
      }
    }


    // カスタムウィジェット
    // WORKSパネルのウィジェットエリアを作成する関数がどれなのかを登録する
    add_action('widgets_init', 'my_widgets_area');
    // WORKSパネルのウィジェットクラスを登録する
    add_action('widgets_init', function(){
      register_widget("my_widgets_item");
    });

    // WORKSパネルのウィジェットエリアを作成する
    function my_widgets_area(){

      // worksパネルのウィジェット
      register_sidebar(array(
        'name' => 'WORKSパネル',
        'id' => 'works_panel',
        'before_widget' => '<div>',
        'after_widget' => '</div>'
      ));
    }

    // WORKSスライダーのウィジェットエリアを作成する関数がどれなのかを登録する
    add_action('widgets_init', 'my_widgets_area2');

    // WORKSスライダーのウィジェットクラスを登録する
    add_action('widgets_init', function(){
      register_widget("my_widgets_item2");
    });

    // WORKSパネルのウィジェットエリアを作成する
    function my_widgets_area2(){

      // worksスライダーのウィジェット
      register_sidebar(array(
        'name' => 'WORKSスライダー',
        'id' => 'works_slider',
        'before_widget' => '<div>',
        'after_widget' => '</div>'
      ));
    }

    // WORKSパネルウィジェット自体を作成する
    class my_widgets_item extends WP_Widget {
      function my_widgets_item(){
        parent::WP_Widget(false, $name = 'WORKSパネル');
      }

      function form($instance) {
        // 入力情報をサニタイズして変数へ格納
        $title = esc_attr($instance['title']);
        $img = esc_attr($instance['img']);
        $body = esc_attr($instance['body']);
?>
    <p>
    <label for="<?php echo $this->get_field_id('title'); ?>">
      <?php echo 'タイトル:'; ?>
    </label>

    <input id="<?php echo $this->get_field_id('title'); ?>" type="text" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $title; ?>">
    </p>

    <p>
    <label for="<?php echo $this->get_field_id('img'); ?>">
      <?php echo '　　画像:'; ?>
    </label>

    <input id="<?php echo $this->get_field_id('img'); ?>" type="text" name="<?php echo $this->get_field_name('img'); ?>" value="<?php echo $img; ?>">
    </p>

    <p>
    <label for="<?php echo $this->get_field_id('body'); ?>">
      <?php echo '使用言語:'; ?>
    </label>

    <input id="<?php echo $this->get_field_id('body'); ?>" type="text" name="<?php echo $this->get_field_name('body'); ?>" value="<?php echo $body; ?>">
    </p>
<?php
    }
    // ウィジェットに入力された情報を保存する処理
    function update($new_instance, $old_instance) {
      $instance = $old_instance;
      $instance['title'] = strip_tags($new_instance['title']);
      $instance['img'] = trim($new_instance['img']);
      $instance['body'] = trim($new_instance['body']);

      return $instance;
    }

    //管理画面から入力されたウィジェットを画面に表示する処理
    function widget($args, $instance){
      // 配列を変数に展開
      extract($args);

      // ウィジェットから入力された情報を習得
      $title = apply_filters('widget_title', $instance['title']); //html,phpタグを取り除く
      $img = apply_filters('widget_img', $instance['img']);
      $body = apply_filters('widget_body', $instance['body']); //先頭と最後部の空白を取り除く

      // ウィジェットから入力された情報がある場合、htmlを表示する
      if ($title){
?>
      <div class="panel panel-hover panel-border js-show-modal js-show-modal-slider">
        <p class="panel-head"><?php echo $title; ?></p>
        <div class="panel-body">
          <img class="panel-img" src="<?php echo $img ?>" alt="<?php echo $title; ?>">
        </div>
        <div class="panel-foot">
          <p><?php echo $body; ?></p>
        </div>
      </div>

<?php

    }
  }
}
    // WORKSスライダーウィジェット自体を作成する
    class my_widgets_item2 extends WP_Widget {
      function my_widgets_item2(){
        parent::WP_Widget(false, $name = 'WORKSスライダー');
      }

      function form($instance) {
        // 入力情報をサニタイズして変数へ格納
        $title = esc_attr($instance['title']);
        $img = esc_attr($instance['img']);
        $body = esc_attr($instance['body']);
        $site_link = esc_attr($instance['site_link']);
        $git_link = esc_attr($instance['git_link']);
?>
    <p>
    <label for="<?php echo $this->get_field_id('title'); ?>">
      <?php echo 'タイトル:'; ?>
    </label>

    <input id="<?php echo $this->get_field_id('title'); ?>" type="text" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $title; ?>">
    </p>

    <p>
    <label for="<?php echo $this->get_field_id('img'); ?>">
      <?php echo '　　画像:'; ?>
    </label>

    <input id="<?php echo $this->get_field_id('img'); ?>" type="text" name="<?php echo $this->get_field_name('img'); ?>" value="<?php echo $img; ?>">
    </p>

    <p>
    <label for="<?php echo $this->get_field_id('body'); ?>">
      <?php echo '　　説明:'; ?>
    </label>

    <textarea rows="16" cols="28" id="<?php echo $this->get_field_id('body'); ?>" name="<?php echo $this->get_field_name('body'); ?>"><?php echo $body; ?></textarea>
    </p>

    <p>
    <label for="<?php echo $this->get_field_id('site_link'); ?>">
      <?php echo 'サイトURL:'; ?>
    </label>

    <input id="<?php echo $this->get_field_id('site_link'); ?>" type="text" name="<?php echo $this->get_field_name('site_link'); ?>" value="<?php echo $site_link; ?>">
    </p>

    <p>
    <label for="<?php echo $this->get_field_id('git_link'); ?>">
      <?php echo 'GitURL:'; ?>
    </label>

    <input id="<?php echo $this->get_field_id('git_link'); ?>" type="text" name="<?php echo $this->get_field_name('git_link'); ?>" value="<?php echo $git_link; ?>">
    </p>

<?php
    }
    // ウィジェットに入力された情報を保存する処理
    function update($new_instance, $old_instance) {
      $instance = $old_instance;
      $instance['title'] = strip_tags($new_instance['title']);
      $instance['img'] = trim($new_instance['img']);
      $instance['body'] = trim($new_instance['body']);
      $instance['site_link'] = ($new_instance['site_link']);
      $instance['git_link'] = ($new_instance['git_link']);

      return $instance;
    }

    //管理画面から入力されたウィジェットを画面に表示する処理
    function widget($args, $instance){
      // 配列を変数に展開
      extract($args);

      // ウィジェットから入力された情報を習得
      $title = apply_filters('widget_title', $instance['title']); //html,phpタグを取り除く
      $img = apply_filters('widget_img', $instance['img']);
      $body = apply_filters('widget_body', $instance['body']); //先頭と最後部の空白を取り除く
      $site_link = apply_filters('widget_site_link', $instance['site_link']); //先頭と最後部の空白を取り除く
      $git_link = apply_filters('widget_git_link', $instance['git_link']); //先頭と最後部の空白を取り除く

      // ウィジェットから入力された情報がある場合、htmlを表示する
      if ($title){
?>
    <li class="slider__item">
      <p><span class="btn-close js-hide-modal"><i class="fas fa-times-circle modal-hide-btn"></i></span></p>
      <div class="modal-head">
        <p><?php echo $title?></p>
      </div>
      <div class="modal-body">
          <img class="modal-img" src="<?php echo $img?>" alt="<?php echo $head?>">
      </div>
      <div class="modal-foot">
        <p><?php echo nl2br($body) ?></p>
        <p>URL:<a href="<?php echo $site_link ?>"  target="_blank"><?php echo $site_link ?></a></p>
        <p>GitHub:<a href="<?php echo $git_link ?>" target="_blank"><?php echo $git_link ?></a></p>
      </div>
    </li>

<?php

    }
  }
}
