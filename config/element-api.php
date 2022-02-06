<?php

use craft\elements\Entry;
use craft\helpers\UrlHelper;

return [
    'endpoints' => [
		// Return all entry from home - website
        'allentry.json' => function() {	// JSON file name - http://localhost/craft/web/allentry.json
            return[
                'elementType' => Entry::class,
                'criteria' => ['section' => 'home'],	// criteria to define which section is selected
                'transformer' => function(Entry $entry) {
                    $imgMainBackgound = $entry->imagemainbackgound->one();
					$contentMessageList = [];
					
					// Loop for store message list
					foreach ($entry->getFieldValue('matrixlowercontent')->all() as $block) {
						switch ($block->type->handle) {
							case 'textmessage':
								$contentMessageList[] = [
									'textmessage' => $block['textmessage'],
								];
								break;
						}
					}
					

                    return [
						'TextContentCenterMain' => $entry->textcontentcentermain,
						'TextContentCenterDetail' => $entry->textcontentcenterdetail,
						'BackgroundImage' => $imgMainBackgound ? $imgMainBackgound->getUrl(['height' => 0]) : null,
						'ContentList' => $contentMessageList,
                    ];
                },
                'meta' => [
                    'type' => 'sitedata'
                ],
            ];
        },
		// Return all image entry from home - website
		'image.json' => function() {	// JSON file name - http://localhost/craft/web/image.json
            return[
                'elementType' => Entry::class,
                'criteria' => ['section' => 'home'],	// criteria to define which section is selected
                'transformer' => function(Entry $entry) {
                    $imgMainBackgound = $entry->imagemainbackgound->one();

                    return [
						'BackgroundImage' => $imgMainBackgound ? $imgMainBackgound->getUrl(['height' => 0]) : null,
                    ];
                },
                'meta' => [
                    'type' => 'sitedata'
                ],
            ];
        },
    ]
];