<?php 

return (object) $blocks = [
  //index sections files

  'ranking' => [
    'name' => 'ranking',
    'sample' => 'ranking.png',
    'data' => [
      'heading_one'=>['name'=>'heading_one','type'=>'text'],
      'subheading_one'=>['name'=>'subheading_one','type'=>'text'],
      'heading_two'=>['name'=>'heading_two','type'=>'text'],
      'subheading_two'=>['name'=>'subheading_two','type'=>'text'],
    ],
  ],




  'table_reservation' => [
    'name' => 'table_reservation',
    'sample' => 'table_reservation.png',
    'data' => [
      'heading'=>['name'=>'heading','type'=>'text'],
      'sub_heading'=>['name'=>'sub_heading','type'=>'text'],
      'button_text'=>['name'=>'button_text','type'=>'text'],
      'image'=>['name'=>'image','type'=>'file'],
    ],
  ],





  'follow_up_section_with_right_image' => [
    'name' => 'follow_up_section_with_right_image',
    'sample' => 'follow_up_section_with_right_image.png',
    'data' => [
      'heading'=>['name'=>'heading','type'=>'text'],
      'sub_heading'=>['name'=>'sub_heading','type'=>'text'],
      'link'=>['name'=>'link','type'=>'url'],
      'image'=>['name'=>'image','type'=>'file'],
    ],
  ],




  'follow_up_section_with_left_image' => [
    'name' => 'celebrate',
    'sample' => 'follow_up_section_with_left_image.png',
    'data' => [
      'image'=>['name'=>'image','type'=>'file'],
      'heading'=>['name'=>'heading','type'=>'text'],
      'sub_heading'=>['name'=>'sub_heading','type'=>'text'],
      'link'=>['name'=>'link','type'=>'url'],
    ],
  ],





  'follow_up_section_with_background_image' => [
    'name' => 'food-drink',
    'sample' => 'follow_up_section_with_background_image.png',
    'data' => [
      'heading'=>['name'=>'heading','type'=>'text'],
      'sub_heading'=>['name'=>'sub_heading','type'=>'text'],
      'link'=>['name'=>'link','type'=>'url'],
      'background_image'=>['name'=>'background_image','type'=>'file'],
    ],
  ],







  //welcome sections files 


  'qoute_without_heading' => [
    'name' => 'welcome-center-text',
    'sample' => 'qoute_without_heading.png',
    'data' => [
      'qoute_text'=>['name'=>'qoute_text', 'type'=>'text'],
      'author'=>['name'=>'author','type'=>'text'],
    ],
  ],

  'qoute_with_heading' => [
    'name' => 'our-story-text',
    'sample' => 'qoute_with_heading.png',
    'data' => [
      'qoute_text'=>['name'=>'qoute_text', 'type'=>'text'],
      'author'=>['name'=>'author','type'=>'text'],
    ],
  ],



  'products_showcase' => [
    'name' => 'welcome-images',
    'sample' => 'products_showcase.png',
    'data' => [
      'heading'=>['name'=>'heading','type'=>'text'],
      'products'=>['name'=>'products','type'=>'table']
    ],
  ],





  //our story sections files


  'our_story_text_one' => [
    'name' => 'our-story-text',
    'sample' => 'our_story_text_one.png',
    'data' => [
      'header',
      'heading',
      'subheading',
    ],
  ],

  'our_story_one' => [
    'name' => 'our-story-one',
    'sample' => 'our_story_one.png',
    'data' => [
      'heading',
      'image',
    ],
  ],

  'our_story_text_two' => [
    'name' => 'our-story-center-text',
    'sample' => 'our_story_text_two.png',
    'data' => [
      'heading',
    ],
  ],

  'our_story_two' => [
    'name' => 'our-story-two',
    'sample' => 'our_story_two.png',
    'data' => [
      'image',
      'heading',
    ],
  ],

  'our_story_footer_images' => [
    'name' => 'our-story-footer-img',
    'sample' => 'our_story_footer_images.png',
    'data' => [
      'images',
    ],
  ],

  //Hours+Location sections files
  'hour_image_text' => [
    'name' => 'hour-image-text',
    'sample' => 'hour_image_text.png',
    'data' => [
      'heading',
      'link',
      'phone',
      'subheading',
      'image',
    ],
  ],

  //Direction missing

  //Menus sections files
  'menus_nav' => [
    'name' => 'menus-nav',
    'sample' => 'menus_nav.png',
    'data' => [
      'button',
      'nav-bar',
    ],
  ],

  // News and Events

  'news_images' => [
    'name' => 'news-footer-images',
    'sample' => 'news_images.png',
    'data' => [
      'images',
      'subheading',
      'button',
    ],
  ],

];



