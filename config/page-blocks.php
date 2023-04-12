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
    'name' => 'qoute_without_heading',
    'sample' => 'qoute_without_heading.png',
    'data' => [
      'qoute_text'=>['name'=>'qoute_text', 'type'=>'text'],
      'author'=>['name'=>'author','type'=>'text'],
    ],
  ],

  'qoute_with_heading' => [
    'name' => 'qoute_with_heading',
    'sample' => 'qoute_with_heading.png',
    'data' => [
      'heading'=>['name'=>'heading', 'type'=>'text'],
      'qoute_text'=>['name'=>'qoute_text', 'type'=>'text'],
      'author'=>['name'=>'author','type'=>'text'],
    ],
  ],



  'products_showcase' => [
    'name' => 'products_showcase',
    'sample' => 'products_showcase.png',
    'data' => [
      'heading'=>['name'=>'heading','type'=>'text'],
      'products'=>['name'=>'products','type'=>'table']
    ],
  ],





  //our story sections files


/*  'our_story_text_one' => [
    'name' => 'our-story-text',
    'sample' => 'our_story_text_one.png',
    'data' => [
      'header',
      'heading',
      'subheading',
    ],
  ],*/



  'right_image_with_text' => [
    'name' => 'right_image_with_text',
    'sample' => 'right_image_with_text.png',
    'data' => [
      'heading'=>['name'=>'heading','type'=>'text'],
      'image'=>['name'=>'image','type'=>'file'],
    ],
  ],

  'paragraph' => [
    'name' => 'paragraph',
    'sample' => 'paragraph.png',
    'data' => [
      'paragraph'=>['name'=>'paragraph','type'=>'text'],
    ],
  ],

  'left_image_with_text' => [
    'name' => 'left_image_with_text',
    'sample' => 'left_image_with_text.png',
    'data' => [
      'heading'=>['name'=>'heading','type'=>'text'],
      'image'=>['name'=>'image','type'=>'file'],
    ],
  ],

  'multiple_images' => [
    'name' => 'multiple_images',
    'sample' => 'multiple_images.png',
    'data' => [
    'image'=>['name'=>'image','type'=>'file'],

    ],
  ],

  //Hours+Location sections files
  'hour_image_text' => [
    'name' => 'hour_image_text',
    'sample' => 'hour_image_text.png',
    'data' => [
      'heading'=>['name'=>'heading','type'=>'text'],
      'link'=>['name'=>'link','type'=>'url'],
      'phone'=>['name'=>'phone','type'=>'number'],
      'subheading'=>['name'=>'subheading','type'=>'text'],
      'image'=>['name'=>'image','type'=>'file'],

    ],
  ],

  //Direction(map at footer in hour+location) missing

  //Menus sections files
  'caffe_menu' => [
    'name' => 'cafe_menu',
    'sample' => 'cafe_menu.png',
    'data' => [
      'button'=>['name'=>'button','type'=>'button'],
      'navbar'=>['name'=>'button','type'=>'cafe_menu']
    ],
  ],

  // News and Events

  'news_images' => [
    'name' => 'news_images',
    'sample' => 'news_images.png',
    'data' => [
      'images'=>['name'=>'images','type'=>'files'],
      'subheading'=>['name'=>'subheading','type'=>'text'],
      'phone'=>['name'=>'phone','type'=>'number'],
      'button'=>['name'=>'button','type'=>'button'],

    ],
  ],

];



