<?php
    // 1. customize ACF path
    add_filter('acf/settings/path', 'jegaden_acf_settings_path');
    function jegaden_acf_settings_path( $path ) {
        $path = get_stylesheet_directory() . '/lib/acf/';
        return $path;
    }

    // 2. customize ACF dir
    add_filter('acf/settings/dir', 'jegaden_acf_settings_dir');
    function jegaden_acf_settings_dir( $dir ) {
    $dir = get_stylesheet_directory_uri() . '/lib/acf/';
    return $dir;
    }

    // 3. Hide ACF field group menu item
    //add_filter('acf/settings/show_admin', '__return_false');

    // 4. Include ACF
    include_once( get_stylesheet_directory() . '/lib/acf/acf.php' );

    // 5. Unhide native metabox
    add_filter('acf/settings/remove_wp_meta_box', '__return_false');

    /** Create Options Pages */
    if( function_exists('acf_add_options_page') ) {
        acf_add_options_page(array(
            'page_title' 	=> 'Globals',
            'menu_title'	=> 'Globals',
            'menu_slug' 	=> 'globals',
            'capability'	=> 'edit_posts',
            'redirect'		=> false
        ));
    }



    function jegaden_blockgrid_gallery( $output, $atts, $instance ) {
        $atts = shortcode_atts( array(
          'order'   => 'ASC',
          'orderby' => 'menu_order ID',
          'id'      => get_the_ID(),
          'columns' => 3,
          'size'    => 'thumbnail',
          'include' => '',
          'exclude' => '',
          ), $atts );

        $atts[ 'columns' ] = 3;

        if ( ! empty( $atts['include'] ) ) {
          $_attachments = get_posts( array( 'include' => $atts['include'], 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $atts['order'], 'orderby' => $atts['orderby'] ) );

          $attachments = array();
          foreach ( $_attachments as $key => $val ) {
            $attachments[$val->ID] = $_attachments[$key];
          }
        } elseif ( ! empty( $atts['exclude'] ) ) {
          $attachments = get_children( array( 'post_parent' => intval( $atts[ 'id' ] ), 'exclude' => $atts['exclude'], 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $atts['order'], 'orderby' => $atts['orderby'] ) );
        } else {
          $attachments = get_children( array( 'post_parent' => intval( $atts[ 'id' ] ), 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $atts['order'], 'orderby' => $atts['orderby'] ) );
        }

        if ( empty( $attachments ) )
          return '';
        $galleryid='psgallery-'.rand(10,99);

        $output = '<div id="'.$galleryid.'" class="psgallery psgallery--incontent" itemscope itemtype="http://schema.org/ImageGallery">';
        $i=0;
        foreach ( $attachments as $id => $attachment ) {
          $img        = wp_get_attachment_image_url( $id, $atts[ 'size' ] );
          $thumb      = wp_get_attachment_image_src( $id, $atts[ 'size' ] );
          $img_srcset = wp_get_attachment_image_srcset( $id, $atts[ 'size' ] );
          $img_full   = wp_get_attachment_image_url( $id, 'xlarge' );
          $image      = wp_get_attachment_image_src( $id, 'xlarge' );

          $caption = ( ! $attachment->post_excerpt ) ? '' : ' data-caption="' . esc_attr( $attachment->post_excerpt ) . '" ';
          $imgtitle = ( ! $attachment->post_excerpt ) ? '' : ' data-title="' . esc_attr( $attachment->post_excerpt ) . '" ';


            $ratio=100;
            if ($thumb) {
                $ratio = $thumb[2] / $thumb[1] * 100;
            }


          $output .= '<figure class="psgallery__item" data-aos-anchor="#'.$galleryid.'" itemprop="associatedMedia" itemscope itemtype="http://schema.org/ImageObject">'
            . '<a href="' . esc_url( $img_full ) . '" class="thumbnail" itemprop="contentUrl" '.$caption.' '.$imgtitle.'" data-size="'.$image['1'].'x'.$image['2'].'" style="padding-bottom: '.$ratio.'%">'
            . '<img width="'.$thumb['1'].'" height="'.$thumb['2'].'" src="' . esc_url( $img ) . '" ' . $caption . ' itemprop="thumbnail" alt="' . esc_attr( $attachment->title ) . '"  srcset="' . esc_attr( $img_srcset ) . '" sizes="(max-width: 50em) 87vw, 680px" />'
            . '</a>';
            $output .= (! $attachment->post_excerpt) ? '' : '<figcaption>'.esc_attr( $attachment->post_excerpt ).'</figcaption>';
            $output .= '</figure>';
        }
        $output .= '<div class="censoroverlay"><p>The following pictures may disturb the spiritual calm of some of our viewers.</p><a class="button small js-togglecensoroverlay" href="#">Show Pictures</a></div>';
        $output .= '</div>';
        //$output .= file_get_contents(get_stylesheet_directory_uri() . '/templates/photoswipedom.php');
        $output.='
      <div class="pswp" tabindex="-1" role="dialog" aria-hidden="true">
          <div class="pswp__bg"></div>
          <div class="pswp__scroll-wrap">
              <div class="pswp__container">
                  <div class="pswp__item"></div>
                  <div class="pswp__item"></div>
                  <div class="pswp__item"></div>
              </div>
              <div class="pswp__ui pswp__ui--hidden">

                  <div class="pswp__top-bar">
                      <div class="pswp__counter"></div>
                      <button class="pswp__button pswp__button--close" title="Close (Esc)"></button>
                      <button class="pswp__button pswp__button--share" title="Share"></button>
                      <button class="pswp__button pswp__button--fs" title="Toggle fullscreen"></button>
                      <button class="pswp__button pswp__button--zoom" title="Zoom in/out"></button>

                      <div class="pswp__preloader">
                          <div class="pswp__preloader__icn">
                            <div class="pswp__preloader__cut">
                              <div class="pswp__preloader__donut"></div>
                            </div>
                          </div>
                      </div>
                  </div>

                  <div class="pswp__share-modal pswp__share-modal--hidden pswp__single-tap">
                      <div class="pswp__share-tooltip"></div>
                  </div>

                  <button class="pswp__button pswp__button--arrow--left" title="Previous (arrow left)">
                  </button>

                  <button class="pswp__button pswp__button--arrow--right" title="Next (arrow right)">
                  </button>

                  <div class="pswp__caption">
                      <div class="pswp__caption__center"></div>
                  </div>

              </div>
          </div>
      </div>

        ';

        return $output;
      }
      add_filter( 'post_gallery', 'jegaden_blockgrid_gallery', 10, 3 );
