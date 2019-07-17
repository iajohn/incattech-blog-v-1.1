<?php

return [
    'app' => [
            'title' => 'General Contact Settings',
            'desc' => 'Application general Contact settings.', // (optional)
            'icon' => 'material-icons settings', // (optional)

            'elements' => [
            	// site name
                [
                    'name' => 'site_name', // unique key for setting
                    'type' => 'text', // type of input can be text, number, textarea, select, boolean, checkbox etc.
                    'label' => "Company's Name", // label for input
                    // optional properties
                    'placeholder' => "Enter Company's Name", // placeholder for input
                    'class' => 'form-control', // override global input_class
                    'style' => '', // any inline styles
                    'rules' => 'required|min:2|max:20', // validation rules for this input
                    'value' => '', // any default value
                    'hint' => "You can set the company's name here" // help block text for input
            	],
            	
            	// site logo
            	// [
             //        'name' => 'logo',
             //        'type' => 'file',
             //        'label' => 'Upload logo',
             //        'hint' => 'Must be an image and cropped in desired size',
             //        // 'rules' => 'image|max:500'
             //    ],

				// number
				[
				    'name' => 'number',
				    'type' => 'text',
				    'label' => "Company's Number",
				    // optional fields
				    // 'data_type' => '',
				    'min' => 5,
				    'max' => 100,
				    'rules' => 'required|min:5|max:100',
				    'placeholder' => "Company's Number",
				    'class' => 'form-control',
				    'style' => 'color:red',
				    'hint' => "You can set the company's number."
				],

				// email
				[
                    'name' => 'email',
                    'type' => 'email',
                    'label' => "Company's Email Address",
                    'placeholder' => 'Enter Email Address',
                    'rules' => 'required|email',
                    'hint' => "You can set the company's email address.",
                ],

                // webmail
                [
                    'name' => 'webemail',
                    'type' => 'email',
                    'label' => "Company's Webmail Address",
                    'placeholder' => 'Enter Webmail Address',
                    'rules' => 'required|email',
                    'hint' => "You can set the company's webemail address.",
                ],

                // address
                [
				    'name' => 'adress',
                    'type' => 'textarea',
                    'label' => "Company's Address",
				    'rows' => 5,
				    'cols' => 10,
				    'placeholder' => "Enter Company's Address",
				    'hint' => "company's address goes here.",
				],
				
            ]

        ],

    'social' => [

        'title' => 'Social Media',
        'desc' => 'Social media account settings',
        'icon' => 'glyphicon glyphicon-telephone',

        'elements' => [
                [
                    'name' => 'facebook',
                    'type' => 'text',
                    'label' => 'Facebook Address',
                    'placeholder' => 'Enter Facebook Address',
                    'value'	=> 'https://www.facebook.com/',
                    'rules' => 'required|url',
                    'hint' => "enter company's facebook address here.",
                ],

                [
                    'name' => 'instagram',
                    'type' => 'text',
                    'label' => 'Instagram Address',
                    'placeholder' => 'Enter Instagram Address',
                    'value'	=> 'https://www.instagram.com/',
                    'rules' => 'required|url',
                    'hint' => "enter company's instagram address here.",
                ],

                [
                    'name' => 'twitter',
                    'type' => 'text',
                    'label' => 'Twitter Address',
                    'placeholder' => 'Enter Twitter Address',
                    'value'	=> 'https://www.twitter.com/',
                    'rules' => 'required|url',
                    'hint' => "enter company's twitter address here.",
                ],

                [
                    'name' => 'youtube',
                    'type' => 'text',
                    'label' => 'YouTube Address',
                    'placeholder' => 'Enter YouTube Address',
                    'value'	=> 'https://www.youtube.com/',
                    'rules' => 'required|url',
                    'hint' => "enter company's youtube address here.",
                ],

                [
                    'name' => 'whatsapp',
                    'type' => 'text',
                    'label' => 'WhatsApp Address',
                    'placeholder' => 'Enter WhatsApp Address',
                    'value'	=> 'https://www.whatsapp.com/',
                    'rules' => 'required|url',
                    'hint' => "enter company's whatsapp address here.",
                ],
                
            ]
    ],

    // 'about_us' => [

    //     'title' => 'About Us',
    //     'desc' => 'About settings for the company',
    //     'icon' => 'glyphicon glyphicon-building',

    //     'elements' => [
    //     		// about us
    //             [
				//     'name' => 'about_us',
    //                 'type' => 'textarea',
    //                 'label' => 'About Us',
				//     'rows' => 4,
				//     'cols' => 10,
				//     'placeholder' => 'Enter Email Address',
				//     'hint' => "You can set the company's about us content here.",
				// ],

				// // about us featured image
    //             [
    //                 'name' => 'about_img',
    //                 'type' => 'file',
    //                 'label' => 'Upload About Us Image',
    //                 'hint' => 'Must be an image and cropped in desired size',
    //                 // 'rules' => 'image|max:5000'
    //             ],
                
    //         ]
    // ],

    // 'policy' => [

    //     'title' => 'Private Policy',
    //     'desc' => 'Private Policy settings for the company',
    //     'icon' => 'glyphicon glyphicon-building',

    //     'elements' => [
    //     		// about us
    //             [
				//     'name' => 'private_policy',
    //                 'type' => 'textarea',
    //                 'label' => 'Private Policy',
				//     'rows' => 4,
				//     'cols' => 10,
				//     'placeholder' => 'Enter Email Address',
				//     'hint' => "You can set the company's private policy content here.",
				// ],

				// // about us featured image
    //             [
    //                 'name' => 'private_policy_img',
    //                 'type' => 'file',
    //                 'label' => 'Upload Private Policy Image',
    //                 'hint' => 'Must be an image and cropped in desired size',
    //                 // 'rules' => 'image|max:5000'
    //             ],
                
    //         ]
    // ],
];