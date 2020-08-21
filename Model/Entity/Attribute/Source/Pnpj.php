<?php

namespace Pnpj\Customer\Model\Entity\Attribute\Source;

use Magento\Eav\Model\Entity\Attribute\Source\AbstractSource;

class Pnpj extends AbstractSource
{
	public function getAllOptions()
	{
		return [
			'pessoa_fisica' => [
				'label' => 'Pessoa física',
				'value' => '1'
			],
			'pessoa_juridica' => [
				'label' => 'Pessoa jurídica',
				'value' => '2'
			]
		];
	}
}
