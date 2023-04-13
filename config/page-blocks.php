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
      'button_text'=>['name'=>'button_text','type'=>'text'],
      'link'=>['name'=>'link','type'=>'url'],
      'image'=>['name'=>'image','type'=>'file'],
    ],
  ],




  'follow_up_section_with_left_image' => [
    'name' => 'follow_up_section_with_left_image',
    'sample' => 'follow_up_section_with_left_image.png',
    'data' => [
      'image'=>['name'=>'image','type'=>'file'],
      'heading'=>['name'=>'heading','type'=>'text'],      
      'sub_heading'=>['name'=>'sub_heading','type'=>'text'],
      'button_text'=>['name'=>'button_text','type'=>'button_text'],
      'link'=>['name'=>'link','type'=>'url'],
    ],
  ],





  'follow_up_section_with_background_image' => [
    'name' => 'follow_up_section_with_background_image',
    'sample' => 'follow_up_section_with_background_image.png',
    'data' => [
      'heading'=>['name'=>'heading','type'=>'text'],
      'sub_heading'=>['name'=>'sub_heading','type'=>'text'],
      'button_text'=>['name'=>'button_text','type'=>'button_text'],      
      'link'=>['name'=>'link','type'=>'url'],
      'background_image'=>['name'=>'background_image','type'=>'file'],
    ],
  ],







  //welcome sections files 


  'qoute_without_heading' => [
    'name' => 'qoute_without_heading',
    'sample' => 'qoute_without_heading.png',
    'data' => [
      'qoute_text'=>['name'=>'qoute_text', 'type'=>'text', 'class'=>'editor'],
    ],
  ],

  'qoute_with_heading' => [
    'name' => 'qoute_with_heading',
    'sample' => 'qoute_with_heading.png',
    'data' => [
      'heading'=>['name'=>'heading', 'type'=>'text'],
      'qoute_text'=>['name'=>'qoute_text', 'type'=>'text', 'class'=>'editor'],
    ],
  ],



  'products_showcase' => [
    'name' => 'products_showcase',
    'sample' => 'products_showcase.png',
    'data' => [
      'heading'=>['name'=>'heading','type'=>'text'],
      'products'=>['name'=>'product_showcase','type'=>'table']
    ],
  ],




  'right_image_with_text' => [
    'name' => 'right_image_with_text',
    'sample' => 'right_image_with_text.png',
    'data' => [
      'text'=>['name'=>'text','type'=>'text', 'class'=>'editor'],
      'image'=>['name'=>'image','type'=>'file'],
    ],
  ],

  'paragraph' => [
    'name' => 'paragraph',
    'sample' => 'paragraph.png',
    'data' => [
      'paragraph'=>['name'=>'paragraph','type'=>'text', 'class'=>'editor'],
    ],
  ],

  'left_image_with_text' => [
    'name' => 'left_image_with_text',
    'sample' => 'left_image_with_text.png',
    'data' => [
      'text'=>['name'=>'text','type'=>'text','class'=>'editor'],
      'image'=>['name'=>'image','type'=>'file'],
    ],
  ],

  //Hours+Location sections files
  'hours_and_location' => [
    'name' => 'hours_and_location',
    'sample' => 'hours_and_location.png',
    'data' => [
      'opening_hours'=>['name'=>'opening_hours','type'=>'text', 'class'=>'editor'],
      'map'=>['name'=>'map','type'=>'file'],
      'video_url'=>['name'=>'video_url','type'=>'text'],
      'kiosk_opening_hours'=>['name'=>'kiosk_opening_hours','type'=>'text', 'class'=>'editor'],

    ],
  ],

  //Menus sections files
  'menu' => [
    'name' => 'cafe_menu',
    'sample' => 'cafe_menu.png',
    'data' => [

    ],
  ],

  // News and Events

  'news_and_popups' => [
    'name' => 'news_and_popups',
    'sample' => 'news_and_popups.png',
    'data' => [
      'heading'=>['name'=>'heading','type'=>'text'],
      'text'=>['name'=>'text','type'=>'text'],
      'new_popups'=>['name'=>'new_popups','type'=>'table']

    ],
  ],

];



