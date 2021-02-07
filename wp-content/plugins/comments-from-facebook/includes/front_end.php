<?php 

	/*###################### Facebook comments front-end ##################*/	
	
class wpdevart_comment_front_end{
	private $menu_name;
	
	private $plugin_url;
	
	private $databese_parametrs;
	
	private $params;
	
	public static $id_for_content=0;

	/*###################### Construct parameters function ##################*/		
	
	function __construct($params){
		
		$this->databese_parametrs=$params['databese_parametrs'];
		//If plugin url doesn't come in parent class
		if(isset($params['plugin_url']))
			$this->plugin_url=$params['plugin_url'];
		else
			$this->plugin_url=trailingslashit(dirname(plugins_url('',__FILE__)));
		//Generating js code for footer.php			
		add_action( 'wp_head',array($this,'generete_front_javascript'));
		add_action( 'wp_footer',array($this,'generete_facbook_js_sdk'));
		// Generating content code 
		add_shortcode( 'wpdevart_facebook_comment', array($this,'wpdevart_comment_shortcode') );
		add_action('the_content',array($this,'insert_facebook_comment_in_content'));
		$this->params=$this->generete_params();
		// Updated parameters
		
		
		
	}
	
	/*###################### Database function ##################*/
	
	private function generete_params(){
		
		foreach($this->databese_parametrs as $param_array_key => $param_value){
			foreach($this->databese_parametrs[$param_array_key] as $key => $value){
				$front_end_parametrs[$key]=stripslashes(get_option($key,$value));
			}
		}		
		return $front_end_parametrs;
		
	}
	
	/*###################### Insert comments in content function ##################*/	
	
	public function insert_facebook_comment_in_content($content){
			$jsone_comment_show_in= json_decode(stripslashes($this->params['wpdevart_comments_box_show_in']), true);
			global $post;
			$value = get_post_meta( $post->ID, '_disabel_wpdevart_facebook_comment', true );
			if($value!='disable' && (((is_home() || is_front_page()) && $jsone_comment_show_in['home']==true) || (is_page() && $jsone_comment_show_in['page']==true) || (is_single() && $jsone_comment_show_in['post']==true))) {
				
				$params=array(
					"facebook_app_id"					=> $this->params['wpdevart_comment_facebook_app_id'],
					"curent_url"						=> get_permalink(),		
					"order_type"						=> $this->params['wpdevart_comments_box_order_type'],	
					"title_text"						=> $this->params['wpdevart_comment_title_text'],
					"title_text_color"					=> $this->params['wpdevart_comment_title_text_color'],
					"title_text_font_size"				=> $this->params['wpdevart_comment_title_text_font_size'],
					"title_text_font_famely"			=> $this->params['wpdevart_comment_title_text_font_famely'],
					"title_text_position"				=> $this->params['wpdevart_comment_title_text_position'],
					"width"								=> $this->params['wpdevart_comments_box_width'],
					"count_of_comments"					=> $this->params['wpdevart_comments_box_count_of_comments'],			
					"locale"							=> $this->params['wpdevart_comments_box_locale'],
				);
				$content.=wpdevart_comment_setting::generete_iframe_by_array($params);

			} 
			return  $content;
		
		
	}
	
	/*###################### Scripts and Styles function ##################*/
	
	public function generete_front_javascript(){
			wp_enqueue_script('thickbox');
			wp_enqueue_style('thickbox');
			echo '<meta property="fb:app_id" content="'.$this->params['wpdevart_comment_facebook_app_id'].'"/>';
		
	}
	
	/*###################### Shortcode function ##################*/	
	
	public function wpdevart_comment_shortcode($atts){
		$atts = shortcode_atts( array(
			"facebook_app_id"					=> $this->params['wpdevart_comment_facebook_app_id'],
			"curent_url"						=> get_permalink(),	
			"order_type"						=> $this->params['wpdevart_comments_box_order_type'],		
			"title_text"						=> $this->params['wpdevart_comment_title_text'],
			"title_text_color"					=> $this->params['wpdevart_comment_title_text_color'],
			"title_text_font_size"				=> $this->params['wpdevart_comment_title_text_font_size'],
			"title_text_font_famely"			=> $this->params['wpdevart_comment_title_text_font_famely'],
			"title_text_position"				=> $this->params['wpdevart_comment_title_text_position'],
			"width"								=> $this->params['wpdevart_comments_box_width'],
			"count_of_comments"					=> $this->params['wpdevart_comments_box_count_of_comments'],			
			"locale"							=> $this->params['wpdevart_comments_box_locale'],
		), $atts, 'wpdevart_facebook_comment' );
		return  wpdevart_comment_setting::generete_iframe_by_array($atts);
	}

    /*############  Generate Facebook_Js_SDK function  ################*/	
	
	public function generete_facbook_js_sdk(){
		?>
        <div id="fb-root"></div>
        <script>(function(d, s, id) {
          var js, fjs = d.getElementsByTagName(s)[0];
          if (d.getElementById(id)) return;
          js = d.createElement(s); js.id = id;
          js.src = "//connect.facebook.net/<?php echo $this->params['wpdevart_comments_box_locale']; ?>/sdk.js#xfbml=1&appId=<?php echo $this->params['wpdevart_comment_facebook_app_id']; ?>&version=v2.3";
          fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));</script>	
    <?php
	}
	/*Function for creating content iframe*/

}
?>