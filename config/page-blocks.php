<?php 

return (object) $blocks = [
  //index sections files

  'ranking' => [
    'title'=>'Ranking',
    'name' => 'ranking.blade.php',
    'data' => [
      'heading_one'=>['name'=>'heading_one','type'=>'text'],
      'subheading_one'=>['name'=>'subheading_one','type'=>'text'],
      'heading_two'=>['name'=>'heading_two','type'=>'text'],
      'subheading_two'=>['name'=>'subheading_two','type'=>'text'],
    ],
  ],




  'table_reservation' => [
    'name' => 'book-table.blade.php',
    'data' => [
      'heading'=>['name'=>'heading','type'=>'text'],
      'sub_heading'=>['name'=>'sub_heading','type'=>'text'],
      'button_text'=>['name'=>'button_text','type'=>'text'],
      'image'=>['name'=>'image','type'=>'file'],
    ],
  ],





  'follow_up_section_with_right_image' => [
    'name' => 'book-table.blade.php',
    'data' => [
      'heading'=>['name'=>'heading','type'=>'text'],
      'sub_heading'=>['name'=>'sub_heading','type'=>'text'],
      'link'=>['name'=>'link','type'=>'url'],
      'image'=>['name'=>'image','type'=>'file'],
    ],
  ],




  'follow_up_section_with_left_image' => [
    'name' => 'celebrate.blade.php',
    'data' => [
      'image'=>['name'=>'image','type'=>'file'],
      'heading'=>['name'=>'heading','type'=>'text'],
      'sub_heading'=>['name'=>'sub_heading','type'=>'text'],
      'link'=>['name'=>'link','type'=>'url'],
    ],
  ],





  'follow_up_section_with_background_image' => [
    'name' => 'food-drink.blade.php',
    'data' => [
      'heading'=>['name'=>'heading','type'=>'text'],
      'sub_heading'=>['name'=>'sub_heading','type'=>'text'],
      'link'=>['name'=>'link','type'=>'url'],
      'background_image'=>['name'=>'background_image','type'=>'file'],
    ],
  ],







  //welcome sections files 


  'qoute_without_heading' => [
    'name' => 'welcome-center-text.blade.php',
    'data' => [
      'qoute_text'=>['name'=>'qoute_text', 'type'=>'text'],
      'author'=>['name'=>'author','type'=>'text'],
    ],
  ],

  'qoute_with_heading' => [
    'name' => 'our-story-text.blade.php',
    'data' => [
      'qoute_text'=>['name'=>'qoute_text', 'type'=>'text'],
      'author'=>['name'=>'author','type'=>'text'],
    ],
  ],



  'products_showcase' => [
    'name' => 'welcome-images.blade.php',
    'data' => [
      'heading'=>['name'=>'heading','type'=>'text'],
      'products'=>['name'=>'products','type'=>'table']
    ],
  ],





  //our story sections files


  'our_story_text1' => [
    'name' => 'our-story-text.blade.php',
    'data' => [
      'header',
      'heading',
      'subheading',
    ],
  ],

  'our_story_one' => [
    'name' => 'our-story-one.blade.php',
    'data' => [
      'heading',
      'image',
    ],
  ],

  'our_story_text2' => [
    'name' => 'our-story-center-text.blade.php',
    'data' => [
      'heading',
    ],
  ],

  'our_story_two' => [
    'name' => 'our-story-two.blade.php',
    'data' => [
      'image',
      'heading',
    ],
  ],

  'our_story_footer_images' => [
    'name' => 'our-story-footer-img.blade.php',
    'data' => [
      'images',
    ],
  ],

  //Hours+Location sections files
  'hour_image_text' => [
    'name' => 'hour-image-text.blade.php',
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
    'name' => 'menus-nav.blade.php',
    'data' => [
      'button',
      'nav-bar',
    ],
  ],

  // News and Events

  'news_images' => [
    'name' => 'news-footer-images.blade',
    'data' => [
      'images',
      'subheading',
      'button',
    ],
  ],

];



