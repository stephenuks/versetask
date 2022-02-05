<?php

use craft\elements\Entry;
use craft\helpers\UrlHelper;

return [
    'endpoints' => [
		// Return all entry from home - website
        'allentry.json' => function() {
            return[
                'elementType' => Entry::class,
                'criteria' => ['section' => 'home'],	// criteria to define which section is selected
                'transformer' => function(Entry $entry) {
                    $imgMainBackgound = $entry->imagemainbackgound->one();
					$contentMessage = [];
					$contentType = [];
					//foreach ($entry->matrixlowercontent as $block) {
					foreach ($entry->getFieldValue('matrixlowercontent')->all() as $block) {
						switch ($block->type->handle) {
							case 'textmessage':
								$contentType[] = [
									'textmessage' => $block->textmessage->getParsedContent(),
								];
								break;
						}
						//$contentType[] = $entry->getFieldValue('matrixlowercontent')->all();
						//$contentList[] = ['textmessage' => $entry->matrixlowercontent->textmessage];
						//$contentMessage[] = $entry->getParsedContent();
					}
					

                    return [
						'TextContentCenterMain' => $entry->textcontentcentermain,
						'TextContentCenterDetail' => $entry->textcontentcenterdetail,
						'BackgroundImage' => $imgMainBackgound ? $imgMainBackgound->getUrl(['height' => 0]) : null,
						'ContentType' => $contentType,
						//'ContentMessage' => $contentMessage,
                    ];
                },
                'meta' => [
                    'type' => 'sitedata'
                ],
            ];
        },
		// Return all image entry from home - website
		'image.json' => function() {
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